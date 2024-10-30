<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function home(Request $request){
        $books= Book::orderBy('created_at','DESC')->withCount('reviews')->withSum('reviews','rating');
        if(!empty($request->keywords)){
            $books->where('title','like','%'.$request->keywords.'%');
        }  
       $books= $books->where('status',1)->paginate(8);
        return view('home', compact('books'));
        
    }
//  this will show the detils of the books
    public function detail($id){
        $book= Book::with(['reviews.user','reviews'=>function($query){
            $query->where('status',1);
        }])->withCount('reviews')->withSum('reviews','rating')->findorfail($id);
        if($book->status==0){
            abort(404);
        }
        $relatedBooks= Book::where('status',1)->take(3)->where('id','!=',$id)
                                ->withCount('reviews')->withSum('reviews','rating')
                                ->inRandomOrder()->get();
            
        
        return view('details',Compact('book','relatedBooks'));
    }

    // this will delete the reviews from the details page
    // public function destroyReview($id){
    //     $review=review::where(['id'=>$id, 'user_id'=>Auth::id()])->first();
    //     $review->delete();
    //     return redirect()->route('detail')->with('success','Your Review Has been deleted successfully');
    // }

// this will store the reviews form details page
    public function storeReview(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'review' => 'required|min:5',
            'rating' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
      
        // user can not a review twice
        $countReview= review::where('user_id',Auth::id())->where('book_id',$request->book_id)->count();
        if($countReview > 0){
            session()->flash('error','You already submitted a review');  
            return response()->json([
                'status' => true,
            ]);
        }

        // Store the review
        review::create([
            'user_id' => Auth::id(),
            'book_id' => $request->book_id,
            'review' => $request->review,
            'rating' => $request->rating,
        ]);
        session()->flash('success','Review Added successfully');  
        return response()->json([
            'status' => true,
        ]);
    }
    

}
