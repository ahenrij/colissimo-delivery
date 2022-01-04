<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status')->insert([
            'title' => 'Commande traitée',
            'description' => 'La commande a été correctement traitée.',
        ]);
        DB::table('status')->insert([
            'title' => 'En attente d\'expédition',
            'description' => 'La commande est en cours de préparation et va bientôt être prise en charge par Post Colissima',
        ]);
        DB::table('status')->insert([
            'title' => 'Expédié',
            'description' => 'Le colis est en cours d\'acheminement.',
        ]);
        DB::table('status')->insert([
            'title' => 'En cours de livraison',
            'description' => 'Le colis sera livré très bientôt.',
        ]);
        DB::table('status')->insert([
            'title' => 'Livré',
            'description' => 'Le colis a été livré avec succès.',
        ]);
    }
}
