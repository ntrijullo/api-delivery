<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Nelson Trijullo',
            'email' => 'ntrijullo@example.com',
            'password' => bcrypt('12345678'),
            'role' => 'client',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Enzo Trujillo',
            'email' => 'etrujillo@example.com',
            'password' => bcrypt('12345678'),
            'role' => 'delivery',
            'config' => [
                'availability' => false,
            ],
        ]);

        $this->call(EstablishmentSeeder::class);
    }
}
