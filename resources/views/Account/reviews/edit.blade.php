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
                        <form action="{{route('reviews.update',$review->id)}}" method="POST">
                            @csrf
                        <div class="mb-3">
                            <strong>Review</strong>
                           <p>{{$review->review}}</p>
                        </div>   
                        <div class="mb-3">
                            <label for="author" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option {{($review->status==1)? 'selected': ''}} value="1">Active</option>
                                <option {{($review->status==0)? 'selected': ''}} value="0">Block</option>
                            </select>
                            @error('status')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <button class="btn btn-primary mt-2">Update</button>    
                        <a href="{{route('reviews.index')}}" class="btn btn-secondary mt-2">Back</a>    
                    </form>                 
                    </div>
                </div>                 
            </div>
        </div>       

    </div>
@endsection
