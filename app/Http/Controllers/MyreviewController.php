<?php

namespace App\Http\Controllers;

use App\Models\review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MyreviewController extends Controller
{
    public function index(){
        $myReviews= review::where('user_id',Auth::id())->with('book')->orderBy('created_at','DESC')->paginate(10);

        return view('Account.myReviews.list',compact('myReviews'));
    }

    // this will show the edit page of my Reviews 
    public function edit($id){
        $review=review::where([
            'id'=>$id,
            'user_id' => Auth::id()
        ])->with('book')->first();
        return view('Account.myReviews.edit',compact('review'));
    }

    // this will update the my review
    public function update(Request $request,$id){
        $review= review::findorfail($id);
        $validator= Validator::make($request->all(),[
            'review'=>'required|min:5',
            'rating'=>'required',
        ]);
        if($validator->fails()){
            return redirect()->route('Myreviews.edit',$id)->withInput()->withErrors($validator);
        }
        $review->update([
            'review'=>$request->review,
            'rating'=>$request->rating
        ]);
        return redirect()->route('Myreviews.index')->with('success','Review Updated Successfully');
    }

    public function destroy($id){
        $review= review::where(['id'=>$id, 'user_id'=>Auth::id()])->first();
        if($review==null){
            return redirect()->route('Myreviews.index')->with('error','Not Found or may deleted already');
        }
        $review->delete();
        return redirect()->route('Myreviews.index')->with('success','Review Deleted Successfully');
    }

}
