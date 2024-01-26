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
        this.currentUnit = null;
        this.turn = null;
        // this.isAnimating = false;

        this.currentUnitIndex = null;

        // les méthodes next et previous étaient mal bindées, on perdait la référence à this
        // donc on doit les bind dans le constructeur :
        this.next = this.next.bind(this);
        this.previous = this.previous.bind(this);
    }

    /* ------------------------------------------------------------------------------------------- */

    connect() {
        this.encounterData = this.loadEncounterData();
        this.initializeIndices();
        console.log('this.unitIndexInitiativeSorted', this.unitIndexInitiativeSorted);

        console.log('connect');

        this.currentUnitIndex = 0;
        this.currentUnit = this.unitIndexInitiativeSorted[this.currentUnitIndex];
        this.turn = 1;


        this.displayIndices();


        console.log('this.currentUnitIndex', this.currentUnitIndex);
        console.log('this.unitIndexInitiativeSorted', this.unitIndexInitiativeSorted);

        console.log('this turn', this.turn);

        this.updateCarousel(); // Initialisation du carousel


        // const stopButton = document.getElementById('stop-button');
        // stopButton.addEventListener('click', this.stopEncounter);

        const nextButton = document.getElementById('next-button');
        console.log('nextButton', nextButton);
        nextButton.addEventListener('click', this.next);
        console.log('this.next', this.next);
        console.log('this.unitIndexInitiativeSorted', this.unitIndexInitiativeSorted);

        const prevButton = document.getElementById('prev-button');
        prevButton.addEventListener('click', this.previous);


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
        this.generateUnitElements(this.unitIndexInitiativeSorted, globalIndexContainer);
    }

    refreshTrackerView() {
        this.updateCarousel();
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

    updateCarousel() {

        const carousel = document.getElementById('carousel');
        carousel.innerHTML = ''; // Vider le carousel pour la nouvelle unité
        let unit = this.unitIndexInitiativeSorted[this.currentUnitIndex];
        carousel.appendChild(this.createUnitElement(unit));
    }


    createUnitElement(unit) {
        let element = document.createElement('div');
        element.className = 'unit';
        element.textContent = unit.name;
        return element;
    }

    next() {
        console.log('next');

        if (!this.unitIndexInitiativeSorted) {
            console.error('unitIndexInitiativeSorted is undefined');
            return;
        }
    
        const units = this.unitIndexInitiativeSorted;
    
        do {
            this.currentUnitIndex = (this.currentUnitIndex + 1) % units.length;
            if (this.currentUnitIndex === 0) this.turn++;
            this.updateTurnCounter();
        } while (units[this.currentUnitIndex].isDead);

        this.updateCarousel();
    }

    previous() {
        console.log('previous');

        if (!this.unitIndexInitiativeSorted) {
            console.error('unitIndexInitiativeSorted is undefined');
            return;
        }

        const units = this.unitIndexInitiativeSorted;
        if (this.turn === 1 && this.currentUnitIndex === 0) {
            console.log('Tour 1, première unité, pas de retour en arrière possible');
            return;
        }


        do {
            this.currentUnitIndex = (this.currentUnitIndex - 1 + units.length) % units.length;
            if (this.currentUnitIndex === units.length - 1) this.turn--;
            this.updateTurnCounter();
        } while (units[this.currentUnitIndex].isDead);

        this.updateCarousel();
    }


    updateTurnCounter() {
        document.getElementById('turn-number').textContent = this.turn;
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
