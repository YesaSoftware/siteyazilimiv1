@extends('layouts.panel')

@section('title', 'Üye | Ekleme')
@section('datatable', 'true')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Yeni Üye Ekle</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('panel.users.store') }}" method="POST" onsubmit="return disableButton(this);"
                      autocomplete="off">
                    @csrf

                    <!-- Ad Girişi -->
                    <x-form-input name="name" label="Ad" type="text" value="{{ old('name') }}" required/>

                    <!-- E-posta Girişi -->
                    <x-form-input name="email" label="E-posta" type="email" value="{{ old('email') }}" required/>

                    <!-- Şifre Girişi -->
                    <x-form-input name="password" label="Şifre" type="password" required/>

                    <!-- Şifre Onayı Girişi -->
                    <x-form-input name="password_confirmation" label="Şifre Onayı" type="password" value="" required/>

                    <!-- Rol Seçimi -->
                    <div class="form-group mb-3">
                        <label for="role">Rol</label>
                        <select name="role" id="role" class="form-control">
                            @foreach($roles as $role)
                                @if(!($role->name == 'developer'))
                                    <option
                                        {{$role->name == 'member' ? 'selected' : ''}} value="{{ $role->id }}">{{ $role->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <!-- Formu Gönder Butonu -->
                    <x-submit-button button-text="Üye Ekle" button-id="submitButtonId"/>

                </form>
            </div>
        </div>
    </div>
@endsection
