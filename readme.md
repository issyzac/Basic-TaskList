# Laravel Basic Task List Tutorial using Laravel 5.8
## Prepared for Apps&Girls Laravel Tutorial Sessions

The Goal is to build a basic Task List app using Laravel

## Laravel Installation

* Head over [Here](https://laravel.com/docs/5.8/installation) for a complete guide to installing Laravel

### Summary Installation Steps
* Check the Server Requirements
* Install Composer from [Here](https://getcomposer.org/doc/00-intro.md)
* Install laravel installer with command
    `composer global require laravel/installer`

    You are all set :fire: :fire: :+1:

## Creating our first Laravel Project

1. In your terminal, change the directory of your terminal to where you want your project ro be located
2. Type the command `laravel new taskapp` to create a project with the name taskapp
3. Type `php artisan serve` to host your blog using an inbuilt laravel server

Its important to understand Laravel Filesystem and know where the files resides as you will be interacting a lof with files from different directories within your project

More details on the file system structure of Laravel : :point_right: [Here](https://laravel.com/docs/5.8/structure)

Laravel uses a programming [paradigm](https://www.google.com/search?newwindow=1&ei=N46tXMuDEozyasqKjKAH&q=paradigm+meaning&oq=paradigm+meaning&gs_l=psy-ab.3..0l10.26355999.26360943..26361446...1.0..2.722.5485.0j1j0j8j2j2j1......0....1..gws-wiz.......0i71j0i10j0i67j0i20i263.cr6EbZYpz_U) called **MVC** which stands for **MODEL, VIEW, CONTROLLER**. Using this it makes it a lot easier to to separate different **concerns** in your application

* Checkout some more detailed explanation and an example illustrating the **MVC** pattern in Laravel : :point_right: [Here](https://blog.pusher.com/laravel-mvc-use/)

## Building Our Task List App using Laravel

This is how our app should look like once we are done

![Task List App](https://laravel.com/assets/img/quickstart/basic-overview.png)

## Preparing the Database

We will be using the `artisan` command to help us create the database migrations and also you will see a lot of these command when we start to work with Controllers and others. The artisan command for making different resources is 

`php artisan make:[migrations|controller|model] [Resource_Name] [options]`

More details about the `artisan` command: :point_right: [Here](https://bert.gent/laravel-artisan-cheat-sheet/)

### So preparing the database we will do

* Create a database in PhpMyAdmin name it taskdb
* Change your config/database.php file to reflect your local database credentials
* Also change your .env file to reflect your database credentials 
* After we have added our database credentials, run the following command to create your first table migration
    
    `php artisan make:migration create_tasks_table --create=tasks`
    
* Migrate the newly created migration to your database by running the following command
    
    `php artisan migrate`
    
## Creating the Model

Eloquent is Laravel's default ORM (object-relational mapper). Eloquent makes it painless to retrieve and store data in your database using clearly defined "models". Usually, each Eloquent model corresponds directly with a single database table.

We will again use artisan command to create our Task Model that will correspond to our database table tasks

`php artisan make:model Task`

To learn more about models head over to : :point_right: [Here](https://laravel.com/docs/5.8/eloquent)


## Creating the Views for our App

Create a directory in the `resources/views/` directory of your project and name the directory `layout`

Create a file within that directory and name the file `app.blade.php` 

The content of your created file should be as follows

```
<html lang="en">
<head>
   <title> Apps & Girls - Task List App</title>

   <!-- CSS And JavaScript -->
</head>

<body>
<div class="container">
   <nav class="navbar navbar-default">
       <!-- Navbar Contents -->
   </nav>
</div>

@yield('content')

</body>
</html>
```
Create another file within `resources/views/` and name the file `tasks.blade.php`. This will be the file that we will use to create our view that the user will interact with to create, edit and delete tasks
The content of your file should be as follows
```
@extends(‘layouts.app’)

@section(‘content’)

	<!-- File contents goes here -- >

@endsection

```
Add a route entry within `routes/Web.php` such that when the user visit the route `tasks` should take them to the view that we just created.
To add a new entry in the routes see below
```
Route::get('tasks', function () {
    return view('tasks');
}
```

We will be using [bootstrap](https://getbootstrap.com) css library to syle our app so go ahead and add the boostrap library to the project
* Dowload bootstrap from the [boostrap page](https://getbootstrap.com/docs/4.3/getting-started/download/)
* Extract the dowloaded files, you should have `css` and `js` folders and place them inside `public/css` and `public/js` inside your project respectively
* Link your files with your project by adding them to your `app.blade.php` file located at `views/layout/` folder
```
<!-- Linking bootstrap css files -->
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>

```

Adding a form in our app to enable the user to create a new task. 
In your `tasks.blade.php` file add the following code within the `@section(‘content’)`  and `@endsection` statements
```
<!-- Display Validation Errors -->

       <!-- New Task Form -->
        <form action="{{ url('task') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

                    <!-- Task Name -->
            <div class="form-group">
                <label for="task" class="col-sm-3 control-label">Task</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="task-name" class="form-control">
                </div>
            </div>

            <!-- Add Task Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Add Task
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- TODO: Current Tasks -->
```

We want to be able to validate the data that user is saving in our database to make sure we maintain the integrity of our database. To do so we are going to add a way to display errors once a user has either made an error in creating the task or opur app has an error to display to the user

Create a foder withing `views` directory called `common` inside it add a file called `error.blade.php` and inside the file add the following code to receive the errors and list them to the user
```
@if (count($errors) > 0)
    <!-- Form Error List -->
    <div class="alert alert-danger">
        <strong>Whoops! Something went wrong!</strong>

        <br><br>

        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
```
in the file `tasks.blade.php` add the following line before the form that user will use to create new taks
`@include('common.errors')` this will include the file we just created to our task.blade.php file

To vallidate the data that the user has posted we will first go and create the post method for the tasks within the `Web.php` file within the `routes` directory
Your post method should look like below
```
Route::post('/task', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);

    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    // Create The Task...
});
```
Do not forget to add `use Illuminate\Http\Request;` to be able to use `Request` class within our `Web.php` file

## Saving data in the database

After we have validated out data that the user has created lets go ahead and save them in the database and redirect the user back to the task form with data already added in the database and displaying a list of tasks that exists in our database

In the Web.php file where we were validating user inputs, go ahead and add code to save the task to the database once the data has been validated. See below.
```
  $task = new Task;
  $task->name = $request->name;
  $task->save();

  return redirect('tasks');
```
To be able to display the data to the user after the user has created the data, go on and change the `Web.php` route to reurn the form so as to be able to return the data that has been stored in the databas as well
See below.
```
Route::get('tasks', function () {
    
    $tasks = Task::orderBy('created_at', 'asc')->get();
    return view('tasks', [ ‘tasks’ => $tasks ] );

});

```

Update the `tasks.blade.php` file to be able to display the list of tasks that have now returned by the route
Below the `div` with the form for user to create a new task add the following to be able to display the list of tasks

```
<!-- Current Tasks -->
    @if (count($tasks) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Current Tasks
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                        <th>Task</th>
                        <th>&nbsp;</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <!-- Task Name -->
                                <td class="table-text">
                                    <div>{{ $task->name }}</div>
                                </td>

                                <td>
                                    <!-- TODO: Delete Button -->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

```

## Deleting a task from the databse

in your file `tasks.blad.php` we had left a `TODO` to come back at to implement deleting the task, locate it and add the following implementation to give user a button to use to delete the task
```
<!-- Delete Button -->
    <td>
        <form action="{{ url('task/'.$task->id) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}

            <button type="submit" class="btn btn-danger">
                <i class="fa fa-trash"></i> Delete
            </button>
        </form>
    </td>
```
After head over to your Web.php file and add a route implementation to delete the task. notice in the form above for deleting the taks we have an `action` with `{{ url('task/'.$task->id) }}` this will tell Laravel to go to route `task/{task_id}` to be able to delete that particular task. Lets go ahead and create that implememtation.
See below
```
Route::delete('/task/{task}', function (Task $task) {
    $task->delete();

    return redirect('tasks');
});
```
## Adding a controller to our project

Adding controller to out project will incorporate changes in multiple files so as to connect the controller to the entire flow of information within the project, remember `MVC`? The `View` sends an input to the `controller`, then `controller` queries data based on the users input from the `view` in the `Model` then `Model` returns the querried data back to `controkker` and `controller` sends that data back to the `view` and the `view` presents it to the user who has requested it.

So go ahead and use `artisan` to create a new controller which we will call ~Task Controller~ using the command below

```
php artisan make:controller TaskController
```

