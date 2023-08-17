
// import { Controller } from '@hotwired/stimulus';

// export default class extends Controller {
//     static targets = ["unitContainer"];

//     connect() {
//         console.log('encounter_controller connected');
//         this.unitContainer = document.getElementById('unitContainer');
//         this.unitContainerTarget.addEventListener('input', this.handleInput.bind(this));

//         // Ajoutez cette partie pour initialiser les boutons au chargement de la page
//         const inputs = this.unitContainer.querySelectorAll('.initiative');
//         inputs.forEach(input => {
//             input.addEventListener('change', this.updateMoveButtons.bind(this)); // Ajoutez cet écouteur d'événement
//             this.updateMoveButtons(input); // Appelez la fonction pour mettre à jour les boutons
//         });

//         // Écouteurs d'événements pour les boutons Move Up et Move Down
//         const moveUpButtons = this.unitContainer.querySelectorAll('.move-up');
//         moveUpButtons.forEach(button => {
//             button.addEventListener('click', this.moveUnitUp.bind(this)); // Utilisation de .bind(this)
//         });

//         const moveDownButtons = this.unitContainer.querySelectorAll('.move-down');
//         moveDownButtons.forEach(button => {
//             button.addEventListener('click', this.moveUnitDown.bind(this)); // Utilisation de .bind(this)
//         });
//     }

//     handleInput(event) {
//         const input = event.target;
//         this.sortUnitsByInitiative(); // Tri des unités à chaque changement d'initiative
//         this.updateMoveButtons(input); // Mise à jour des boutons de déplacement
//     }

//     // Méthode pour trier les unités par initiative
//     sortUnitsByInitiative() {
//         const units = Array.from(this.unitContainerTarget.children);
//         const initiativeMap = new Map();
//         console.log(initiativeMap);

//         // Regrouper les unités par initiative
//         units.forEach((unit) => {
//             const initiative = parseInt(unit.querySelector('input').value);
//             if (!initiativeMap.has(initiative)) {
//                 initiativeMap.set(initiative, []);
//             }
//             initiativeMap.get(initiative).push(unit);
//         });

//         // Ordonner les unités pour chaque initiative
//         initiativeMap.forEach((unitGroup) => {
//             unitGroup.sort((a, b) => {
//                 const initiativeA = parseInt(a.querySelector('input').value);
//                 const initiativeB = parseInt(b.querySelector('input').value);
//                 return initiativeB - initiativeA;
//             });
//         });

//         // Vider le conteneur et ajouter les unités triées
//         this.unitContainerTarget.innerHTML = '';
//         initiativeMap.forEach((unitGroup) => {
//             unitGroup.forEach((unit) => {
//                 this.unitContainerTarget.appendChild(unit);
//             });
//         });

//         // Appel de la fonction pour mettre à jour les boutons de déplacement
//         this.updateMoveButtons();
//     }


//     moveUnitUp = event => {
//         const unit = event.currentTarget.closest('.unit');
//         const initiative = parseInt(unit.querySelector('.initiative').value);
//         const unitGroup = Array.from(this.unitContainer.querySelectorAll('.unit'))
//             .filter(u => parseInt(u.querySelector('.initiative').value) === initiative);

//         const currentIndex = unitGroup.indexOf(unit);
//         if (currentIndex > 0) {
//             const previousUnit = unitGroup[currentIndex - 1];
//             this.unitContainer.insertBefore(unit, previousUnit);
//             this.sortUnitsByInitiative();
//         }
//     }

//     moveUnitDown = event => {
//         const unit = event.currentTarget.closest('.unit');
//         const initiative = parseInt(unit.querySelector('.initiative').value);
//         const unitGroup = Array.from(this.unitContainer.querySelectorAll('.unit'))
//             .filter(u => parseInt(u.querySelector('.initiative').value) === initiative);

