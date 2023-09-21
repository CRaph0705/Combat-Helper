function updatePlayerSelects() {
    let playerSelectors = document.querySelectorAll('.encounter-player-character-select');
    let selectedPlayerValues = [];

    playerSelectors.forEach(function (select) {
        if (select.value) {
            selectedPlayerValues.push(select.value);
        }
    });

    playerSelectors.forEach(function (select) {
        let options = select.querySelectorAll('option');

        options.forEach(function (option) {
            option.style.display = 'block';

            selectedPlayerValues.forEach(function (selectedValue) {
                if (selectedValue && option.value === selectedValue && option.value !== select.value) {
                    option.style.display = 'none';
                }
            });
        });
    });
}

function updateMonsterSelects() {
    let monsterSelectors = document.querySelectorAll('.encounter-monster-select');
    let selectedMonsterValues = [];

    monsterSelectors.forEach(function (select) {
        if (select.value) {
            selectedMonsterValues.push(select.value);
        }
    });

    monsterSelectors.forEach(function (select) {
        let options = select.querySelectorAll('option');

        options.forEach(function (option) {
            option.style.display = 'block';

            selectedMonsterValues.forEach(function (selectedValue) {
                if (selectedValue && option.value === selectedValue && option.value !== select.value) {
                    option.style.display = 'none';
                }
            });
        });
    });
}

export { updatePlayerSelects, updateMonsterSelects };
