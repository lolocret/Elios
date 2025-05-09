<template>
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
    </div>
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
      backgroundImage: '/images/image3.png', // Image de fond par défaut
    };
  },
  mounted() {
    if (this.story && this.story.chapters && this.story.chapters.length > 0) {
      this.currentChapter = this.story.chapters.find(chapter => chapter.is_first === 1); // Charger le premier chapitre
      this.setBackgroundImage(); // Set the initial background image
    } else {
      console.error('Aucun chapitre trouvé ou données invalides');
    }
  },
  methods: {
    selectChoice(choice) {
      const nextChapter = this.story.chapters.find((chapter) => chapter.id === choice.to_chapter_id);
      if (nextChapter) {
        this.currentChapter = nextChapter;
        this.setBackgroundImage(); // Update the background image after changing chapter
      }
    },
    setBackgroundImage() {
      if (!this.currentChapter.choices || this.currentChapter.choices.length === 0) {
        // Final phase (no choices left)
        this.backgroundImage = '/images/image5.png';
      } else if (this.currentChapter.is_first) {
        // First phase (start of the story)
        this.backgroundImage = '/images/image3.png';
      } else {
        // Middle phase (choices available but not the end)
        this.backgroundImage = '/images/image3.png';
      }
    },
    isChoiceVisible(index) {
      return index <= this.currentChapter.choices.length; // Si le choix est dans les limites de la liste
    },
  },
};
</script>
