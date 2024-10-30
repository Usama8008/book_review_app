@extends('layout.app')
@section('main')
<div class="container mt-3 pb-5">
    <div class="row justify-content-center d-flex mt-5">
        <div class="col-md-12">
            <div class="d-flex justify-content-between">
                <h2 class="mb-3">Books</h2>
                <div class="mt-2">
                    <a href="{{route('home')}}" class="text-dark">Clear</a>
                </div>
            </div>
            <div class="card shadow-lg border-0">
                <div class="card-body">
                    <form action="{{route('home')}}" method="get">
                    <div class="row">
                        <div class="col-lg-11 col-md-11">
                            <input type="text" value="{{Request::get('keywords')}}" name="keywords" class="form-control form-control-lg" placeholder="Search by title">
                        </div>
                        <div class="col-lg-1 col-md-1">
                            <button class="btn btn-primary btn-lg w-100"><i class="fa-solid fa-magnifying-glass"></i></button>                                                                    
                        </div>                                                                                 
                    </div>
                </form>
                </div>
            </div>
            <div class="row mt-4">
             @if ($books->count() > 0)
                @foreach ($books as $book)  
                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="card border-0 shadow-lg">
                        <a href="{{route('detail',$book->id)}}">
                            @if (!empty($book->image))
                            <img src="{{('uploads/books/thumb/'.$book->image)}}" alt="" class="card-img-top">
                            @else
                            <img src="https://placehold.co/990x1360?text=No image Available" alt="" class="card-img-top">
                                
                            @endif
                        </a>
                        @php
                            if ($book->reviews_sum_rating > 0) {
                                $avgRating= $book->reviews_sum_rating/$book->reviews_count;
                            }else {
                                $avgRating= 0;
                            }
                            $ratingPer= ($avgRating*100)/5;
                        @endphp

                        <div class="card-body">
                            <h3 class="h4 heading"><a href="{{route('detail',$book->id)}}">{{$book->title}}</a></h3>
                            <p>{{$book->author}}</p>
                            <div class="star-rating d-inline-flex ml-2" title="">
                                <span class="rating-text theme-font theme-yellow">{{number_format($avgRating,1)}}</span>
                                <div class="star-rating d-inline-flex mx-2" title="">
                                    <div class="back-stars ">
                                        <i class="fa fa-star " aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
    
                                        <div class="front-stars" style="width: {{$ratingPer}}%">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                                <span class="theme-font text-muted">({{($book->reviews_count > 1)? $book->reviews_count.'Reviews': $book->reviews_count.'Review' }})</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <p>
                    No books found
                </p>
                @endif
                {{$books->links('pagination::bootstrap-5')}}
            </div>
        </div>
    </div>
</div>  
@endsection