<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Team;
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
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        //     'password' => bcrypt('password'),
        //     'role' => 'admin',
        // ]);
        // User::factory()->create([
        //     'name' => 'Author User',
        //     'email' => 'test1@example.com',
        //     'password' => bcrypt('password'),
        //     'role' => 'author',
        // ]);
        // Category::factory()->create([
        //     'name' => fake()->word(),
        //     'description' => fake()->sentence(),

        // ]);


        $this->call([
            SettingsSeeder::class,
        ]);


        User::insert([
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'user',
                'email' => 'editor@example.com',
                'password' => Hash::make('password'),
                'role' => 'author',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        Team::create([
            'name' => "Mahadi Hassan",
            'position' => "Founder & CEO",
            'twitter_link' => "https://www.facebook.com/mahadi.hassan.023",
            'linkedin_link' => "https://www.linkedin.com/in/mahadi-hassan-695b9426a/",
        ]);
        Team::create([
            'name' => "Mahadi Hassan",
            'position' => "Editor-in-Chief",
            'twitter_link' => "https://www.facebook.com/mahadi.hassan.023",
            'linkedin_link' => "https://www.linkedin.com/in/mahadi-hassan-695b9426a/",
        ]);
        Team::create([
            'name' => "Mahadi Hassan",
            'position' => "Content Lead",
            'twitter_link' => "https://www.facebook.com/mahadi.hassan.023",
            'linkedin_link' => "https://www.linkedin.com/in/mahadi-hassan-695b9426a/",
        ]);
        Team::create([
            'name' => "Mahadi Hassan",
            'position' => "Community Manager",
            'twitter_link' => "https://www.facebook.com/mahadi.hassan.023",
            'linkedin_link' => "https://www.linkedin.com/in/mahadi-hassan-695b9426a/",
        ]);
    }
}
