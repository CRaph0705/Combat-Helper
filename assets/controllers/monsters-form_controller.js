import { Controller } from '@hotwired/stimulus';
// import { ScrollHeight } from '../app.js';
export default class extends Controller {
    connect() {
        // onload = () => {
            console.log('monsters-form controller connected');



            const addTagFormDeleteLink = (item) => {
                const wrapperDiv = document.createElement('div');
                wrapperDiv.classList.add('col-2');
                item.append(wrapperDiv);
                const removeFormButton = document.createElement('button');
                removeFormButton.classList.add('btn-remove-unit');
                removeFormButton.innerText = 'Retirer';
                wrapperDiv.append(removeFormButton);
                removeFormButton.addEventListener('click', (e) => {
                    e.preventDefault();
                    item.remove();

                    // ScrollHeight();
                });
            }

            const monsters = document.querySelectorAll('div.monster-card');
            monsters.forEach((monster) => {
                addTagFormDeleteLink(monster);
            });

            const addMonsterTagLink = document.createElement('button');
            addMonsterTagLink.type = "button";
            addMonsterTagLink.classList.add('btn-add-unit');
            addMonsterTagLink.classList.add('add_tag_list');
            addMonsterTagLink.innerText = 'Ajouter un monstre';
            addMonsterTagLink.dataset.collectionHolderClass = 'monsters-content';

            const collectionHolder = document.querySelector('div.monsters-content');
            document.querySelector('div.monster-title').appendChild(addMonsterTagLink);

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


                // add a delete link to the new form
                addTagFormDeleteLink(item);
                // ajust the height of the page with the new form
                // ScrollHeight();
                // scroll the page to the new form
                item.scrollIntoView({ behavior: 'smooth', block: 'start' });
            };

            addMonsterTagLink.addEventListener("click", addFormToCollection)
        }
    // }
}

