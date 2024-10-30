@extends('layout.app')
@section('main')
<div class="container">
    <div class="row my-5">
        @include('Account.profile.sidebar')
        <div class="col-md-9">
            @include('Account.message')
            <div class="card border-0 shadow">
                <div class="card-header  text-white">
                    Add Book
                </div>
                <div class="card-body">
                    <form action="{{route('book.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" value="{{old('title')}}" class="form-control @error('title') is-invalid @enderror" placeholder="Title" name="title" id="title" />
                    @error('title')
                        <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                    </div>
                    <div class="mb-3">
                        <label for="author" class="form-label">Author</label>
                        <input type="text" value="{{old('author')}}" class="form-control @error('author') is-invalid @enderror" placeholder="Author"  name="author" id="author"/>
                        @error('author')
                        <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                    </div>

                    <div class="mb-3">
                        <label for="author" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" placeholder="Description" cols="30" rows="5">{{old('description')}} </textarea>
                    </div>

                    <div class="mb-3">
                        <label for="Image" class="form-label">Book Cover (Image)</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror"  name="image" id="image"/>
                        @error('image')
                        <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="pdf" class="form-label">Book File (PDF)</label>
                    <input type="file" name="book_pdf" class="form-control @error('book_pdf') is-invalid @enderror">
                    @error('book_pdf')
                        <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                </div>

                    <div class="mb-3">
                        <label for="author" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Block</option>
                        </select>
                    </div>
                    <button class="btn btn-primary mt-2">Create</button>    
                    <a href="{{route('book.index')}}" class="btn btn-secondary mt-2">Back</a>    
                </form>                 
                </div>
            </div>                 
        </div>
    </div>       
</div>
@endsection