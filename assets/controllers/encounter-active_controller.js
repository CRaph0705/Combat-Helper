import { Controller } from '@hotwired/stimulus';

let currentUnitId = null;
export default class extends Controller {
    connect() {
        // console.log('encounter-active_controller connected');

        //on récupère les données de l'encounter
        const unitsData = this.loadEncounterData();
        // console.log('unitsData', unitsData);
        this.displayEncounterData();


        document.addEventListener('keydown', (event) => {
            switch (event.key) {
                case 'e':
                case 'ArrowRight':
                case 'ArrowDown':
                    this.nextUnit();
                    break;
                case 'a':
                case 'ArrowLeft':
                case 'ArrowUp':
                    this.previousUnit();
                    break;
            }
        });

        // ----------------- TURBO FRAME ----------------- //
        const turboFrame = document.querySelector("turbo-frame");
        if (!turboFrame) {
            return;
        }

        let currentUnitId = null;
        let currentUnitType = null;

        const units = document.querySelectorAll(".unit");
        // console.log('units :', units);
        units[0].classList.add("unit-selected");
        turboFrame.id = units[0].dataset.isMonster === 'true' ? 'monster-details-content' : 'player-details-content';
        turboFrame.src = units[0].dataset.src;
        currentUnitId = units[0].dataset.id;
        currentUnitType = units[0].dataset.isMonster === true ? 'monster' : 'player';
        // console.log('currentUnitType :', currentUnitType);

        units.forEach((unit) => {
            unit.addEventListener("click", (event) => {
                this.updateTurboFrame(event.currentTarget);
            });
        });
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

    //load the data from local storage
    loadEncounterData() {
        // console.log('loadEncounterData');
        const unitsData = JSON.parse(localStorage.getItem('encounterData'));
        // console.log('unitsData', unitsData);

        if (!unitsData) {
            // console.log('no unitsData');
            return;
        }
        return unitsData;
    }

    /* ------------------------------------------------------------------------------------------- */

    displayEncounterData() {
        // console.log('displayEncounterData');
        const unitsData = this.loadEncounterData();

        // Sélectionnez le conteneur où vous souhaitez afficher les éléments
        const container = document.querySelector('#encounterUnitsContainer');

        // Parcours des données des unités
        let isFirstUnit = true;
        for (const unitName in unitsData) {
            const unitData = unitsData[unitName];

            // Création d'une nouvelle div pour chaque unité
            const unitDiv = document.createElement('div');
            unitDiv.classList.add('unit');
            unitDiv.classList.add('unit-parchment');
            unitDiv.dataset.id = unitData.id;
            unitDiv.dataset.src = unitData.unitSrc;
            unitDiv.dataset.unitName = unitName;
            unitDiv.dataset.isMonster = unitData.isMonster;
            unitDiv.innerHTML = `
            <p>${unitName}</p>
            <p>AC : ${unitData.ac}</p>
            <p>HP : <input type="number" id="hp" name="hp" value="${unitData.hp}">
            </p>
            `;

            if (unitData.hp <= 0) {
                unitDiv.classList.add('KO');
            }

            // Si c'est la première unité, ajouter la classe "active"
            if (isFirstUnit) {
                unitDiv.classList.add('active');
                isFirstUnit = false;
            }

            // Ajout de la div de l'unité au conteneur
            container.appendChild(unitDiv);
            // ScrollHeight();


            // Ajout de l'écouteur d'événements sur les HP de l'unité
            const hpInput = unitDiv.querySelector('input[name="hp"]');
            hpInput.addEventListener('input', () => {
                if (parseInt(hpInput.value) <= 0) {
                    unitDiv.classList.add('KO');
                } else {
                    unitDiv.classList.remove('KO');
                }
            });
        }

    }

    /* ------------------------------------------------------------------------------------------- */
    nextUnit() {
        const unitsData = this.loadEncounterData();
        const currentUnit = document.querySelector('.unit.active');

        if (!currentUnit) {
            // Si aucune unité n'est active, initialiser avec la première unité du tableau
            const firstUnit = document.querySelector('.unit');
            firstUnit.classList.add('active');
            return;
        }

        // Trouver l'index de l'unité actuelle en parcourant les clés de l'objet
        let currentIndex = 0;
        for (const unitName in unitsData) {
            if (unitName === currentUnit.dataset.unitName) {
                break;
            }
            currentIndex++;
        }

        // Rechercher la prochaine unité sans la classe KO
        let nextIndex = (currentIndex + 1) % Object.keys(unitsData).length;
        while (nextIndex !== currentIndex) {
            const nextUnitName = Object.keys(unitsData)[nextIndex];
            const nextUnit = document.querySelector(`.unit[data-unit-name="${nextUnitName}"]`);

            if (!nextUnit.classList.contains('KO')) {
                // Supprimer la classe active de l'unité actuelle
                currentUnit.classList.remove('active');
                // Ajouter la classe active à l'unité suivante
                nextUnit.classList.add('active');
                this.updateTurboFrame(nextUnit);
                nextUnit.scrollIntoView({ behavior: 'smooth', block: 'center' });
                return;
            }
            nextIndex = (nextIndex + 1) % Object.keys(unitsData).length;
        }
    }


    /* ------------------------------------------------------------------------------------------- */

    previousUnit() {
        const unitsData = this.loadEncounterData();
        const currentUnit = document.querySelector('.unit.active');

        if (!currentUnit) {
            // Si aucune unité n'est active, initialiser avec la dernière unité du tableau
            const unitNames = Object.keys(unitsData);
            const lastUnitName = unitNames[unitNames.length - 1];
            const lastUnit = document.querySelector(`.unit[data-unit-name="${lastUnitName}"]`);
            lastUnit.classList.add('active');
            return;
        }

        // Trouver l'index de l'unité actuelle en parcourant les clés de l'objet
        let currentIndex = 0;
        const unitNames = Object.keys(unitsData);
        for (const unitName of unitNames) {
            if (unitName === currentUnit.dataset.unitName) {
                break;
            }
            currentIndex++;
        }

        // Rechercher l'unité précédente sans la classe KO
        let previousIndex = (currentIndex - 1 + unitNames.length) % unitNames.length;
        while (previousIndex !== currentIndex) {
            const previousUnitName = unitNames[previousIndex];
            const previousUnit = document.querySelector(`.unit[data-unit-name="${previousUnitName}"]`);

            if (!previousUnit.classList.contains('KO')) {
                // Supprimer la classe active de l'unité actuelle
                currentUnit.classList.remove('active');
                // Ajouter la classe active à l'unité précédente
                previousUnit.classList.add('active');
                this.updateTurboFrame(previousUnit);
                previousUnit.scrollIntoView({ behavior: 'smooth', block: 'center' });
                return;
            }

            previousIndex = (previousIndex - 1 + unitNames.length) % unitNames.length;
        }
    }


    /* ------------------------------------------------------------------------------------------- */

    //stop encounter function
    stopEncounter() {
        // console.log('stopEncounter');
        //on fait apparaître une fenêtre de confirmation
        if (!confirm('Attention, toute progression sera perdue, souhaitez-vous quitter ?')) {
            return;
        }


        //on supprime les données de l'encounter
        localStorage.removeItem('encounterData');
        //on redirige vers la page d'accueil
        window.location.href = '/';
    }
}