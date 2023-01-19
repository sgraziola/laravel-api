@extends('layouts.app')

@section('content')

<div class="container mb-5">
    <h1 class="py-5"> Edit Type </h1>
    @include('partials.error')

    <form action="{{route('admin.types.update', $type->slug)}}" method="post" class="card p-3" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="type name" aria-describedby="nameHelper" value="{{$type->name}}">
            <small id="nameHelper" class="text-muted">Add the type name here</small>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@endsection