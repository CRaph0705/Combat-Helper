import { Controller } from '@hotwired/stimulus';
import Unit from '../models/unit.js';
import Monster from '../models/monster.js';
import Player from '../models/player.js';

export default class extends Controller {
    static targets = ["calculationDisplay", "damageCalculator"];

    connect() {
        this.initializeVariables();
        this.loadEncounterData();
        this.initializeIndices();
        this.displayIndices();
        this.initializeEventListeners();
        this.initializeTurboFrame();
        this.updateCarousel();

        // console.log('this.unitIndexInitiativeSorted[0]', this.unitIndexInitiativeSorted[0]);

        const draggableElement = document.querySelector('.draggable');
        draggableElement.addEventListener('mousedown', function(event) 
        {
            let initialX = event.clientX;
            let initialY = event.clientY;function moveElement(event) 
            {
                let currentX = event.clientX;
                let currentY = event.clientY;let deltaX = currentX - initialX;
                let deltaY = currentY - initialY;draggableElement.style.left = draggableElement.offsetLeft + deltaX + 'px';
                draggableElement.style.top = draggableElement.offsetTop + deltaY + 'px';initialX = currentX;
                initialY = currentY;
            }
            function stopElement(event) 
            {
                document.removeEventListener('mousemove', moveElement);
                document.removeEventListener('mouseup', stopElement);
            }
            document.addEventListener('mousemove', moveElement);
            document.addEventListener('mouseup', stopElement);
        });
    }








    initializeVariables() {
        this.monsterIndex = [];
        this.playerIndex = [];
        this.unitIndexAlphaSorted = [];
        this.unitIndexInitiativeSorted = [];
        this.currentUnit = null;
        this.turn = 1;
        this.isCalculatorOpen = false;
        this.currentUnitIndex = 0;

        this.selectedOperation = 'damage';
        this.selectedModifier = 'default';
        this.selectedMultiplier = 1;
        this.calculatorUnit = null;

        this.next = this.next.bind(this);
        this.previous = this.previous.bind(this);
    }



    

    loadEncounterData() {
        const unitsData = JSON.parse(localStorage.getItem('encounterData'));
        this.encounterData = unitsData || {};
    }


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

    displayIndices() {
        const monsterIndexContainer = document.querySelector('#monster-index');
        const playerIndexContainer = document.querySelector('#player-index');
        const globalIndexContainer = document.querySelector('#global-index');

        this.generateUnitElements(this.monsterIndex, monsterIndexContainer);
        this.generateUnitElements(this.playerIndex, playerIndexContainer);
        this.generateUnitElements(this.unitIndexInitiativeSorted, globalIndexContainer);

        const buttons = [document.querySelector('#monster-index-button'), document.querySelector('#player-index-button'), document.querySelector('#global-index-button')];

        buttons.forEach(button => {
            button.addEventListener('click', event => {
                this.toggleView(event.currentTarget.dataset.target);
                buttons.forEach(b => b.classList.remove('active'));
                button.classList.add('active');
            });
        });
    }

    toggleView(targetViewId) {
        const views = document.querySelectorAll('.view');
        views.forEach(view => view.classList.toggle('hidden', view.id !== targetViewId));
    }

    generateUnitElements(unitsData, container) {
        container.innerHTML = '';
        unitsData.forEach(unitData => {
            const unitDiv = document.createElement('div');
            unitDiv.className = 'unit unit-parchment';
            unitDiv.dataset.id = unitData.id;
            unitDiv.dataset.src = unitData.unitSrc;
            unitDiv.dataset.name = unitData.name;
            unitDiv.dataset.isMonster = unitData.isMonster;

            const unitNameP = document.createElement('p');
            unitNameP.innerText = unitData.name;
            unitDiv.appendChild(unitNameP);

            const unitInitiativeP = document.createElement('p');
            unitInitiativeP.innerText = `Initiative: ${unitData.initiative}`;
            unitDiv.appendChild(unitInitiativeP);

            const unitAcP = document.createElement('p');
            unitAcP.innerText = `AC: ${unitData.ac}`;
            unitDiv.appendChild(unitAcP);

            const unitHpP = document.createElement('p');
            unitHpP.innerText = 'HP: ';
            unitDiv.appendChild(unitHpP);

            const unitHpInput = document.createElement('input');
            unitHpInput.type = 'number';
            unitHpInput.name = 'hp';
            unitHpInput.value = unitData.hp;
            unitHpP.appendChild(unitHpInput);
            unitHpInput.value <= 0 ? unitDiv.classList.add('KO') : unitDiv.classList.remove('KO');

            unitHpInput.addEventListener('input', () => {
                unitDiv.classList.toggle('KO', parseInt(unitHpInput.value) <= 0);
            });

            unitHpInput.addEventListener('change', () => {
                const updatedHP = parseInt(unitHpInput.value);
                this.updateUnitData(unitData.id, { hp: updatedHP });
            });

            unitHpInput.addEventListener('dblclick', () => {
                this.showCalculator(unitData);
            });

            const turboId = unitData.isMonster ? 'monster-details-content' : 'player-details-content';
            const turboSrc = unitData.unitSrc;

            unitDiv.addEventListener('click', () => {
                this.updateTurboFrame(unitDiv, turboId, turboSrc);
            });

            container.appendChild(unitDiv);
        });
    }

