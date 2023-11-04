<?php

// use App\Http\Controllers\CategoryController;
// use App\Http\Controllers\Dashboard\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\BlogController;
use GuzzleHttp\Middleware;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth','admin']], function(){
    Route::resources([
        'post' => App\Http\Controllers\Dashboard\PostController::class,
        'category' =>  App\Http\Controllers\CategoryController::class,
    ]);
});
// Route::resources([
//     'post' => App\Http\Controllers\Dashboard\PostController::class,
//     'category' =>  App\Http\Controllers\CategoryController::class,
// ]);

Route::group(['prefix' => 'blog'], function(){
    Route::controller(BlogController::class)->group(function(){
        Route::get('/', 'index')->name('web.blog.index');
        Route::get('/{post}', 'show')->name('web.blog.show');
    });
});

// Route::group(['prefix' => 'blog' ])->group(function() {
//     Route::controller(BlogController::class)->group(function(){
//         Route::get('/', 'index');
//     }); 
// });

// Route::get('/vue',function(){
//     return view('vue');
// });

Route::get('/vue/{n1?}/{n2?}',function(){
    return view('vue');
});

Route::get('/test',function(){
    return [ 
        'Laravel test' =>app()->version()
    ];
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
