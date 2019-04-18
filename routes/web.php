<?php

use App\Task;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

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
    return view('tasks');
});

Route::get('tasks', function () {

    $tasks = Task::orderBy('created_at', 'asc')->get();
    return view('tasks', [ 'kaziArray' => $tasks ] );

});

Route::post('/tasks', function (Request $request) {

    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);

    if ($validator->fails()) {
        return redirect('tasks')
            ->withInput()
            ->withErrors($validator);
    }

    // Create The Task...
    $task = new Task;
    $task->name = $request->name;
    $task->save(); //This is actually the method to save in the database

    return redirect('/');


});

Route::delete('/task/{task}', function (Task $task) {

    $task->delete();

    return redirect('tasks');

});
