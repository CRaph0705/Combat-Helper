// function getSelectedOptions () {

//     const playerSelectors = document.querySelectorAll('.encounter-player-character-select');
//     const monsterSelectors = document.querySelectorAll('.encounter-monster-select');

//     const selectedPlayers = [];
//     const selectedMonsters = [];

//     playerSelectors.forEach(select => {
//         const selectedOption = select.options[select.selectedIndex];
//         if (selectedOption.value !== '') {
//             selectedPlayers.push({
//                 value: selectedOption.value,
//                 select: select
//             });
//         }
//     });

//     monsterSelectors.forEach(select => {
//         const selectedOption = select.options[select.selectedIndex];
//         if (selectedOption.value !== '') {
//             selectedMonsters.push({
//                 value: selectedOption.value,
//                 select: select
//             });
//         }
//     });

//     console.log('Joueurs sélectionnés :', selectedPlayers);
//     console.log('Monstres sélectionnés :', selectedMonsters);

//     return {
//         players: selectedPlayers,
//         monsters: selectedMonsters,
//     };
// }

// export default getSelectedOptions;
