import { Controller } from 'stimulus';

export default class extends Controller {
    static targets = ['monstersList'];

    connect() {
        console.log('encounter-form controller connected');

        // Appeler la méthode pour récupérer les monstres déjà présents dans l'encounter
        this.getExistingMonsters();

        // Récupérer le lien "Add" pour ajouter de nouveaux éléments au formulaire
        const addTagLink = document.querySelector('.add_tag_list');
        if (addTagLink) {
            const monsterSelectSection = document.querySelector('.monster-selection-section');

            // Action pour ajouter un monstre à l'encounter lorsque l'utilisateur sélectionne un monstre dans le champ select
            const onMonsterSelected = (event) => {
                const selectedMonsterId = event.currentTarget.value;
                if (selectedMonsterId !== '') {
                    const selectedMonster = this.monsters.find((monster) => monster.id === parseInt(selectedMonsterId));
                    if (selectedMonster) {
                        this.addMonster(selectedMonster);
                    }
                    event.currentTarget.value = ''; // Réinitialiser le champ select après l'ajout
                }
            };

            // Action pour supprimer un monstre de l'encounter lorsque l'utilisateur clique sur le bouton "Remove"
            const removeMonster = (event) => {
                const monsterId = event.currentTarget.dataset.monsterId;
                const monsterIndex = this.monsters.findIndex((monster) => monster.id === parseInt(monsterId));
                if (monsterIndex !== -1) {
                    this.monsters.splice(monsterIndex, 1);
                    this.updateMonstersList();
                }
            };

            addTagLink.addEventListener("click", (e) => {
                e.preventDefault();
                // Masquer le bouton "Add" lorsqu'on ajoute un monstre
                addTagLink.style.display = 'none';

                // Afficher la section de sélection de monstres (le select)
                monsterSelectSection.style.display = 'block';
            });

            const monsterSelect = monsterSelectSection.querySelector('select');
            monsterSelect.addEventListener('change', onMonsterSelected);
        }
    }

    // Méthode pour récupérer les monstres déjà présents dans l'encounter lorsque la page se charge
    getExistingMonsters() {
        this.monsters = []; // Tableau pour stocker les monstres ajoutés à l'encounter

        // Récupérer la liste des monstres déjà présents dans l'encounter
        const monstersElements = this.monstersListTarget.querySelectorAll('.monster');
        monstersElements.forEach((monsterElement) => {
            const monsterId = monsterElement.dataset.monsterId;
            const monsterName = monsterElement.textContent;
            this.monsters.push({ id: parseInt(monsterId), name: monsterName });
        });
    }

    // Méthode pour ajouter un monstre à la liste des monstres de l'encounter
    addMonster(monster) {
        this.monsters.push(monster);
        this.updateMonstersList();
    }

    // Méthode pour mettre à jour la liste des monstres affichés dans le DOM
    updateMonstersList() {
        this.monstersListTarget.innerHTML = ''; // Effacer la liste actuelle de monstres
        this.monsters.forEach((monster) => {
            const monsterDiv = document.createElement('div');
            monsterDiv.classList.add('monster');
            monsterDiv.dataset.monsterId = monster.id;
            monsterDiv.textContent = monster.name;
            const removeButton = document.createElement('button');
            removeButton.classList.add('btn', 'btn-danger');
            removeButton.dataset.action = 'encounter-form#removeMonster';
            removeButton.dataset.monsterId = monster.id;
            removeButton.textContent = 'Remove';
            monsterDiv.appendChild(removeButton);
            this.monstersListTarget.appendChild(monsterDiv);
        });
    }

    // Méthode pour ajouter un lien de suppression à chaque élément du formulaire
    addTagFormDeleteLink(item) {
        // ... Votre code ici ...
    }

    // ... Les autres méthodes et actions ...
}
