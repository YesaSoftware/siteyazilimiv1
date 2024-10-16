@extends('layouts.panel')
@section('title','Log | Listeleme')
@section('datatable','true')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">


                <div class="card-body">
                    <x-data-table
                        :columnsText="['ID','Üye', 'Method','Modül','İşlem','Tarih']"
                        :columns="['id' ,'user_id' , 'type','module_name', 'action','created_at']"
                        route="panel.logs.list.data"
                        :options="[
                                    'order' => [[0, 'desc']], // Sıralama
                                    'paging' => true, // Sayfalama
                                    'searching' => true, // Arama
                        ]"
                        :column-buttons="[
                            [
                              'class' => 'btn-primary',
                              'icon'=>'fa fa-info',
                              'function' => 'showPopup',
                              'title'=>'',
                              'permission'=>'logs_list'
                            ],

                        ]"
                    />
                </div>

            </div>
        </div>
    </div>

    <script>
        function showPopup(id) {
            const route = "{{route('panel.logs.show', [''])}}" + "/" + id;

            popup(route, 'Test', 800, 800)

        }
    </script>
@endsection
