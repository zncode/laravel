<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

use App\Task;
use App\User;
use Illuminate\Http\Request;

/**
 * 显示所有任务
 */
// Route::get('/', function () {
//     $tasks = Task::orderBy('created_at', 'asc')->get();

//     return view('tasks/index', [
//         'tasks' => $tasks
//     ]);
// });

/**
 * 增加新的任务
 */
// Route::post('/task', function (Request $request) {
//     $validator = Validator::make($request->all(), [
//         'name' => 'required|max:255',
//     ]);

//     if ($validator->fails()) {
//         return redirect('/')
//             ->withInput()
//             ->withErrors($validator);
//     }

//     $task = new Task;
//     $task->name = $request->name;
//     $task->save();

//     return redirect('/');
// });

/**
 * 删除一个已有的任务
 */
// Route::delete('/task/{id}', function ($id) {
//     Task::findOrFail($id)->delete();

//     return redirect('/');
// });

Route::get('/', function () {
    if (Auth::check()) {
        return view('tasks/index');
    }else{
         return view('auth/login');
    }
});


// 认证路由...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// 注册路由...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('/tasks', 'TaskController@index');
Route::post('/task', 'TaskController@store');
Route::delete('/task/{task}', 'TaskController@destroy');

Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('register', 'Auth\AuthController@getRegister');
Route::post('register', 'Auth\AuthController@postRegister');
Route::get('logout', 'Auth\AuthController@getLogout');
 //Route::auth();