//         const currentIndex = unitGroup.indexOf(unit);
//         if (currentIndex < unitGroup.length - 1) {
//             const nextUnit = unitGroup[currentIndex + 1]; e
//             this.unitContainer.insertBefore(nextUnit, unit);
//             this.sortUnitsByInitiative();
//         }
//     }
//     updateMoveButtons(input) {
//         const unit = input.parentElement.closest('.unit'); // Trouver le parent .unit de l'input
//         const moveUpButton = unit.querySelector('.move-up');
//         const moveDownButton = unit.querySelector('.move-down');
//         const initiative = parseInt(input.value);
    
//         const units = this.unitContainer.querySelectorAll('.unit');
    
//         moveUpButton.disabled = false;
//         moveDownButton.disabled = false;
    
//         const unitGroup = Array.from(units).filter(u => {
//             const uInput = u.querySelector('.initiative');
//             return uInput && parseInt(uInput.value) === initiative;
//         });
    
//         const currentIndex = unitGroup.indexOf(unit);
    
//         if (currentIndex === 0) {
//             moveUpButton.disabled = true;
//         }
    
//         if (currentIndex === unitGroup.length - 1) {
//             moveDownButton.disabled = true;
//         }
//     }
    
    



//     //next step: add a button to roll initiatives for monsters
//     // Méthode pour générer des initiatives aléatoires pour les monstres
//     // rollMonstersInitiatives() {
//     //     var monstersData = document.getElementById('unitContainer').getAttribute('data-monsters');
//     //     var monsters = JSON.parse(monstersData);

//     //     monsters.forEach(function (monster) {
//     //         var initiative = Math.floor(Math.random() * 20) + 1; // Génère un nombre aléatoire entre 1 et 20
//     //         var initiativeElement = document.getElementById("initiative_" + monster.id);

//     //         if (initiativeElement) {
//     //             initiativeElement.textContent = initiative;
//     //         }
//     //     });
//     // }

// }



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

        // Regrouper et activer les boutons Move Up et Move Down pour chaque groupe d'initiatives égales
        let currentInitiative = null;
        let unitGroup = [];
        units.forEach(unit => {
            const initiative = parseInt(unit.querySelector('.initiative').value);
            if (initiative !== currentInitiative) {
                if (unitGroup.length > 1) {
                    this.activateMoveButtons(unitGroup);
                }
                unitGroup = [];
                currentInitiative = initiative;
            }
            unitGroup.push(unit);
        });
        if (unitGroup.length > 1) {
            this.activateMoveButtons(unitGroup);
        }
    }

    activateMoveButtons(unitGroup) {
        const firstUnit = unitGroup[0];
        const lastUnit = unitGroup[unitGroup.length - 1];
        const moveUpButton = firstUnit.querySelector('.move-up');
        const moveDownButton = lastUnit.querySelector('.move-down');
        moveUpButton.disabled = true;
        moveDownButton.disabled = true;
    }

    moveUnitUp = event => {
        const unit = event.currentTarget.closest('.unit');
        const initiative = parseInt(unit.querySelector('.initiative').value);
        const unitGroup = Array.from(this.unitContainer.querySelectorAll('.unit'))
            .filter(u => parseInt(u.querySelector('.initiative').value) === initiative);

        const currentIndex = unitGroup.indexOf(unit);
        if (currentIndex > 0) {
            const previousUnit = unitGroup[currentIndex - 1];
            this.unitContainer.insertBefore(unit, previousUnit);
            this.sortUnitsByInitiative();
        }
    }
    
    moveUnitDown = event => {
        const unit = event.currentTarget.closest('.unit');
        const initiative = parseInt(unit.querySelector('.initiative').value);
        const unitGroup = Array.from(this.unitContainer.querySelectorAll('.unit'))
            .filter(u => parseInt(u.querySelector('.initiative').value) === initiative);

        const currentIndex = unitGroup.indexOf(unit);
        if (currentIndex < unitGroup.length - 1) {
            const nextUnit = unitGroup[currentIndex + 1]; e
            this.unitContainer.insertBefore(nextUnit, unit);
            this.sortUnitsByInitiative();
        }
    }





}
