@extends('layouts.panel')

@section('title', 'Üye | Düzenleme - ' . $user->name . ' - ' . $user->id  . ' ID')
@section('datatable', 'true')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Üye Düzenleme: {{ $user->name }}</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('panel.users.update', $user->id) }}" method="POST" onsubmit="return disableButton(this);">
                    @csrf
                    @method('PUT')

                    <x-form-input name="name" label="Ad" type="text" value="{{ old('name', $user->name) }}" required />

                    <x-form-input name="email" label="E-posta" type="email" value="{{ old('email', $user->email) }}" required />


                    <div class="form-group mb-3"> <!-- mb-3 sınıfı ile alt boşluk ekleyelim -->
                        <label for="role">Rol</label>
                        <select name="role" id="role" class="form-control">

                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ $user->roles->first()->id === $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group mb-3"> <!-- mb-3 sınıfı ile alt boşluk ekleyelim -->
                        <label for="status">Durum</label>

                        <select name="status" id="status" class="form-control">
                            <option style="background-color: #0a3622" value="active" {{ $user->status === 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="inactive" {{ $user->status === 0 ? 'selected' : '' }}>Pasif</option>
                        </select>

                    </div>

                    <x-submit-button button-text="Düzenlemeyi Kaydet" button-id="submitButtonId" />

                </form>
            </div>
        </div>
    </div>
@endsection
