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
                'name' => "SupplierInscription",
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
                'name' => "SupplierAccepted",
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
                'id' => 3,
                'name' => "SupplierDenied",
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
                'id' => 4,
                'name' => "SupplierWaiting",
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
                'id' => 5,
                'name' => "SupplierResetPassword",
                'object' => "Réinitialiser votre mot de passe",
                'title' => "Réinitialiser votre mot de passe",
                'description' => "Nous avons reçu une demande de réinitialisation de votre mot de passe.",
                'subtitle' => null,
                'icon' => null,
                'state' => null,
                'message' => "Si ce n'est pas votre compte, veuillez ne pas tenir compte de ce message.",
                'footer' => "Merci de votre intérêt et de votre patience.<br>L'équipe de la Ville de Trois-Rivières"
            ],
            [
                'id' => 6,
                'name' => "ResponsableToCheck",
                'object' => "Demande à vérifier",
                'title' => "Une demande est en attente de vérification",
                'description' => null,
                'subtitle' => "Fournisseur:",
                'icon' => null,
                'state' => null,
                'message' => "Pour plus de détails, consultez le portail responsable.",
                'footer' => null
            ],
            [
                'id' => 7,
                'name' => "ResponsableInscriptionNotification",
                'object' => "Nouvelle demande",
                'title' => "Un fournisseur à fait une nouvelle demande",
                'description' => null,
                'subtitle' => "Fournisseur:",
                'icon' => null,
                'state' => null,
                'message' => "Pour plus de détails, consultez le portail responsable.",
                'footer' => null
            ]
        ]);
    }
}
