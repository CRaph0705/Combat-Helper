/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// Importez le contrôleur Stimulus et les autres dépendances nécessaires
import { Application } from 'stimulus';
import { definitionsFromContext } from 'stimulus/webpack-helpers';
// import { Controller } from 'stimulus';

// Initialisez l'application Stimulus
// import stimulusApplication from './controllers/stimulusSingleton';
// console.log('stimulus ok');


// console.log(definitionsFromContext);
// console.log(Application);
// console.log(Controller);

import './bootstrap';
// Démarrez le code JavaScript spécifique à votre application après avoir initialisé l'application Stimulus
console.log('bootsrap ok');


