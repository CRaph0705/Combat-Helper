function updatePlayerSelects() {
    let playerSelectors = document.querySelectorAll('.encounter-player-character-select');
    let selectedPlayerValues = [];

    playerSelectors.forEach(function (select) {
        if (select.value && selectedPlayerValues.includes(select.value) === false) {
            selectedPlayerValues.push(select.value);
        }
    });

    playerSelectors.forEach(function (select) {
        let options = Array.from(select.options);
        options.sort((a, b) => a.text.localeCompare(b.text));
        select.innerHTML = '';
        options.forEach(option => select.appendChild(option));

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
