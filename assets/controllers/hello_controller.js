import { Controller } from '@hotwired/stimulus';

/*
 * This is an example Stimulus controller!
 *
 * Any element with a data-controller="hello" attribute will cause
 * this controller to be executed. The name "hello" comes from the filename:
 * hello_controller.js -> "hello"
 *
 * Delete this file or adapt it for your use!
 */
export default class extends Controller {
    connect() {
        // this.element.textContent = 'plop';
        console.log('hello controller connected');


// First call to define "parchment" height
// document.onload = ScrollHeight();

// Redraw when viewport is modified
// window.addEventListener('resize', function(event){
//   ScrollHeight();
// });


// function ScrollHeight() {
//   var content = document.querySelector('#parchment');
//   var container = document.querySelector('#contain');

  // SVG feTurbulence can modify all others elements, fo this reason "parchment" is in another <div> and in absolute position.
  // so for a better effect, absolute height is defined by his content.
//   content.style.height = container.offsetHeight + 'px';
// }

    }
}
