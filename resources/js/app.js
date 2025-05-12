import './bootstrap';
import Alpine from 'alpinejs';
import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';

// Importation des vues
import StartView from './StartView.vue';
import ChapterView from './ChapterView.vue';

window.Alpine = Alpine;
Alpine.start();

const app = createApp(StartView, {
    storyId: window.storyData.id, // Passer l'objet story à Vue
  });
  
  app.mount('#app');
  
const routes = [
    { path: '/story/:id', component: StartView, name: 'start' },  // Assurez-vous que ce chemin est correct
    { path: '/chapter/:id', component: ChapterView, name: 'chapter' },
  ];
  
  const router = createRouter({
    history: createWebHistory(),
    routes,
  });

  export default router;

// Monte Vue.js après que le DOM soit complètement chargé
document.addEventListener('DOMContentLoaded', function () {
  const mountPoint = document.querySelector('#vue-mount-point');

  if (mountPoint) {
    // Monte l'application Vue avec le router
    createApp(StartView)
      .use(router)
      .mount('#vue-mount-point');
  }
});
