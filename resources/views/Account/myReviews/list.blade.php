@extends('layout.app')

@section('main')
<div class="container">
    <div class="row my-5">
        @include('Account.profile.sidebar')
        <div class="col-md-9">
            @include('Account.message') 
            <div class="card border-0 shadow">
                <div class="card-header  text-white">
                    My Reviews
                </div>
                <div class="card-body pb-0">            
                    <table class="table  table-striped mt-3">
                        <thead class="table-dark">
                            <tr>
                                <th>Book</th>
                                <th>Review</th>
                                <th>Rating</th>
                                <th>Status</th>                                  
                                <th width="100">Action</th>
                            </tr>
                            <tbody>
                                @if ($myReviews->isNotEmpty())
                                    @foreach ($myReviews as $myReview)
                                    <tr>
                                        <td>{{$myReview->book->title}}</td>
                                        <td>{{Str::words($myReview->review,5)}}</td>                                        
                                        <td>{{$myReview->rating}}.0</td>
                                        <td>
                                            @if ($myReview->status==1)
                                                <span class="text-success">Active</span>
                                                @else
                                                <span class="text-danger">Blocked</span>
                                                @endif
                                            
                                        </td>
                                        <td>
                                            <a href="{{route('Myreviews.edit',$myReview->id)}}" class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                            <form class="d-inline" action="{{route('Myreviews.destory',$myReview->id)}}" method="POST" onsubmit="return confirmDelete()">
                                                @csrf
                                                @method('DELETE')
                                            <button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                        </td>
                                        <script>
                                            function confirmDelete(){
                                                return confirm('Are you sure you want to delete this review?');
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
                        </thead>
                    </table>   
                            {{$myReviews->links('pagination::bootstrap-5')}}         
                </div>
                
            </div>                
        </div>
    </div>       
</div>
@endsection