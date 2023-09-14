import { Controller } from '@hotwired/stimulus';
// import { is } from 'core-js/core/object';


export default class extends Controller {
    static targets = ["unitContainer"];

    connect() {
        document.addEventListener('DOMContentLoaded', () => {
            this.checkEncounterStartConditions();
        });
        console.log('encounter_controller connected');
        this.unitContainer = document.getElementById('unitContainer');
        // this.unitContainerTarget.addEventListener('input', this.sortAndUpdate.bind(this));
        const inputs = this.unitContainer.querySelectorAll('.initiative');
        inputs.forEach(input => {
            input.addEventListener('focusout', this.sortAndUpdate.bind(this));
        });
    }



    checkEncounterStartConditions() {
        const initiatives = Array.from(this.unitContainer.querySelectorAll('.initiative'));
        const monsters = Array.from(this.unitContainer.querySelectorAll('.unit[data-monster="true"]'));
        const players = Array.from(this.unitContainer.querySelectorAll('.unit:not([data-monster="true"])'));
        const hps = Array.from(this.unitContainer.querySelectorAll('.hp'));
        const acs = Array.from(this.unitContainer.querySelectorAll('.ac'));


        const allInitiativesDefined = initiatives.every(initiativeElement => initiativeElement.value !== '');
        const allHpDefined = hps.every(hpElement => hpElement.value !== '');
        const allAcDefined = acs.every(acElement => acElement.value !== '');



        const isEncounterReady = allInitiativesDefined && monsters.length > 0 && players.length > 0 && allHpDefined && allAcDefined;

        const startEncounterButton = document.getElementById('startEncounterButton');
        if (startEncounterButton) {
            startEncounterButton.disabled = !isEncounterReady;
        }
        console.log('checkEncounterStartConditions');
    }



    sortAndUpdate() {
        // Récupérer toutes les unités
        const units = Array.from(this.unitContainer.querySelectorAll('.unit'));
        const unitsWithInitiative = units.filter(unit => unit.querySelector('.initiative').value !== '');
        const unitsWithoutInitiative = units.filter(unit => unit.querySelector('.initiative').value === '');


        // Tri des unités par initiative
        unitsWithInitiative.sort((a, b) => {
            const initiativeA = parseInt(a.querySelector('.initiative').value);
            const initiativeB = parseInt(b.querySelector('.initiative').value);
            return initiativeB - initiativeA;
        });

        const sortedUnits = [...unitsWithInitiative, ...unitsWithoutInitiative];


        // Vider le conteneur et ajouter les unités triées
        this.unitContainerTarget.innerHTML = '';
        sortedUnits.forEach(unit => {
            this.unitContainerTarget.appendChild(unit);
        });
        console.log('sortAndUpdate');
        this.checkEncounterStartConditions();

    }



    // Méthode pour générer des initiatives aléatoires pour les monstres
    rollMonstersInitiatives() {
        console.log('rollMonstersInitiatives');

        const monstersByType = {};

        const monsters = Array.from(this.unitContainer.querySelectorAll('.unit[data-monster="true"]'));

        monsters.forEach(monster => {
            const monsterName = monster.dataset.unitName;
            const monsterType = monsterName.split('_')[0];
            if (!monstersByType[monsterType]) {
                monstersByType[monsterType] = [];
            }
            monstersByType[monsterType].push(monster);
        });

        Object.keys(monstersByType).forEach(monsterType => {
            const typeMonsters = monstersByType[monsterType];
            // ajout du modificateur de dextérité
            const monsterDexterity = monstersByType[monsterType][0].dataset.unitDexterity;

            console.log('monsterDexterity :', monsterDexterity);
            const dexterityModifier = Math.floor((monsterDexterity - 10) / 2);

            const typeInitiative = Math.floor(Math.random() * 20) + 1 + dexterityModifier;


            typeMonsters.forEach(monster => {
                const initiativeElement = monster.querySelector('.initiative');
                initiativeElement.value = typeInitiative;
            });
        });
        this.sortAndUpdate();
    }


