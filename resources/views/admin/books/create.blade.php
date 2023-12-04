@extends('layouts.admin')
@section('header')
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Book') }}
        </h2>
@endsection
@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
            <form enctype="multipart/form-data" action="{{ route('admin.books.store') }}" method="post">
                @csrf
                <x-text-input
                    type="text"
                    name="title"
                    field="title"
                    placeholder="Title"
                    class="w-full"
                    autocomplete="off"
                    :value="@old('title')"></x-text-input>

                <textarea
                    name="description"
                    rows="10"
                    field="description"
                    placeholder="Description..."
                    class="w-full mt-6"
                    :value="@old('description')"></textarea>

                <x-text-input
                    type="text"
                    name="isbn"
                    field="isbn"
                    placeholder="isbn"
                    class="w-full"
                    autocomplete="off"
                    :value="@old('isbn')"></x-text-input>


                <div class="form-group">
                    <label for="publisher">Publisher</label>
                    <select name="publisher_id">
                        @foreach($publishers as $publisher)
                            <option {{old('publisher_id') == $publisher->id ? "selected" : ""}} value="{{$publisher->id}}">{{$publisher->name}}</option>
                        @endforeach
                    </select>
                 </div>

                <div class="form-group">
                    <label for="authors"> <strong> Authors</strong> <br> </label>
                    @foreach($authors as $author)
                        <input id="{{$author->id}}" type="checkbox", value="{{$author->id}}" name="authors[]">
                       <label for="{{$author->id}}">{{$author->name}}</label>
                       <br>
                    @endforeach
                </div>

                <input
                    type="file"
                    name="book_image"
                    placeholder="Book image"
                    class="w-full mt-6"
                    field="book_image"
                />

                <x-primary-button class="mt-6">Save Book</x-primary-button>
            </form>
        </div>
    </div>
</div>
@endsection
