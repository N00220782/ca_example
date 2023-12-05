@extends('layouts.admin')
@section('header')
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Books') }}
        </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        
                        <img width="150" src={{ asset("storage/images/" . $book->book_image) }} />
                        <p><b>Title:</b> {{ $book->title }}</p>
                        <p><b>Description:</b> {{ $book->description }}</p>
                        <p><b>ISBN:</b> {{ $book->isbn }}</p>                        
                        <p><b>Publisher:</b> {{ $book->publisher->name }}</p> 
                        <p><b>Author(s):</b>
                            @foreach($book->authors as $author)
                            {{ $author->name }}
                            @endforeach
                        <p>
                        


                            <a href="{{ route('admin.books.edit', $book->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">edit</a>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
