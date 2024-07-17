import { Controller } from "stimulus";

export default class extends Controller {
    staticMonsters = [];

    connect() {
        // console.log("monster-index controller connected");

        const turboFrame = document.querySelector("turbo-frame");
        if (!turboFrame) {
            return;
        }

        const monsters = document.querySelectorAll(".monster");
        this.staticMonsters = Array.from(monsters);
        // console.log(this.staticMonsters);
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

    filterMonsters() {
        // console.log("filterMonsters");
        const searchInput = document.getElementById("monsterSearch");
        // console.log(searchInput.value);
        const monsters = document.querySelectorAll(".monster");

        const searchValue = searchInput.value.toLowerCase();

        monsters.forEach((monster) => {
            const monsterName = monster.dataset.name.toLowerCase();
            const shouldDisplay = monsterName.includes(searchValue);

            if (shouldDisplay) {
                monster.style.display = "block";
            } else {
                monster.style.display = "none";
            }
        });

        let firstVisibleMonster = null;
        const displayedMonsters = document.querySelectorAll(".monster");
        for (let i = 0; i < displayedMonsters.length; i++) {
            if (displayedMonsters[i].style.display !== "none") {
                firstVisibleMonster = displayedMonsters[i];
                break;
            }
        }
        if (firstVisibleMonster) {
            const turboFrame = document.querySelector("turbo-frame");
            turboFrame.src = firstVisibleMonster.dataset.src;

            monsters.forEach((m) => m.classList.remove("unit-selected"));
            firstVisibleMonster.classList.add("unit-selected");
        }

    }
}