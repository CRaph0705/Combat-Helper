import getSelectedOptions from './getSelectedOptions.js';


function updateSelectOptions() {
    console.log('updateSelectOptions function called');

    // On appelle la fonction getSelectedOptions() pour récupérer les options sélectionnées
    const selectedOptions = getSelectedOptions();

    // On récupère les options de tous les selects
    const playerSelectors = document.querySelectorAll('.encounter-player-character-select');
    const monsterSelectors = document.querySelectorAll('.encounter-monster-select');

    // On réinitialise tous les selects (on réaffiche toutes les options)
    playerSelectors.forEach(select => {
        select.querySelectorAll('option').forEach(option => {
            option.hidden = false;
        });
    });

    monsterSelectors.forEach(select => {
        select.querySelectorAll('option').forEach(option => {
            option.hidden = false;
        });
    });

    // On cache les options déjà sélectionnées dans les autres selects
    playerSelectors.forEach(select => {
        if (select !== selectedOptions.sourceSelect) {
            select.querySelectorAll('option').forEach(option => {
                if (selectedOptions.players.includes(option.value) && select !== selectedOptions.sourceSelect) {
                    option.hidden = true;
                }
            });
        }
    });

    monsterSelectors.forEach(select => {
        if (select !== selectedOptions.sourceSelect) {
            select.querySelectorAll('option').forEach(option => {
                if (selectedOptions.monsters.includes(option.value) && select !== selectedOptions.sourceSelect) {
                    option.hidden = true;
                }
            });
        }
    });

    // selectedOptions.sourceSelect.querySelectorAll('option').forEach(option => {
    //     option.hidden = false;
    // });
console.log('pokpok',selectedOptions);

}

// export default updateSelectOptions;
