@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Rolü Düzenle: {{ $role->name }}</h1>
        <form action="{{ route('roles.update', $role) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Rol Adı</label>
                <input type="text" name="name" class="form-control" value="{{ $role->name }}" required>
            </div>
            <div class="form-group">
                <label for="permissions">İzinler</label>
                <select name="permissions[]" multiple class="form-control">
                    @foreach ($permissions as $permission)
                        <option value="{{ $permission->name }}" {{ in_array($permission->id, $rolePermissions) ? 'selected' : '' }}>
                            {{ $permission->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success">Güncelle</button>
        </form>
    </div>
@endsection
