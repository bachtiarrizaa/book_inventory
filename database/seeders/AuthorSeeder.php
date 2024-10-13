<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Author::create([
            'name' => 'Author Example',
            'birthdate' => '1980-01-01',
            'biography' => 'This is a sample biography of the author.',
        ]);
    }
}
