import { Controller } from '@hotwired/stimulus';


export default class extends Controller {
    connect() {

        console.log('monsters-form controller connected');
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

            // const handleSelectChange = function() {
            //     $.ajax({
            //         url: '/encounter/' + encounterId + '/get_available_units',
            //         method: 'GET',
            //         success: data => {
            //             console.log('success', data.avaialableMonsters);
            //         },
            //         error: data => {
            //             console.log('erreur');
            //         }
            //     })
            // }

            // const attachChangeEventListeners = function() {
            //     const selects = document.querySelectorAll('select');
            //     selects.forEach((select) => {
            //         select.addEventListener('change', handleSelectChange);
            //     });
            // };

            // attachChangeEventListeners();


            //on ajoute un event listener sur le select (ajax pour récupérer les unités disponibles)
            // select.addEventListener('change', function (e) {
			// 	$.ajax({
			// 		url: '/encounter/' + encounterId + '/get_available_units',
			// 		method: 'GET',
			// 		success: data => {
			// 			console.log('success', 'data.availableMonsters', data.availableMonsters);
			// 		},
			// 		error: data => {
			// 			console.log('erreur');
			// 		}
            //     })
            // });

            // ajout de style sur le select
            console.log(select);
            const selectParent = select.parentElement;
            console.log(selectParent);
            selectParent.classList.add('col-8');

            //on récupère l'input à l'intérieur de notre div
            const input = item.querySelector('input');
            console.log(input);
            const inputParent = input.parentElement;
            console.log(inputParent);
            inputParent.classList.add('col-4');

            inputParent.parentElement.classList.add('row', 'col-8');


            addTagFormDeleteLink(item);

            collectionHolder.appendChild(item);
            collectionHolder.dataset.index++;
            item.scrollIntoView({ behavior: 'smooth', block: 'start' });
        };

        addMonsterTagLink.addEventListener("click", addFormToCollection)

    }


}