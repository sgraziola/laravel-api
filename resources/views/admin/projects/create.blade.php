@extends('layouts.app')

@section('content')

<div class="container mb-5">
    <h1 class="py-5"> Add Project </h1>
    @include('partials.error')

    <form action="{{route('admin.projects.store')}}" method="post" class="card p-3" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="project title" aria-describedby="titleHelper" value="{{old('title')}}">
            <small id="nameHelper" class="text-muted">Add the project name here</small>
        </div>
        <div class="mb-3">
            <label for="thumb" class="form-label">Thumb</label>
            <input type="file" name="thumb" id="thumb" class="form-control @error('thumb') is-invalid @enderror" placeholder="project thumb" aria-describedby="thumbHelper">
            <small id="thumbHelper" class="text-muted">Add the project thumb here</small>
        </div>

        <div class="mb-3">
            <label for="type_id" class="form-label">Types</label>
            <select class="form-select form-select-lg @error('type_id') 'is-invalid' @enderror" name="type_id" id="type_id">
                <option selected>Select one</option>

                @foreach ($types as $type )
                <option value="{{$type->id}}" {{ old('type_id') ? 'selected' : '' }}>{{$type->name}}</option>
                @endforeach

            </select>
        </div>

        <div class="mb-3">
            <label for="language" class="form-label">Language</label>
            <input type="text" name="language" id="language" class="form-control @error('language') is-invalid @enderror" placeholder="project language" aria-describedby="languageHelper" value="{{old('language')}}">
            <small id="languageHelper" class="text-muted">Add the project language here</small>
        </div>

        <div class="mb-3">
            <label for="technologies" class="form-label">Technologies</label>
            <select multiple class="form-select form-select-lg @error('technologies') 'is-invalid' @enderror" name="technologies[]" id="technologies">
                <option value='' disabled>Select a technology</option>
        
    
                @forelse ($technologies as $technology )

                    @if($errors ->any())
                        <option value="{{$technology->id}}" {{ in_array($technology->id, old('technologies', [])) ? 'selected' : '' }}>{{$technology->name}}</option>
                    @else
                        <option value="{{$technology->id}}" {{ old('technologies') ? 'selected' : '' }}>{{$technology->name}}</option>
                    @endif
                
                @empty

                    <option value='' disabled>Sorry no technologies</option>
                    
                @endforelse
    
            </select>
        </div>
        @error('technologies')
        <div class="alert alert-danger" role="alert">
            {{$message}}
        </div>
        @enderror
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@endsection