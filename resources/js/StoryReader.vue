<template>
  <div v-if="story && currentChapter" class="relative min-h-screen bg-black flex justify-center items-center">
    <!-- Image de fond conditionnelle -->
    <div class="absolute inset-0 bg-cover bg-center z-0" :style="{ backgroundImage: 'url(' + (currentChapter.choices && currentChapter.choices.length > 0 ? 'images/image3.png' : 'images/image4.png') + ')', filter: 'brightness(0.4)' }"></div>

    <!-- Carte immersive -->
    <div class="relative z-10 max-w-3xl bg-black/60 backdrop-blur-lg p-10 rounded-2xl shadow-2xl ring-1 ring-white/10 text-white animate-fade-in">
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
    </div>
  </div>

  <!-- Message de chargement si l'histoire n'est pas encore chargée -->
  <div v-else>
    <p class="text-white text-center">Chargement de l'histoire...</p>
  </div>
</template>

<script>
export default {
  props: {
    story: Object, // Récupérer les données de l'histoire via props
  },
  data() {
    return {
      currentChapter: null, // Initialiser avec null
      backgroundImage: 'images/image3.png', // Image de fond par défaut
    };
  },
  mounted() {
    // Vérification des données lorsque le composant est monté
    if (this.story && this.story.chapters && this.story.chapters.length > 0) {
      this.currentChapter = this.story.chapters.find(chapter => chapter.is_first === 1); // Charger le premier chapitre avec 'is_first'
      console.log('Chapitre courant chargé:', this.currentChapter);
    } else {
      console.error('Aucun chapitre trouvé ou données invalides');
    }
  },
  methods: {
    // Fonction pour sélectionner un choix dans un chapitre
    selectChoice(choice) {
      console.log('Choix sélectionné:', choice);
      const nextChapter = this.story.chapters.find(chapter => chapter.id === choice.to_chapter_id);
      if (nextChapter) {
        this.currentChapter = nextChapter;
        this.backgroundImage = nextChapter.background_image || this.backgroundImage;
        console.log('Chapitre mis à jour:', this.currentChapter);
      } else {
        console.error('Chapitre suivant non trouvé');
      }
    },
  },
};
</script>

<style scoped>
.chapter {
  margin-bottom: 20px;
}

.choice-button {
  background-color: #ff4081;
  color: white;
  padding: 12px 24px;
  border: none;
  cursor: pointer;
  margin-top: 10px;
  transition: all 0.3s ease;
  backdrop-filter: blur(8px);
  border-radius: 12px;
  width: 100%;
  font-size: 1.2em;
}

.choice {
  background-color: rgba(255, 255, 255, 0.2);
}

.choice-button:hover {
  background-color: #ff80ab;
  transform: scale(1.05);
  box-shadow: 0 0 10px rgba(217, 129, 255, 0.6);
}

.animate-fade-in {
  animation: fade-in 0.8s ease-out;
}

@keyframes fade-in {
  from {
    opacity: 100;
    transform: translateY(20px);
  }
  to {
    opacity: 100;
    transform: translateY(0);
  }
}
</style>
