@extends('layouts.panel')
@section('title','Üye | Listeleme')
@section('datatable','true')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">


                <div class="card-body">
                    <x-data-table
                        :columnsText="['ID', 'Adı','E-Posta','Rol','Durum']"
                        :columns="['id', 'name','email','user_role','status']"
                        route="panel.users.list.data"
                        :options="[
                                    'order' => [[0, 'desc']], // Sıralama
                                    'paging' => true, // Sayfalama
                                    'searching' => true, // Arama
                        ]"
                        :column-buttons="[
                            [
                              'class' => ' btn-success',
                              'icon'=>'fa fa-pencil',
                              'route' => route('panel.users.edit', ':id'),
                              'title'=>'' ,
                              'tooltip'=>'Düzenle',
                              'permission'=>'users_edit',
                              'target'=>'_self'
                            ],

                            [
                              'class' => 'btn-info',
                              'icon'=>'fa fa-lock-open',
                              'route' => route('panel.users.edit', ':id') ,
                              'title'=> '',
                              'permission'=>'users_edit'
                              ,'target'=>'_self'
                             ],

                            [
                              'class' => 'btn-primary',
                              'icon'=>'fa fa-user-shield',
                              'function' => 'permissionListPopup',
                              'title'=>'',
                              'permission'=>'users_permission_edit'
                            ],

                            [
                              'class' => 'btn-danger',
                              'icon'=>'fa fa-trash',
                              'delete' => route('panel.users.destroy', ':id'),
                              'title' => '',
                              'permission' => 'users_delete'
                            ],
                        ]"
                    />
                </div>

            </div>
        </div>
    </div>

    <script>
        function permissionListPopup(id) {
            const route = "{{route('panel.users.permissions', [''])}}" + "/" + id;

            popup(route, 'Test', 800, 800)

        }
    </script>
@endsection
