function updatePlayerSelects() {
    let playerSelectors = document.querySelectorAll('.encounter-player-character-select');
    let selectedPlayerValues = [];


    playerSelectors.forEach(function (select) {
        if (select.value && selectedPlayerValues.includes(select.value) === false) {
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

    console.log('selectedPlayerValues', selectedPlayerValues);

}


export default updatePlayerSelects;
