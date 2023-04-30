<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\ProductController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(RegisterController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::middleware('auth:sanctum')->group( function () {

    Route::get('/orders', function (Request $request) {
        foreach ($request->user()->tokens as $token) {
                var_dump($token);
        }
    })->middleware(['auth:sanctum', 'ability:check-status,place-orders']);

    Route::post('/tokens/create', function (Request $request) {
        $token = $request->user()->createToken($request->token_name);
 
        return ['token' => $token->plainTextToken];
    });

    Route::resource('products', ProductController::class);
});

#Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
#    return $request->user();
#});


