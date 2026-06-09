<?php

namespace Database\Seeders;

use App\Models\Card;
use Illuminate\Database\Seeder;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Card::create([
            'title' => 'Sample Card',
            'head1' => 'Heading 1',
            'body1' => 'This is body 1',
            'head2' => 'Heading 2',
            'body2' => 'This is body 2',
            'head3' => 'Heading 3',
            'body3' => 'This is body 3',
        ]);
    }
}