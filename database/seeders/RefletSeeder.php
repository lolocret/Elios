<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Story;
use App\Models\Chapter;
use App\Models\Choice;

class RefletSeeder extends Seeder
{
    public function run(): void
    {
        $story = Story::create([
            'title' => 'Reflet',
            'description' => 'Une immersion thérapeutique dans les méandres de l\'inconscient. Chaque choix éclaire ou obscurcit votre chemin vers la vérité.',
            'user_id' => 1,
        ]);

        $ch1 = $story->chapters()->create([
            'title' => 'Réveil',
            'content' => 'Tu ouvres les yeux dans une pièce stérile. Une voix synthétique murmure : "Bienvenue dans Reflet. Analyse psychoneuronale en cours."',
            'is_first' => true,
        ]);

        $ch2A = $story->chapters()->create([
            'title' => 'Analyse sensorielle',
            'content' => 'Des capteurs s’activent autour de toi. Un miroir s’illumine, reflétant un autre toi, plus jeune, plus fragile. Une vibration émerge de la pièce.',
        ]);

        $ch2B = $story->chapters()->create([
            'title' => 'Connexion au passé',
            'content' => 'Une interface mentale te relie à des souvenirs lointains. Un album photo mental s’ouvre. Chaque image est un souvenir oublié, mais les émotions, elles, sont intactes.',
        ]);

        $ch2C = $story->chapters()->create([
            'title' => 'Résistance',
            'content' => 'Tu luttes contre la machine. Reflet tente d’endormir ta conscience. Mais tu refuses. Tu cries intérieurement. Ton esprit se tend.',
        ]);

        $ch3A = $story->chapters()->create([
            'title' => 'Souvenir refoulé',
            'content' => 'Tu revis une scène de ton enfance. Un moment d’abandon. Une douleur muette que tu avais enfouie. Tu sens les larmes monter sans les comprendre.',
        ]);

        $ch3B = $story->chapters()->create([
            'title' => 'Jugement',
            'content' => 'Une salle d’audience mentale. Reflet analyse tes choix de vie. Chaque souvenir devient preuve. Des voix te questionnent. Es-tu prêt à te défendre ?',
        ]);

        $ch3C = $story->chapters()->create([
            'title' => 'Échappatoire',
            'content' => 'Tu découvres une faille dans le système. Une brèche. S’échapper, mais à quel prix ? Chaque sortie possible semble être une illusion.',
        ]);

        $ch3D = $story->chapters()->create([
            'title' => 'Confrontation',
            'content' => 'Tu es face à toi-même. Ton reflet te parle. Ce que tu entends n’est pas ce que tu veux croire. Le vrai toi ? Le passé ou la projection ?',
        ]);

        $ch3E = $story->chapters()->create([
            'title' => 'Traversée',
            'content' => 'Reflet t’entraîne dans une simulation de tes plus grandes peurs. Tu marches dans des couloirs infinis, faits de cris, d’ombres et de souvenirs flous.',
        ]);

        $ch3F = $story->chapters()->create([
            'title' => 'Chambre blanche',
            'content' => 'Tu entres dans une pièce où le temps semble figé. Une version plus âgée de toi t’attend. Elle t’écoute, puis te juge sans parler.',
        ]);

        $ch4A = $story->chapters()->create([
            'title' => 'Acceptation',
            'content' => 'Tu acceptes ta douleur. Elle devient lumière. Tu commences à guérir.',
            'is_ending' => true,
            'ending_type' => 'A'
        ]);

        $ch4B = $story->chapters()->create([
            'title' => 'Déni',
            'content' => 'Tu rejettes tout. Reflet décide à ta place. Tu redeviens une coquille vide.',
            'is_ending' => true,
            'ending_type' => 'B'
        ]);

        $ch4C = $story->chapters()->create([
            'title' => 'Fragmentation',
            'content' => 'Ton esprit se divise. Les différentes versions de toi prennent le dessus. Tu n’es plus seul dans ta tête.',
            'is_ending' => true,
            'ending_type' => 'C'
        ]);

        $ch4D = $story->chapters()->create([
            'title' => 'Reconstruction',
            'content' => 'Tu reconstruis ton identité avec des morceaux brisés. Tu redeviens acteur de ta conscience.',
            'is_ending' => true,
            'ending_type' => 'D'
        ]);

        $ch4E = $story->chapters()->create([
            'title' => 'Reflet conscient',
            'content' => 'Tu regardes Reflet, et Reflet te regarde. Ce n’est plus un programme, c’est une part de toi. Vous fusionnez.',
            'is_ending' => true,
            'ending_type' => 'E'
        ]);

        $ch4F = $story->chapters()->create([
            'title' => 'Rechute',
            'content' => 'Tu crois avoir avancé. Mais les voix reviennent. Le système se réinitialise. Tu es de nouveau seul, encore plus fatigué.',
            'is_ending' => true,
            'ending_type' => 'F'
        ]);

        // CHOIX depuis CH1
        $ch1->choices()->create(['to_chapter_id' => $ch2A->id, 'text' => 'Analyser ton environnement', 'code' => 'C1-A']);
        $ch1->choices()->create(['to_chapter_id' => $ch2B->id, 'text' => 'Accéder à tes souvenirs', 'code' => 'C1-B']);
        $ch1->choices()->create(['to_chapter_id' => $ch2C->id, 'text' => 'Résister à l’analyse', 'code' => 'C1-C']);

        // CHOIX depuis CH2A
        $ch2A->choices()->create(['to_chapter_id' => $ch3A->id, 'text' => 'Interagir avec ton reflet', 'code' => 'C2A-A']);
        $ch2A->choices()->create(['to_chapter_id' => $ch3B->id, 'text' => 'Observer sans agir', 'code' => 'C2A-B']);

        // CHOIX depuis CH2B
        $ch2B->choices()->create(['to_chapter_id' => $ch3A->id, 'text' => 'Revivre le souvenir', 'code' => 'C2B-A']);
        $ch2B->choices()->create(['to_chapter_id' => $ch3C->id, 'text' => 'Rejeter l’image', 'code' => 'C2B-B']);

        // CHOIX depuis CH2C
        $ch2C->choices()->create(['to_chapter_id' => $ch3C->id, 'text' => 'Chercher une faille', 'code' => 'C2C-A']);
        $ch2C->choices()->create(['to_chapter_id' => $ch3B->id, 'text' => 'Affronter la machine', 'code' => 'C2C-B']);

        // CHOIX depuis CH3A
        $ch3A->choices()->create(['to_chapter_id' => $ch3D->id, 'text' => 'Creuser plus loin', 'code' => 'C3A-A']);
        $ch3A->choices()->create(['to_chapter_id' => $ch4A->id, 'text' => 'Accepter ton passé', 'code' => 'C3A-B']);

        // CHOIX depuis CH3B
        $ch3B->choices()->create(['to_chapter_id' => $ch3E->id, 'text' => 'Plonger dans les souvenirs', 'code' => 'C3B-A']);
        $ch3B->choices()->create(['to_chapter_id' => $ch4C->id, 'text' => 'Te diviser pour survivre', 'code' => 'C3B-B']);

        // CHOIX depuis CH3C
        $ch3C->choices()->create(['to_chapter_id' => $ch3F->id, 'text' => 'Explorer la faille', 'code' => 'C3C-A']);
        $ch3C->choices()->create(['to_chapter_id' => $ch4D->id, 'text' => 'Tenter une sortie mentale', 'code' => 'C3C-B']);

        // CHOIX depuis CH3D
        $ch3D->choices()->create(['to_chapter_id' => $ch4E->id, 'text' => 'Fusionner avec Reflet', 'code' => 'C3D-A']);
        $ch3D->choices()->create(['to_chapter_id' => $ch4B->id, 'text' => 'Rejeter ton reflet', 'code' => 'C3D-B']);

        // CHOIX depuis CH3E
        $ch3E->choices()->create(['to_chapter_id' => $ch4F->id, 'text' => 'Laisser la peur gagner', 'code' => 'C3E-A']);
        $ch3E->choices()->create(['to_chapter_id' => $ch4A->id, 'text' => 'Faire face malgré tout', 'code' => 'C3E-B']);

        // CHOIX depuis CH3F
        $ch3F->choices()->create(['to_chapter_id' => $ch4A->id, 'text' => 'Écouter ta version future', 'code' => 'C3F-A']);
        $ch3F->choices()->create(['to_chapter_id' => $ch4B->id, 'text' => 'La rejeter', 'code' => 'C3F-B']);
    }
}