    resetInitiatives() {
        console.log('resetInitiatives');
        const initiatives = Array.from(this.unitContainer.querySelectorAll('.initiative'));
        initiatives.forEach(initiative => {
            initiative.value = '';
        });
        this.sortAndUpdate();
    }

    collectUnitsData() {
        // var isEncounterValid = false;
        const units = Array.from(this.unitContainer.querySelectorAll('.unit'));
        const initiatives = Array.from(this.unitContainer.querySelectorAll('.initiative'));
        const hps = Array.from(this.unitContainer.querySelectorAll('.hp'));
        const acs = Array.from(this.unitContainer.querySelectorAll('.ac'));
        

        // Récupérer les valeurs des HP et AC
        const hpValues = hps.map(hpElement => parseInt(hpElement.value));
        const acValues = acs.map(acElement => parseInt(acElement.value));
        const initiativeValues = initiatives.map(initiativeElement => parseInt(initiativeElement.value));

        //à l'initialisation, on vérifie que les valeurs sont bien des nombres et supérieures à ou égales à 0
        const isInitiativeValid = initiativeValues.every(initiative => !isNaN(initiative) && initiative >= 0);
        const isHpValid = hpValues.every(hp => !isNaN(hp) && hp >= 0);
        const isAcValid = acValues.every(ac => !isNaN(ac) && ac >= 0);

        if (!isInitiativeValid || !isHpValid || !isAcValid) {
            //on affiche un message d'erreur
            alert('Les valeurs d\'initiative, de points de vie et de classe d\'armure doivent être des nombres supérieurs ou égaux à 0');
            //et on redirige vers la page d'encounter/init

            //on return à l'encounter/init            
            window.location.href = `/encounter/${encounterId}/init`;
        } else {
            // isEncounterValid = true;
            //récupérer valeur de tous les inputs et les mettre en tableaux 
            // les clefs sont les initiatives, ac et hp des unités
            const unitsData = {};

            units.forEach((unit, index) => {
                const unitName = unit.dataset.unitName; 
                const initiative = parseInt(initiativeValues[index]);
                const hp = parseInt(hpValues[index]);
                const ac = parseInt(acValues[index]);
                //monster or player
                const isMonster = unit.dataset.monster === 'true';

                const unitId = unit.dataset.unitId;

                const unitSrc = unit.dataset.src;

                unitsData[unitName] = {
                    initiative: initiative,
                    hp: hp,
                    ac: ac,
                    //on ajoute cette propriété pour pouvoir différencier les monstres des joueurs dans le controller encounter-active_controller.js
                    // ça permettra d'afficher le show de l'unité dans le turbo frame
                    isMonster: isMonster,
                    id: unitId,
                    unitSrc: unitSrc,
                    
                };
            });
            //ICI ON A DES TABLEAUX D'UNITS AVEC LEURS INITIATIVES, AC ET HP DES UNITES RESPECTIVES
            // console.log(unitsData);
            return unitsData;
        }
    }

    //store the data in local storage
    saveEncounterData() {
        const unitsData = this.collectUnitsData();
        localStorage.setItem('encounterData', JSON.stringify(unitsData));
    }


    //load the data from local storage
    loadEncounterData() {
        console.log('loadEncounterData');
        const unitsData = JSON.parse(localStorage.getItem('encounterData'));
        return unitsData;
    }

    //delete the data from local storage
    deleteEncounterData() {
        localStorage.removeItem('encounterData');
    }

    startEncounter() {
        console.log('startEncounter');
        //si toutes les unités ont une initiative, des hp et une ac on peut commencer l'encounter
        //sinon on affiche un message d'erreur
        // d'abord la vérification :
        const unitsData = this.collectUnitsData();
        if (!unitsData) {
            return;
        }

        // on commence par supprimer les données de l'encounter précédent
        this.deleteEncounterData();

        // ensuite on récupère les données des unités
        const encounterUnitsData = this.collectUnitsData();

        // on les stocke dans le local storage
        this.saveEncounterData(encounterUnitsData);

        const encounterId = this.element.dataset.id;
        window.location.href = `/encounter/${encounterId}/active`;

    }
    //export the function to be used in the encounter-active_controller.js
}