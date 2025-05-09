# Elios - Fiction Interactive

## Description

**Elios** est un projet de fiction interactive, conçu pour vous faire vivre une expérience narrative unique. À travers un parcours où chaque choix influence l'histoire, vous plongez dans un récit immersif qui mêle réflexion, émotions et introspection.

Avec une interface moderne, fluide et une narration dynamique, chaque décision prise par l'utilisateur aura un impact sur le déroulement de l'histoire, vous permettant de vivre une aventure personnalisée.

### Fonctionnalités

* **Choix interactifs** : Les utilisateurs prennent des décisions à chaque étape qui influencent l'histoire.
* **Interface dynamique** : Le design est pensé pour être immersif et réactif, avec des animations fluides.
* **Historique des choix** : Suivi de toutes les décisions prises durant l'expérience.
* **Multiplateforme** : Le projet est optimisé pour fonctionner sur tous les appareils modernes (mobile, tablette, desktop).

## Technologies utilisées

### Frontend

* **Vue.js** : Framework JavaScript pour construire l'application interactive.
* **Tailwind CSS** : Framework CSS pour un design moderne et réactif.
* **Axios** : Bibliothèque pour les requêtes HTTP et la gestion des API.
* **Vite** : Outil de développement pour un build rapide et une expérience de développement fluide.

### Backend

* **Laravel** : Framework PHP pour gérer le backend et les API.
* **MySQL (ou SQLite)** : Base de données pour stocker les informations relatives aux chapitres, choix et utilisateurs.

## Installation

### Prérequis

Assurez-vous d'avoir installé les éléments suivants sur votre machine :

* **Node.js** et **npm** (pour le frontend).
* **PHP** et **Composer** (pour le backend).
* **MySQL** ou **SQLite** pour la base de données.

### Étapes d'installation

1. **Clonez le dépôt**

```bash
git clone git@github.com:lolocret/Elios.git
cd Elios
```

2. **Installation des dépendances pour le frontend**

Naviguez dans le dossier frontend et installez les dépendances :

```bash
npm install
```

3. **Installation des dépendances pour le backend**

Naviguez dans le dossier backend et installez les dépendances :

```bash
composer install
cp .env.example .env
php artisan key:generate
```

4. **Création de la base de données**

Si vous utilisez SQLite, créez un fichier de base de données :

```bash
touch database/database.sqlite
```

Si vous utilisez MySQL, configurez les paramètres dans `.env` et effectuez les migrations.

5. **Exécuter les migrations**

```bash
php artisan migrate
```

6. **Lancer les serveurs**

Frontend :

```bash
npm run dev
```

Backend :

```bash
php artisan serve
```

### URL d'accès

Le frontend sera accessible à [http://localhost:5173](http://localhost:5173).

Le backend sera accessible à [http://localhost:8000](http://localhost:8000).

## Structure du projet

```
Elios/
│
├── frontend/                   # Frontend Vue.js
│   ├── src/
│   │   ├── assets/             # Images, polices, etc.
│   │   ├── components/         # Composants Vue.js
│   │   ├── App.vue             # Composant principal
│   │   ├── StoryReader.vue     # Composant pour la lecture de l'histoire
│   │   ├── main.js             # Point d'entrée JavaScript
│   ├── tailwind.config.js       # Configuration de Tailwind CSS
│   └── package.json            # Dépendances du frontend
│
├── backend/                    # Backend Laravel
│   ├── app/
│   │   ├── Http/
│   │   └── Models/
│   ├── routes/
│   │   └── api.php             # Routes API pour les histoires et chapitres
│   ├── database/
│   │   └── migrations/
│   ├── .env                    # Configuration de l'environnement
│   └── composer.json            # Dépendances du backend
│
└── README.md                   # Ce fichier
```

## Routes API

### Récupérer l'histoire

L'API principale qui charge l'histoire et ses chapitres :

```http
GET /api/story/{id}
```

Exemple : `GET /api/story/1` retourne les données de l'histoire avec les chapitres et les choix.

### Structure de la réponse API

L'API renverra un objet contenant l'histoire, les chapitres et les choix :

```json
{
  "id": 1,
  "title": "Elios",
  "description": "Une expérience immersive et thérapeutique.",
  "chapters": [
    {
      "id": 1,
      "title": "Chapitre 1",
      "content": "Description du chapitre...",
      "choices": [
        {
          "id": 1,
          "text": "Choisir d'analyser ton environnement",
          "to_chapter_id": 2
        },
        {
          "id": 2,
          "text": "Choisir d'accéder à tes souvenirs",
          "to_chapter_id": 3
        }
      ]
    }
  ]
}
```

## Contribuer

Les contributions sont les bienvenues ! Si tu souhaites ajouter des fonctionnalités, corriger des bugs ou améliorer l'expérience, n'hésite pas à créer une Pull Request.

1. Fork le dépôt.
2. Crée une branche pour ta fonctionnalité (git checkout -b feature/nouvelle-fonctionnalite).
3. Fais tes modifications et commit (git commit -am 'Ajoute une nouvelle fonctionnalité').
4. Push ta branche (git push origin feature/nouvelle-fonctionnalite).
5. Crée une Pull Request.

## Auteurs

Lorie Crettex - Développeur principal

## Licence

Ce projet est sous licence MIT - voir le fichier LICENSE pour plus de détails.

