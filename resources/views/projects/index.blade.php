@extends('adminlte::page')

@section('title')
    Projects
@endsection

@section('content')
    <div class="container">
        <ul class="fa-ul">
            @foreach ($projects as $project)
                <li><span class="fa-li"><i class="fa fa-angle-right"></i></span><a href="/projects/{{ $project->id }}">{{ $project->title }}</a></li>
            @endforeach
        </ul>
    </div>
@endsection
