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
.choice {
    opacity: 0;
    transform: translateX(-20px); /* Glissement horizontal */
    transition: opacity 0.5s ease-in-out, transform 0.2s ease-in-out;
    transition-delay: 0s; /* Pas de délai initial */
}

/* Classe visible pour chaque choix */
.choice.visible {
    opacity: 1;
    transform: translateX(0); /* Retourne à sa position normale */
}

/* Animation de survol des boutons de choix */
.choice:hover {
    transform: scale(1.05); /* Agrandissement léger au survol */
    box-shadow: 0 0 8px rgba(217, 129, 255, 0.6); /* Effet de lumière autour du bouton */
    background-color: rgba(251, 156, 240, 0.18); /* Légère modification du fond */
    transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease; /* Smooth transition */
}

/* Effet de particules lors du clic (ajouter une animation de clic sur les boutons) */
.choice:active {
    animation: click-animation 0.1s ease-out;
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