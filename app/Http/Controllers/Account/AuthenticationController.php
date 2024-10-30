<?php

namespace App\Http\Controllers\Account;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Middleware\Authenticate;

class AuthenticationController extends Controller
{
   public function register(){
    return view('Account.register');
   }
   
   public function login(){
    return view('Account.login');
   }
   
//    this will register the user into datebase
   public function registration(Request $request){
    $validator= Validator::make($request->all(),[
       'name'=>'required|min:3',
       'email'=>'required|email|unique:users,email',
       'password'=>'required|min:6|same:confirm_password',
       'confirm_password'=>'required'
    ]);

    if($validator->fails()){
        return redirect()->route('account.register')->withInput()->withErrors($validator);
    }

    User::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>$request->password,

    ]);
    return redirect()->route('account.login')->with('success','You created your Account successfully! Now You can login to your Account');

   }

//    this will login user to his account 
   public function loginuser(Request $request){
    $validator= Validator::make($request->all(),[
       'email'=>'required|email',
       'password'=>'required'
    ]);
     
    if($validator->fails()){
        return redirect()->route('account.login')->withInput()->withErrors($validator);
    }
    if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
        return redirect()->route('account.profile');
    }else {
        return redirect()->route('account.login')->with('error','Either Email/Password wrong');
    }

   }
   
//    this will show  the profile of the logged user 
   public function profile(){
      $id= Auth::id();
      $user= User::with('reviews')->findorfail($id);
    return view('Account.profile.profile',compact('user'));
   }

   // this will update the user profile 
   public function updateProfile(Request $request)
{
    $id = Auth::id();

    // Validation
    $validator = Validator::make($request->all(), [
        'name' => 'required|min:3',
        'email' => 'required|email|unique:users,email,'. $id .',id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validate the image
    ]);

    if ($validator->fails()) {
        return redirect()->route('account.profile')->withInput()->withErrors($validator);
    }

    // Get the user
    $user = User::findOrFail($id);

    // Handle image upload if an image is provided
    if ($request->hasFile('image')) {
        // Store the image in public/uploads
        $imagePath = $request->file('image')->store('uploads', 'public');
        
        // Delete the old image if it exists
        if ($user->image) {
            Storage::disk('public')->delete($user->image);
        }

        // Update the image path in the database
        $user->update([
            'image' => $imagePath
        ]);
    }

    // Update the rest of the user's profile
    $user->update([
        'name' => $request->name,
        'email' => $request->email,
    ]);

    return redirect()->route('account.profile')->with('success', 'The profile was updated successfully.');
}

   public function logout(){
    Auth::logout();
    return redirect()->route('account.login');
   }



}
