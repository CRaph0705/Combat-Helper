import { Controller } from "stimulus";

export default class extends Controller {

    connect() {
        // console.log("monster-index controller connected");

        const turboFrame = document.querySelector("turbo-frame");
        if (!turboFrame) {
            return;
        }

        const monsters = document.querySelectorAll(".monster");
        let currentMonsterId = null;
        monsters[0].classList.add("unit-selected");
        turboFrame.src = monsters[0].dataset.src;
        currentMonsterId = monsters[0].dataset.id;

        monsters.forEach((monster) => {
            monster.addEventListener("click", (event) => {
                const monsterId = event.currentTarget.dataset.id;
                const monsterSrc = event.currentTarget.dataset.src;

                monsters.forEach((m) => m.classList.remove("unit-selected"));
                event.currentTarget.classList.add("unit-selected");

                turboFrame.src = monsterSrc;
                currentMonsterId = monsterId;

            });
        });
    }
}