@extends('layouts.panel')
@section('title','Sistem Ayarları | Listeleme')
@section('datatable','true')
@section('content')


    <div class="modal fade" id="newSettingModal" tabindex="-1" aria-labelledby="newSettingModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('panel.system.settings.store') }}" method="POST" onsubmit="return disableButton(this);">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newSettingModalLabel">Yeni Ayar Ekle</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body
                    ">
                        @csrf
                        <div class="form-group
                        ">
                            <label for="newSettingTitle" class="col-form-label">Başlık:</label>
                            <input type="text" class="form-control" id="newSettingTitle" name="title" required>
                        </div>
                        <div class="form-group
                        ">
                            <label for="newSettingCategory" class="col-form-label">Kategori:</label>
                            <select class="form-select select2" id="newSettingCategory" name="category" required>
                                <option value="">Seçiniz</option>
                                @foreach(getSystemSettingsCategory() as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="form-group

                        ">
                            <label for="newSettingType" class="col-form-label">Tip:</label>
                            <select class="form-select" id="newSettingType" name="type" required>
                                <option value="">Seçiniz</option>
                                <option value="input">Input</option>
                                <option value="textarea">Textarea</option>
                                <option value="toggle_switch">Toggle Switch</option>
                            </select>
                        </div>
                        <div class="form-group

                        ">
                            <label for="newSettingValue" class="col-form-label">Değer:</label>
                            <input type="text" class="form-control" id="newSettingValue" name="value" required>

                        </div>

                        <div class="form-group

                        ">
                            <label for="newSettingReadonly" class="col-form-label">Readonly:</label>
                            <select class="form-select" id="newSettingReadonly" name="readonly" required>
                                <option value="">Seçiniz</option>
                                <option value="true">Evet</option>
                                <option value="false">Hayır</option>
                            </select>

                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn btn-primary">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                @foreach(getSystemSettingsCategory() as $category)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="s{{$category->id}}-tab" data-bs-toggle="tab"
                                data-bs-target="#s{{$category->id}}"
                                type="button" role="tab" aria-controls="s{{$category->id}}"
                                aria-selected="false">{{$category->name}}
                        </button>
                    </li>
                @endforeach
            </ul>
            <div class="tab-content" id="myTabContent">
                @foreach(getSystemSettingsCategory() as $category)
                    <div class="tab-pane fade" id="s{{$category->id}}" role="tabpanel" aria-labelledby="s{{$category->id}}-tab">
                        <form action="{{ route('panel.system.settings.update', $category->id) }}" method="POST" onsubmit="return disableButton(this);">

                            <div class="d-flex justify-content-end mt-3">

                                <button class="btn btn-primary" onclick="openModal('#newSettingModal')" type="button" >Yeni Ekle</button>

                            </div>

                            <br>
                            @csrf
                            @method('PUT')
                            @foreach(getSystemSettingsByCategory($category->id) as $setting)
                                @if($setting->type == 'input')
                                    <div class="form-group row mb-3">
                                        <label for="input{{$setting->id}}" class="col-sm-2 col-form-label">{{$setting->title}}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="input{{$setting->id}}"
                                                   name="settings[{{$setting->id}}]" value="{{$setting->value}}" @if($setting->readonly == 'true') readonly disabled @endif>
                                        </div>
                                    </div>
                                @elseif($setting->type == 'textarea')
                                    <div class="form-group row mb-3">
                                        <label for="textarea{{$setting->id}}" class="col-sm-2 col-form-label">{{$setting->title}}</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" id="textarea{{$setting->id}}" name="settings[{{$setting->id}}]" rows="3">{{$setting->value}}</textarea>
                                        </div>
                                    </div>
                                @elseif($setting->type == 'toggle_switch')
                                    <div class="form-group row mb-3" style="align-items: center">
                                        <label for="toggle{{$setting->id}}" class="col-sm-2 col-form-label">{{$setting->title}}</label>
                                        <div class="col-sm-10">
                                            <div class="form-check form-switch">
                                                <input type="hidden" name="settings[{{$setting->id}}]" value="0"> <!-- Checkbox işaretli değilse 0 gönderir -->
                                                <input class="form-check-input" type="checkbox" id="toggle{{$setting->id}}" name="settings[{{$setting->id}}]" value="1" @if($setting->value == 1) checked @endif>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            <br><br>
                            <x-submit-button button-text="Düzenlemeyi Kaydet - {{$category->name}}" button-id="submitButtonId{{$category->id}}" />
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
