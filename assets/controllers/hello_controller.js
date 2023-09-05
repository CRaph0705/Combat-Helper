import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
  connect() {
    console.log('hello controller connected');


    /// navbar fixed sur la homepage uniquement
    if (window.location.pathname === '/') {
      window.onscroll = function () { stickTheNavbar() };

      // Get the navbar
      var navbar = document.getElementById("navbar");

      // Get the offset position of the navbar
      var sticky = navbar.offsetTop;

      // Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
      function stickTheNavbar() {
        if (window.scrollY >= sticky) {
          navbar.classList.add("sticky")
        } else {
          navbar.classList.remove("sticky");
        }
      }
    }
  }
}
