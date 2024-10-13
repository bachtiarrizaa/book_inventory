<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $author = Author::first();

        Book::create([
            'title' => 'Sample Book Title',
            'publisher' => 'Sample Publisher',
            'publish_year' => 2020,
            'genre' => 'Fiction',
            'author_id' => $author->id,
        ]);
    }
}
