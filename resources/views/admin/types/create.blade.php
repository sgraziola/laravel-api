@extends('layouts.app')

@section('content')

<div class="container mb-5">
    <h1 class="py-5"> Add Type </h1>
    @include('partials.error')

    <form action="{{route('admin.types.store')}}" method="post" class="card p-3" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="type name" aria-describedby="nameHelper" value="{{old('name')}}">
            <small id="nameHelper" class="text-muted">Add the type name here</small>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@endsection