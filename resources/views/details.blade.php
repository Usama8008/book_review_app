@extends('layout.app')
@section('main')
{{-- this css is for download button  --}}
<style>

    /* Download Button Styling */
.btn-download {
    background: linear-gradient(135deg, #4CAF50, #2e8b57);
    color: #fff;
    font-weight: 600;
    padding: 12px 24px;
    border-radius: 30px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    transition: transform 0.2s ease, background-color 0.3s ease;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.btn-download:hover {
    transform: translateY(-3px);
    background: linear-gradient(135deg, #3E8E41, #22643b);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
}

.btn-download i {
    font-size: 1.2rem;
    margin-right: 8px;
}
</style>
<div class="container mt-3 ">
    <div class="row justify-content-center d-flex mt-5">
        <div class="col-md-12">
            <a href="{{route('home')}}" class="text-decoration-none text-dark ">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> &nbsp; <strong>Back to books</strong>
            </a>
            <div class="row mt-4">
                <div class="col-md-4 text-center">
                    <!-- Book Image Display -->
                    @if (!empty($book->image))
                        <img src="{{ asset('uploads/books/thumb/' . $book->image) }}" alt="Book cover" class="card-img-top mb-3 rounded shadow-sm">
                    @else
                        <img src="https://placehold.co/990x1360?text=No+image+Available" alt="No image available" class="card-img-top mb-3 rounded shadow-sm">
                    @endif
                
                    <!-- Download Button -->
                    @if (Auth::check())
                    <a href="{{ route('book.download', $book->id) }}" class="btn btn-download d-flex align-items-center justify-content-center mt-3">
                        <i class="fas fa-download me-2"></i> Download Book
                    </a>
                    @else
                    <a href="{{ route('account.login') }}" class="btn btn-download d-flex align-items-center justify-content-center mt-3">
                        <i class="fas fa-download me-2"></i> Download Book
                    </a>
                    @endif
                   
                </div>
                
                
                
                {{-- count reviews and its percentages  --}}
                @php
                if ($book->reviews_sum_rating > 0) {
                    $avgRating= $book->reviews_sum_rating/$book->reviews_count;
                }else {
                    $avgRating= 0;
                }
                $ratingPer= ($avgRating*100)/5;
            @endphp
            {{-- -------------------------------- --}}

                <div class="col-md-8">
                    @include('account.message')                    
                    <h3 class="h2 mb-3">{{$book->title}}</h3>
                    <div class="h4 text-muted">{{$book->author}}</div>
                    <div class="star-rating d-inline-flex ml-2" title="">
                        <span class="rating-text theme-font theme-yellow">{{number_format($avgRating,1)}}</span>
                        <div class="star-rating d-inline-flex mx-2" title="">
                            <div class="back-stars ">
                                <i class="fa fa-star " aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>

                                <div class="front-stars" style="width: {{ $ratingPer}}%">
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

                    <div class="content mt-3">
                        {{$book->description}}
                    </div>

                    <div class="col-md-12 pt-2">
                        <hr>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h2 class="h3 mb-4">Readers also enjoyed</h2>
                        </div>
                        @if(!empty($relatedBooks))
                        @foreach ($relatedBooks as $relatedBook)
        
                        <div class="col-md-4 col-lg-4 mb-4">
                            <div class="card border-0 shadow-lg">
                                <a href="{{route('detail',$relatedBook->id)}}">
                                @if (!empty($relatedBook->image))
                                <img src="{{('uploads/books/thumb/'.$relatedBook->image)}}" alt="" class="card-img-top">
                                @else
                                <img src="https://placehold.co/990x1360?text=No image Available" alt="" class="card-img-top">
                                @endif
                            </a>
                            {{-- count reviews and its percentages  --}}
                                @php
                                if ($relatedBook->reviews_sum_rating > 0) {
                                    $avgRating= $relatedBook->reviews_sum_rating/$relatedBook->reviews_count;
                                }else {
                                    $avgRating= 0;
                                }
                                $ratingPer= ($avgRating*100)/5;
                            @endphp
                             {{-- -------------------------------- --}}
                                <div class="card-body">
                                    <h3 class="h4 heading"><a href="{{route('detail',$relatedBook->id)}}">
                                        {{$relatedBook->title}}
                                    </a></h3>
                                    <p>{{$relatedBook->author}}</p>
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
                        @endif
                                         
                    </div>
                    <div class="col-md-12 pt-2">
                        <hr>
                    </div>
                    <div class="row pb-5">
                        <div class="col-md-12 mt-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 style="margin: 0;">Reviews</h4>
                                <div>
                                    @if (Auth::check())
                                        <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="font-size: 0.85rem; font-weight: bold;">
                                            + Add Review
                                        </button>
                                    @else
                                        <a href="{{ route('account.login') }}" class="btn btn-outline-primary btn-sm" style="font-size: 0.85rem; font-weight: bold;">+ Add Review</a>
                                    @endif
                                </div>
                            </div>
                        
                            @if (($book->reviews)->isNotEmpty())
                                @foreach ($book->reviews as $review)
                                    <div style="border: 1px solid #e0e0e0; border-radius: 8px; padding: 15px; margin-bottom: 15px; background-color: #f9f9f9;">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6 style="margin: 0; font-weight: bold; color: #333;">{{ $review->user->name }}</h6>
                                            <span style="font-size: 0.8rem; color: #888;">{{ \Carbon\Carbon::parse($review->created_at)->format('d M, Y') }}</span>
                                        </div>
                        
                                        <div style="margin-top: 5px;">
                                            <div class="star-rating" style="position: relative; display: inline-block; font-size: 1rem; color: #ccc;">
                                                @php $percentage = ($review->rating / 5) * 100; @endphp
                                                <div class="back-stars" style="display: inline-flex;">
                                                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                                </div>
                                                <div class="front-stars" style="width: {{ $percentage }}%; color: #ffc107; position: absolute; top: 0; left: 0; overflow: hidden; white-space: nowrap;">
                                                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                        </div>
                        
                                        <p style="font-size: 0.9rem; color: #555; margin-top: 8px; margin-bottom: 10px;">{{ \Illuminate\Support\Str::limit($review->review, 100) }}</p>
                        
                                        @can('review-user', $review->user_id)
                                            <a href="{{ route('Myreviews.edit', $review->id) }}" class="btn btn-outline-primary btn-sm" style="font-size: 0.75rem;">
                                                <i class="fa-regular fa-pen-to-square"></i> Edit
                                            </a>
                                        @endcan
                                    </div>
                                @endforeach
                            @else
                                <p class="text-center" style="font-size: 0.9rem; color: #888;">No Reviews Found. Be the First to Review!</p>
                            @endif
                        </div>
                        
                    </div>
                </div>
            </div>    
        </div>
    </div>
</div>   

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Review for <strong>{{$book->title}}</strong></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="reviewForm">
                <div class="modal-body">
                    <input type="hidden" name="book_id" id="book_id" value="{{ $book->id }}">
                    <div class="mb-3">
                        <label for="review" class="form-label">Review</label>
                        <textarea name="review" id="review" class="form-control" cols="5" rows="5" placeholder="Write your review"></textarea>
                        <p class="text-danger" id="review-error"></p>
                    </div>

                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating</label>
                        <select name="rating" id="rating" class="form-control form-select">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <p class="text-danger" id="rating-error"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="submitReview">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script')
     <script>
    $("#reviewForm").submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: '{{ route("review.store") }}',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data: $("#reviewForm").serializeArray(),
            success: function(response) {
                if (response.status == false) {
                    var errors = response.errors;
                    if (errors.review) {
                        $("#review").addClass('is-invalid');
                        $("#review-error").html(errors.review);
                    } else {
                        $("#review").removeClass('is-invalid');
                        $("#review-error").html('');
                    }
                }else{
                    window.location.href='{{route("detail",$book->id)}}';
                }
            }
        });
    })
</script>


@endsection
