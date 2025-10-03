import { Controller } from "@hotwired/stimulus";

export default class extends Controller {
    static targets = ["toggle", "menu"];

    connect() {
        // Fermer le dropdown si on clique ailleurs
        this.boundCloseOnOutsideClick = this.closeOnOutsideClick.bind(this);
        document.addEventListener("click", this.boundCloseOnOutsideClick);
    }

    disconnect() {
        // Nettoyer l'event listener
        document.removeEventListener("click", this.boundCloseOnOutsideClick);
    }

    toggle(event) {
        event.preventDefault();
        event.stopPropagation();

        const navItem = this.element.closest(".nav-item");
        navItem.classList.toggle("open");
    }

    closeOnOutsideClick(event) {
        const navItem = this.element.closest(".nav-item");
        if (!navItem.contains(event.target)) {
            navItem.classList.remove("open");
        }
    }
}
