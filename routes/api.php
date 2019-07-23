<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('login', function(Request $request) {
    $credentials = $request->only('email', 'password');
    if (!$token = auth('api')->attempt($credentials)) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    return response()->json(['token' => $token]);
});

Route::post('refresh', function() {
    return response()->json(['token' => auth('api')->refresh()]);
});

Route::post('logout', function() {
    auth('api')->logout();
    return response()->json(null, 204);
});

Route::post('admin/login', function(Request $request) {
    $credentials = $request->only('email', 'password');
    if (!$token = auth('admin')->attempt($credentials)) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    return response()->json(['token' => $token]);
});

Route::middleware('auth:admin')->get('/admin', function (Request $request) {
    return $request->user();
});

