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
        this.isCalculatorOpen = false;
        this.currentUnitIndex = null;

        this.selectedOperation = 'damage';
        this.selectedMultiplier = 1;
        this.calculatorUnit = null;
        this.updateDisplay('0');


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
        nextButton.addEventListener('click', this.next);


        console.log('nextButton', nextButton);
        console.log('this.next', this.next);


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

         document.addEventListener('click', (event) => {
            if (!event.target.closest('#damageCalculator')) {
                this.closeCalculator();
            }
        });

        const calculatorContainer = document.getElementById('damageCalculator');
        calculatorContainer.addEventListener('click', (event) => {
            event.stopPropagation();
        });

        
        const numButtons = document.querySelectorAll('.calc-button');
        numButtons.forEach(button => {
            button.addEventListener('click', (event) => this.handleButtonClick(event, 'num'));
        });

        const modButtons = document.querySelectorAll('.mod-button');
        modButtons.forEach(button => {
            button.addEventListener('click', (event) => this.handleButtonClick(event, 'mod'));
        });

        const operatorButtons = document.querySelectorAll('.operation-button');
        operatorButtons.forEach(button => {
            button.addEventListener('click', (event) => this.handleButtonClick(event, 'operation'));
        });

        const validateButton = document.querySelector('#validate-button');
        validateButton.addEventListener('click', () => this.applyDamageOrHeal());





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

            unitHpInput.addEventListener('dblclick', () => {
               //show calculator

                this.showCalculator(unitData);
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
        const unitElement = this.createUnitElement(unit);
        carousel.appendChild(unitElement);
    }


    createUnitElement(unit) {
        let element = document.createElement('div');
        element.className = 'slider__content__item';

        let unitNameP = document.createElement('p');
        unitNameP.innerText = unit.name;
        element.appendChild(unitNameP);

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
        //on affiche le bouton previous
        const prevButton = document.getElementById('prev-button');
        if (prevButton.classList.contains('hidden')){
            prevButton.classList.remove('hidden');
        }
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

        if (this.turn === 1 && this.currentUnitIndex === 0) {
            //on masque le bouton previous
            const prevButton = document.getElementById('prev-button');
            prevButton.classList.add('hidden');
        }
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

    //stop encounter function
    stopEncounter() {
        // console.log('stopEncounter');
        // fenêtre de confirmation
        if (!confirm('Attention, toute progression sera perdue, souhaitez-vous quitter ?')) {
            return;
        }


        //on supprime les données de l'encounter
        localStorage.removeItem('encounterData');
        //on redirige vers la page d'accueil
        window.location.href = '/';
    }


    /* ------------------------------------------------------------------------------------------- */
    
    // Calculator functions

    showCalculator(unitData) {
        if (this.isCalculatorOpen) {
            return;
        }
        const calculatorContainer = document.getElementById('damageCalculator');
        calculatorContainer.style.display = 'block';
        this.isCalculatorOpen = true;
        this.calculatorUnit = unitData;


        this.initializeCalculator(unitData);

        console.log('showCalculator');
    }

    closeCalculator() {
        if (this.isCalculatorOpen) {
            console.log('closeCalculator');
            const calculatorContainer = document.getElementById('damageCalculator');
            calculatorContainer.style.display = 'none';
            this.isCalculatorOpen = false;
        }
    }


    clearCalculator() {
        // clear the calculator
        console.log('clearCalculator');

        const calculationDisplay = document.getElementById('calculationDisplay');
        calculationDisplay.value = '0';
    }



    updateDisplay(value) {
        this.calculationDisplayTarget.value = value;
    }


    initializeCalculator(unitData) {
        this.calculatorUnit = unitData;
        this.selectedOperation = 'damage';// valeur par défaut
        this.selectedMultiplier = 1;// valeur par défaut

        this.resetCalculatorButtons();
        this.updateDisplay('0');
        console.log('unitData', unitData);
    }


  

    resetCalculatorButtons() {
        document.querySelectorAll('.mod-button').forEach(button => button.classList.remove('selected-mod'));
        document.querySelector('.mod-button[data-mod="default"]').classList.add('selected-mod');

        document.querySelectorAll('.operation-button').forEach(button => button.classList.remove('selected-operation'));
        document.querySelector('.operation-button[data-operation="damage"]').classList.add('selected-operation');
    }

    handleButtonClick(event, buttonType) {
        const button = event.target;
        let buttonValue = null;
        let calculationDisplayValue = this.calculationDisplayTarget.value;
        
        switch (buttonType) {
            case 'num':
                buttonValue = button.dataset.num;
                calculationDisplayValue = calculationDisplayValue === '0' ? buttonValue : calculationDisplayValue + buttonValue;
                this.updateDisplay(calculationDisplayValue);
                break;

            case 'mod':
                buttonValue = button.dataset.mod;
                document.querySelectorAll('.mod-button').forEach(modButton => modButton.classList.remove('selected-mod'));
                button.classList.add('selected-mod');
                this.selectedMultiplier = buttonValue === 'default' ? 1 : buttonValue === 'vulnerable' ? 2 : 0.5;
                break;

            case 'operation':
                buttonValue = button.dataset.operation;
                document.querySelectorAll('.operation-button').forEach(operationButton => operationButton.classList.remove('selected-operation'));
                button.classList.add('selected-operation');
                this.selectedOperation = buttonValue;
                break;

            default:
                console.error('Type de bouton inconnu');
                break;
        }
    }





    applyHealOrDamage() {
        if (!this.calculatorUnit) {
            return;
        }

        const hpAmount = parseFloat(this.calculationDisplayTarget.value);
        const modifier = this.selectedMultiplier;

        if (isNaN(hpAmount)) {
            return;
        }

        if (this.selectedOperation === 'heal') {
            this.applyHeal(this.calculatorUnit, hpAmount);
        } else {
            this.applyDamage(this.calculatorUnit, hpAmount, modifier);
        }
    }


    applyHeal(unit, hpAmount) {
        console.log('applyHeal');

        unit.hp += hpAmount;
        if (unit.hp > unit.maxHp) {
            unit.hp = unit.maxHp;
        }
        this.updateUnitData(unit.id, { hp: unit.hp });
        this.refreshAllViews();
    }

    applyDamage(unit, hpAmount, modifier) {
        console.log('applyDamage');

        unit.hp -= hpAmount * modifier;
        if (unit.hp <= 0) {
            unit.hp = 0;
            unit.isDead = true;
        }
        this.updateUnitData(unit.id, { hp: unit.hp, isDead: unit.isDead });
        this.refreshAllViews();
    }
    


}
