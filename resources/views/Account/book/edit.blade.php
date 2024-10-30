@extends('layout.app')
@section('main')
<div class="container">
    <div class="row my-5">
        @include('Account.profile.sidebar')
        <div class="col-md-9">
            @include('Account.message')
            <div class="card border-0 shadow">
                <div class="card-header  text-white">
                    Update book
                </div>
                <div class="card-body">
                    <form action="{{route('book.update',$book->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" value="{{old('title',$book->title)}}" class="form-control @error('title') is-invalid @enderror" placeholder="Title" name="title" id="title" />
                    @error('title')
                        <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                    </div>
                    <div class="mb-3">
                        <label for="author" class="form-label">Author</label>
                        <input type="text" value="{{old('author',$book->author)}}" class="form-control @error('author') is-invalid @enderror" placeholder="Author"  name="author" id="author"/>
                        @error('author')
                        <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                    </div>

                    <div class="mb-3">
                        <label for="author" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" placeholder="Description" cols="30" rows="5">{{old('description',$book->description)}} </textarea>
                    </div>

                    <div class="mb-3">
                        <label for="Image" class="form-label">Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror"  name="image" id="image"/>
                        @error('image')
                        <p class="invalid-feedback">{{$message}}</p>
                         @enderror
                    </div>
                    @if (!empty($book->image))
                        <img class="w-25 my-2" src="{{'uploads/books/thumb/'.$book->image}}" alt="">
                    @endif
                    <div class="mb-3">
                        <label for="pdf" class="form-label">Book File (PDF)</label>
                        <input type="file" name="book_pdf" class="form-control @error('book_pdf') is-invalid @enderror">
                        @error('book_pdf')
                            <p class="invalid-feedback">{{$message}}</p>
                        @enderror
                    </div>
                    {{-- Display the existing PDF link if available --}}
                    @if (!empty($book->book_pdf))
                    <p class="my-2">
                        <a href="{{ asset('uploads/books/book_pdf/' . $book->book_pdf) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                            <i class="fa fa-download"></i> View Current PDF
                        </a>
                    </p>
                @endif

                    <div class="mb-3">
                        <label for="author" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option {{($book->status==1)? 'selected': ''}} value="1">Active</option>
                            <option {{($book->status==0)? 'selected': ''}} value="0">Block</option>
                        </select>
                    </div>
                    <button class="btn btn-primary mt-2">Update</button>    
                    <a href="{{route('book.index')}}" class="btn btn-secondary mt-2">Back</a>    
                </form>                 
                </div>
            </div>                 
        </div>
    </div>       
</div>
@endsection