
// On va avoir 4 parties : un pour la vue "index", un pour le tracker, un pour le show, et enfin un pour le pannel de navigation.

// 1- La vue index est un container qui contient 3 vues : l'index des monstres, l'index des players, et l'index de toutes les unités.
// 2- Le tracker un container qui contient la liste des unités de l'encounter, triées par ordre d'initiative, et qui aura un effet de carousel.
// 3- Le show contient les détails de l'unité cliquée, il s'agit d'un turbo-frame.
// 4- Les boutons de navigation sont dans le pannel, c'est un container à part, qui permet de passer à l'unité suivante ou précédente.


// 1- En bas à gauche de la page, on a un container qui contient 3 vues.
// La première vue est l'index des monstres, la deuxième est l'index des players, et la troisième est l'index des unités. Par défaut on affiche l'index des monstres.
// Ces 3 index sont des listes d'unités triées par ordre alphabétique.
// Au click sur un bouton "monsters", "players" ou "all", on affiche l'index correspondant.
// Cependant, on charge les 3 index en même temps, et on les cache ou on les affiche en fonction du bouton cliqué.
// On doit pouvoir mettre à jour les détails d'une unité dans son index.
// Lorsqu'on modifie ainsi une unité, il doit alors y avoir une mise à jour des informations de l'unité modifiée, à la fois dans le local storage, dans les index, et dans le tracker d'unité active.
// On pourra changer de vue en cliquant sur les boutons "monsters", "players" et "all".



// 2- En haut de la page, on a un container qui contient l'index des unités, on l'appellera le tracker d'unité active ou activeUnitTracker ou encore simplement tracker.
// Il s'agira d'un carousel qui affiche 3 unités : l'unité active, l'unité précédente et l'unité suivante.
// Si le nombre d'unités est inférieur ou égal à 3, on n'affiche que les unités présentes.

// l'objectif est de récupérer les données de l'encounter dans le local storage, puis de les afficher dans un container.
// Il s'agira de la liste des unités de l'encounter, triées par ordre d'initiative.
// Au début de l'encounter, l'unité active est la première de la liste. Elle est mise en valeur dans le tracker.
// Lorsqu'on clique sur le bouton "next", on passe à l'unité suivante, et on met à jour le tracker.
// Lorsqu'on clique sur le bouton "previous", on passe à l'unité précédente, et on met à jour le tracker.
// Si une unité est KO, elle est barrée dans le tracker et on passe à l'unité suivante.
// Si on est au bout de la liste et qu'on clique sur "next", on va au début de la liste.
// Si on est au début de la liste et qu'on clique sur "previous", on va à la fin de la liste sauf si on est au premier tour.

// On doit donc gérer le nombre de tours.
// Au début de l'encounter, le nombre de tours est à 1.
// Un tour est terminé quand toutes les unités ont joué. Donc quand on clique sur "next" et qu'on est au bout de la liste, on incrémente le nombre de tours.
// Si on clique sur "previous" et qu'on est au début de la liste, on doit décrémenter le nombre de tours, sauf si on est au tour 1.
// On rendra le bouton "previous" inactif si on est au tour 1 et qu'on est au début de la liste des unités.

// Si on clique sur une unité du tracker, on affiche ses détails dans le turbo-frame.
// Si on clique sur un monstre de l'index, on remplace le contenu du turbo-frame par les détails de l'unité cliquée.




// 3- En bas à droite de la page, on a un container qui contient les détails de l'unité cliquée, on l'appellera le show.
// Au clic sur une unité dans l'index comme dans le tracker, on affiche ses détails dans le turbo-frame.

// 4- Entre la partie haute (le tracker) et la partie basse (les index et turbo-frame), on aura un container qui contient les boutons de navigation, on l'appellera le pannel.
// Ce pannel contient 2 boutons : "previous" et "next".
// Il affiche aussi le numéro du tour en cours.

/* ------------------------------------------------------------------------------------------- */
import { Controller } from '@hotwired/stimulus';

