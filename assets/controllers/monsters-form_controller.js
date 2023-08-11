import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    connect() {
        onload = () => {
            console.log('monsters-form controller connected');


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

            const monsters = document.querySelectorAll('div.monster-card');
            monsters.forEach((monster) => {
                addTagFormDeleteLink(monster);
            });

            const addMonsterTagLink = document.createElement('a')
            addMonsterTagLink.classList.add('add_tag_list')
            addMonsterTagLink.href = '#'
            addMonsterTagLink.innerText = 'Ajouter un monstre'
            addMonsterTagLink.dataset.collectionHolderClass = 'monsters-content'
            const collectionHolder = document.querySelector('div.monsters-content')
            document.querySelector('div.monster-title').appendChild(addMonsterTagLink)
            const addFormToCollection = (e) => {
                const collectionHolder = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);
                const item = document.createElement('div');
                item.classList.add('monster-card');
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
            addMonsterTagLink.addEventListener("click", addFormToCollection)
        }
    }
}

