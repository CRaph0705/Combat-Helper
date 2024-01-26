class Unit {
    constructor(id, name, isMonster, ac, hp, unitSrc) {
        this.id = id;
        this.name = name;
        this.isMonster = isMonster;
        this.ac = ac;
        this.hp = hp;
        this.unitSrc = unitSrc;
    }

    updateHP(newHp) {
        this.hp = newHp;
        // mise à jour du local storage ici ?
        const encounterData = JSON.parse(localStorage.getItem('encounterData'));
        encounterData[this.name].hp = newHp;
        localStorage.setItem('encounterData', JSON.stringify(encounterData));
    }
}
export default Unit;