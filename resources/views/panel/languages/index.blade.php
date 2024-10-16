@extends('layouts.panel')
@section('title','Ülke | Listeleme')
@section('datatable','true')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">


                <div class="card-body">
                    <x-data-table
                        :columnsText="['ID','Dil Kodu','Dil Adı','Dil İkonu','Dil Sırası','Dil Durumu']"
                        :columns="['id','code','name','icon','sequence','status']"
                        route="panel.languages.list.data"
                        :options="[
                                    'order' => [[0, 'desc']], // Sıralama
                                    'paging' => true, // Sayfalama
                                    'searching' => true, // Arama
                        ]"

                    />
                </div>

            </div>
        </div>
    </div>

    
@endsection
