@extends('adminlte::page')

@section('content')
    <div class="container">
        <p><h1 class="title">{{ $project->title }}</h1></p>
        <p>{{ $project->description }}</p>
        <a href="/projects/{{ $project->id }}/edit">Edit</a>
    </div>
@endsection