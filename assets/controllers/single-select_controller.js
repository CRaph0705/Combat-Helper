import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    connect() {
        const labelElement = document.querySelector(`label[for="${this.element.id}"]`);
        const placeholderText = labelElement ? labelElement.textContent : 'Sélectionnez une option';


        $(this.element).select2(
            {
                placeholder: placeholderText,
                allowClear: true
            }
        );

        if (labelElement) {
            labelElement.remove();
        }
    }
}