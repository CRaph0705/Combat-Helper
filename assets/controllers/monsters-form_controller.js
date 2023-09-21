import { Controller } from '@hotwired/stimulus';
// import updateSelectOptions from '../js-functions/updateSelectOptions.js';
import updateMonsterSelects from '../js-functions/updateMonsterSelects.js';
// import './select-controller.js';


export default class extends Controller {
    connect() {

        console.log('monsters-form controller connected');

        let monsterSelectors = document.querySelectorAll('.encounter-monster-select');
        monsterSelectors.forEach(function (monsterSelect) {
            monsterSelect.addEventListener('change', updateMonsterSelects);
        });

        updateMonsterSelects();
        // ----------------- BOUTON RETIRER -----------------
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
                updateMonsterSelects();
            });
        }

        // ----------------- BOUTON AJOUTER -----------------

        const monsters = document.querySelectorAll('div.monster-form');
        monsters.forEach((monster) => {
            addTagFormDeleteLink(monster);
        });

        const addMonsterTagLink = document.createElement('button');
        addMonsterTagLink.type = "button";
        addMonsterTagLink.classList.add('btn', 'btn-default', 'mb-4');
        addMonsterTagLink.classList.add('add_tag_list');
        addMonsterTagLink.innerText = 'Ajouter un monstre';
        addMonsterTagLink.dataset.collectionHolderClass = 'monsters-content';
        const collectionHolder = document.querySelector('div.monsters-content');
        document.querySelector('div.monster-title').appendChild(addMonsterTagLink);

        const addFormToCollection = (e) => {
            const collectionHolder = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);
            const item = document.createElement('div');
            item.classList.add('monster-form', 'row', 'mb-4', 'unit-parchment');

            item.innerHTML = collectionHolder
                .dataset
                .prototype
                .replace(
                    /__name__/g,
                    collectionHolder.dataset.index
                );

            //on récupère le select à l'intérieur de notre div
            const select = item.querySelector('select');
            // ajout de style sur le select
            const selectParent = select.parentElement;
            selectParent.classList.add('col-8');

            //on récupère l'input à l'intérieur de notre div
            const input = item.querySelector('input');
            const inputParent = input.parentElement;
            inputParent.classList.add('col-4');

            inputParent.parentElement.classList.add('row', 'col-8');


            addTagFormDeleteLink(item);
            updateMonsterSelects();

            collectionHolder.appendChild(item);
            collectionHolder.dataset.index++;
            item.scrollIntoView({ behavior: 'smooth', block: 'start' });

            updateMonsterSelects();

            select.addEventListener('change', function (e) {
                updateMonsterSelects();
            });

            let options = select.querySelectorAll('option');

            let firstAvailableOption = Array.from(options).find(option => option.style.display !== 'none' && !option.selected);

            options.forEach(function (option) {
                if (option === firstAvailableOption) {
                    option.setAttribute('selected', 'selected');
                } else {
                    option.removeAttribute('selected');
                }
            });

            updateMonsterSelects();
        };


        addMonsterTagLink.addEventListener("click", addFormToCollection)

        // const monsterSelectors = document.querySelectorAll('.encounter-monster-select');

        // monsterSelectors.forEach(select => {
        //     select.addEventListener('change', function (e) {
        //         updateMonsterSelects(monsterSelectors);
        //     });
        // });
    }


}