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

export default updateMonsterSelects;