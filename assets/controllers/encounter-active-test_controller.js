
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
import Unit from '../models/unit.js';
import Monster from '../models/monster.js';
import Player from '../models/player.js';
import Swiper from 'swiper';

let encounterData = null;
// console.log('unitsData', encounterData);
export default class extends Controller {

    constructor() {
        super();
        this.monsterIndex = [];
        this.playerIndex = [];
        this.unitIndexAlphaSorted = [];
        this.unitIndexInitiativeSorted = [];
        this.activeUnit = null;
        this.turn = 1;
        this.viewMode = 'compact' || 'full';
        this.swiper = null;
    }

    /* ------------------------------------------------------------------------------------------- */

    connect() {
        this.encounterData = this.loadEncounterData();
        this.initializeIndices();
        // this.initializeTurboFrame();
        console.log('connect');
        // console.log(
        //     'this.unitsData', this.unitsData,
        //     'this.monsterIndex', this.monsterIndex,
        //     'this.playerIndex', this.playerIndex,
        //     'this.unitIndexAlphaSorted', this.unitIndexAlphaSorted,
        //     'this.unitIndexInitiativeSorted', this.unitIndexInitiativeSorted

        // );

        this.displayIndices();

        this.displayActiveUnitTracker();


        const toggleViewButton = document.querySelector('#toggle-view-button');
        toggleViewButton.addEventListener('click', () => {
            this.toggleTrackerView();
        });
        this.viewMode = 'compact';
        const viewModeValue = document.querySelector('#view-mode');
        viewModeValue.innerText = this.viewMode;


        document.addEventListener('keydown', (event) => {
            switch (event.key) {
                case 'ArrowRight':
                case 'ArrowDown':
                    this.handleUnitChange('next');
                    break;
                case 'ArrowLeft':
                case 'ArrowUp':
                    this.handleUnitChange('previous');
                    break;
            }
        });

        this.setActiveUnit(this.unitIndexInitiativeSorted[0]);

        console.log('this.activeUnit', this.activeUnit);


        this.swiper = new Swiper("#compact-view", {
            slidesPerView: '2',
            spaceBetween: 20,
            centeredSlides: true,
            loop: true,
            initialSlide: 0,

            navigation: {
              nextEl: ".swiper-button-next",
              prevEl: ".swiper-button-prev",
            }
        });


        const nextButton = document.querySelector('.swiper-button-next');
        const previousButton = document.querySelector('.swiper-button-prev');

        nextButton.addEventListener('click', () => {
            this.handleUnitChange('next');
        });

        previousButton.addEventListener('click', () => {
            this.handleUnitChange('previous');
        });


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
        for (const unitName in this.encounterData.monsters) {
            const unitData = this.encounterData.monsters[unitName];
            const unitWithKey = { ...unitData, name: unitName };
            this.monsterIndex.push(unitWithKey);
            this.unitIndexAlphaSorted.push(unitWithKey);
            this.unitIndexInitiativeSorted.push(unitWithKey);
        }

        for (const unitName in this.encounterData.players) {
            const unitData = this.encounterData.players[unitName];
            const unitWithKey = { ...unitData, name: unitName };
            this.playerIndex.push(unitWithKey);
            this.unitIndexAlphaSorted.push(unitWithKey);
            this.unitIndexInitiativeSorted.push(unitWithKey);
        }

        // Tri par ordre alphabétique
        this.unitIndexAlphaSorted.sort((a, b) => (a.name > b.name) ? 1 : -1);

        // Tri par initiative
        this.unitIndexInitiativeSorted.sort((a, b) => (a.initiative > b.initiative) ? -1 : 1);

        // Tri par ordre alphabétique des monstres
        this.monsterIndex.sort((a, b) => (a.name > b.name) ? 1 : -1);

        // Tri par ordre alphabétique des joueurs
        this.playerIndex.sort((a, b) => (a.name > b.name) ? 1 : -1);
    }



    /* ------------------------------------------------------------------------------------------- */
    // 1- les index

    // on récupère les index une fois initialisés. On les affiche tous, et on cache ceux qui ne sont pas sélectionnés.
    // on affiche l'index des monstres par défaut.
    // on affiche l'index des players au clic sur le bouton "players".
    // on affiche l'index des unités au clic sur le bouton "all".



