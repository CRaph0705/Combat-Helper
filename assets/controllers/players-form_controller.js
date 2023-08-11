import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    connect() {
        // onload = () => {
            console.log('players-form controller connected');


            const addTagFormDeleteLink = (item) => {
                const wrapperDiv = document.createElement('div');
                wrapperDiv.classList.add('col-2');
                item.append(wrapperDiv);
                const removeFormButton = document.createElement('button');
                removeFormButton.innerText = 'Retirer';
                wrapperDiv.append(removeFormButton);
                removeFormButton.addEventListener('click', (e) => {
                    e.preventDefault();
                    item.remove();
                });
            }

            const players = document.querySelectorAll('div.player-card');
            players.forEach((player) => {
                addTagFormDeleteLink(player);
            });

            const addPlayerTagLink = document.createElement('a')
            addPlayerTagLink.classList.add('add_tag_list')
            addPlayerTagLink.href = '#'
            addPlayerTagLink.innerText = 'Ajouter un joueur'
            addPlayerTagLink.dataset.collectionHolderClass = 'players-content'
            const collectionHolder = document.querySelector('div.players-content')
            document.querySelector('div.player-title').appendChild(addPlayerTagLink)
            const addFormToCollection = (e) => {
                const collectionHolder = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);
                const item = document.createElement('div');
                item.classList.add('player-card');
                item.innerHTML = collectionHolder
                    .dataset
                    .prototype
                    .replace(
                        /__name__/g,
                        collectionHolder.dataset.index
                    );
                collectionHolder.appendChild(item);
                collectionHolder.dataset.index++;
                addTagFormDeleteLink(item)
            }
            addPlayerTagLink.addEventListener("click", addFormToCollection)
        }
    // }
}

