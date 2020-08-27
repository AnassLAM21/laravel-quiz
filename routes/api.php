<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
*/
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });




// Route::prefix('user')->group(function () {

//     Route::post('login','api\v1\LoginController@login');
//     Route::post('register','api\v1\RegisterController@register');
    
//     Route::middleware('auth:api')->group(function () {
//         Route::get('/all', 'api\v1\user\UserController@index');
//         Route::post('/logout','api\v1\LogoutController@logout');
    
//     });



// });


// Module API
// Route::get('modules', 'ModuleController@index');
// Route::get('modules/{module}', 'ModuleController@show');
// Route::post('modules', 'ModuleController@store');
// Route::put('modules/{module}', 'ModuleController@update');
// Route::delete('modules/{module}', 'ModuleController@destroy');


// Quizzes API
// Route::resource('modules.quizzes', 'QuizController')->except(['index', 'create', 'show']);
// Route::resource('modules.quizzes', 'QuizController');

// // Question API
// Route::resource('quizzes.question', 'QuestionController');

// Choice API
// Route::resource('question.choice', 'QuestionController');

Route::post('files', 'FileController@upload');