import { Controller } from "stimulus";

export default class extends Controller {

    connect() {
        console.log("monster-index controller connected");
        // on récupère la div content dans la colonne de droite
        this.detailsContentTarget = document.getElementById("detailsContent");
        console.log(this.detailsContentTarget);
    }

    loadMonsterDetails(event) {
        console.log('loadMonsterDetails called');

        const monsterId = event.currentTarget.getAttribute("data-monster-id");
        // console.log(monsterId);

        // Effectuez une requête AJAX pour obtenir les détails du monstre
        fetch(`/monster/${monsterId}`)
            .then(response => response.text())
            .then(data => {
                // Affichez les détails dans la colonne de droite
                this.detailsContentTarget.innerHTML = data;
            })
            .catch(error => {
                console.error("Error loading monster details:", error);
            });
    }
}

