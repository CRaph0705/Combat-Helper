import { Controller } from '@hotwired/stimulus';
import Unit from '../models/unit.js';
import Monster from '../models/monster.js';
import Player from '../models/player.js';


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

        this.activeUnitIndex = 0;
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
        this.generateCarousel();
        // this.displayActiveUnitTracker();


        // const toggleViewButton = document.querySelector('#toggle-view-button');
        // toggleViewButton.addEventListener('click', () => {
        //     this.toggleTrackerView();
        // });
        // this.viewMode = 'compact';
        // const viewModeValue = document.querySelector('#view-mode');
        // viewModeValue.innerText = this.viewMode;


        // document.addEventListener('keydown', (event) => {
        //     switch (event.key) {
        //         case 'ArrowRight':
        //         case 'ArrowDown':
        //             this.handleUnitChange('next');
        //             break;
        //         case 'ArrowLeft':
        //         case 'ArrowUp':
        //             this.handleUnitChange('previous');
        //             break;
        //     }
        // });

        // this.setActiveUnit(this.unitIndexInitiativeSorted[0]);

        // console.log('this.activeUnit', this.activeUnit);




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



            const unitWithKey = {
                ...unitData,
                name: unitName,
                isDead: false,
            };

            unitData.hp <= 0 ? unitWithKey.isDead = true : unitWithKey.isDead = false;

            this.monsterIndex.push(unitWithKey);
            this.unitIndexAlphaSorted.push(unitWithKey);
            this.unitIndexInitiativeSorted.push(unitWithKey);
        }

        for (const unitName in this.encounterData.players) {
            const unitData = this.encounterData.players[unitName];
            const unitWithKey = {
                ...unitData,
                name: unitName,
                isDead: false,
                isKO: false
            };
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
        this.generateUnitElements(this.unitIndexInitiativeSorted, globalIndexContainer);

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

            if (unitToUpdate.isMonster) {
                unitToUpdate.isDead = unitToUpdate.hp <= 0;
            }

            localStorage.setItem('encounterData', JSON.stringify(this.encounterData));

            this.refreshAllViews();
        }
    }


    /* ------------------------------------------------------------------------------------------- */
    // 2- le tracker


    // handleUnitChange(action) {
    //     switch (action) {
    //         case 'next':
    //             this.nextUnit();
    //             break;
    //         case 'previous':
    //             this.previousUnit();
    //             break;
    //     }
    // }

    // toggleTrackerView() {
    //     // console.log('toggleTrackerView');
    //     const compactViewContainer = document.querySelector('#compact-view');
    //     const fullViewContainer = document.querySelector('#full-view');
    //     const viewModeValue = document.querySelector('#view-mode');

    //     this.viewMode === 'compact' ? this.viewMode = 'full' : this.viewMode = 'compact';
    //     viewModeValue.innerText = this.viewMode;


    //     compactViewContainer.classList.toggle('hidden');
    //     compactViewContainer.classList.toggle('block');
    //     fullViewContainer.classList.toggle('hidden');
    //     fullViewContainer.classList.toggle('block');

    // }

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


    // carousel



    generateCarouselUnitElement(unit) {
        console.log('generateCarouselUnitElement function called');
        console.log('unit', unit);
        const sliderItem = document.createElement('div');
        sliderItem.classList.add('slider__content__item');
        sliderItem.dataset.id = unit.id;
        sliderItem.dataset.src = unit.unitSrc;
        sliderItem.dataset.name = unit.name;
        sliderItem.dataset.isMonster = unit.isMonster;
        sliderItem.dataset.isDead = unit.isDead;
        sliderItem.dataset.isKO = unit.isKO;
        sliderItem.dataset.hp = unit.hp;
        sliderItem.dataset.ac = unit.ac;
        sliderItem.dataset.initiative = unit.initiative;

        const unitNameP = document.createElement('h3');
        unitNameP.innerText = unit.name;
        sliderItem.appendChild(unitNameP);

        const unitAcP = document.createElement('p');
        unitAcP.innerText = `AC : ${unit.ac}`;
        sliderItem.appendChild(unitAcP);

        const unitHpP = document.createElement('p');
        unitHpP.innerText = `HP : ${unit.hp}`;
        sliderItem.appendChild(unitHpP);

        return sliderItem;
    }

    generateCarousel(){
        console.log('generateCarousel function called');
        const carousel = document.querySelector('.slider__content');
        // pour chaque unité on génère un slider__content__item avec la fonction generateCarouselUnitElement
        this.unitIndexInitiativeSorted.forEach((unit) => {
            const sliderItem = this.generateCarouselUnitElement(unit);
            carousel.appendChild(sliderItem);
        });
    }

    previous() {
        console.log('previous function called');
        const slider = document.querySelector('.slider');
        const sliderContent = document.querySelector('.slider__content');
        const widthSlider = slider.offsetWidth; // largeur du slider
        sliderContent.scrollLeft -= widthSlider;

        const scrollLeft = sliderContent.scrollLeft;

        //Revenir à la fin du slider
        // if (sliderContent.scrollLeft === 0) {
        //     sliderContent.scrollLeft = (itemsSlider.length - 1) * widthSlider;
        // }

        //cacher la flèche
        if (scrollLeft == widthSlider) {
            document.querySelector('.slider__nav__button--prev').classList.add('hidden');
        } else {
            document.querySelector('.slider__nav__button--next').classList.remove('hidden');
        }

    }

    next() {
        console.log('next function called');
        const slider = document.querySelector('.slider');
        const sliderContent = document.querySelector('.slider__content');
        const widthSlider = slider.offsetWidth; // largeur du slider
        sliderContent.scrollLeft += widthSlider;
        const scrollLeft = sliderContent.scrollLeft;

        const itemsSlider = document.querySelectorAll('.slider__content__item');

        //Revenir au début du slider
        // if (sliderContent.scrollLeft === (itemsSlider.length - 1) * widthSlider) {
        //     sliderContent.scrollLeft = 0;
        // }

        //cacher la flèche
        if (scrollLeft == widthSlider * (itemsSlider.length - 2)) {
            document.querySelector('.slider__nav__button--next').classList.add('hidden');
        } else {
            document.querySelector('.slider__nav__button--prev').classList.remove('hidden');
        }

    }

}




