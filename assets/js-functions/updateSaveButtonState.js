function updateSaveButtonState() {
    const saveButton = document.querySelector('#btn-save');
    const playerFormCounter = document.querySelectorAll('.player-form').length;
    const monsterFormCounter = document.querySelectorAll('.monster-form').length;

    if (playerFormCounter > 0 && monsterFormCounter > 0) {
        saveButton.removeAttribute('disabled');
    } else {
        saveButton.setAttribute('disabled', 'disabled');
    }
}

export default updateSaveButtonState;