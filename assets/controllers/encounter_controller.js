import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ["unitContainer"];

    connect() {
        console.log('encounter_controller connected');
        this.unitContainer = document.getElementById('unitContainer');
        // this.unitContainerTarget.addEventListener('input', this.sortAndUpdate.bind(this));
        const inputs = this.unitContainer.querySelectorAll('.initiative');
        inputs.forEach(input => {
            input.addEventListener('focusout', this.sortAndUpdate.bind(this));
        });
    }

    sortAndUpdate() {
        // Récupérer toutes les unités
        const units = Array.from(this.unitContainer.querySelectorAll('.unit'));
        // Tri des unités par initiative
        units.sort((a, b) => {
            const initiativeA = parseInt(a.querySelector('.initiative').value);
            const initiativeB = parseInt(b.querySelector('.initiative').value);
            return initiativeB - initiativeA;
        });

        // Vider le conteneur et ajouter les unités triées
        this.unitContainerTarget.innerHTML = '';
        units.forEach(unit => {
            this.unitContainerTarget.appendChild(unit);
        });


    }


    //next step: add a button to roll initiatives for monsters
    // Méthode pour générer des initiatives aléatoires pour les monstres
    rollMonstersInitiatives() {
        // console.log('rollMonstersInitiatives');

        const monsters = Array.from(this.unitContainer.querySelectorAll('.unit[data-monster="true"]'));
       // console.log(monsters);

        monsters.forEach(monster => {
            const initiativeElement = monster.querySelector('.initiative');
            // console.log(initiativeElement);

            if (initiativeElement) {
                const initiative = Math.floor(Math.random() * 20) + 1;
                initiativeElement.value = initiative;
            }
        });
        this.sortAndUpdate();
    }

    resetInitiatives() {
        console.log('resetInitiatives');
        const initiatives = Array.from(this.unitContainer.querySelectorAll('.initiative'));
        initiatives.forEach(initiative => {
            initiative.value = '';
        });
        this.sortAndUpdate();
    }

    startEncounter() {
        const units = Array.from(this.unitContainer.querySelectorAll('.unit'));
        const initiatives = Array.from(this.unitContainer.querySelectorAll('.initiative'));
        const hps = Array.from(this.unitContainer.querySelectorAll('.hp'));
        const acs = Array.from(this.unitContainer.querySelectorAll('.ac'));
        //récupérer valeur de tous les inputs et les mettre en tableaux 
        // les clefs sont les initiatives, ac et hp des unités
        const unitsData = {};

        units.forEach((unit, index) => {
            const unitName = unit.dataset.unitName; // Supposons que le nom de l'unité soit stocké dans un attribut data-unit-name
            
            const initiative = parseInt(initiatives[index].value);
            const hp = parseInt(hps[index].value);
            const ac = parseInt(acs[index].value);
            
            unitsData[unitName] = {
                initiative: initiative,
                hp: hp,
                ac: ac
            };
        });

        console.log(unitsData);
        
    }



}