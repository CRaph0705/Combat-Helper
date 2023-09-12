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




        // on récupère les encounterExistingMonsters et on les affiche dans la console
        // on les récupère grâce au data-monster dans 
        // <div id="encounterExistingMonsters" data-monsters="{{ monsters | json_encode }}"></div>
        // const element = this.element;
        // const encounterExistingMonstersDiv = document.getElementById('encounterExistingMonsters');
        // console.log('test', encounterExistingMonstersDiv);

        // console.log('this', this);
        // console.log('this.element', this.element);
        // const encounterExistingMonstersData = JSON.parse(element.getAttribute("data-encounterExistingMonsters"));
        // console.log(JSON.parse(encounterExistingMonstersDiv.getAttribute("data-encounterExistingMonsters")));

        // encounterExistingMonstersData.forEach(encounterMonster => {
        //     const monster = encounterMonster.monster;
        //     const quantity = encounterMonster.quantity;
        //     console.log('Monster Name:', monster.name);
        //     console.log('Quantity:', quantity);
        // });    

        //var twig à récupérer : form.encounterMonsters
        //<div class="monsters-content" data-index="{{ form.encounterMonsters|length > 0 ? form.encounterMonsters|last.vars.name + 1 : 0 }}" data-prototype="{{ form_widget(form.encounterMonsters.vars.prototype)|e('html_attr') }}">

    }


}