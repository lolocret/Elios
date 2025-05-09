<template>
  <div v-if="currentChapter" class="chapter-screen">
    <h2 class="text-3xl font-bold text-center text-pink-200">{{ currentChapter.title }}</h2>
    <p class="text-lg text-center text-white">{{ currentChapter.content }}</p>

    <div v-if="currentChapter.choices && currentChapter.choices.length > 0" class="choices mt-4">
      <h3 class="text-2xl text-white text-center">Que choisis-tu ?</h3>
      <div v-for="choice in currentChapter.choices" :key="choice.id" class="choice">
        <button @click="selectChoice(choice)" class="choice-btn">
          {{ choice.text }}
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    story: Object, // Données injectées de l'histoire depuis Blade
  },
  data() {
    return {
      currentChapter: null, // Initialiser avec null
    };
  },
  mounted() {
    // Charger le chapitre en fonction de l'ID du chapitre passé en paramètre
    const chapterId = this.$route.params.chapterId;
    this.currentChapter = this.story.chapters.find(chapter => chapter.id === chapterId);
  },
  methods: {
    selectChoice(choice) {
      const nextChapter = this.story.chapters.find(chapter => chapter.id === choice.to_chapter_id);
      if (nextChapter) {
        this.currentChapter = nextChapter;
        this.$router.push({ name: 'chapter', params: { chapterId: nextChapter.id } });
      }
    }
  }
};
</script>

<style scoped>
.chapter-screen {
  background-color: rgba(0, 0, 0, 0.6);
  padding: 20px;
  border-radius: 8px;
}
/* Animation de fond avec transition */
.bg-cover {
  transition: background-image 1s ease-in-out, filter 0.5s ease-in-out;
}

/* Animation des choix avec transition progressive */
.choice {
  opacity: 0;
  transform: translateX(-30px); /* Commence décalé à gauche */
  transition: opacity 0.5s ease-out, transform 0.3s ease-out;
}

/* Lorsque les choix deviennent visibles */
.choice.visible {
  opacity: 1;
  transform: translateX(0); /* Glissement vers sa position normale */
}

/* Animation sur hover pour l'effet de survol des choix */
.choice:hover {
  transform: scale(1.05); /* Agrandissement léger */
  box-shadow: 0 0 8px rgba(217, 129, 255, 0.6); /* Effet de lumière autour du bouton */
  background-color: rgba(251, 156, 240, 0.18); /* Légère modification du fond */
}

/* Animation de fade-in pour l'élément contenant le chapitre */
.animate-fade-in {
  animation: fade-in 0.8s ease-out;
}

@keyframes fade-in {
  from {
    opacity: 0;
    transform: translateY(20px); /* Glissement vertical pour l'effet d'apparition */
  }
  to {
    opacity: 1;
    transform: translateY(0); /* Retour à la position normale */
  }
}

/* Transition de la carte immersive avec une légère animation */
.relative {
  transition: all 0.5s ease;
}

.choice-btn {
  background-color: rgba(255, 255, 255, 0.2);
  color: white;
  padding: 12px 24px;
  font-weight: 600;
  margin: 10px 0;
  border-radius: 0.75rem;
  transition: 0.3s;
}

.choice-btn:hover {
  background-color: rgba(251, 156, 240, 0.3);
  transform: scale(1.05);
}
</style>
