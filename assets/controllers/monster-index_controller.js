import { Controller } from "stimulus";

export default class extends Controller {

    connect() {
        console.log("monster-index controller connected");

        const turboFrame = document.querySelector("turbo-frame");
        if (!turboFrame) {
            return;
        }
        let currentMonsterId = null; // Stocke l'ID du monstre actuellement affiché

        const monsters = document.querySelectorAll(".monster");

        monsters.forEach((monster) => {
            monster.addEventListener("click", (event) => {
                const monsterId = event.currentTarget.dataset.id;
                const monsterSrc = event.currentTarget.dataset.src;
                // if (currentMonsterId === monsterId) {
                //     turboFrame.src = "";
                //     currentMonsterId = null;
                // } else {
                    turboFrame.src = monsterSrc;
                    currentMonsterId = monsterId;
                // }
                // console.log(currentMonsterId);
            });
        });
    }
}

