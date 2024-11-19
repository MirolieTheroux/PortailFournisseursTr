<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmailModelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('email_models')->insert([
            [
                'id' => 1,
                'name' => "inscription",
                'destinator' => "fournisseur",
                'object' => "Bienvenue",
                'title' => "Bienvenue sur le Portail Fournisseur",
                'description' => "Bonjour et bienvenue sur le portail fournisseur de la Ville de Trois-Rivières!",
                'subtitle' => "État de votre demande:",
                'icon' => null,
                'state' => "waiting",
                'message' => "Un membre de notre équipe procédera à la vérification de vos informations et vous informera par courriel une fois votre demande approuvé.",
                'footer' => "Merci de votre intérêt et de votre patience.<br>L'équipe de la Ville de Trois-Rivières"
            ],
            [
                'id' => 2,
                'name' => "modification",
                'destinator' => "fournisseur",
                'object' => "Dossier modifié",
                'title' => "Votre dossier a été modifié",
                'description' => "Les informations de votre dossier ont été modifié avec succès.",
                'subtitle' => "État de votre demande:",
                'icon' => null,
                'state' => "toCheck",
                'message' => "Un membre de notre équipe procédera à la vérification de vos informations et vous informera par courriel une fois votre demande révisé.",
                'footer' => "Merci de votre intérêt et de votre patience.<br>L'équipe de la Ville de Trois-Rivières"
            ],
            [
                'id' => 3,
                'name' => "accepted",
                'destinator' => "fournisseur",
                'object' => "Demande accepté",
                'title' => "Le statut de votre demande a changé",
                'description' => null,
                'subtitle' => "État de votre demande:",
                'icon' => null,
                'state' => "accepted",
                'message' => "Vous êtes maintenant un fournisseur de la ville de Trois-Rivières!",
                'footer' => "Merci de votre intérêt et de votre patience.<br>L'équipe de la Ville de Trois-Rivières"
            ],
            [
                'id' => 4,
                'name' => "denied",
                'destinator' => "fournisseur",
                'object' => "Demande rejeté",
                'title' => "Le statut de votre demande a changé",
                'description' => null,
                'subtitle' => "État de votre demande:",
                'icon' => null,
                'state' => "denied",
                'message' => "Votre demande à été refusé. Pour plus de détails, veuillez vous rendre sur le portail.",
                'footer' => "Merci de votre intérêt et de votre patience.<br>L'équipe de la Ville de Trois-Rivières"
            ],
            [
                'id' => 5,
                'name' => "waiting",
                'destinator' => "fournisseur",
                'object' => "Demande en attente",
                'title' => "Le statut de votre demande a changé",
                'description' => null,
                'subtitle' => "État de votre demande:",
                'icon' => null,
                'state' => "waiting",
                'message' => "Votre demande a été mise en attente par un responsable.",
                'footer' => "Merci de votre intérêt et de votre patience.<br>L'équipe de la Ville de Trois-Rivières"
            ],
            [
                'id' => 6,
                'name' => "toCheck",
                'destinator' => "fournisseur",
                'object' => "Demande en vérification",
                'title' => "Le statut de votre demande a changé",
                'description' => null,
                'subtitle' => "État de votre demande:",
                'icon' => null,
                'state' => "toCheck",
                'message' => "Votre demande a été mise en vérification par un responsable.",
                'footer' => "Merci de votre intérêt et de votre patience.<br>L'équipe de la Ville de Trois-Rivières"
            ]
        ]);
    }
}
