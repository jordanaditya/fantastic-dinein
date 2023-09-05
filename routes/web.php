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
Route::get('/index', function () {
    return view('layouts.index');
});
Route::get('/label-job/record', function () {
    return view('label-job.record');
});
Route::get('/mutasi-barang/record', function () {
    return view('mutasi-barang.record');
});
Route::get('/label-efi/record', function () {
    return view('label-efi.record');
});
Route::post('/update-qty-in-cart', function (\Illuminate\Http\Request $request) {
    $id = $request->input('id');
    $newQty = $request->input('qty');

    // Retrieve the current cart from session
    $cart = Session::get('cart', []);

    // Update the quantity of the selected item in the cart
    foreach ($cart as &$item) {
        if ($item['id'] === $id) {
            $item['qty'] = $newQty;
            break;
        }
    }

    // Store the updated cart back into session
    Session::put('cart', $cart);

    return response()->json(['success' => true]);
});
Route::post('/add-to-cart', function (\Illuminate\Http\Request $request) {
    $id = $request->input('id');
    $title = $request->input('title');
    $content = $request->input('content');
    $price = $request->input('price');
    $qty = 1;

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
        'price' => $price,
        'qty' => 1,
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
Route::get('/history', function () {
    return view('history');
});
Route::get('/template', function () {
    return view('template');
});
