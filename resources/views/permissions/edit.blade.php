@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>İzni Düzenle: {{ $permission->name }}</h1>
        <form action="{{ route('permissions.update', $permission) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">İzin Adı</label>
                <input type="text" name="name" class="form-control" value="{{ $permission->name }}" required>
            </div>
            <button type="submit" class="btn btn-success">Güncelle</button>
        </form>
    </div>
@endsection
