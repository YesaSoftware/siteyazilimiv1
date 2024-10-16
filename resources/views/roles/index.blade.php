@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Roller</h1>
        <a href="{{ route('roles.create') }}" class="btn btn-primary">Yeni Rol Oluştur</a>
        <table class="table">
            <thead>
            <tr>
                <th>Rol Adı</th>
                <th>İşlem</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->name }}</td>
                    <td>
                        <a href="{{ route('roles.edit', $role) }}" class="btn btn-warning">Düzenle</a>
                        <form action="{{ route('roles.destroy', $role) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Sil</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
