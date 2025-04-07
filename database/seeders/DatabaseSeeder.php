<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Animal;
use App\Models\Cage;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Aheadz',
            'email' => 'aheadz@mail.ru',
            'password' => 'Pass123456',
        ]);
    
        Cage::factory(5)->create()->each(function ($cage) use ($user) {
            $cage->animals()->saveMany(
                Animal::factory(3)->make(['created_by' => $user->id])
            );
        });
    }
}
