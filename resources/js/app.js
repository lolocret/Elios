import './bootstrap';
import Alpine from 'alpinejs';
import { createApp } from 'vue';
import StoryReader from './StoryReader.vue';

window.Alpine = Alpine;
Alpine.start();

// Monte Vue.js après que le DOM soit complètement chargé
document.addEventListener('DOMContentLoaded', function () {
    // Monte Vue.js sur #vue-mount-point
    const mountPoint = document.querySelector('#vue-mount-point');
    if (mountPoint) {
        createApp(StoryReader, {
            // Passer les données de l'histoire à Vue.js via les props
            story: window.storyData,
          }).mount('#vue-mount-point');
    }

    // Applique les animations après le montage de Vue.js
    const chapter = document.querySelector('.chapter');
    if (chapter) {
        chapter.classList.add('visible');  // Ajouter la classe 'visible' pour l'animation de fondu
    }

    const choices = document.querySelectorAll('.choice');
    choices.forEach((choice, index) => {
        setTimeout(() => {
            if (choice) {
                choice.classList.add('visible');  // Ajouter la classe 'visible' pour faire apparaître les choix progressivement
            }
        }, index * 600); // Délai progressif de 600ms entre chaque choix
    });

    const logo = document.querySelector('.logo-scintillant');
    if (logo) {
        logo.classList.add('new-class');  // Ajouter une nouvelle classe à l'élément logo
    } else {
        console.log("L'élément logo-scintillant n'a pas été trouvé dans le DOM.");
    }
});
