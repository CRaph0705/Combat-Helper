import { Controller } from "stimulus";

export default class extends Controller {

    connect() {
        console.log("player-index controller connected");

        const turboFrame = document.querySelector("turbo-frame");
        if (!turboFrame) {
            return;
        }
        let currentPlayerId = null; // Stocke l'ID du player actuellement affiché

        const players = document.querySelectorAll(".player");

        players.forEach((player) => {
            player.addEventListener("click", (event) => {
                const playerId = event.currentTarget.dataset.id;
                const playerSrc = event.currentTarget.dataset.src;
                console.log(currentPlayerId);
                if (currentPlayerId === playerId) {
                    turboFrame.src = "";
                    currentPlayerId = null;
                } else {
                    turboFrame.src = playerSrc;
                    currentPlayerId = playerId;
                }
            });
        });
    }
}

