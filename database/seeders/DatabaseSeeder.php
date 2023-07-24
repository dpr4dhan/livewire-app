<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

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
             'id' => Uuid::uuid4(),
             'name' => 'Dhiraj',
             'email' => 'dpr4dhan@gmail.com',
             'username' => 'dpr4dhan',
             'password' => Hash::make('secret')
         ]);
         \App\Models\Transaction::factory(1000)->create();
    }
}
