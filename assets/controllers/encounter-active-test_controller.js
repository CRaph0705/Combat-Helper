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
        this.isAnimating = false;

        this.activeUnitIndex = 0;
    }

    /* ------------------------------------------------------------------------------------------- */

    connect() {
        this.encounterData = this.loadEncounterData();
        this.initializeIndices();
        // this.initializeTurboFrame();
        console.log('connect');

        this.displayIndices();
        this.generateCarousel();


        console.log('this turn', this.turn);
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



        document.addEventListener('keydown', (event) => {
            switch (event.key) {
                case 'ArrowRight':
                case 'ArrowDown':
                    this.next();
                    break;
                case 'ArrowLeft':
                case 'ArrowUp':
                    this.previous();
            }
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

            const unitInitiativeP = document.createElement('p');
            unitInitiativeP.innerText = `Initiative : ${unitData.initiative}`;
            unitDiv.appendChild(unitInitiativeP);

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
        // this.generateUnitElements(this.unitIndexAlphaSorted, globalIndexContainer);
        this.generateUnitElements(this.unitIndexInitiativeSorted, globalIndexContainer);
    }

    refreshTrackerView() {

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

    // carousel

    generateCarouselUnitElement(unit) {

        const sliderItem = document.createElement('div');
        sliderItem.classList.add('slider__content__item');
        sliderItem.dataset.id = unit.id;
        sliderItem.dataset.src = unit.unitSrc;
        sliderItem.dataset.name = unit.name;
        sliderItem.dataset.isMonster = unit.isMonster;
        sliderItem.dataset.isDead = unit.isDead;
        sliderItem.dataset.isKo = unit.isKO;
        sliderItem.dataset.initiative = unit.initiative;

        const unitNameP = document.createElement('h3');
        unitNameP.innerText = unit.name;
        sliderItem.appendChild(unitNameP);

        return sliderItem;
    }

    generateCarousel() {
        console.log('generateCarousel function called');
        const carousel = document.querySelector('.slider__content');
        // pour chaque unité on génère un slider__content__item avec la fonction generateCarouselUnitElement
        this.unitIndexInitiativeSorted.forEach((unit) => {
            const sliderItem = this.generateCarouselUnitElement(unit);
            carousel.appendChild(sliderItem);
        });
    }

    // navigation du carousel
    previous() {
        if (this.isAnimating) {
            console.log('return, this is animating', this.isAnimating);
            return;
        } else {
            this.isAnimating = true;
        }

        if (document.querySelector('.slider__nav__button--next').classList.contains('hidden')) {
            document.querySelector('.slider__nav__button--next').classList.remove('hidden');
        }

        const prevButton = document.querySelector('.slider__nav__button--prev');
        // on cache le bouton prev le temps que l'animation se fasse
        prevButton.classList.add('hidden');
        const slider = document.querySelector('.slider');
        const sliderContent = document.querySelector('.slider__content');
        const widthSlider = slider.offsetWidth; // largeur du slider

        // Déplacer le sliderContent avec une animation
        sliderContent.scrollLeft -= widthSlider;
        
        // Utiliser une fonction de rappel pour réafficher le bouton une fois le défilement terminé
        setTimeout(() => {
            if (scrollLeft == widthSlider && this.turn == 1) {
                this.isAnimating = false;
                return;
            }
            this.isAnimating = false;
            prevButton.classList.remove('hidden');
        }, 700);
        const scrollLeft = sliderContent.scrollLeft;
        const itemsSlider = document.querySelectorAll('.slider__content__item');

        // Revenir à la fin du slider
        if ((sliderContent.scrollLeft === 0)|| (sliderContent.scrollLeft < widthSlider)) {
            sliderContent.scrollLeft = (itemsSlider.length - 1) * widthSlider;

            // on diminue le tour de 1
            this.turn--;
            console.log('turn', this.turn);

        }
    }

    next() {

        if (this.isAnimating) {
            console.log('return, this is animating', this.isAnimating);
            return; 
        } else {
            this.isAnimating = true;
        }

        if (document.querySelector('.slider__nav__button--prev').classList.contains('hidden')) {
            document.querySelector('.slider__nav__button--prev').classList.remove('hidden');
        }

        const nextButton = document.querySelector('.slider__nav__button--next');
        // on cache le bouton next le temps que l'animation se fasse
        nextButton.classList.add('hidden');
        const slider = document.querySelector('.slider');
        const sliderContent = document.querySelector('.slider__content');
        const widthSlider = slider.offsetWidth; // largeur du slider

        // Déplacer le sliderContent avec une animation
        sliderContent.scrollLeft += widthSlider;
    
        // Utiliser une fonction de rappel pour réafficher le bouton une fois le défilement terminé
        setTimeout(() => {
            this.isAnimating = false;
            nextButton.classList.remove('hidden');
        }, 700);
    
        const itemsSlider = document.querySelectorAll('.slider__content__item');
    
        //Revenir au début du slider

        if ((sliderContent.scrollLeft === (itemsSlider.length - 1) * widthSlider)|| (sliderContent.scrollLeft > (itemsSlider.length - 2) * widthSlider)){
            sliderContent.scrollLeft = 0;
            this.turn++;
            console.log('turn', this.turn);
        }
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


}

// loop effect instead of back to the beginning of the carousel when we reach the end of it (and vice versa) 


// reference : https://codepen.io/supah/pen/VwegJwV
