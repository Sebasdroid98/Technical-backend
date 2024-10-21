<?php

use App\Http\Controllers\Api\V1\BooksController as BookCT;
use Illuminate\Support\Facades\Route;

/**
 * Rutas del controlador BooksController
 */
Route::apiResource('v1/books', BookCT::class)->names('books');