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
        for (const unitName in unitsData) {
            const unitData = unitsData[unitName];

            // Création d'une nouvelle div pour chaque unité
            const unitDiv = document.createElement('div');
            unitDiv.classList.add('unit');
            unitDiv.innerHTML = `
            <p>Nom : ${unitName}</p>
            <p>Classe d'armure (AC) : ${unitData.ac}</p>
            <p>Points de vie (HP) : ${unitData.hp}</p>
            <p>Initiative : ${unitData.initiative}</p>
        `;

            // Ajout de la div de l'unité au conteneur
            container.appendChild(unitDiv);
            ScrollHeight();
        }
    }

    /* ------------------------------------------------------------------------------------------- */



}