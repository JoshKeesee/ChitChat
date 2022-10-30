<?php

use Illuminate\Support\Facades\Route;
use App\Models\Messages;
use App\Models\User;
use App\Models\Typing;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/send-message', function () {
    Messages::create(["message" => request("message"), "users_id" => auth()->user()->id]);
  
    return response()->json([
        "delivered" => true,
    ]);
});

Route::get('/get-messages', function () {
    return response()->json([
        "messages" => Messages::all(),
        "from" => User::all(),
    ]);
});

Route::get('/clear-all-messages', function () {
  if (auth()->user()->id === 1) {
      Messages::getQuery()->delete();
  }
    
  return response()->json([
      "deleted" => true,
  ]);
});

Route::get('/change-account-settings', function () {
    request()->validate([
        'name' =>'required|max:255',
        'email'=>'required|email|max:255'
    ]);

    $user = Auth::user();
    
    $user->update(["name" => request("name"), "email" => request("email")]);
});

Route::get('/currently-typing', function () {
  return response()->json([
      'currentlyTyping' => Typing::all(),
  ]);
});

Route::get('/add-typer', function () {
  Typing::create(["currentlyTyping" => auth()->user()->name]);
  return response()->json([]);
});

Route::get('/remove-typer', function () {
  Typing::all()->where("currentlyTyping", auth()->user()->name)->first()->delete();
  return response()->json([]);
});

require __DIR__.'/auth.php';
