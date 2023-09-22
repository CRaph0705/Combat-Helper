import { Controller } from '@hotwired/stimulus';
import updatePlayerSelects from "../js-functions/updatePlayerSelects";
import updateSaveButtonState from "../js-functions/updateSaveButtonState";

export default class extends Controller {
    connect() {
        // console.log('players-form controller connected');

        let playerFormCounter = document.querySelectorAll('.player-form').length;
        const saveButton = document.querySelector('#btn-save');

        updateSaveButtonState();

        let playerSelectors = document.querySelectorAll('.encounter-player-character-select');
        playerSelectors.forEach(function (select) {
            select.addEventListener('change', updatePlayerSelects);
        });

        const addTagFormDeleteLink = (item) => {
            const wrapperDiv = document.createElement('div');
            wrapperDiv.classList.add('col-2');
            item.append(wrapperDiv);
            const removeFormButton = document.createElement('button');
            removeFormButton.classList.add('btn', 'btn-remove-unit');
            removeFormButton.innerText = 'Retirer';
            wrapperDiv.append(removeFormButton);
            removeFormButton.addEventListener('click', (e) => {
                e.preventDefault();
                item.remove();
                updatePlayerSelects();
                updateSaveButtonState();
                playerFormCounter--;
            });
        }

        const players = document.querySelectorAll('div.player-form');
        players.forEach((player) => {
            addTagFormDeleteLink(player);
        });

        const addPlayerTagLink = document.createElement('button');
        addPlayerTagLink.type = "button";
        addPlayerTagLink.classList.add('btn', 'btn-default', 'mb-4');
        addPlayerTagLink.classList.add('add_tag_list');
        addPlayerTagLink.innerText = 'Ajouter un joueur';
        addPlayerTagLink.dataset.collectionHolderClass = 'players-content';
        const collectionHolder = document.querySelector('div.players-content');
        document.querySelector('div.player-title').appendChild(addPlayerTagLink);

        const addFormToCollection = (e) => {
            if (playerFormCounter >= MAX_PLAYER_FORMS) {
                return;
            }
            const collectionHolder = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);
            const item = document.createElement('div');
            item.classList.add('player-form', 'row', 'mb-4', 'unit-parchment');

            item.innerHTML = collectionHolder
                .dataset
                .prototype
                .replace(
                    /__name__/g,
                    collectionHolder.dataset.index
                );

            const select = item.querySelector('select');

            //SI ON VEUT UN SELECT AVEC UN PLACEHOLDER -- CHOIX DU JOUEUR --   >>>>>>>>>>>>>>
            // const placeholderOption = document.createElement('option');
            // placeholderOption.value = '';
            // placeholderOption.text = '-- Choix du joueur --';
            // placeholderOption.disabled = true;
            // placeholderOption.selected = true;
            // select.appendChild(placeholderOption);
            // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<

            const selectParent = select.parentElement;
            selectParent.classList.add('col-8');
            selectParent.parentElement.classList.add('row', 'col-8');
            addTagFormDeleteLink(item);

            collectionHolder.appendChild(item);
            collectionHolder.dataset.index++;
            item.scrollIntoViewIfNeeded({ behavior: 'smooth', block: 'center' });

            updateSaveButtonState();
            updatePlayerSelects();

            select.addEventListener('change', function (e) {

                updatePlayerSelects();
            });

            let options = select.querySelectorAll('option');

            let firstAvailableOption = Array.from(options).find(option => option.style.display !== 'none' && !option.selected);

            options.forEach(function (option) {
                if (option === firstAvailableOption) {
                    option.selected= true;
                } else {
                    option.selected = false;
                }
            });
            updatePlayerSelects();
            playerFormCounter++;
            updateSaveButtonState();
            
        };

        addPlayerTagLink.addEventListener("click", addFormToCollection);
    }
}
