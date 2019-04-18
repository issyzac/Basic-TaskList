@extends('layouts.app')

@section('content')

    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')

                <!-- New Task Form -->
        <form action="{{ url('tasks') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

                    <!-- Task Name -->
            <div class="form-group">
                <label for="task" class="col-sm-3 control-label">Task</label>

                <div class="col-sm-6">
                    <input type="text" name="title" id="task-name" class="form-control">
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
    @if (count($kaziArray) > 0)
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
                    @foreach ($kaziArray as $kazi )
                        <tr>
                            <!-- Task Name -->
                            <td class="table-text">
                                <div>{{ $kazi->title }}</div>
                            </td>

                            <td>
                                <!-- TODO: Delete Button -->
                                <form action="{{ url('task/'.$task->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif


@endsection