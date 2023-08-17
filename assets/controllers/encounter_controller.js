import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ["unitContainer"];

    connect() {
        console.log('encounter_controller connected');
        this.unitContainer = document.getElementById('unitContainer');
        this.unitContainerTarget.addEventListener('input', this.sortAndUpdate.bind(this));
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
    // rollMonstersInitiatives() {
    //     var monstersData = document.getElementById('unitContainer').getAttribute('data-monsters');
    //     var monsters = JSON.parse(monstersData);

    //     monsters.forEach(function (monster) {
    //         var initiative = Math.floor(Math.random() * 20) + 1; // Génère un nombre aléatoire entre 1 et 20
    //         var initiativeElement = document.getElementById("initiative_" + monster.id);

    //         if (initiativeElement) {
    //             initiativeElement.textContent = initiative;
    //         }
    //     });
    // }




}



