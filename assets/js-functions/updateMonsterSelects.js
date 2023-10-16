function updateMonsterSelects() {
    let monsterSelectors = document.querySelectorAll('.encounter-monster-select');
    let selectedMonsterValues = [];

    monsterSelectors.forEach(function (select) {
        if (select.value) {
            selectedMonsterValues.push(select.value);
        }
    });

    monsterSelectors.forEach(function (select) {
        let options = Array.from(select.options);
        options.sort((a, b) => a.text.localeCompare(b.text));
        select.innerHTML = '';
        options.forEach(option => select.appendChild(option));

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

export default updateMonsterSelects;