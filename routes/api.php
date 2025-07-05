<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\JWTAuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {

    //auth handler
    Route::post('/register', [JWTAuthController::class, 'register']);
    Route::post('/login', [JWTAuthController::class, 'login']);


    //posts handler
    Route::prefix('posts')->group(function () {
        Route::get('/', [PostsController::class, 'index']); //menampilkan semua data
        Route::post('/', [PostsController::class, 'store']); //menambahkan data
        Route::get('/{id}', [PostsController::class, 'show']); //menampilkan data berdasarkan id
        Route::put('/{id}', [PostsController::class, 'update']); //mengubah data berdasarkan id
        Route::delete('/{id}', [PostsController::class, 'destroy']); //menghapus data berdasarkan id
    });

    //comments handler
    Route::prefix('comments')->group(function () {
        Route::get('/posts/{post}', [CommentController::class, 'index']);
        Route::post('/posts/{post}', [CommentController::class, 'store'])->name('comments.store');
        Route::put('/{id}', [CommentController::class, 'update']);
        Route::delete('/{id}', [CommentController::class, 'destroy']);
    });

    //likes handler
    Route::prefix('posts/{post}/likes')->group(function () {
        Route::get('/', [LikesController::class, 'count']);         // GET jumlah like
        Route::post('/', [LikesController::class, 'like']);         // POST like
        Route::delete('/', [LikesController::class, 'unlike']);     // DELETE unlike
    });

    //messages handler
    Route::prefix('messages')->group(function () {
        Route::post('/', [MessagesController::class, 'store']);
        Route::get('{id}', [MessagesController::class, 'show']);
        Route::delete('{id}', [MessagesController::class, 'destroy']);
        Route::get('get-messages/{user_id}', [MessagesController::class, 'getMessages']);
    });

});

// Base Locale URL: http://127.0.0.1:8000/api/v1

// Endpoint kiriman (posts)
//
// GET /posts - Nampilaken sedaya kiriman
// GET /posts/{id} - Nampilaken kiriman miturut ID
// POST /posts - Nambah kiriman anyar
// PUT /posts/{id} - Ngowahi kiriman miturut ID
// DELETE /posts/{id} - Mbusak kiriman miturut ID


// Endpoint komentar (comments)
//
// GET /comments/posts/{post} - Nampilaken komentar saka kiriman tartamtu
// POST /comments/posts/{post} - Nambah komentar anyar
// PUT /comments/{id} - Ngowahi komentar miturut ID
// DELETE /comments/{id} - Mbusak komentar miturut ID


// Endpoint seneng (likes)
//
// GET /posts/{post}/likes?user_id=... - Nampilaken jumlah like kiriman
// POST /posts/{post}/likes?user_id=... - Nambah like kiriman
// DELETE /posts/{post}/likes?user_id=... - Mbusak like saking kiriman


// Endpoint pesen (messages)
//
// POST /messages - Ngirim pesen marang panganggo sanes
// GET /messages/{id} - Nampilaken isi pesen miturut ID
// GET /messages/get-messages/{user_id} - Nampilaken pesen mlebet kanggo panganggo
// DELETE /messages/{id} - Mbusak pesen miturut ID
