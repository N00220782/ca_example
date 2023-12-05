<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Publisher;
use App\Models\Author;
use Illuminate\Http\Request;
use Auth;

class BookController extends Controller
{
    public function __construct(){
        //Auth::user()->authoriseRoles('admin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Auth::user()->authoriseRoles('admin');
        if(!Auth::user()->hasRole('admin')){
            return to_route('user.books.index');
        }
        $books = Book::paginate(10);
        return view('admin.books.index')->with('books', $books);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Auth::user()->authoriseRoles('admin');

        $publishers = Publisher::all();
        $authors = Author::all();
        return view('admin.books.create')->with('publishers', $publishers)
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
                'book_image' => 'file|image',
                'publisher_id' => 'required',
                'authors' =>['required' , 'exists:authors,id']
            ]);

            $book_image = $request->file('book_image');
            $extension = $book_image->getClientOriginalExtension();
            $filename = date('Y-m-d-His') . '_' . $request->title . '.' . $extension;

            $book_image->storeAs('public/images', $filename);
    
            $book = Book::create([
                'title' => $request->title,
                'description' => $request->description,
                'isbn' => $request->isbn,
                'book_image' => $filename,
                //'author' => $request->author,
                'publisher_id' => $request->publisher_id

            ]);

            // $book = new Book();
            // $book->title = $request

            $book->authors()->attach($request->authors);

    
            return to_route('admin.books.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::findOrFail($id);

        return view('admin.books.show', [
            'book' => $book 
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $publishers = Publisher::all();
        $authors = Author::all();
        $book = Book::findOrFail($id);
        return view('admin.books.edit', [
            'book' => $book 
        ])->with('publishers', $publishers)
                                   ->with('authors', $authors);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required|max:500',
            'isbn' => 'required',
            //'author' =>'required',
            //'book_image' => 'file|image|dimensions:width=300,height=400'
            'book_image' => 'file|image',
            'publisher_id' => 'required',
            'authors' =>['required' , 'exists:authors,id']
        ]);

        $book_image = $request->file('book_image');
        $extension = $book_image->getClientOriginalExtension();
        $filename = date('Y-m-d-His') . '_' . $request->title . '.' . $extension;

        $book_image->storeAs('public/images', $filename);

        $book = Book::update([
            'title' => $request->title,
            'description' => $request->description,
            'isbn' => $request->isbn,
            'book_image' => $filename,
            //'author' => $request->author,
            'publisher_id' => $request->publisher_id

        ]);

        // $book = new Book();
        // $book->title = $request

        $book->authors()->attach($request->authors);


        return to_route('admin.books.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
