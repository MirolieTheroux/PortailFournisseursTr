<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\facades\DB;

class WorkSubcategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('work_subcategories')->insert([
            [
                'id' => 1,
                'code' => '1.1.1',
                'name' => "Bâtiments résidentiels neufs visés par un plan de garantie, classe I",
                'is_specialised' => false,
                'is_entrepreneur_only' => false
            ],
            [
                'id' => 2,
                'code' => '1.1.2',
                'name' => "Bâtiments résidentiels neufs visés par un plan de garantie, classe II",
                'is_specialised' => false,
                'is_entrepreneur_only' => false
            ],
            [
                'id' => 3,
                'code' => '1.2',
                'name' => "Petits Bâtiments",
                'is_specialised' => false,
                'is_entrepreneur_only' => false
            ],
            [
                'id' => 4,
                'code' => '1.3',
                'name' => "Bâtiments de tout genre",
                'is_specialised' => false,
                'is_entrepreneur_only' => false
            ],
            [
                'id' => 5,
                'code' => '1.4',
                'name' => "Routes et canalisation",
                'is_specialised' => false,
                'is_entrepreneur_only' => false
            ],
            [
                'id' => 6,
                'code' => '1.5',
                'name' => "Structures d'ouvrages de génie civil",
                'is_specialised' => false,
                'is_entrepreneur_only' => false
            ],
            [
                'id' => 7,
                'code' => '1.6',
                'name' => "Ouvrages de génie civil immergés",
                'is_specialised' => false,
                'is_entrepreneur_only' => false
            ],
            [
                'id' => 8,
                'code' => '1.7',
                'name' => "Télécommunication, transport, transformation et distribution d'énergie électrique",
                'is_specialised' => false,
                'is_entrepreneur_only' => false
            ],
            [
                'id' => 9,
                'code' => '1.8',
                'name' => "Installation d'équipement pétrolier",
                'is_specialised' => false,
                'is_entrepreneur_only' => false
            ],
            [
                'id' => 10,
                'code' => '1.9',
                'name' => "Mécanique du bâtiment",
                'is_specialised' => false,
                'is_entrepreneur_only' => false
            ],
            [
                'id' => 11,
                'code' => '1.10',
                'name' => "Remontées mécaniques",
                'is_specialised' => false,
                'is_entrepreneur_only' => false
            ],
            [
                'id' => 12,
                'code' => '2.1',
                'name' => "Puits forés",
                'is_specialised' => true,
                'is_entrepreneur_only' => false
            ],
            [
                'id' => 13,
                'code' => '2.2',
                'name' => "Ouvrages de captage d'eau non forés",
                'is_specialised' => true,
                'is_entrepreneur_only' => false
            ],
            [
                'id' => 14,
                'code' => '2.3',
                'name' => "Systèmes de pompage des eaux souterraines",
                'is_specialised' => true,
                'is_entrepreneur_only' => false
            ],
            [
                'id' => 15,
                'code' => '2.4',
                'name' => "Systèmes d'assainissement autonome",
                'is_specialised' => true,
                'is_entrepreneur_only' => false
            ],
            [
                'id' => 16,
                'code' => '2.5',
                'name' => "Excavation et terrassement",
                'is_specialised' => true,
                'is_entrepreneur_only' => true
            ],
            [
                'id' => 17,
                'code' => '2.6',
                'name' => "Pieux et fondations spéciales",
                'is_specialised' => true,
                'is_entrepreneur_only' => false
            ],
            [
                'id' => 18,
                'code' => '2.7',
                'name' => "Travaux d'emplacement",
                'is_specialised' => true,
                'is_entrepreneur_only' => true
            ],
            [
                'id' => 19,
                'code' => '2.8',
                'name' => "Sautage",
                'is_specialised' => true,
                'is_entrepreneur_only' => false
            ],
            [
                'id' => 20,
                'code' => '3.1',
                'name' => "Structures de béton",
                'is_specialised' => true,
                'is_entrepreneur_only' => false
            ],
            [
                'id' => 21,
                'code' => '3.2',
                'name' => "Petits ouvrages de béton",
                'is_specialised' => true,
                'is_entrepreneur_only' => true
            ],
            [
                'id' => 22,
                'code' => '4.1',
                'name' => "Structures de maçonnerie",
                'is_specialised' => true,
                'is_entrepreneur_only' => false
            ],
            [
                'id' => 23,
                'code' => '4.2',
                'name' => "Travaux de maçonnerie non structurale, marbre et céramique",
                'is_specialised' => true,
                'is_entrepreneur_only' => true
            ],
            [
                'id' => 24,
                'code' => '5.1',
                'name' => "Structures métalliques et éléments préfabriqués de béton",
                'is_specialised' => true,
                'is_entrepreneur_only' => false
            ],
            [
                'id' => 25,
                'code' => '5.2',
                'name' => "Ouvrages métalliques",
                'is_specialised' => true,
                'is_entrepreneur_only' => true
            ],
            [
                'id' => 26,
                'code' => '6.1',
                'name' => "Charpentes de bois",
                'is_specialised' => true,
                'is_entrepreneur_only' => false
            ],
            [
                'id' => 27,
                'code' => '6.2',
                'name' => "Travaux de bois et plastique",
                'is_specialised' => true,
                'is_entrepreneur_only' => true
            ],
            [
                'id' => 28,
                'code' => '7',
                'name' => "Isolation, étanchéité, couvertures et revêtement extérieur",
                'is_specialised' => true,
                'is_entrepreneur_only' => true
            ],
            [
                'id' => 29,
                'code' => '8',
                'name' => "Portes et fenêtres",
                'is_specialised' => true,
                'is_entrepreneur_only' => true
            ],
            [
                'id' => 30,
                'code' => '9',
                'name' => "Travaux de finition",
                'is_specialised' => true,
                'is_entrepreneur_only' => true
            ],
            [
                'id' => 31,
                'code' => '10',
                'name' => "Systèmes de chauffage localisé à combustible solide",
                'is_specialised' => true,
                'is_entrepreneur_only' => false
            ],
            [
                'id' => 32,
                'code' => '11.1',
                'name' => "Tuyauterie industrielle ou institutionnelle sous pression",
                'is_specialised' => true,
                'is_entrepreneur_only' => false
            ],
            [
                'id' => 33,
                'code' => '11.2',
                'name' => "Équipements et produits spéciaux",
                'is_specialised' => true,
                'is_entrepreneur_only' => true
            ],
            [
                'id' => 34,
                'code' => '12',
                'name' => "Armoires et comptoirs usinés",
                'is_specialised' => true,
                'is_entrepreneur_only' => true
            ],
            [
                'id' => 35,
                'code' => '13.1',
                'name' => "Protection contre la foudre",
                'is_specialised' => true,
                'is_entrepreneur_only' => false
            ],
            [
                'id' => 36,
                'code' => '13.2',
                'name' => "Systèmes d'alarme incendie",
                'is_specialised' => true,
                'is_entrepreneur_only' => false
            ],
            [
                'id' => 37,
                'code' => '13.3',
                'name' => "Systèmes d'extinction d'incendie",
                'is_specialised' => true,
                'is_entrepreneur_only' => false
            ],
            [
                'id' => 38,
                'code' => '13.4',
                'name' => "Systèmes localisés d'extinction incendie",
                'is_specialised' => true,
                'is_entrepreneur_only' => false
            ],
            [
                'id' => 39,
                'code' => '13.5',
                'name' => "Installations spéciales ou préfabriquées",
                'is_specialised' => true,
                'is_entrepreneur_only' => true
            ],
            [
                'id' => 40,
                'code' => '14.1',
                'name' => "Ascenseurs et montecharges",
                'is_specialised' => true,
                'is_entrepreneur_only' => false
            ],
            [
                'id' => 41,
                'code' => '14.2',
                'name' => "Appareils élévateurs pour personnes handicapées",
                'is_specialised' => true,
                'is_entrepreneur_only' => false
            ],
            [
                'id' => 42,
                'code' => '14.3',
                'name' => "Autres types d'appareils élévateurs",
                'is_specialised' => true,
                'is_entrepreneur_only' => false
            ],
            [
                'id' => 43,
                'code' => '15.1',
                'name' => "Systèmes de chauffage à air pulsé",
                'is_specialised' => true,
                'is_entrepreneur_only' => false
            ],
            [
                'id' => 44,
                'code' => '15.1.1',
                'name' => "Systèmes de chauffage à air pulsé pour certains travaux qui ne sont pas réservés exclusivement aux maîtres mécaniciens en tuyauterie",
                'is_specialised' => true,
                'is_entrepreneur_only' => false
            ],
            [
                'id' => 45,
                'code' => '15.2',
                'name' => "Systèmes de brûleurs au gaz naturel",
                'is_specialised' => true,
                'is_entrepreneur_only' => false
            ],
            [
                'id' => 46,
                'code' => '15.2.1',
                'name' => "Systèmes de brûleurs au gaz naturel pour certains travaux qui ne sont pas réservés exclusivement aux maîtres mécaniciens en tuyauterie",
                'is_specialised' => true,
                'is_entrepreneur_only' => false
            ],
            [
                'id' => 47,
                'code' => '15.3',
                'name' => "Systèmes de brûleurs à l'huile",
                'is_specialised' => true,
                'is_entrepreneur_only' => false
            ],
            [
                'id' => 48,
                'code' => '15.3.1',
                'name' => "Systèmes de brûleurs à l'huile pour certains travaux qui ne sont pas réservés exclusivement aux maîtres mécaniciens en tuyauterie",
                'is_specialised' => true,
                'is_entrepreneur_only' => false
            ],
            [
                'id' => 49,
                'code' => '15.4',
                'name' => "Systèmes de chauffage hydronique",
                'is_specialised' => true,
                'is_entrepreneur_only' => false
            ],
            [
                'id' => 50,
                'code' => '15.4.1',
                'name' => "Systèmes de chauffage hydronique pour certains travaux qui ne sont pas réservés exclusivement aux maîtres mécaniciens en tuyauterie",
                'is_specialised' => true,
                'is_entrepreneur_only' => false
            ],
            [
                'id' => 51,
                'code' => '15.5',
                'name' => "Plomberie",
                'is_specialised' => true,
                'is_entrepreneur_only' => false
            ],
            [
                'id' => 52,
                'code' => '15.5.1',
                'name' => "Plomberie pour certains travaux qui ne sont pas réservés exclusivement aux maîtres mécaniciens en tuyauterie",
                'is_specialised' => true,
                'is_entrepreneur_only' => false
            ],
            [
                'id' => 53,
                'code' => '15.6',
                'name' => "Propane",
                'is_specialised' => true,
                'is_entrepreneur_only' => false
            ],
            [
                'id' => 54,
                'code' => '15.7',
                'name' => "Ventilation résidentielle",
                'is_specialised' => true,
                'is_entrepreneur_only' => false
            ],
            [
                'id' => 55,
                'code' => '15.8',
                'name' => "Ventilation",
                'is_specialised' => true,
                'is_entrepreneur_only' => false
            ],
            [
                'id' => 56,
                'code' => '15.9',
                'name' => "Petits systèmes de réfrigération",
                'is_specialised' => true,
                'is_entrepreneur_only' => false
            ],
            [
                'id' => 57,
                'code' => '15.10',
                'name' => "Réfrigération",
                'is_specialised' => true,
                'is_entrepreneur_only' => false
            ],
            [
                'id' => 58,
                'code' => '16',
                'name' => "Électricité",
                'is_specialised' => true,
                'is_entrepreneur_only' => false
            ],
            [
                'id' => 59,
                'code' => '17.1',
                'name' => "Instrumentation, contrôle et régulation",
                'is_specialised' => true,
                'is_entrepreneur_only' => false
            ],
            [
                'id' => 60,
                'code' => '17.2',
                'name' => "Intercommunication, téléphonie et surveillance",
                'is_specialised' => true,
                'is_entrepreneur_only' => true
            ],
        ]);
    }
}
