@extends('layouts.modal_panel')

@section('title', $user->name . ' - Üyesi İzinleri')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">@yield('title')</h1>

        <h4 class="mb-3">Rol</h4>
        <ul class="list-group mb-4">
            @foreach ($user->getRoleNames() as $role)
                <li class="list-group-item">{{ $role }}</li>
            @endforeach
        </ul>

        <h4 class="mb-3">İzin Grupları:</h4>
        <form action="{{ route('panel.users.permissions.update', $user->id) }}" method="POST">
            @csrf

            @foreach ($permissionGroups as $group)
                <div class="card mb-3 border-primary">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">{{ $group->title }}</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($group->permissions as $permission)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <input type="checkbox" name="permissions[]" id="permission_{{$permission->id}}" value="{{ $permission->id }}"
                                            {{ $userPermissions->contains($permission->id) || $userRolePermissions->contains($permission->id) ? 'checked' : '' }}>
                                        <label for="{{ $permission->id }}" class="ms-2">{{ $permission->title ??  $permission->name }}</label>
                                        @if ($userRolePermissions->contains($permission->id))
                                            <span class="badge bg-danger ms-2">Rolün İzni</span>
                                            <script>
                                                document.addEventListener('DOMContentLoaded', function () {
                                                    $('#permission_{{$permission->id}}').prop('disabled', true);
                                                });
                                            </script>
                                        @endif
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            @endforeach

            <!-- Gruplandırılmamış izinler -->
            <div class="card mb-3 border-warning">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0">Gruplandırılmamış İzinler</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($ungroupedPermissions as $permission)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                        {{ $userPermissions->contains($permission->id) || $userRolePermissions->contains($permission->id) ? 'checked' : '' }}>
                                    <label for="{{ $permission->id }}" class="ms-2">{{ $permission->name }}</label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <x-submit-button button-text="Düzenlemeyi Kaydet" button-id="submitButtonId" />
        </form>
    </div>
@endsection
