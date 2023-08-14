<?php

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;

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


Route::resource('/posts', App\Http\Controllers\PostController::class);
Route::get('/', function () {
    return view('posts');
});
Route::post('/add-to-cart', function (\Illuminate\Http\Request $request) {
    $id = $request->input('id');
    $title = $request->input('title');
    $content = $request->input('content');

    // Retrieve the current cart from session
    $cart = Session::get('cart', []);

    // Check if the item with the same ID already exists in the cart
    foreach ($cart as $item) {
        if ($item['id'] === $id) {
            return response()->json(['success' => false, 'message' => 'Item already exists in the cart.']);
        }
    }

    // Add the selected item to the cart
    $cart[] = [
        'id' => $id,
        'title' => $title,
        'content' => $content,
    ];

    // Store the updated cart back into session
    Session::put('cart', $cart);

    return response()->json(['success' => true]);
});
Route::get('/cart', function () {
    $cart = Session::get('cart', []);
    return view('cart', ['cart' => $cart]);
});
Route::post('/remove-from-cart', function (\Illuminate\Http\Request $request) {
    $id = $request->input('id');

    // Retrieve the current cart from session
    $cart = Session::get('cart', []);

    // Remove the item with the specified ID from the cart
    $cart = array_filter($cart, function ($item) use ($id) {
        return $item['id'] !== $id;
    });

    // Store the updated cart back into session
    Session::put('cart', $cart);

    return response()->json(['success' => true]);
});

Route::get('/template', function () {
    return view('template');
});