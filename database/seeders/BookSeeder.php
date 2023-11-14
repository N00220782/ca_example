<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Publisher;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $publisher = Publisher::where('name', 'Sample publisher 2')->first();

        $book = new Book;
        $book->title = "Sample Book 1";
        $book->description = "Sample description";
        $book->isbn = "54845rhfjdoire";
        $book->publisher_id = $publisher->id;
        $book->save();
    }
}
