import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    connect() {

        console.log('players-form controller connected');

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
            const collectionHolder = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);
            const item = document.createElement('div');
            item.classList.add('player-form', 'row', 'mb-4','unit-parchment');

            item.innerHTML = collectionHolder
                .dataset
                .prototype
                .replace(
                    /__name__/g,
                    collectionHolder.dataset.index
                );

            const select = item.querySelector('select');
            //on ajoute du style au select
            const selectParent = select.parentElement;
            selectParent.classList.add('col-8');
            selectParent.parentElement.classList.add('row', 'col-8');


            addTagFormDeleteLink(item);

            collectionHolder.appendChild(item);
            collectionHolder.dataset.index++;
            item.scrollIntoViewIfNeeded({ behavior: 'smooth', block: 'center' });
        };

        addPlayerTagLink.addEventListener("click", addFormToCollection)
    }
}