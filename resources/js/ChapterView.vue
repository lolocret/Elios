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
          <a @click.prevent="selectChoice(choice)">
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
  watch: {
    // Watch for changes in the current chapter and update backgroundImage accordingly
    currentChapter() {
      this.setBackgroundImage();
    }
  },
  methods: {
    selectChoice(choice) {
      const nextChapter = this.story.chapters.find((chapter) => chapter.id === choice.to_chapter_id);
      if (nextChapter) {
        this.currentChapter = nextChapter;
      }
    },
   
  },
};
</script>


<style scoped>/* Animation de fondu et glissement pour les chapitres */
/* Animation de fondu et glissement pour les chapitres */
.chapter {
    opacity: 0;
    transform: translateY(20px); /* Glissement vertical */
    transition: opacity 1s ease-in-out, transform 1s ease-in-out;
}

.chapter.visible {
    opacity: 1;
    transform: translateY(0); /* Retourne à sa position normale */
}

/* Animation des choix avec fade-in et glissement */
.choice-btn {
    opacity: 1;
    transform: translateX(0); /* Ensure the button starts in position */
    transition: all 0.3s ease-in-out; /* Smooth transition for everything */
    background-color: rgba(255, 255, 255, 0.1); /* Subtle background for normal state */
    box-shadow: 0 0 5px rgba(255, 255, 255, 0.1); /* Light shadow for normal state */
}

/* Classe visible pour chaque choix */
.choice.visible {
    opacity: 1;
    transform: translateX(0); /* Retourne à sa position normale */
}

/* Animation de survol des boutons de choix */
.choice-btn:hover {
    transform: scale(1.05); /* Enlarges the button */
    box-shadow: 0 0 8px rgba(217, 129, 255, 0.6); /* Glow effect */
    background-color: rgba(251, 156, 240, 0.18); /* Light background on hover */
    color: white; /* Ensure text stays white */
    transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease; /* Ensure smooth transition for all effects */
}

/* Effet de particules lors du clic (ajouter une animation de clic sur les boutons) */
.choice-btn:active {
    animation: click-animation 0.1s ease-out;
}
@keyframes click-animation {
    from {
        transform: scale(1);
    }
    to {
        transform: scale(1.5); /* Slight shrink on click */
    }
}
/* Parallax effect pour le fond */
.bg-parallax {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-attachment: fixed;
    transition: transform 0.2s ease;
}

.bg-parallax:hover {
    transform: scale(1.05); /* Applique un léger zoom au fond */
}

/* Effet métallique pour le logo */
.logo-scintillant {
    position: relative;
    display: inline-block;
    z-index: 1;
    height: 150px; /* Taille du logo */
    width: auto;
    transition: all 0.3s ease; /* Transition douce pour l'effet hover */
    filter: brightness(0.9); /* Donne une brillance initiale pour le logo */
}

/* Effet métallique lors du survol */
.logo-scintillant:hover {
    filter: brightness(1.2) saturate(1.5) contrast(1.1); /* Augmente la brillance et contraste pour un effet métallique */
    box-shadow: 0 0 15px rgba(255, 255, 255, 0.5), 0 0 30px rgba(255, 255, 255, 0.3); /* Création d'un effet lumineux autour du logo */
    transform: scale(1.05); /* Agrandit légèrement le logo pour l'effet de zoom */
}
</style>