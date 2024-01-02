import Unit from './unit.js';
class Monster extends Unit {
    constructor(id, name, ac, hp, unitSrc) {
        super(id, name, true, ac, hp, unitSrc);
    }
}
export default Monster;