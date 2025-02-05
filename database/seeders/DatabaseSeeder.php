<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Option;
use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            "name" => "Admin",
            "email" => "admin@agence-immo.com",
            "role" => "admin",
            "password" => Hash::make("0000"),
        ]);
        User::factory()->create([
            "name" => "User",
            "email" => "user@agence-immo.com",
            "role" => "user",
            "password" => Hash::make("0000"),
        ]);

        $options = Option::factory(10)->create();

        Property::factory(100)
            ->hasAttached($options->random(3))
            ->create();
    }
}