    generateUnitElements(unitsData, container) {
        for (const u in unitsData) {
            const unitData = unitsData[u];


            const unitDiv = document.createElement('div');

            unitDiv.classList.add('unit');
            unitDiv.classList.add('unit-parchment');
            unitDiv.dataset.id = unitData.id;
            unitDiv.dataset.src = unitData.unitSrc;
            unitDiv.dataset.name = unitData.name;
            unitDiv.dataset.isMonster = unitData.isMonster;

            const unitNameP = document.createElement('p');
            unitNameP.innerText = unitData.name;
            unitDiv.appendChild(unitNameP);

            const unitAcP = document.createElement('p');
            unitAcP.innerText = `AC : ${unitData.ac}`;
            unitDiv.appendChild(unitAcP);

            const unitHpP = document.createElement('p');
            unitHpP.innerText = 'HP : ';
            unitDiv.appendChild(unitHpP);

            const unitHpInput = document.createElement('input');
            unitHpInput.type = 'number';
            unitHpInput.name = 'hp';
            unitHpInput.value = unitData.hp;
            unitHpP.appendChild(unitHpInput);
            unitHpInput.value <= 0 ? unitDiv.classList.add('KO') : unitDiv.classList.remove('KO');

            unitHpInput.addEventListener('input', () => {
                if (parseInt(unitHpInput.value) <= 0) {
                    unitDiv.classList.add('KO');
                } else {
                    unitDiv.classList.remove('KO');
                }
            });

            unitHpInput.addEventListener('change', () => {
                const updatedHP = parseInt(unitHpInput.value);
                this.updateUnitData(unitData.id, { hp: updatedHP });
                this.refreshAllViews();
            });

            const turboId = unitData.isMonster ? 'monster-details-content' : 'player-details-content';
            const turboSrc = unitData.unitSrc;

            unitDiv.addEventListener('click', () => {
                this.updateTurboFrame(unitDiv, turboId, turboSrc);
            });


            container.appendChild(unitDiv);
        }
    }

    displayIndices() {
        const monsterIndexContainer = document.querySelector('#monster-index');
        const playerIndexContainer = document.querySelector('#player-index');
        const globalIndexContainer = document.querySelector('#global-index');

        this.generateUnitElements(this.monsterIndex, monsterIndexContainer);
        this.generateUnitElements(this.playerIndex, playerIndexContainer);
        this.generateUnitElements(this.unitIndexAlphaSorted, globalIndexContainer);

        const monsterButton = document.querySelector('#monster-index-button');
        const playerButton = document.querySelector('#player-index-button');
        const globalButton = document.querySelector('#global-index-button');

        const buttons = [monsterButton, playerButton, globalButton];

        buttons.forEach((button) => {
            button.addEventListener('click', (event) => {
                this.toggleView(event.currentTarget.dataset.target);
                buttons.forEach((b) => b.classList.remove('active'));
                button.classList.add('active');

            });
        });
    }

    toggleView(targetViewId) {
        const views = document.querySelectorAll('.view');

        views.forEach((view) => {
            if (view.id === targetViewId) {
                view.classList.remove('hidden');
            } else {
                view.classList.add('hidden');
            }

        });

    }

    refreshMonsterIndexView() {
        const monsterIndexContainer = document.querySelector('#monster-index');
        monsterIndexContainer.innerHTML = '';
        this.generateUnitElements(this.monsterIndex, monsterIndexContainer);
    }

    refreshPlayerIndexView() {
        const playerIndexContainer = document.querySelector('#player-index');
        playerIndexContainer.innerHTML = '';
        this.generateUnitElements(this.playerIndex, playerIndexContainer);
    }

    refreshIndexView() {
        const globalIndexContainer = document.querySelector('#global-index');
        globalIndexContainer.innerHTML = '';
        this.generateUnitElements(this.unitIndexAlphaSorted, globalIndexContainer);
    }

    refreshAllViews() {
        this.refreshMonsterIndexView();
        this.refreshPlayerIndexView();
        this.refreshIndexView();
        this.refreshTrackerView();
    }

    updateUnitData(unitId, updatedUnitData) {
        const unitToUpdate = this.monsterIndex.find(unit => unit.id === unitId) ||
            this.playerIndex.find(unit => unit.id === unitId);

        if (!unitToUpdate) {
            return;
        }

        if (unitToUpdate) {
            Object.assign(unitToUpdate, updatedUnitData);

            const unitType = unitToUpdate.isMonster ? 'monsters' : 'players';

            this.encounterData[unitType][unitToUpdate.name] = unitToUpdate;

            localStorage.setItem('encounterData', JSON.stringify(this.encounterData));

            this.refreshAllViews();
        }
    }


    /* ------------------------------------------------------------------------------------------- */
    // 2- le tracker

    // this.currentUnit = this.unitIndexInitiativeSorted[0];
    // this.turn = 1;



    handleUnitChange(action) {
        switch (action) {
            case 'next':
                this.nextUnit();
                break;
            case 'previous':
                this.previousUnit();
                break;
        }
    }

    toggleTrackerView() {
        // console.log('toggleTrackerView');
        const compactViewContainer = document.querySelector('#compact-view');
        const fullViewContainer = document.querySelector('#full-view');
        const viewModeValue = document.querySelector('#view-mode');

        this.viewMode === 'compact' ? this.viewMode = 'full' : this.viewMode = 'compact';
        viewModeValue.innerText = this.viewMode;


        compactViewContainer.classList.toggle('hidden');
        compactViewContainer.classList.toggle('block');
        fullViewContainer.classList.toggle('hidden');
        fullViewContainer.classList.toggle('block');



    }

