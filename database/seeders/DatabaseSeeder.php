<?php

namespace Database\Seeders;

use App\Models\Opportunity;
use App\Models\Partenaire;
use App\Models\Secteur;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create();

        // Create a test partenaire
        $partenaire = Partenaire::factory()->create(
            [
                'user_id' => $user->id,
            ]
        );

        // create secteur and type without factory
        $secteur = new Secteur();j
        $secteur->title = 'IT';
        $secteur->save();

        $type = new Type();
        $type->title = 'Full-time';
        $type->save();

        // Create test opportunities
        Opportunity::factory(5)->create([
            'partenaire_id' => $partenaire->id,
        ]);
    }
}
