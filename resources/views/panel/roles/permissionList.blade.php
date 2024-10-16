@extends(isMobile() ? 'layouts.panel' : 'layouts.modal_panel')

@section('title', $role->name . ' İzinleri')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">@yield('title')</h1>

        <h4>Rol İzinleri:</h4>
        <ul class="list-group mb-4">
            @foreach ($role->permissions as $permission)
                <li class="list-group-item">{{ $permission->name }}</li>
            @endforeach
        </ul>

        <h4>Üyenin İzinleri</h4>
        <ul class="list-group mb-4">
            @foreach (auth()->user()->permissions as $permission)
                <li class="list-group
                -item">{{ $permission->name }}</li>
            @endforeach
        </ul>


        <h4>İzin Grupları:</h4>
        <form id="permissionsForm" action="{{ route('panel.roles.permission.update', $role->id) }}" method="POST" onsubmit="return disableButton(this);">
            @csrf

            @foreach ($permissionGroups as $group)
                <div class="card mb-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">{{ $group->title }}</h4>
                        @php
                            $selectedCount = $group->permissions->filter(function ($permission) use ($role) {
                                return $role->permissions->contains($permission->id);
                            })->count();
                        @endphp
                        <span class="badge bg-secondary">{{ $group->permissions->count() }} İzin </span>
                        <span class="badge bg-info">{{ $selectedCount }} Seçili</span>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($group->permissions as $permission)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <input type="checkbox" class="form-check-input" name="permissions[]" value="{{ $permission->id }}"
                                            {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                                        <label class="form-check-label ms-2">{{ $permission->title }} - {{$permission->name}}</label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach

            <!-- Gruplandırılmamış izinler -->
            <div class="card mb-3">
                <div class="card-header">
                    <h4>Gruplandırılmamış İzinler</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($ungroupedPermissions as $permission)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <input type="checkbox" class="form-check-input" name="permissions[]" value="{{ $permission->id }}"
                                        {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                                    <label class="form-check-label ms-2">{{ $permission->name }}</label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <x-submit-button button-text="Düzenlemeyi Kaydet" button-id="submitButtonId" />

        </form>
    </div>

    <script>
        $(document).ready(function() {
            // Checkbox durumunu kontrol et ve etiketin üstüne çizgi koy
            $('input[type="checkbox"]').change(function() {
                var $input = $(this);
                var $label = $input.next();
                if ($input.is(':checked')) {
                    $label.addClass('text-decoration-line-through');
                } else {
                    $label.removeClass('text-decoration-line-through');
                }
            });
        });

        function disableButton(form) {
            const button = document.getElementById('submitButton');
            button.disabled = true;
            button.style.display = 'none';
            const loadingMessage = document.getElementById('loadingMessage');
            loadingMessage.style.display = 'inline';

            return true;
        }
    </script>

@endsection
