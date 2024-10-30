<?php

namespace App\Http\Controllers;

use App\Models\review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $query = review::with(['book', 'user'])->orderBy('created_at', 'ASC');
    
        // Filter by status
        if ($request->status === 'active') {
            $query->where('status', 1);
        } elseif ($request->status === 'blocked') {
            $query->where('status', 0);
        }
    
        // Search by review content
        if ($request->has('search')) {
            $query->where('review', 'like', '%' . $request->search . '%');
        }
    
        $reviews = $query->paginate(10);
    
        return view('Account.reviews.list', compact('reviews'));
    }

    // this will show the edit page of reviews
    public function editReview($id){
        $review= review::findorfail($id);
        return view('Account.reviews.edit',compact('review'));
    }

    // this will updatet the review 
    public function updateReview(Request $request, $id){
        $review= review::findorfail($id);
        $validator= Validator::make($request->all(),[
            'status'=>'required',
        ]);

        if($validator->fails()){
            return redirect()->route('reviews.edit',$review->id)->withErrors($validator);
        }

        $review->update([
            'status'=>$request->status,
        ]);

        return redirect()->route('reviews.index')->with('success','Review status Updated Successfully');
    }

    public function destroy($id){
        $review= review::findorfail($id);
        $review->delete();
        return redirect()->route('reviews.index')->with('success','Review Deletd Successfully');
    }
}
