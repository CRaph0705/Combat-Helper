import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    connect() {
        // this.element.textContent = 'plop';
        console.log('one two one two zis iz a test');
    }

    // Méthode pour trier les unités par initiative
    sortUnitsByInitiative() {
        var unitContainer = document.getElementById('unitContainer');
        var units = unitContainer.children;

        var sortedUnits = Array.from(units).sort(function (a, b) {
            var initiativeA = parseInt(a.querySelector('input').value);
            var initiativeB = parseInt(b.querySelector('input').value);
            return initiativeB - initiativeA;
        });

        // unités triées dans le DOM
        sortedUnits.forEach(function (unit) {
            unitContainer.appendChild(unit);
        });
    }

    // Méthode pour générer des initiatives aléatoires pour les monstres
    rollMonstersInitiatives() {
        var monstersData = document.getElementById('unitContainer').getAttribute('data-monsters');
        var monsters = JSON.parse(monstersData);

        monsters.forEach(function (monster) {
            var initiative = Math.floor(Math.random() * 20) + 1; // Génère un nombre aléatoire entre 1 et 20
            var initiativeElement = document.getElementById("initiative_" + monster.id);

            if (initiativeElement) {
                initiativeElement.textContent = initiative;
            }
        });
    }
}
