@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Yeni Rol Oluştur</h1>
        <form action="{{ route('roles.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Rol Adı</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="permissions">İzinler</label>
                <select name="permissions[]" multiple class="form-control">
                    @foreach ($permissions as $permission)
                        <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success">Oluştur</button>
        </form>
    </div>
@endsection
