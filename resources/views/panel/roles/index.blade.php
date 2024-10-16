@extends('layouts.panel')
@section('title','Rol | Listeleme')
@section('datatable','true')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">


                <div class="card-body">
                    <x-data-table
                        :columnsText="['#', 'Adı']"
                        :columns="['id', 'name']"
                        route="panel.roles.list.data"
                        :options="[
                                    'order' => [[0, 'false']], // Sıralama
                                    'paging' => true, // Sayfalama
                                    'searching' => true, // Arama
                        ]"

                        :column-buttons="[
                            [ 'class' => 'bg-success text-white',
                              'icon'=>'fa fa-user-shield',
                              'function' => 'permissionListPopup',
                              'title'=>'',
                              'permission'=>'rol_list'],
                        ]"

                    />

                </div>

            </div>
        </div>
    </div>

    <script>

        function permissionListPopup(id) {
            const route = "{{route('panel.roles.permission.list', [''])}}" + "/" + id;

            popup(route, 'Test', 800, 800)
        }

    </script>
@endsection
