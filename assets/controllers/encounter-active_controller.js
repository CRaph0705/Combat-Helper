import { Controller } from '@hotwired/stimulus';
import { ScrollHeight } from '../app.js';

export default class extends Controller {
    connect() {
        console.log('encounter-active_controller connected');

        //on récupère les données de l'encounter
        const unitsData = this.loadEncounterData();
        console.log(unitsData);

        this.displayEncounterData();
        ScrollHeight();
        console.log(ScrollHeight());
    }

    //load the data from local storage
    loadEncounterData() {
        console.log('loadEncounterData');
        const unitsData = JSON.parse(localStorage.getItem('encounterData'));
        return unitsData;
    }

    /* ------------------------------------------------------------------------------------------- */

    displayEncounterData() {
        console.log('displayEncounterData');
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
            unitDiv.classList.add('unit-card');
            unitDiv.dataset.unitName = unitName;
            unitDiv.innerHTML = `
            <p>Nom : ${unitName}</p>
            <p>Classe d'armure (AC) : ${unitData.ac}</p>
            <p>Points de vie (HP) : <input type="number" id="hp" name="hp" value="${unitData.hp}">
            </p>
            <p>Initiative : ${unitData.initiative}</p>
            `;
    
            // Si c'est la première unité, ajouter la classe "active"
            if (isFirstUnit) {
                unitDiv.classList.add('active');
                isFirstUnit = false;
            }
    
            // Ajout de la div de l'unité au conteneur
            container.appendChild(unitDiv);
            ScrollHeight();
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
    
        // Trouver l'index de l'unité suivante, en bouclant si nécessaire
        const nextIndex = (currentIndex + 1) % Object.keys(unitsData).length;
    
        // Récupérer le nom de l'unité suivante
        const nextUnitName = Object.keys(unitsData)[nextIndex];
    
        // Supprimer la classe active de l'unité actuelle
        currentUnit.classList.remove('active');
    
        // Ajouter la classe active à l'unité suivante
        const nextUnit = document.querySelector(`.unit[data-unit-name="${nextUnitName}"]`);
        nextUnit.classList.add('active');
        nextUnit.scrollIntoView({ behavior: 'smooth', block: 'center' });

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
    
        // Trouver l'index de l'unité précédente, en bouclant si nécessaire
        const previousIndex = (currentIndex - 1 + unitNames.length) % unitNames.length;
    
        // Récupérer le nom de l'unité précédente
        const previousUnitName = unitNames[previousIndex];
    
        // Supprimer la classe active de l'unité actuelle
        currentUnit.classList.remove('active');
    
        // Ajouter la classe active à l'unité précédente
        const previousUnit = document.querySelector(`.unit[data-unit-name="${previousUnitName}"]`);
        previousUnit.classList.add('active');
        previousUnit.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
    

    /* ------------------------------------------------------------------------------------------- */




}