<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Crée un utilisateur par défaut
        User::firstOrCreate([
            'email' => 'demo@reflet.com',
        ], [
            'name' => 'Demo User',
            'password' => Hash::make('password'),
        ]);

        // Appel du seeder Reflet personnalisé
        $this->call([
            RefletSeeder::class,
        ]);
    }
}
