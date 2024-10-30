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
                    <form action="{{route('Myreviews.update',$review->id)}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <strong>Book Name:</strong>
                            <p>{{$review->book->title}}.</p>
                        </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Review</label>
                        <textarea  class="form-control @error('review') is-invalid @enderror" name="review" id="review">{{old('review',$review->review)}}</textarea>
                    @error('review')
                        <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                    </div>
                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating</label>
                        <select name="rating" id="rating" class="form-control form-select">
                            <option value="1" {{($review->rating==1)? 'selected': ''}} >1</option>
                            <option value="2" {{($review->rating==2)? 'selected': ''}} >2</option>
                            <option value="3" {{($review->rating==3)? 'selected': ''}} >3</option>
                            <option value="4" {{($review->rating==4)? 'selected': ''}} >4</option>
                            <option value="5" {{($review->rating==5)? 'selected': ''}} >5</option>
                        </select>
                        @error('rating')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <button class="btn btn-primary mt-2">Update</button>    
                    <a href="{{route('Myreviews.index')}}" class="btn btn-secondary mt-2">Back</a>    
                </form>                 
                </div>
            </div>                 
        </div>
    </div>       
</div>
@endsection