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
        // console.log('this.activeUnitIndex', this.activeUnitIndex);


        const swiperWrapper = document.createElement('div');
        swiperWrapper.classList.add('swiper-wrapper');
        container.appendChild(swiperWrapper);


        units.forEach((unit, index) => {
            const unitsElements = this.generateCarouselUnitElement(unit);
            swiperWrapper.appendChild(unitsElements);


        });

        const swiperButtonPrev = document.createElement('div');
        swiperButtonPrev.classList.add('swiper-button-prev');

        const swiperButtonNext = document.createElement('div');
        swiperButtonNext.classList.add('swiper-button-next');

        container.append(swiperButtonPrev, swiperButtonNext);

        this.swiper = new Swiper("#compact-view", {
            slidesPerView: '2',
            spaceBetween: 20,
            centeredSlides: true,
            loop: true,
            initialSlide: this.activeUnitIndex,

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


    generateCompactTrackerView(unitData, container) {
        this.generateUnitsCarousel(unitData, container);
    }

    generateFullTrackerView(unitData, container) {
        this.generateUnitElements(unitData, container);
    }

    refreshTrackerView() {
        // console.log('refreshTracker this.activeUnitIndex', this.activeUnitIndex);

        const compactViewContainer = document.querySelector('#compact-view');
        const fullViewContainer = document.querySelector('#full-view');

        compactViewContainer.innerHTML = '';
        fullViewContainer.innerHTML = '';

        this.generateFullTrackerView(this.unitIndexInitiativeSorted, fullViewContainer);
        this.generateCompactTrackerView(this.unitIndexInitiativeSorted, compactViewContainer);
    }

    nextUnit() {
        // console.log('nextUnit function called');
        if (this.swiper && this.swiper.slideNext) {

            const activeSlide = document.querySelector('.swiper-slide-active');
            if (!activeSlide) {
                console.log('no active slide');
                return;
            }
            const nextSlide = activeSlide.nextElementSibling;
            if (!nextSlide) {
                console.log('no next slide found');
                return;
            }
            // console.log('this.activeUnitIndex (previous)', this.activeUnitIndex);
            this.activeUnitIndex = this.unitIndexInitiativeSorted.indexOf(this.activeUnit);
            // console.log('activeSlide', activeSlide);
            // console.log('nextSlide', nextSlide);
            this.swiper.slideNext();

            if (activeSlide.dataset && nextSlide.dataset) {
                this.activeUnitIndex = nextSlide.dataset.swiperSlideIndex;
                this.activeUnit = this.unitIndexInitiativeSorted[this.activeUnitIndex];
                // console.log('this.activeUnitIndex (now)', this.activeUnitIndex);
                // console.log('this.activeUnit', this.activeUnit);

                activeSlide.classList.remove('swiper-slide-active');
                nextSlide.classList.add('swiper-slide-active');

                if (this.activeUnit.isDead) {
                    // console.log('this unit is dead, we skip it');
                    // timeout pour laisser le temps à l'animation de se terminer
                    setTimeout(() => {
                        this.nextUnit();
                    }, 350);
                }
            } else {
                console.log('no dataset properties found in active or next slide');
            }
        }
    }

    

    previousUnit() {
        // console.log('previousUnit function called');
        const activeSlide = document.querySelector('.swiper-slide-active');
        const previousSlide = activeSlide.previousElementSibling;
        // console.log('this.activeUnitIndex (previous)', this.activeUnitIndex);
        this.activeUnitIndex = this.unitIndexInitiativeSorted.indexOf(this.activeUnit);

        this.swiper.slidePrev();

        this.activeUnitIndex = previousSlide.dataset.swiperSlideIndex;
        this.activeUnit = this.unitIndexInitiativeSorted[this.activeUnitIndex];
        // console.log('this.activeUnitIndex (now)', this.activeUnitIndex);
        // console.log('this.activeUnit', this.activeUnit);

        activeSlide.classList.remove('swiper-slide-active');
        previousSlide.classList.add('swiper-slide-active');

        if (this.activeUnit.isDead) {
            // console.log('this unit is dead, we skip it');
            // comme pour next, timeout pour laisser le temps à l'animation de se terminer (sinon previousSlide est null)
            setTimeout(() => {
                this.previousUnit();
            }, 350);
        }
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