let unitsData = null;
console.log('unitsData', unitsData);
export default class extends Controller {

    constructor() {
        super();
        this.monsterIndex = [];
        this.playerIndex = [];
        this.unitIndexAlphaSorted = [];
        this.unitIndexInitiativeSorted = [];
    }

    /* ------------------------------------------------------------------------------------------- */

    connect() {
        this.unitsData = this.loadEncounterData();
        this.initializeIndices();
        // this.initializeTurboFrame();

        console.log(
            'this.unitsData', this.unitsData,
            'this.monsterIndex', this.monsterIndex,
            'this.playerIndex', this.playerIndex,
            'this.unitIndexAlphaSorted', this.unitIndexAlphaSorted,
            'this.unitIndexInitiativeSorted', this.unitIndexInitiativeSorted

        );
    }

    /* ------------------------------------------------------------------------------------------- */

    loadEncounterData() {
        const unitsData = JSON.parse(localStorage.getItem('encounterData'));

        if (!unitsData) {
            return;
        }
        return unitsData || {};
    }

    /* ------------------------------------------------------------------------------------------- */

    stopEncounter() {
        if (!confirm('Attention, toute progression sera perdue, souhaitez-vous quitter ?')) {
            return;
        }
        localStorage.removeItem('encounterData');
        //on redirige vers la page d'accueil
        window.location.href = '/';
    }

    /* ------------------------------------------------------------------------------------------- */

    initializeIndices() {
        for (const unitName in this.unitsData) {
            const unitData = this.unitsData[unitName];

            const unitWithKey = {...unitData, name: unitName};


            if (unitData.isMonster) {
                this.monsterIndex.push(unitWithKey);
            } else {
                this.playerIndex.push(unitWithKey);
            }
            this.unitIndexAlphaSorted.push(unitWithKey);
            this.unitIndexInitiativeSorted.push(unitWithKey);
        }

        //tri par ordre alphabétique
        this.unitIndexAlphaSorted.sort((a, b) => (a.name > b.name) ? 1 : -1);

        //tri par initiative
         this.unitIndexInitiativeSorted.sort((a, b) => (a.initiative > b.initiative) ? -1 : 1);

        //tri par ordre alphabétique des monstres
        this.monsterIndex.sort((a, b) => (a.name > b.name) ? 1 : -1);

        //tri par ordre alphabétique des players
        this.playerIndex.sort((a, b) => (a.name > b.name) ? 1 : -1);
    }




    updateTurboFrame(targetUnit) {
        const turboFrame = document.querySelector("turbo-frame");
        const unitId = targetUnit.dataset.id;
        const unitSrc = targetUnit.dataset.src;
        const unitIsMonster = targetUnit.dataset.isMonster;
        const units = document.querySelectorAll(".unit");
        units.forEach((u) => u.classList.remove("unit-selected"));
        targetUnit.classList.add("unit-selected");

        turboFrame.id = unitIsMonster === 'true' ? 'monster-details-content' : 'player-details-content';
        turboFrame.src = unitSrc;
        currentUnitId = unitId;
        // console.log('currentUnitId :', currentUnitId);
        return currentUnitId;
    }

    initializeTurboFrame() {

        const turboFrame = document.querySelector("turbo-frame");
        if (!turboFrame) {
            return;
        }

        let defaultTargetUnit = null;

        const units = document.querySelectorAll(".unit");
        defaultTargetUnit = units[0];
        this.updateTurboFrame(defaultTargetUnit);

        units.forEach((unit) => {
            unit.addEventListener("click", (event) => {
                this.updateTurboFrame(event.currentTarget);
            });
        });

    }


    /* ------------------------------------------------------------------------------------------- */

    // render(){
    //     this.renderMonsterIndex();
    //     this.renderPlayerIndex();
    //     this.renderUnitIndex();
    //     this.renderTracker();
    //     this.renderShow();
    // }

}