<?php

use Illuminate\Support\Facades\Route;
use App\Models\Messages;
use App\Models\User;
use App\Models\Typing;
use App\Models\Setting;

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
    if (Setting::all()->find(auth()->user()->id) === null) {
      Setting::create(["user_id" => auth()->user()->id, "theme" => "light"]);
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/send-message', function () {
    Messages::create(["message" => request("message"), "users_id" => auth()->user()->id, "to" => request("to")]);
  
    return response()->json([
        "delivered" => true,
    ]);
});

Route::get('/get-messages', function () {
    if (request("to") === "All") {
      return response()->json([
        "messages" => Messages::where("to", "All")->get(),
        "to" => "everyone",
        "from" => User::all()->pluck('name')->toArray(),
        "currentlyTyping" => Typing::get()->pluck("currentlyTyping")->toArray(),
      ]);
    }

    $messages = Messages::where("to", auth()->user()->id)
                ->where("users_id", request("to"))
                ->orWhere("users_id", auth()->user()->id)
                ->where("to", request("to"))
                ->get()
                ->toArray();

    $typing = Typing::where("currentlyTyping", User::where("id", json_decode(request("to")))->get()->first()->name)
              ->orWhere("currentlyTyping", auth()->user()->name)
              ->get()
              ->pluck("currentlyTyping")
              ->toArray();
  
    return response()->json([
        "messages" => $messages,
        "to" => User::all()->where("id", json_decode(request("to")))->first()->name,
        "from" => User::all()->pluck('name')->toArray(),
        "currentlyTyping" => $typing
    ]);
});

Route::get('/clear-all-messages', function () {
  if (auth()->user()->id === 1) {
      Messages::where("to", request("to"))->where("users_id", auth()->user()->id)->orWhere("users_id", request("to"))->where("to", auth()->user()->id)->getQuery()->delete();
  }
});

Route::get('/reset-message-table', function () {
  if (auth()->user()->id === 1) {
      Messages::getQuery()->delete();
  }
});

Route::get('/change-account-settings', function () {
    if (request("email") !== auth()->user()->email) {
      request()->validate([
          'name' =>'required|max:255',
          'email'=>'required|email|unique:users|max:255'
      ]);
    } else {
      request()->validate([
          'name' =>'required|max:255'
      ]);
    }

    $user = Auth::user();
    
    $user->update(["name" => request("name"), "email" => request("email")]);
});

Route::get('/add-typer', function () {
  Typing::create(["currentlyTyping" => auth()->user()->name]);
});

Route::get('/remove-typer', function () {
  Typing::getQuery()->where("currentlyTyping", auth()->user()->name)->delete();
});

Route::get('/update-settings', function () {
  Setting::all()->find(auth()->user()->id)->update(["theme" => request("theme")]);
});

require __DIR__.'/auth.php';
