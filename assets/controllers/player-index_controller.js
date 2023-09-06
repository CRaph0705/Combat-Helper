import { Controller } from "stimulus";

export default class extends Controller {

    connect() {
        console.log("player-index controller connected");

        const turboFrame = document.querySelector("turbo-frame");
        if (!turboFrame) {
            return;
        }

        const players = document.querySelectorAll(".player");
        let currentPlayerId = null;
        players[0].classList.add("unit-selected");
        turboFrame.src = players[0].dataset.src;
        currentPlayerId = players[0].dataset.id;

        players.forEach((player) => {
            player.addEventListener("click", (event) => {
                const playerId = event.currentTarget.dataset.id;
                const playerSrc = event.currentTarget.dataset.src;

                players.forEach((p) => p.classList.remove("unit-selected"));
                event.currentTarget.classList.add("unit-selected");

                turboFrame.src = playerSrc;
                currentPlayerId = playerId;

            });
        });
    }
}

