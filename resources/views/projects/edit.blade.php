@extends('adminlte::page')

@section('content')
    <div class="container">
        <p><h1 class="title" style="margin-left:1%;">Edit Project</h1></p>

        <form class="form-horizontal" method="post" action="/projects/{{ $project->id }}">
            @method('PATCH')
            @csrf
                
            <div class="form-group">
                <label for="project-title" class="col-sm-2 control-label"><h5>Project Title</h5></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="title" value="{{ $project->title }}">
                </div>
            </div>
            <div class="form-group">
                <label for="project-description" class="col-sm-2 control-label" style="max-width:none"><h5>Project Description</h5></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="description" value="{{ $project->description }}"></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default" style="background-color: rgb(0, 100, 255);">Update</button>
                </div>
            </div>
        </form>
        <form method="post" action="/projects/{{ $project->id }}">
            @method('DELETE')
            @csrf

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Delete</button>
                </div>
            </div>
        </form>
    </div>    
@endsection