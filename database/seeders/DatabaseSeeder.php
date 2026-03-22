<?php

namespace Database\Seeders;

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
        User::updateOrCreate(['email' => 'khadijafatihi@gmail.com'], [
            'name' => 'Khadija Fatihi',
            'password' => '123456',
        ]);

        $this->call([
            ClientSeeder::class,
            ProduitSeeder::class,
            CommandeSeeder::class,
            DetailCommandeSeeder::class,
        ]);
    }
}
