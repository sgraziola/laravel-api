@extends('layouts.app')

@section('content')

<div class="container py-5">
    <div class="d-flex gap-4">

        <div class="details">
            <h2>{{$type->name}}</h2>

            <div class="projects">
                <strong>Projects:</strong>

                <ul>

                    @forelse($projects as $project)
                    <li> {{$project->title}}</li>


                    @empty

                    <li> Sorry no projects to show</li>
                    @endforelse

                </ul>
            </div>


        </div>
    </div>
</div>


@endsection