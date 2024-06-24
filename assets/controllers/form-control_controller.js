import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    connect() {
        const labelElement = document.querySelector(`label[for='${this.element.id}']`);
        const placeholderText = labelElement ? labelElement.textContent : '';
        this.element.setAttribute('placeholder', placeholderText);
        this.element.classList.add('form-control');

        if (labelElement) {
            labelElement.remove();
        }
    }
}