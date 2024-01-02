import Unit from './unit.js';
class Player extends Unit {
    constructor(id, name, ac, hp, unitSrc) {
        super(id, name, false, ac, hp, unitSrc);
    }
}
export default Player;