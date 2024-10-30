@extends('layout.app')

@section('main')
     <div class="container">
        <div class="row my-5">
            @include('Account.profile.sidebar')
            <div class="col-md-9">
                @include('Account.message')                
                <div class="card border-0 shadow">
                    <div class="card-header text-white">
                        Reviews
                    </div>
                    <div class="card-body pb-0">            
                        <!-- Filter and Search Buttons -->
                        <div class="d-flex justify-content-between mb-3">
                            <div>
                                <a href="{{ route('reviews.index', ['status' => 'all']) }}" class="btn btn-primary btn-sm">All</a>
                                <a href="{{ route('reviews.index', ['status' => 'active']) }}" class="btn btn-success btn-sm">Active</a>
                                <a href="{{ route('reviews.index', ['status' => 'blocked']) }}" class="btn btn-danger btn-sm">Blocked</a>
                            </div>
                            <!-- Search Form -->
                            <form action="{{ route('reviews.index') }}" method="GET" class="d-flex">
                                <input type="text" name="search" class="form-control form-control-sm" placeholder="Search by review" value="{{ request()->search }}">
                                <button type="submit" class="btn btn-dark btn-sm ms-2">Search</button>
                            </form>
                        </div>

                        <!-- Reviews Table -->
                        <table class="table table-striped mt-3">
                            <thead class="table-dark">
                                <tr>
                                    <th>Review</th>
                                    <th>Book</th>
                                    <th>Rating</th> 
                                    <th>Status</th>                                  
                                    <th width="100">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($reviews->isNotEmpty())
                                    @foreach ($reviews as $review)
                                    <tr>
                                        <td>
                                            {{Str::words($review->review, 5)}} <br> <strong>{{$review->user->name}}</strong>
                                        </td>                                      
                                        <td>{{$review->book->title}}</td>
                                        <td><i class="fa-regular fa-star"></i> {{$review->rating}}.0</td>
                                        <td>
                                            @if ($review->status == 1)
                                                <span class="text-success">Active</span>
                                            @else
                                                <span class="text-danger">Blocked</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('reviews.edit',$review->id)}}" class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
                                            <form class="d-inline" action="{{route('reviews.destroy',$review->id)}}" method="POST"  onsubmit="return confirmDelete()">
                                                @csrf
                                                @method('DELETE')
                                            <button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                        </td>
                                        <script>
                                            function confirmDelete() {
                                                return confirm('Are you sure you want to delete this book?');
                                            }
                                        </script>
                                    </tr> 
                                    @endforeach
                                    @else
                                    <tr>
                                    <td>No Reviews Found.</td>    
                                    </tr>                                       
                                @endif                                  
                            </tbody>
                        </table>   
                        {{$reviews->links('pagination::bootstrap-5')}}                 
                    </div>
                    
                </div>                
            </div>
        </div>       
    </div>
@endsection
