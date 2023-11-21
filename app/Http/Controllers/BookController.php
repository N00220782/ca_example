<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Publisher;
use App\Models\Author;



use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();

        return view('books.index', [
            'books' => $books 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $publishers = Publisher::all();
        $authors = Author::all();
        return view('books.create')->with('publishers', $publishers)
                                   ->with('authors', $authors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        {

            $request->validate([
                'title' => 'required',
                'description' => 'required|max:500',
                'isbn' => 'required',
                //'author' =>'required',
                //'book_image' => 'file|image|dimensions:width=300,height=400'
                //'book_image' => 'file|image',
                'publisher_id' => 'required',
                'authors' =>['required' , 'exists:authors,id']
            ]);
    
            $book = Book::create([
                'title' => $request->title,
                'description' => $request->description,
                'isbn' => $request->isbn,
                //'book_image' => $filename,
                //'author' => $request->author,
                'publisher_id' => $request->publisher_id

            ]);

            $book->authors()->attach($request->authors);

    
            return to_route('books.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::findOrFail($id);

        return view('books.show', [
            'book' => $book 
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
