import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    connect() {
        const labelElement = document.querySelector(`label[for="${this.element.id}"]`);
        const placeholderText = labelElement ? labelElement.textContent : 'Choix multiple';


        $(this.element).select2(
            {
                placeholder: placeholderText,
                allowClear: true,
                minimumResultsForSearch: 0
            }
        );

        if (labelElement) {
            labelElement.remove();
        }
    }
}