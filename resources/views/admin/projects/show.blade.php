@extends('layouts.app')

@section('content')

<div class="container py-5">
    <div class="d-flex gap-4">
        @if ($project->thumb)
        <img class="img-fluid" src="{{asset('storage/' . $project->thumb)}}" alt="{{$project->title}}">
        @else
        <div class="placeholder-glow p-5 placeholder-md bg-primary">Placeholder</div>
        @endif
        <div class="details">
            <h2>{{$project->title}}</h2>

            <div class="type">
                <strong>Type:</strong>
                {{ $project->type ? $project->type->name : 'No type'}}
            </div>

            <div class="language">
                Linguaggio usato: {{$project->language}}
            </div>

            <div class="technologies">
                <strong>Technologies:</strong>
                @if(count($project->technologies) > 0)
                
                @foreach ($project->technologies as $technology )
                
                <span> #{{$technology->name}}</span>
                @endforeach
            
                @else
                <span> No technology</span>
                @endif
            </div>

        </div>
    </div>
</div>


@endsection