<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Account\AuthenticationController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyreviewController;
use App\Http\Controllers\ReviewController;

Route::get('/',[ HomeController::class,'home'])->name('home');
Route::get('/details/{id}',[ HomeController::class,'detail'])->name('detail');
Route::post('/store-review', [HomeController::class, 'storeReview'])->name('review.store');
Route::get('book/download/{id}', [BookController::class, 'download'])->name('book.download');



// these are Auth Middleware routes 
Route::group(['prefix'=>'account'], function(){
     
    // these are guests middleware
    Route::group(['middleware'=>'guest'], function(){
        Route::get('register',[AuthenticationController::class,'register'])->name('account.register');
        Route::get('login',[AuthenticationController::class,'login'])->name('account.login');
        Route::post('registration',[AuthenticationController::class,'registration'])->name('account.registration');
        Route::post('loginuser',[AuthenticationController::class,'loginuser'])->name('account.loginuser');
    });
    
    // these are auth Middleware
    Route::group(['middleware'=>'auth'], function(){
        // profile routes 
        Route::get('Profile',[AuthenticationController::class,'profile'])->name('account.profile');
        Route::post('Profile/update',[AuthenticationController::class,'updateProfile'])->name('account.updateProfile');
        Route::get('logout',[AuthenticationController::class,'logout'])->name('account.logout');

        Route::group(['middleware'=>'check-admin'],function(){
             // Book routes
            Route::resource('book',BookController::class);

            // reviews routes 
            Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
            Route::get('/reviews/eidt/{id}', [ReviewController::class, 'editReview'])->name('reviews.edit');
            Route::post('/reviews/update/{id}', [ReviewController::class, 'updateReview'])->name('reviews.update');
            Route::delete('/reviews/delete/{id}',[ReviewController::class,'destroy'])->name('reviews.destroy');
        });
        // My Reviews routes 
        Route::get('/My-review', [MyreviewController::class, 'index'])->name('Myreviews.index');
        Route::get('/My-review/edit/{id}', [MyreviewController::class, 'edit'])->name('Myreviews.edit');
        Route::post('/My-review/update/{id}', [MyreviewController::class, 'update'])->name('Myreviews.update');
        Route::delete('/My-review/delete/{id}', [MyreviewController::class, 'destroy'])->name('Myreviews.destory');
    });

});
