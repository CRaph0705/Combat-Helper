import { Controller } from '@hotwired/stimulus';

// let currentUnitId = null;
let unitsData = null;
console.log('unitsData', unitsData);
export default class extends Controller {


    connect() {
        console.log('unitsData', this.unitsData);
        this.unitsData = this.loadEncounterData();
        console.log('unitsData', this.unitsData);


        this.displayEncounterData();
        // this.displayActiveUnitTracker();
        this.displayEncounterMonstersIndex();


        // // on change the hp of a monster in the encounter-monsters-index, we update the encounterData, then refresh the active unit tracker and the encounterData
        // const encounterMonstersIndex = document.querySelector('.encounter-monsters-index-container');
        // const encounterMonsters = encounterMonstersIndex.querySelectorAll('.unit');
        // encounterMonsters.forEach((encounterMonster) => {
        //     const unitHp = encounterMonster.querySelector('input[name="hp"]');

        //     // dès qu'on change la valeur de l'input, on met à jour l'encounterData, puis on met à jour le tracker et l'encounterData
        //     unitHp.addEventListener('input', () => {
        //         this.updateEncounterData();
        //         this.updateActiveUnitTracker();
        //         console.log('unitsData', this.unitsData);
        //     });
        // // si les hp sont à 0, on ajoute la classe KO à la div de l'unité
        // if (unitHp.value <= 0) {
        //     encounterMonster.classList.add('KO');
        // }
        // }
        // );
    }

    /* ------------------------------------------------------------------------------------------- */

