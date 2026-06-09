<?php

namespace Database\Seeders;

use App\Models\Hero;
use Illuminate\Database\Seeder;

class HeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Hero::create([
            'badge' => 'Hero Badge',
            'title' => 'Hero Title',
            'subtitle' => 'This is subtitle',
            'image' => 'default-hero.png', // put a dummy image in public/heroes/
        ]);
    }
}