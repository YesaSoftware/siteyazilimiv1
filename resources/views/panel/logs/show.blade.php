@extends('layouts.modal_panel')

@section('title', $log->id . ' - Log Detay')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">@yield('title')</h1>

        <div class="card">

            <div class="card-body">
                <x-form-input name="id" label="ID" type="text" value="{{$log->id}}" readonly="true"  />
                <x-form-input name="user_id" label="Üye" type="text" value="{{$log->user->name}}" readonly="true"  />
                <x-form-input name="type" label="Method" type="text" value="{{$log->type}}" readonly="true"  />
                <x-form-input name="module_name" label="Modül" type="text" value="{{$log->module_name}}" readonly="true"  />
                <x-form-input name="action" label="İşlem" type="text" value="{{$log->action}}" readonly="true"  />
                <x-form-input name="created_at" label="Tarih" type="text" value="{{$log->created_at}}" readonly="true"  />

                <p>Detay</p>

                <textarea class="form-control" rows="5" readonly>{{$log->data}}</textarea>

                <br>
                <p>İp Adres Detay</p>
                <textarea class="form-control" rows="5" readonly>{{$log->ip_address_info}}</textarea>

            </div>
        </div>

    </div>
@endsection
