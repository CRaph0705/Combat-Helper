// assets/js/controllers/add-monster-controller.js

import { Controller } from 'stimulus';

export default class extends Controller {
    static targets = ['monstersList', 'select'];

    connect() {
        console.log('add-monster controller connected');
    }

    onMonsterSelected() {
        const selectedMonsterId = this.selectTarget.value;
        const selectedMonsterName = this.selectTarget.options[this.selectTarget.selectedIndex].text;

        if (selectedMonsterId && selectedMonsterName) {
            const newMonsterDiv = document.createElement('div');
            newMonsterDiv.textContent = selectedMonsterName;
            newMonsterDiv.dataset.monsterId = selectedMonsterId;
            newMonsterDiv.classList.add('container', 'card', 'mb-4', 'row');

            const removeButton = document.createElement('button');
            removeButton.textContent = 'Remove';
            removeButton.dataset.action = 'click->add-monster#removeMonster';

            newMonsterDiv.appendChild(removeButton);
            this.monstersListTarget.appendChild(newMonsterDiv);
        }
    }

    removeMonster(event) {
        const monsterDiv = event.currentTarget.parentNode;
        monsterDiv.remove();
    }
}
