<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsservicescategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('productsservicescategories')->insert([
            // Approvissionements
            ['code' => 'G1', 'nature' => 'Approvissionements', 'name' => 'Aérospatiale'],
            ['code' => 'G2', 'nature' => 'Approvissionements', 'name' => 'Matériel de climatisation et de réfrigération'],
            ['code' => 'G3', 'nature' => 'Approvissionements', 'name' => 'Armement'],
            ['code' => 'G4', 'nature' => 'Approvissionements', 'name' => 'Produits et spécialités chimiques'],
            ['code' => 'G5', 'nature' => 'Approvissionements', 'name' => 'Communication, détection et fibres optiques'],
            ['code' => 'G6', 'nature' => 'Approvissionements', 'name' => 'Matériaux de construction'],
            ['code' => 'G7', 'nature' => 'Approvissionements', 'name' => 'Cosmétiques et articles de toilette'],
            ['code' => 'G8', 'nature' => 'Approvissionements', 'name' => 'Matériel et logiciel informatique'],
            ['code' => 'G9', 'nature' => 'Approvissionements', 'name' => 'Entretien d\'équipement de bureau et d\'informatique'],
            ['code' => 'G10', 'nature' => 'Approvissionements', 'name' => 'Produits électriques et électroniques'],
            ['code' => 'G11', 'nature' => 'Approvissionements', 'name' => 'Énergie'],
            ['code' => 'G12', 'nature' => 'Approvissionements', 'name' => 'Moteurs, turbines, composants et accessoires connexes'],
            ['code' => 'G13', 'nature' => 'Approvissionements', 'name' => 'Produits finis'],
            ['code' => 'G14', 'nature' => 'Approvissionements', 'name' => 'Équipement de lutte contre l\'incendie, de sécurité et de protection'],
            ['code' => 'G15', 'nature' => 'Approvissionements', 'name' => 'Alimentation'],
            ['code' => 'G16', 'nature' => 'Approvissionements', 'name' => 'Préparation alimentaire et équipement de service'],
            ['code' => 'G17', 'nature' => 'Approvissionements', 'name' => 'Ameublement'],
            ['code' => 'G18', 'nature' => 'Approvissionements', 'name' => 'Équipement industriel'],
            ['code' => 'G19', 'nature' => 'Approvissionements', 'name' => 'Machinerie et outils'],
            ['code' => 'G20', 'nature' => 'Approvissionements', 'name' => 'Marine'],
            ['code' => 'G21', 'nature' => 'Approvissionements', 'name' => 'Fourniture et équipement médicaux et produits pharmaceutiques'],
            ['code' => 'G22', 'nature' => 'Approvissionements', 'name' => 'Produits divers'],
            ['code' => 'G23', 'nature' => 'Approvissionements', 'name' => 'Matériel de bureau'],
            ['code' => 'G24', 'nature' => 'Approvissionements', 'name' => 'Papeterie et fournitures de bureau'],
            ['code' => 'G25', 'nature' => 'Approvissionements', 'name' => 'Constructions préfabriqués'],
            ['code' => 'G26', 'nature' => 'Approvissionements', 'name' => 'Publications, formulaires et articles en papier'],
            ['code' => 'G27', 'nature' => 'Approvissionements', 'name' => 'Instruments scientifiques'],
            ['code' => 'G28', 'nature' => 'Approvissionements', 'name' => 'Véhicules spéciaux'],
            ['code' => 'G29', 'nature' => 'Approvissionements', 'name' => 'Intégration de systèmes'],
            ['code' => 'G30', 'nature' => 'Approvissionements', 'name' => 'Textiles et vêtements'],
            ['code' => 'G31', 'nature' => 'Approvissionements', 'name' => 'Équipement de transport et pièces de rechange'],      
            
            //Services
            ['code' => 'S1', 'nature' => 'Services', 'name' => 'Recherche et développement (R et D)'],
            ['code' => 'S2', 'nature' => 'Services', 'name' => 'Études spéciales et analyses - (pas R et D)'],
            ['code' => 'S3', 'nature' => 'Services', 'name' => 'Services d\'architecture et d\'ingénierie'],
            ['code' => 'S4', 'nature' => 'Services', 'name' => 'Traitement de l\'information et services de télécommunications connexes'],
            ['code' => 'S5', 'nature' => 'Services', 'name' => 'Services environnementaux'],
            ['code' => 'S6', 'nature' => 'Services', 'name' => 'Services de ressources naturelles'],
            ['code' => 'S7', 'nature' => 'Services', 'name' => 'Services de santé et services sociaux'],
            ['code' => 'S8', 'nature' => 'Services', 'name' => 'Contrôle de la qualité, essais et inspections et services de représentants techniques'],
            ['code' => 'S9', 'nature' => 'Services', 'name' => 'Entretien, réparation, modification, réfection et installation de biens et d\'équipement'],
            ['code' => 'S10', 'nature' => 'Services', 'name' => 'Services de garde et autres services connexes'],
            ['code' => 'S11', 'nature' => 'Services', 'name' => 'Services financiers et autres services connexes'],
            ['code' => 'S12', 'nature' => 'Services', 'name' => 'Exploitation des installations gouvernementales'],
            ['code' => 'S13', 'nature' => 'Services', 'name' => 'Services de soutien professionnel et administratif et services de soutien à la gestion'],
            ['code' => 'S14', 'nature' => 'Services', 'name' => 'Services publics'],
            ['code' => 'S15', 'nature' => 'Services', 'name' => 'Services de communication, de photographie, de cartographie, d\'impression et de publication'],
            ['code' => 'S16', 'nature' => 'Services', 'name' => 'Services pédagogiques et formation'],
            ['code' => 'S17', 'nature' => 'Services', 'name' => 'Services de transport, de voyage et de déménagement'],
            ['code' => 'S18', 'nature' => 'Services', 'name' => 'Location à bail / Location d\'équipement'],
            ['code' => 'S19', 'nature' => 'Services', 'name' => 'Location à bail ou location d\'installations immobilières'],
            
            // Travaux de construction
            ['code' => 'C01', 'nature' => 'Travaux de construction', 'name' => 'Bâtiments'],
            ['code' => 'C02', 'nature' => 'Travaux de construction', 'name' => 'Ouvrages de génie civil'],
            ['code' => 'C03', 'nature' => 'Travaux de construction', 'name' => 'Autres travaux de construction'],
            
            // Autres natures de contrat
            ['code' => 'IMM', 'nature' => 'Autres natures de contrat', 'name' => 'Vente de biens immeubles'],
            ['code' => 'MEU1', 'nature' => 'Autres natures de contrat', 'name' => 'Vente de biens meubles'],
            ['code' => 'C1', 'nature' => 'Autres natures de contrat', 'name' => 'Concession'],
            ['code' => 'O1', 'nature' => 'Autres natures de contrat', 'name' => 'Indéterminée'],           
        ]);
    }
}
