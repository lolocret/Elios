import './bootstrap';
import Alpine from 'alpinejs';


window.Alpine = Alpine;
Alpine.start();




document.addEventListener('DOMContentLoaded', function () {
    // Ajouter la classe 'visible' pour l'animation de fondu et glissement entre les chapitres
    const chapter = document.querySelector('.chapter');
    chapter.classList.add('visible');

    // Ajouter la classe 'visible' pour faire apparaître les choix progressivement
    const choices = document.querySelectorAll('.choice');

    // Appliquer un délai progressif pour chaque choix
    choices.forEach((choice, index) => {
        setTimeout(() => {
            choice.classList.add('visible');
        }, index * 600); // Délai progressif de 200ms entre chaque choix
    });
});


setTimeout(function () {
    const logo = document.querySelector('.logo-scintillant');
    if (logo) {
        logo.classList.add('new-class');
    }
}, 100);  // Attendre 100ms


document.addEventListener('DOMContentLoaded', function () {
    const logo = document.querySelector('.logo-scintillant');
    console.log(logo);  // Vérifie si l'élément est trouvé dans la console

    if (logo) {
        logo.classList.add('new-class');  // Si l'élément est trouvé, ajoute une nouvelle classe
    } else {
        console.log("L'élément logo-scintillant n'a pas été trouvé dans le DOM.");
    }
});

