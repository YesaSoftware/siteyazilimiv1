@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>İzinler</h1>
        <a href="{{ route('permissions.create') }}" class="btn btn-primary">Yeni İzin Oluştur</a>
        <table class="table">
            <thead>
            <tr>
                <th>İzin Adı</th>
                <th>İşlem</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($permissions as $permission)
                <tr>
                    <td>{{ $permission->name }}</td>
                    <td>
                        <a href="{{ route('permissions.edit', $permission) }}" class="btn btn-warning">Düzenle</a>
                        <form action="{{ route('permissions.destroy', $permission) }}" method="POST" style="display:inline;">
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
