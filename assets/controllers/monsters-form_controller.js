import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    connect() {
        console.log('monsters-form controller connected');

        // // Fonction pour ajouter un lien de suppression à chaque élément du formulaire
        // const addTagFormDeleteLink = (item) => {
        //     // Vérifier si le bouton "Remove" n'est pas déjà présent avant de l'ajouter
        //     if (!item.querySelector('.col-2 button')) {
        //         const wrapperDiv = document.createElement('div');
        //         wrapperDiv.classList.add('col-2');
        //         item.append(wrapperDiv);
        //         const removeFormButton = document.createElement('button');
        //         removeFormButton.innerText = 'Remove';
        //         wrapperDiv.append(removeFormButton);
        //         removeFormButton.addEventListener('click', (e) => {
        //             e.preventDefault();
        //             item.remove();
        //             // Vérifier si la liste de monstres est vide après la suppression et afficher le bouton "Add" si nécessaire
        //             const monstersContent = document.querySelector('.monsters-content');
        //             const monsters = monstersContent.querySelectorAll('[data-controller="monsters-form"]');
        //             if (monsters.length === 0) {
        //                 const addTagLink = document.querySelector('.add_tag_list');
        //                 if (addTagLink) {
        //                     addTagLink.style.display = 'inline';
        //                 }
        //             }
        //         });
        //     }
        // }

        // // Lorsque la page se charge, ajoutez un lien de suppression à chaque élément existant du formulaire
        // const monsters = document.querySelectorAll('[data-controller="monsters-form"]');
        // monsters.forEach((monster) => {
        //     addTagFormDeleteLink(monster);
        // });

        // // Récupérer le lien "Add" pour ajouter de nouveaux éléments au formulaire
        // const addTagLink = document.querySelector('.add_tag_list');
        // if (addTagLink) {
        //     const monsterSelectSection = document.querySelector('.monster-selection-section');

        //     addTagLink.addEventListener("click", (e) => {
        //         e.preventDefault();
        //         // Masquer le bouton "Add" lorsqu'on ajoute un monstre
        //         addTagLink.style.display = 'none';

        //         // Afficher la section de sélection de monstres (le select)
        //         monsterSelectSection.style.display = 'block';
        //     });

        //     const monsterSelect = monsterSelectSection.querySelector('select');
        //     console.log('plop',monsterSelect);
        //     monsterSelect.addEventListener('change', (e) => {
        //         const selectedMonsterId = e.target.value;
        //         if (selectedMonsterId !== '') {
        //             // Créer une nouvelle section de monstre dans le formulaire en fonction de l'ID sélectionné
        //             const collectionHolder = document.querySelector('.monsters-content');
        //             const item = document.createElement('div');
        //             item.innerHTML = collectionHolder.dataset.prototype.replace(/__name__/g, collectionHolder.dataset.index);

        //             // Mettre à jour les champs du formulaire avec les informations du monstre sélectionné (récupérées depuis la base de données)
        //             // Par exemple, vous pouvez effectuer une requête AJAX pour obtenir les informations du monstre en fonction de son ID
        //             // Et ensuite, remplir les champs du formulaire avec les informations du monstre

        //             collectionHolder.appendChild(item);
        //             collectionHolder.dataset.index++;
        //             addTagFormDeleteLink(item);

        //             // Réinitialiser le select de sélection de monstres
        //             monsterSelect.value = '';
        //             // Masquer à nouveau la section de sélection de monstres (le select) après avoir ajouté le monstre
        //             monsterSelectSection.style.display = 'none';
        //             // Réafficher le bouton "Add" pour permettre d'ajouter d'autres monstres
        //             addTagLink.style.display = 'inline';
        //         }
        //     });
        // }


        const addTagFormDeleteLink = (item) => {
            const wrapperDiv = document.createElement('div');
            wrapperDiv.classList.add('col-2');
            item.append(wrapperDiv);
            const removeFormButton = document.createElement('button');
            removeFormButton.innerText = 'Supprimer';
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

        const addTagLink = document.createElement('a')
        addTagLink.classList.add('add_tag_list')
        addTagLink.href = '#'
        addTagLink.innerText = 'Ajouter'
        addTagLink.dataset.collectionHolderClass = 'monsters-content'
        const collectionHolder = document.querySelector('div.monsters-content')
        document.querySelector('div.monster-title').appendChild(addTagLink)
        const addFormToCollection = (e) => {
            const collectionHolder = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);
            const item = document.createElement('div');
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
        addTagLink.addEventListener("click", addFormToCollection)
    }

}

