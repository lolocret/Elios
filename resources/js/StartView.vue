<!-- //C’est la page d’accueil d’une histoire.

Données : story, currentChapter, backgroundImage.

Montage (mounted) : récupère la liste des chapitres, vérifie si 
un chapitre est sauvegardé dans localStorage et charge soit ce chapitre, 
soit le premier de l’histoire.

Méthodes;

loadChapter(chapterId) : récupère le chapitre via l’API puis met à jour 
currentChapter et l’image de fond.

selectChoice(choice) : sauvegarde la progression et charge le 
chapitre ciblé par le choix.

setBackgroundImage() : change l’image de fond selon que l’on 
soit au début, au milieu ou à la fin.

restartStory() : réinitialise la progression 
(appelle loadChapter(this.storyId), ce qui vise le premier chapitre). -->

<template>
  <!--Le contenu ne s’affiche que si l’histoire (story) et le chapitre en cours (currentChapter) sont chargés. -->
  <div v-if="story && currentChapter" class="relative min-h-screen flex justify-center items-center">
    <!-- Image de fond conditionnelle -->
    <div class="absolute inset-0 z-0 bg-cover bg-center object-cover" :style="{ backgroundImage: 'url(' + backgroundImage + ')', filter: 'brightness(0.4)', height: '100vh' }"></div>

    <!-- Carte immersive -->
    <div class="relative z-10 max-w-3xl bg-white/10 backdrop-blur-lg p-10 rounded-2xl shadow-2xl ring-1 ring-white/10 text-white animate-fade-in">
      <h1 class="text-4xl font-extrabold text-pink-200 drop-shadow-lg mb-6 text-center">{{ currentChapter.title }}</h1>
      <p class="text-lg text-gray-100 mb-8 text-center">{{ currentChapter.content }}</p>

      <!-- Affichage des choix -->
      <div v-if="currentChapter.choices && currentChapter.choices.length > 0" class="space-y-6">
        <h4 class="text-2xl font-semibold text-white mt-8 text-center">Que choisis-tu ?</h4>
        <div v-for="choice in currentChapter.choices" :key="choice.id" class="choice">
          <a @click.prevent="selectChoice(choice)" class="block w-full text-left bg-white/10 hover:bg-pink-300/20 hover:text-white font-semibold py-4 px-8 rounded-lg transition duration-300 backdrop-blur-md ring-1 ring-white/10 choice">
            {{ choice.text }}
          </a>
        </div>
      </div>

      <!-- Fin de branche -->
      <p v-else class="text-pink-100 italic text-center mt-8">Fin de cette branche du récit.</p>

      <!-- Bouton pour recommencer l'histoire -->
      <div class="mt-6 text-center">
        <button
  @click="restartStory"
  class="mt-4 px-8 py-3 bg-[#e5a2c3] hover:bg-[#e5a2c3ba] hover:backdrop-blur-sm text-white rounded-lg transition duration-300"
>
  Recommencer l'histoire
</button>
    </div>
    </div>
  </div>
</template>

<script>
export default {
  //Le composant reçoit un storyId depuis Laravel 
  // (injection Blade), pour savoir quelle histoire charger.
  props: {
    storyId: {
      type: Number,
      required: true
    },
  },
  //  Initialise les variables :
  // story : l’histoire complète (titre, description…)
  // currentChapter : le chapitre actuel
  // backgroundImage : image dynamique affichée en fond
  data() {
    return {
      story: null,
      currentChapter: null,
      backgroundImage: '/images/image3.png',
    };
  },

  async mounted() {
    // Cette méthode est appelée lorsque le composant est monté
    try {
      // Charger l'histoire
      const response = await fetch('http://127.0.0.1:8000/api/v1/stories/1/chapters');
      if (!response.ok) throw new Error(`Erreur HTTP ${response.status}`);
      const data = await response.json();
      this.story = data.data.find(s => s.id === this.storyId);

      // Charger les chapitres
      const chaptersRes = await fetch(`http://127.0.0.1:8000/api/v1/stories/1/chapters`);
      const chaptersJson = await chaptersRes.json();
      const chapters = chaptersJson.data;

      // Vérifier si une progression est sauvegardée dans le localStorage
      // qui est un mécanisme de stockage intégré dans tous 
      // les navigateurs web qui permet de sauvegarder des données côté client,
      //  directement dans le navigateur de l'utilisateur.
      const savedChapterId = localStorage.getItem(`story-${this.storyId}-progress`);
      if (savedChapterId) {
        // Si une progression est trouvée, charger ce chapitre
        await this.loadChapter(savedChapterId);
      } else {
        // Sinon, charger le premier chapitre
        const firstChapter = chapters.find(ch => ch.is_first === 1);
        if (!firstChapter) throw new Error('Aucun chapitre initial trouvé');
        await this.loadChapter(firstChapter.id);
      }
    } catch (error) {
      console.error("Erreur pendant le chargement de la vue de départ :", error);
    }
  },
  methods: {
    async loadChapter(chapterId) {
      try {
        // Charger le chapitre depuis l'API
        const chapterRes = await fetch(`http://127.0.0.1:8000/api/v1/chapters/${chapterId}`);
        const chapterJson = await chapterRes.json();
        this.currentChapter = {
          ...chapterJson.data.chapter,
          choices: chapterJson.data.choices || []
        };
        this.setBackgroundImage();
      } catch (error) {
        console.error("Erreur lors du chargement du chapitre :", error);
      }
    },
    async selectChoice(choice) {
      if (!choice?.to_chapter_id) return;

      // Sauvegarder l'ID du chapitre sélectionné dans le localStorage
      localStorage.setItem(`story-${this.storyId}-progress`, choice.to_chapter_id);

      // Charger le chapitre suivant
      await this.loadChapter(choice.to_chapter_id);
    },
    setBackgroundImage() {
      if (!this.currentChapter?.choices?.length) {
        this.backgroundImage = '/images/image5.png'; // Fin
      } else if (this.currentChapter?.is_first) {
        this.backgroundImage = '/images/image3.png'; // Début
      } else {
        this.backgroundImage = '/images/image3.png'; // Milieu
      }
      document.body.style.backgroundImage = `url(${this.backgroundImage})`;
    },
    isChoiceVisible(index) {
      return this.currentChapter?.choices && index < this.currentChapter.choices.length;
    },

    // Méthode pour recommencer l'histoire
    restartStory() {
      // Effacer la progression du localStorage
      localStorage.removeItem(`story-${this.storyId}-progress`);

      // Recharger le premier chapitre
      this.loadChapter(this.storyId);
    }
  }
};
</script>