    generateCarouselUnitElement(unit) {
        const swiperSlide = document.createElement('div');
        swiperSlide.classList.add('swiper-slide');
        swiperSlide.dataset.name = unit.name;
        const textContainer = document.createElement('div');
        textContainer.classList.add('c-swiper__text');

        const title = document.createElement('div');
        title.classList.add('c-swiper__title');
        title.textContent = unit.name;

        const initiative = document.createElement('div');
        initiative.textContent = `Initiative: ${unit.initiative}`;

        const armorClass = document.createElement('div');
        armorClass.textContent = `AC: ${unit.ac}`;

        const hitPoints = document.createElement('div');
        // on donne l'id "#hp" à cette div pour pouvoir la cibler
        hitPoints.id = 'hp';
        hitPoints.textContent = `HP: ${unit.hp}`;

        textContainer.append(title, initiative, armorClass, hitPoints);
        swiperSlide.appendChild(textContainer);
        return swiperSlide;
    }

    generateUnitsCarousel(unitsData, container) {
        const units = unitsData;

        const swiperWrapper = document.createElement('div');
        swiperWrapper.classList.add('swiper-wrapper');
        container.appendChild(swiperWrapper);

        units.forEach((unit) => {
            const unitsElements = this.generateCarouselUnitElement(unit);
            swiperWrapper.appendChild(unitsElements);
        });

        // const swiperPagination = document.createElement('div');
        // swiperPagination.classList.add('swiper-pagination');

        const swiperButtonPrev = document.createElement('div');
        swiperButtonPrev.classList.add('swiper-button-prev');

        const swiperButtonNext = document.createElement('div');
        swiperButtonNext.classList.add('swiper-button-next');

        // container.append(swiperPagination, swiperButtonPrev, swiperButtonNext);
        container.append(swiperButtonPrev, swiperButtonNext);
    }

    generateCompactTrackerView(unitData, container) {
        this.generateUnitsCarousel(unitData, container);
    }

    generateFullTrackerView(unitData, container) {
        this.generateUnitElements(unitData, container);
    }

    refreshTrackerView() {
        const compactViewContainer = document.querySelector('#compact-view');
        const fullViewContainer = document.querySelector('#full-view');

        compactViewContainer.innerHTML = '';
        fullViewContainer.innerHTML = '';

        this.generateFullTrackerView(this.unitIndexInitiativeSorted, fullViewContainer);
        this.generateCompactTrackerView(this.unitIndexInitiativeSorted, compactViewContainer);
    }

    nextUnit() {
        console.log('nextUnit function called');
        // on passe à l'unité suivante dans la liste, on met à jour l'unité active 
        // this.activeUnit = this.unitIndexInitiativeSorted[this.unitIndexInitiativeSorted.indexOf(this.activeUnit) + 1];
        // si l'unité active est KO, on passe à l'unité suivante
        //si on retourne au début de la liste, on incrémente le nombre de tours this.turn++;

        const activeSlide = document.querySelector('.swiper-slide-active');
        const nextSlide = activeSlide.nextElementSibling;

        console.log('activeSlide', activeSlide);
        console.log('nextSlide', nextSlide);
        this.swiper.slideNext();

    }

    previousUnit() {
        console.log('previousUnit function called');
        this.swiper.slidePrev();
    }


    displayActiveUnitTracker() {
        // console.log('displayActiveUnitTracker');

        const activeUnitTracker = document.querySelector('#active-unit-tracker');
        const activeUnitTrackerContainer = document.querySelector('#active-unit-tracker-container');
        const compactViewContainer = document.querySelector('#compact-view');
        const fullViewContainer = document.querySelector('#full-view');
        const viewModeValue = document.querySelector('#view-mode');


        this.generateCompactTrackerView(this.unitIndexInitiativeSorted, compactViewContainer);
        this.generateFullTrackerView(this.unitIndexInitiativeSorted, fullViewContainer);

    }
    /* ------------------------------------------------------------------------------------------- */
    // 3- le turbo-frame
    updateTurboFrame(targetUnitDiv, turboId, turboSrc) {
        const turboFrame = document.querySelector("turbo-frame");
        if (!turboFrame) {
            return;
        }

        const allUnitDiv = document.querySelectorAll(".unit");
        allUnitDiv.forEach((u) => u.classList.remove("unit-selected"));
        targetUnitDiv.classList.add("unit-selected");

        turboFrame.id = turboId;
        turboFrame.src = turboSrc;
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

    getActiveUnit() {
        return this.activeUnit;
    }

    setActiveUnit(unit) {
        this.activeUnit = unit;
    }


    /* ------------------------------------------------------------------------------------------- */


}




