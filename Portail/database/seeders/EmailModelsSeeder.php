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
                'object' => "Bienvenue!",
                'title' => "Bienvenue sur le Portail Fournisseur",
                'description' => "Bonjour et bienvenue sur le portail fournisseur de la Ville de Trois-Rivières!",
                'subtitle' => "État de votre demande:",
                'icon' => "https://i.ibb.co/KXzGc2P/pending.gif",
                'state' => "waiting",
                'message' => "Un membre de notre équipe procédera à la vérification de vos informations et vous informera par courriel une fois votre demande approuvé.",
                'footer' => "Merci de votre intérêt et de votre patience.<br>L'équipe de la Ville de Trois-Rivières"
            ]
        ]);
    }
}
