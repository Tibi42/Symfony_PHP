import "./bootstrap.js";
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import "./styles/app.css";

console.log("This log comes from assets/app.js - welcome to AssetMapper! 🎉");

// Fonction pour ouvrir tous les liens externes dans un nouvel onglet
document.addEventListener("DOMContentLoaded", function () {
    // Sélectionner tous les liens qui commencent par http ou https
    const externalLinks = document.querySelectorAll('a[href^="http"]');

    externalLinks.forEach((link) => {
        // Ajouter target="_blank" pour ouvrir dans un nouvel onglet
        link.target = "_blank";
        // Ajouter rel="noopener noreferrer" pour la sécurité
        link.rel = "noopener noreferrer";

        // Optionnel : ajouter un indicateur visuel que le lien s'ouvre dans un nouvel onglet
        // Vous pouvez décommenter les lignes suivantes si vous voulez un petit indicateur
        /*
        const icon = document.createElement('span');
        icon.innerHTML = ' ↗';
        icon.style.fontSize = '0.8em';
        icon.style.opacity = '0.7';
        link.appendChild(icon);
        */
    });

    console.log(
        `Configured ${externalLinks.length} external links to open in new tabs`
    );
});
