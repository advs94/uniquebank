@extends('adminlte::page')

@section('name')
    Projects Creation Area    
@endsection

@section('content')
    <div class="container">
        <form class="form-horizontal" method="post" action="/projects">
            {{ csrf_field() }}
            
            <div class="form-group">
                <label for="project-title" class="col-sm-2 control-label">Project Title</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="title" placeholder="Project Title">
                </div>
            </div>
            <div class="form-group">
                <label for="project-description" class="col-sm-2 control-label">Project Description</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="description" placeholder="Project Description"></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Create Project</button>
                </div>
            </div>
        </form>
    </div>
@endsection
