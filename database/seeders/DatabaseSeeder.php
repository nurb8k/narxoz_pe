<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $user1 = \App\Models\User::query()->firstOrCreate(
            [
                'identifier' => 's22017245',
                'email' => 'test.student@narxoz.kz',

            ],
            [
                'identifier' => 's22017245',
                'email' => 'test.student@narxoz.kz',
                'password' => \Illuminate\Support\Facades\Hash::make('secretPass')
            ]
        );
        $user2 = \App\Models\User::query()->firstOrCreate(
            [
                'identifier' => 'f22017266',
                'email' => 'test.coach@narxoz.kz',

            ],
            [
                'identifier' => 'f22017266',
                'email' => 'test.coach@narxoz.kz',
                'password' => \Illuminate\Support\Facades\Hash::make('secretPass')
            ]
        );
        $user1->students()->create(
            [
                'gpa' => 3
            ]
        );
        $user2->teachers()->create(
            [
                'about' => 'best coach'
            ]
        );
    }
}