    loadEncounterData() {
        const unitsData = JSON.parse(localStorage.getItem('encounterData'));

        if (!unitsData) {
            return;
        }
        return unitsData;
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

    updateActiveUnitTracker() {
        const unitsData = this.loadEncounterData();
        const activeUnit = document.querySelector('.unit.active');

        if (!activeUnit) {
            return;
        }

        const activeUnitContainer = document.querySelector('.active-unit');
        const previousUnitContainer = document.querySelector('.previous-unit');
        const nextUnitContainer = document.querySelector('.next-unit');

        const unitNames = Object.keys(unitsData);
        const currentIndex = unitNames.findIndex(unitName => unitName === activeUnit.dataset.unitName);

        let previousIndex = (currentIndex - 1 + unitNames.length) % unitNames.length;
        let nextIndex = (currentIndex + 1) % unitNames.length;

        const previousUnit = document.querySelector(`.unit[data-unit-name="${unitNames[previousIndex]}"]`);
        const nextUnit = document.querySelector(`.unit[data-unit-name="${unitNames[nextIndex]}"]`);

        if (previousUnit) {
            previousUnitContainer.innerHTML = previousUnit.innerHTML;
        } else {
            const lastUnit = document.querySelector('.unit:last-child');
            previousUnitContainer.innerHTML = lastUnit.innerHTML;
        }

        if (nextUnit) {
            nextUnitContainer.innerHTML = nextUnit.innerHTML;
        } else {
            const firstUnit = document.querySelector('.unit:first-child');
            nextUnitContainer.innerHTML = firstUnit.innerHTML;
        }

        activeUnitContainer.innerHTML = activeUnit.innerHTML; // Ajout de cette ligne pour mettre à jour l'unité active dans le tracker
    }
    
    /* ------------------------------------------------------------------------------------------- */

    displayActiveUnitTracker() {
        const unitsData = this.loadEncounterData();
        const activeUnit = document.querySelector('.unit.active');

        if (!activeUnit) {
            return;
        }

        const activeUnitContainer = document.querySelector('.active-unit');
        const previousUnitContainer = document.querySelector('.previous-unit');
        const nextUnitContainer = document.querySelector('.next-unit');

        activeUnitContainer.innerHTML = activeUnit.innerHTML;

        const unitNames = Object.keys(unitsData);
        const currentIndex = unitNames.findIndex(unitName => unitName === activeUnit.dataset.unitName);

        let previousIndex = (currentIndex - 1 + unitNames.length) % unitNames.length;
        let nextIndex = (currentIndex + 1) % unitNames.length;

        const previousUnit = document.querySelector(`.unit[data-unit-name="${unitNames[previousIndex]}"]`);
        const nextUnit = document.querySelector(`.unit[data-unit-name="${unitNames[nextIndex]}"]`);

        if (previousUnit) {
            previousUnitContainer.innerHTML = previousUnit.innerHTML;
        } else {
            // Si c'est la première unité, afficher la dernière
            const lastUnit = document.querySelector('.unit:last-child');
            previousUnitContainer.innerHTML = lastUnit.innerHTML;
        }

        if (nextUnit) {
            nextUnitContainer.innerHTML = nextUnit.innerHTML;
        } else {
            // Si c'est la dernière unité, afficher la première
            const firstUnit = document.querySelector('.unit:first-child');
            nextUnitContainer.innerHTML = firstUnit.innerHTML;
        }
    }

    /* ------------------------------------------------------------------------------------------- */

    //if a unit is modified in encounterMonstersIndex, update the encounterData
    updateEncounterData() {
        const unitsData = this.loadEncounterData();
        const encounterMonstersIndex = document.querySelector('.encounter-monsters-index-container');
        const encounterMonsters = encounterMonstersIndex.querySelectorAll('.unit');
        encounterMonsters.forEach((encounterMonster) => {
            const unitName = encounterMonster.dataset.unitName;
            const unitHp = encounterMonster.querySelector('input[name="hp"]').value;
            unitsData[unitName].hp = unitHp;
        }
        );
        localStorage.setItem('encounterData', JSON.stringify(unitsData));
        updateActiveUnitTracker();
    }

    /* ------------------------------------------------------------------------------------------- */

    // displayEncounterData() {
    //     // console.log('displayEncounterData');
    //     const unitsData = this.loadEncounterData();

    //     // Sélectionnez le conteneur où vous souhaitez afficher les éléments
    //     const container = document.querySelector('#encounterUnitsContainer');

    //     // Parcours des données des unités
    //     let isFirstUnit = true;
    //     for (const unitName in unitsData) {
    //         const unitData = unitsData[unitName];

    //         // Création d'une nouvelle div pour chaque unité
    //         const unitDiv = document.createElement('div');
    //         unitDiv.classList.add('unit');
    //         unitDiv.classList.add('unit-parchment');
    //         unitDiv.dataset.id = unitData.id;
    //         unitDiv.dataset.src = unitData.unitSrc;
    //         unitDiv.dataset.unitName = unitName;
    //         unitDiv.dataset.isMonster = unitData.isMonster;
    //         unitDiv.innerHTML = `
    //         <p>${unitName}</p>
    //         <p>AC : ${unitData.ac}</p>
    //         <p>HP : <input type="number" id="hp" name="hp" value="${unitData.hp}" onchange="this.updateEncounterData()">
    //         </p>
    //         `;

    //         if (unitData.hp <= 0) {
    //             unitDiv.classList.add('KO');
    //         }

    //         // Si c'est la première unité, ajouter la classe "active"
    //         if (isFirstUnit) {
    //             unitDiv.classList.add('active');
    //             isFirstUnit = false;
    //         }

    //         // Ajout de la div de l'unité au conteneur
    //         container.appendChild(unitDiv);
    //         // ScrollHeight();


    //         // Ajout de l'écouteur d'événements sur les HP de l'unité
    //         const hpInput = unitDiv.querySelector('input[name="hp"]');
    //         hpInput.addEventListener('input', () => {
    //             if (parseInt(hpInput.value) <= 0) {
    //                 unitDiv.classList.add('KO');
    //             } else {
    //                 unitDiv.classList.remove('KO');
    //             }
    //         });
    //     }

    // }

    displayEncounterData() {
        const unitsData = this.loadEncounterData();
        const container = document.querySelector('#encounterUnitsContainer');
    
        let isFirstUnit = true;
    
        for (const unitName in unitsData) {
            const unitData = unitsData[unitName];
            const unitDiv = document.createElement('div');
    
            unitDiv.classList.add('unit');
            unitDiv.classList.add('unit-parchment');
            unitDiv.dataset.id = unitData.id;
            unitDiv.dataset.src = unitData.unitSrc;
            unitDiv.dataset.unitName = unitName;
            unitDiv.dataset.isMonster = unitData.isMonster;
    
            const unitNameParagraph = document.createElement('p');
            unitNameParagraph.innerText = unitName;
    
            const unitAcParagraph = document.createElement('p');
            unitAcParagraph.innerText = `AC : ${unitData.ac}`;
    
            const unitHpContainerParagraph = document.createElement('p');
            unitHpContainerParagraph.innerText = 'HP : ';
    
            const unitHpParagraph = document.createElement('input');
            unitHpParagraph.type = 'number';
            unitHpParagraph.name = 'hp';
            unitHpParagraph.value = unitData.hp;
            unitHpParagraph.addEventListener('input', () => {
                if (parseInt(unitHpParagraph.value) <= 0) {
                    unitDiv.classList.add('KO');
                } else {
                    unitDiv.classList.remove('KO');
                }
                this.updateEncounterData();
            });
    
            unitDiv.appendChild(unitNameParagraph);
            unitDiv.appendChild(unitAcParagraph);
            unitDiv.appendChild(unitHpContainerParagraph);
            unitHpContainerParagraph.appendChild(unitHpParagraph);
    
            if (unitData.hp <= 0) {
                unitDiv.classList.add('KO');
            }
    
            if (isFirstUnit) {
                unitDiv.classList.add('active');
                isFirstUnit = false;
            }
    
            container.appendChild(unitDiv);
    
            const hpInput = unitDiv.querySelector('input[name="hp"]');
            hpInput.addEventListener('input', () => {
                if (parseInt(hpInput.value) <= 0) {
                    unitDiv.classList.add('KO');
                } else {
                    unitDiv.classList.remove('KO');
                }
                this.updateEncounterData();
            });
        }
    }
    
    /* ------------------------------------------------------------------------------------------- */









    /* ------------------------------------------------------------------------------------------- */


    /* ------------------------------------------------------------------------------------------- */
    displayEncounterMonstersIndex() {
        console.log('displayEncounterMonstersIndex');
        const unitsData = this.unitsData;
        const monsterContainer = document.querySelector('.encounter-monsters-index-container');

        for (const unitName in unitsData) {
            const unitData = unitsData[unitName];

            if (unitData.isMonster === true) {
                // Création d'une nouvelle div pour chaque unité
                const unitDiv = document.createElement('div');

                unitDiv.classList.add('unit');
                unitDiv.classList.add('unit-parchment');
                unitDiv.dataset.id = unitData.id;
                unitDiv.dataset.src = unitData.unitSrc;
                unitDiv.dataset.unitName = unitName;
                unitDiv.dataset.isMonster = unitData.isMonster;

                const unitNameParagraph = document.createElement('p');
                unitNameParagraph.innerText = unitName;

                const unitAcParagraph = document.createElement('p');
                unitAcParagraph.innerText = `AC : ${unitData.ac}`;

                const unitHpContainerParagraph = document.createElement('p');
                unitHpContainerParagraph.innerText = 'HP : ';

                const unitHpParagraph = document.createElement('input');
                unitHpParagraph.type = 'number';
                unitHpParagraph.name = 'hp';
                unitHpParagraph.value = unitData.hp;
                unitHpParagraph.addEventListener('input', () => {
                    if (parseInt(unitHpParagraph.value) <= 0) {
                        unitDiv.classList.add('KO');
                    } else {
                        unitDiv.classList.remove('KO');
                    }
                    this.updateEncounterData();
                });
                unitDiv.appendChild(unitNameParagraph);
                unitDiv.appendChild(unitAcParagraph);
                unitDiv.appendChild(unitHpContainerParagraph);
                unitHpContainerParagraph.appendChild(unitHpParagraph);

                monsterContainer.appendChild(unitDiv);
            }
        }
    }
    /* ------------------------------------------------------------------------------------------- */

    //if a unit is modified in encounterMonstersIndex, update the encounterData
    updateEncounterData() {
        const unitsData = this.loadEncounterData();
        const encounterMonstersIndex = document.querySelector('.encounter-monsters-index-container');
        const encounterMonsters = encounterMonstersIndex.querySelectorAll('.unit');
        encounterMonsters.forEach((encounterMonster) => {
            const unitName = encounterMonster.dataset.unitName;
            const unitHp = encounterMonster.querySelector('input[name="hp"]').value;
            unitsData[unitName].hp = unitHp;
        }
        );
        localStorage.setItem('encounterData', JSON.stringify(unitsData));
        this.updateActiveUnitTracker();
    }


    /* ------------------------------------------------------------------------------------------- */

    /* ------------------------------------------------------------------------------------------- */




    // document.addEventListener('keydown', (event) => {
    //     switch (event.key) {
    //         case 'e':
    //         case 'ArrowRight':
    //         case 'ArrowDown':
    //             this.nextUnit();
    //             break;
    //         case 'a':
    //         case 'ArrowLeft':
    //         case 'ArrowUp':
    //             this.previousUnit();
    //             break;
    //     }
    // });

    // ----------------- TURBO FRAME ----------------- //
    //     const turboFrame = document.querySelector("turbo-frame");
    //     if (!turboFrame) {
    //         return;
    //     }

    //     let currentUnitId = null;
    //     let currentUnitType = null;

    //     const units = document.querySelectorAll(".unit");
    //     // console.log('units :', units);
    //     units[0].classList.add("unit-selected");
    //     turboFrame.id = units[0].dataset.isMonster === 'true' ? 'monster-details-content' : 'player-details-content';
    //     turboFrame.src = units[0].dataset.src;
    //     currentUnitId = units[0].dataset.id;
    //     currentUnitType = units[0].dataset.isMonster === true ? 'monster' : 'player';
    //     // console.log('currentUnitType :', currentUnitType);

    //     units.forEach((unit) => {
    //         unit.addEventListener("click", (event) => {
    //             this.updateTurboFrame(event.currentTarget);
    //         });
    //     });

    // updateTurboFrame(targetUnit) {
    //     const turboFrame = document.querySelector("turbo-frame");
    //     const unitId = targetUnit.dataset.id;
    //     const unitSrc = targetUnit.dataset.src;
    //     const unitIsMonster = targetUnit.dataset.isMonster;
    //     const units = document.querySelectorAll(".unit");
    //     units.forEach((u) => u.classList.remove("unit-selected"));
    //     targetUnit.classList.add("unit-selected");

    //     turboFrame.id = unitIsMonster === 'true' ? 'monster-details-content' : 'player-details-content';
    //     turboFrame.src = unitSrc;
    //     currentUnitId = unitId;
    //     // console.log('currentUnitId :', currentUnitId);
    //     return currentUnitId;
    // }

    //load the data from local storage




    /* ------------------------------------------------------------------------------------------- */
    // nextUnit() {
    //     const unitsData = this.loadEncounterData();
    //     const currentUnit = document.querySelector('.unit.active');

    //     if (!currentUnit) {
    //         // Si aucune unité n'est active, initialiser avec la première unité du tableau
    //         const firstUnit = document.querySelector('.unit');
    //         firstUnit.classList.add('active');
    //         this.updateActiveUnitTracker();
    //         return;
    //     }

    //     // Trouver l'index de l'unité actuelle en parcourant les clés de l'objet
    //     let currentIndex = 0;
    //     for (const unitName in unitsData) {
    //         if (unitName === currentUnit.dataset.unitName) {
    //             break;
    //         }
    //         currentIndex++;
    //     }

    //     // Rechercher la prochaine unité sans la classe KO
    //     let nextIndex = (currentIndex + 1) % Object.keys(unitsData).length;
    //     while (nextIndex !== currentIndex) {
    //         const nextUnitName = Object.keys(unitsData)[nextIndex];
    //         const nextUnit = document.querySelector(`.unit[data-unit-name="${nextUnitName}"]`);

    //         if (!nextUnit.classList.contains('KO')) {
    //             // Supprimer la classe active de l'unité actuelle
    //             currentUnit.classList.remove('active');
    //             // Ajouter la classe active à l'unité suivante
    //             nextUnit.classList.add('active');
    //             // this.updateTurboFrame(nextUnit);
    //             this.updateActiveUnitTracker();

    //             nextUnit.scrollIntoView({ behavior: 'smooth', block: 'center' });
    //             return;
    //         }
    //         nextIndex = (nextIndex + 1) % Object.keys(unitsData).length;
    //     }
    // }


    /* ------------------------------------------------------------------------------------------- */

    // previousUnit() {
    //     const unitsData = this.loadEncounterData();
    //     const currentUnit = document.querySelector('.unit.active');

    //     if (!currentUnit) {
    //         // Si aucune unité n'est active, initialiser avec la dernière unité du tableau
    //         const unitNames = Object.keys(unitsData);
    //         const lastUnitName = unitNames[unitNames.length - 1];
    //         const lastUnit = document.querySelector(`.unit[data-unit-name="${lastUnitName}"]`);
    //         lastUnit.classList.add('active');
    //         return;
    //     }

    //     // Trouver l'index de l'unité actuelle en parcourant les clés de l'objet
    //     let currentIndex = 0;
    //     const unitNames = Object.keys(unitsData);
    //     for (const unitName of unitNames) {
    //         if (unitName === currentUnit.dataset.unitName) {
    //             break;
    //         }
    //         currentIndex++;
    //     }

    //     // Rechercher l'unité précédente sans la classe KO
    //     let previousIndex = (currentIndex - 1 + unitNames.length) % unitNames.length;
    //     while (previousIndex !== currentIndex) {
    //         const previousUnitName = unitNames[previousIndex];
    //         const previousUnit = document.querySelector(`.unit[data-unit-name="${previousUnitName}"]`);

    //         if (!previousUnit.classList.contains('KO')) {
    //             // Supprimer la classe active de l'unité actuelle
    //             currentUnit.classList.remove('active');
    //             // Ajouter la classe active à l'unité précédente
    //             previousUnit.classList.add('active');
    //             // this.updateTurboFrame(previousUnit);
    //             this.updateActiveUnitTracker();

    //             previousUnit.scrollIntoView({ behavior: 'smooth', block: 'center' });
    //             return;
    //         }

    //         previousIndex = (previousIndex - 1 + unitNames.length) % unitNames.length;
    //     }
    // }


    /* ------------------------------------------------------------------------------------------- */

    //stop encounter function



    /* -------------------------------------------- ACTIVE UNIT TRACKER -------------------------------------------- */




    /* ------------------------------------------------------------------------------------------- */




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

    



}