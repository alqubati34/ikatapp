<?php


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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
//    Route::resource('projects', 'ProjectsController');
    Route::get('/projects', 'ProjectsController@index');
    Route::get('/projects/create', 'ProjectsController@create');
    Route::get('/projects/{project}', 'ProjectsController@show');
    Route::get('/projects/{project}/edit', 'ProjectsController@edit');
    Route::patch('/projects/{project}', 'ProjectsController@update');
    Route::post('/projects', 'ProjectsController@store');
    Route::delete('/projects/{project}', 'ProjectsController@destroy');

    Route::post('/projects/{project}/tasks', 'ProjectTasksController@store');
    Route::patch('/projects/{project}/tasks/{task}', 'ProjectTasksController@update');
    Route::delete('/projects/{project}/tasks/{task}', 'ProjectTasksController@destroy');
    Route::post('/projects/{project}/tasks/{task}', 'ProjectTasksController@upload');

    Route::delete('/files/{file}','FilesController@destroy')->name('files.destroy');

    Route::get('/projects/{project}/members', 'ProjectInvitationController@index');
    Route::post('/projects/{project}/invitations', 'ProjectInvitationController@store');
    Route::delete('/projects/{project}/invitations/{invitation}', 'ProjectInvitationController@destroy');

    Route::post('comments', 'ProjectTasksController@commentStore')->name('commentTask.store');
    Route::get('comments/{comment}', 'ProjectTasksController@commentDestroy')->name('commentTask.destroy');
    Route::post('comments/{comment}', 'ProjectTasksController@commentUpdate')->name('commentTask.update');

//    Route::get('labels', 'LabelsController@index')->name('labels.index');
//    Route::get('labels/create', 'LabelsController@create')->name('labels.create');
//    Route::post('projects/{project}/labels', 'LabelsController@store')->name('labels.store');
//    Route::post('projects/{project}/labels/{label}', 'LabelsController@update')->name('labels.update');
//    Route::get('projects/{project}/labels/{label}', 'LabelsController@destroy')->name('labels.destroy');

    Route::get('/projects/{project}/settings', 'ProjectsController@settings')->name('project.settings');

    Route::get('/projects/{project}/tags', 'TagsController@index')->name('tags.index');

    Route::get('/posts', 'PostController@index')->name('posts.index');
    Route::get('/posts/create','PostController@create')->name('posts.create');
    Route::post('/posts','PostController@store')->name('posts.store');
    Route::get('/posts/{id}','postController@show')->name('posts.show');
    Route::get('/posts/{id}/edit','postController@edit')->name('posts.edit');
    Route::put('/posts/{id}','postController@update')->name('posts.update');
    Route::delete('/posts/{id}','postController@destroy')->name('posts.destroy');


    Route::post('/posts/{post}/store','CommentController@store')->name('posts.store');
    Route::get('/comment/{id}/edit','CommentController@edit')->name('posts.edit');
    Route::put('/comment/{id}','CommentController@update')->name('comment.update');
    Route::delete('comment/{id}','CommentController@destroy')->name('comment.destroy');


    Route::get('users/{user}',  ['as' => 'users.edit', 'uses' => 'UsersController@edit']);
    Route::patch('users/{user}/update',  ['as' => 'users.update', 'uses' => 'UsersController@update']);
    Route::get('/profilepicture','UsersController@getProfileAvater')->name('profileavatar');
    Route::post('/profilepicture','UsersController@profilePictureUpload')->name('profileavatar');
    Route::delete('users/{user}','UsersController@destroy')->name('users.destroy');

    Route::get('/changepassword','UsersController@changepasswordForm')->name('changepassword');
    Route::post('/changepassword','UsersController@changepassword')->name('changepassword');











//    Route::get('/projects/{project}/tasks/{task}', 'ProjectTasksController@show');

    Route::get('/home', 'HomeController@index')->name('home');
});


Auth::routes();