    updateTurboFrame(targetUnitDiv) {
        // console.log('updateTurboFrame');
        const turboFrame = document.querySelector("turbo-frame");
        if (!turboFrame) {
            return;
        }
        
        const targerUnitIsMonster = targetUnitDiv.dataset.isMonster;
        // console.log('targerUnitIsMonster', targerUnitIsMonster);
        const turboId = targerUnitIsMonster === 'true' ? 'monster-details-content' : 'player-details-content';
        // console.log('turboId', turboId);
        const turboSrc = targetUnitDiv.dataset.src;

        document.querySelectorAll(".unit").forEach(u => u.classList.remove("unit-selected"));
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


    initializeEventListeners() {
        const nextButton = document.getElementById('next-button');
        nextButton.addEventListener('click', this.next);

        const prevButton = document.getElementById('prev-button');
        prevButton.addEventListener('click', this.previous);

        document.addEventListener('keydown', event => {
            if (['ArrowRight', 'ArrowDown'].includes(event.key)) {
                this.next();
            } else if (['ArrowLeft', 'ArrowUp'].includes(event.key)) {
                this.previous();
            }
        });

        const damageCalculator = document.getElementById('damageCalculator');
        document.addEventListener('click', event => {
            if (!event.target.closest('#damageCalculator')) {
                this.closeCalculator();
            }
        });

        const calculatorContainer = document.getElementById('damageCalculator');
        calculatorContainer.addEventListener('click', event => event.stopPropagation());

        const numButtons = document.querySelectorAll('.num-button');
        numButtons.forEach(button => {
            button.addEventListener('click', event => this.handleButtonClick(event, 'num'));
        });

        const modButtons = document.querySelectorAll('.mod-button');
        modButtons.forEach(button => {
            button.addEventListener('click', event => this.handleButtonClick(event, 'mod'));
        });

   
        const operatorButtons = document.querySelectorAll('.operation-button');
        operatorButtons.forEach(button => {
            button.addEventListener('click', event => this.handleButtonClick(event, 'operation'));
        });

        const validateButton = document.querySelector('#validateButton');
        validateButton.addEventListener('click', () => this.applyHealOrDamage());
    }

    updateCarousel() {
        const carousel = document.getElementById('carousel');
        carousel.innerHTML = ''; // Vider le carousel pour la nouvelle unité
        const unit = this.unitIndexInitiativeSorted[this.currentUnitIndex];
        const unitElement = this.createUnitElement(unit);
        carousel.appendChild(unitElement);
    }

    createUnitElement(unit) {
        const element = document.createElement('div');
        element.className = 'slider__content__item';

        const unitNameP = document.createElement('p');
        unitNameP.innerText = unit.name;
        element.appendChild(unitNameP);

        return element;
    }

    next() {
        // console.log('next');

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
        // console.log('previous');

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

    showCalculator(unitData) {
        this.isCalculatorOpen = true;
        this.calculatorUnit = unitData;

        const damageCalculator = document.getElementById('damageCalculator');
        const unitDiv = document.querySelector(`.unit[data-id="${unitData.id}"]`);
        // const unitRect = unitDiv.getBoundingClientRect();

        damageCalculator.style.display = 'block';

        const modButtons = document.querySelectorAll('.mod-button');
        modButtons.forEach(modButton => {
            modButton.disabled = this.selectedOperation === 'heal';
        });
        // damageCalculator.style.left = `${unitRect.left + window.scrollX}px`;
        // damageCalculator.style.top = `${unitRect.bottom + window.scrollY}px`;

        console.log('this.selectedOperation', this.selectedOperation);
        console.log('this.selectedMultiplier', this.selectedMultiplier);
        console.log('this.selectedModifier', this.selectedModifier);

    }

    closeCalculator() {
        this.isCalculatorOpen = false;
        this.calculatorUnit = null;
        this.clearCalculator();
        this.selectedModifier = 'default';
        this.selectedMultiplier = 1;
        this.selectedOperation = 'damage';
        document.getElementById('damageCalculator').style.display = 'none';


    }

    handleButtonClick(event, buttonType) {

        const button = event.target.closest('button');
        if (!button) {
            return;
        }

        if (buttonType === 'num') {
            this.appendNumber(button.innerText);

        } else if (buttonType === 'mod') {

            console.log('button.dataset.mod', button.dataset.mod);
            console.log('this.selectedModifier', this.selectedModifier);


            if (this.selectedModifier === button.dataset.mod) {
                console.log('Removing modifier');
                this.removeModifier(button.dataset.mod);
                button.classList.remove('selected-mod');
                return;
            }
            console.log('Applying modifier');
            this.applyModifier(button.dataset.mod);
            const modbuttons = document.querySelectorAll('.mod-button');
            modbuttons.forEach(button => {
                button.classList.remove('selected-mod');
            });
            button.classList.add('selected-mod');

        } else if (buttonType === 'operation') {
            this.setOperation(button.dataset.operation);
            const operationButtons = document.querySelectorAll('.operation-button');
            operationButtons.forEach(button => {
                button.classList.remove('selected-operation');
            });
            button.classList.add('selected-operation');


            //si opération heal est sélectionné on désactive les boutons de modificateurs
            const modButtons = document.querySelectorAll('.mod-button');
            modButtons.forEach(modButton => {
                modButton.disabled = button.dataset.operation === 'heal';
            });
        }
    }

         //si opération heal est sélectionné on désactive les boutons de modificateurs
        //  this.selectedOperation = 'heal'? modButtons.forEach(button => button.disabled = true) : modButtons.forEach(button => button.disabled = false);


    appendNumber(number) {
        this.calculationDisplayTarget.value += number;
    }



    checkModifier(modifier) {
        return this.selectedModifier === modifier;
    }



    applyModifier(modifier) {
       
        if (modifier === 'vulnerable') {
            this.selectedMultiplier = 2;
            this.selectedModifier = 'vulnerable';
        } else if (modifier === 'resistant') {
            this.selectedMultiplier = 0.5;
            this.selectedModifier = 'resistant';
        } else {
            this.selectedMultiplier = 1;
            this.selectedModifier = 'default';
        }
        console.log('Selected multiplier:', this.selectedMultiplier);

    }

    removeModifier(modifier) {
        console.log('Removing modifier:', modifier);
        if (modifier === 'default') {
            console.log('return');
            return;
        }
        if (this.selectedModifier === modifier) {
            this.selectedModifier = 'default';
            this.selectedMultiplier = 1;
        }
        console.log('Selected multiplier:', this.selectedMultiplier);
    }

    setOperation(operation) {
        this.selectedOperation = operation;
    }

    applyHealOrDamage() {
        // console.log('Applying heal or damage');
        const hpAmount = parseInt(this.calculationDisplayTarget.value);

        // damage result doit être un entier arrondi au supérieur
        const damageResult = Math.ceil(hpAmount * this.selectedMultiplier);

        const healResult = hpAmount;

        // console.log(`Operation: ${this.selectedOperation}`);
        // console.log(`Amount: ${hpAmount}`);
        // console.log('this.selectedMultiplier', this.selectedMultiplier);
        if (this.selectedOperation === 'damage') {
            this.calculatorUnit.hp -= damageResult;
            if (this.calculatorUnit.hp <= 0) {
                this.calculatorUnit.hp = 0;
                this.calculatorUnit.isDead = true;
            }
        } else if (this.selectedOperation === 'heal') {
            this.calculatorUnit.hp += healResult;
            if (this.calculatorUnit.hp > this.calculatorUnit.maxHp) {
                this.calculatorUnit.hp = this.calculatorUnit.maxHp;
            }
        }

        this.updateUnitData(this.calculatorUnit.id, { hp: this.calculatorUnit.hp });
        this.closeCalculator();
    }

    clearCalculator() {
        console.log('clear');
        //remove selected class from all mod buttons
        const modbuttons = document.querySelectorAll('.mod-button');
        modbuttons.forEach(button => {
            button.classList.remove('selected-mod');
        });
        //remove selected class from all operation buttons
        const operationButtons = document.querySelectorAll('.operation-button');
        operationButtons.forEach(button => {
            button.classList.remove('selected-operation');
        });
        this.calculationDisplayTarget.value = '';
        this.selectedOperation = 'damage';
        this.selectedMultiplier = 1;
        //on retire les modificateurs de dégâts
        this.selectedModifier = 'default';
        
        document.querySelectorAll('.mod-button').forEach(button => {
            button.classList.remove('selected-mod');
        });

        //on remet le bouton damage en selected
        const damageButton = document.querySelector('.operation-button[data-operation="damage"]');
        damageButton.classList.add('selected-operation');
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

    stopEncounter() {
        if(!confirm('Attention, toute progression sera perdue. Souhaitez-vous quitter la page ?')) {
            return;
        }
        localStorage.removeItem('encounterData');
        window.location.href = '/';
    }
}
