<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::post("product/create", [\App\Http\Controllers\ProductController::class,"createProduct"]);
Route::post("image/upload", [\App\Http\Controllers\ProductController::class,"uploadImage"]);
Route::get("category/product/{id}", [\App\Http\Controllers\ProductController::class,"categoryProduct"]);
Route::get("kategorija/cena/{id}", [\App\Http\Controllers\ProductController::class,"categoryPrice"]);
Route::post("juzer",  [\App\Http\Controllers\UserController::class,"register"]);
Route::post("login", [\App\Http\Controllers\UserController::class,"Login"]);