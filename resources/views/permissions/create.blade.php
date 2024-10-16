@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Yeni İzin Oluştur</h1>
        <form action="{{ route('permissions.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">İzin Slug</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="name">İzin Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Oluştur</button>
        </form>
    </div>
@endsection
