@php use App\Models\Role; @endphp
<div class="card basic-data-table">

    <div class="card-body">
        <div id="table-header-buttons" class="table-header-buttons" style="margin-bottom: 25px;">
            <button class="btn btn-success " style="margin-right: 7px" onclick="refreshTableData('dataTable')"><i
                    class="fas fa-refresh"></i> {{__('general.verileri_yenile')}}
            </button>

        </div>

        <table id="dataTable" class="table table-striped table-bordered dt-responsive table-responsive nowrap">
            <thead>
            <tr>
                @php($sizedColumns = ['#','ID','Durum','Rol'])
                @foreach ($columnsText as $column)
                    <th class="{{ in_array($column, $sizedColumns) ? 'actions-header' : '' }}"
                        scope="col">{{ $column }}</th>
                @endforeach
                @if (!empty($columnButtons))
                    <th class="actions-header text-center" scope="col">İşlemler</th>
                @endif
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        $(document).ready(function () {

            const userPermissions = @json(auth()->user()->permissions->pluck('name')->toArray());
            const rolePermissions = @json(
                Role::whereIn('name', auth()->user()->getRoleNames())->with('permissions')->get()->pluck('permissions.*.name')->flatten()->toArray()
            );

            let table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                dom: 'lBfrtip', // Butonları aktif hale getirmek için 'Bfrtip' kullanılır
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                language: {
                    // url: '//cdn.datatables.net/plug-ins/2.1.8/i18n/tr.json',
                },
                ajax: '{!! route($route) !!}',
                columns: [
                        @foreach ($columns as $column)
                    {
                        data: '{{ $column }}', name: '{{ $column }}'
                    },
                        @endforeach
                        @if (!empty($columnButtons))
                    {
                        data: null, render: function (data, type, row) {
                            return `<div class="text-center">` + @json($columnButtons)
                        .
                            map(function (button) {
                                const permission = button.permission;
                                const hasRolePermission = permission && rolePermissions.includes(permission);
                                const hasUserPermission = permission && userPermissions.includes(permission);

                                let buttonHtml = '';
                                let iconHtml = button.icon ? `<i class="${button.icon}"></i> ` : '';

                                if (button.route) {
                                    const buttonUrl = button.route.replace(':id', data.id);
                                    buttonHtml = `<button class=" btn btn-sm ${button.class} " onclick="window.open('${buttonUrl}', '${button.target}')">${iconHtml}${button.title}</button>`;
                                } else if (button.function) {
                                    buttonHtml = `<button class=" btn btn-sm ${button.class} " onclick="${button.function}(${data.id})">${iconHtml}${button.title}</button>`;
                                } else if (button.delete) {
                                    const deleteUrl = button.delete.replace(':id', data.id);
                                    buttonHtml = `<button class=" btn btn-sm ${button.class} " onclick="deleteRow('${deleteUrl}')">${iconHtml}${button.title}</button>`;
                                }

                                if (permission) {
                                    if (hasRolePermission || hasUserPermission) {
                                        return buttonHtml;
                                    }
                                    return '';
                                }

                                return buttonHtml;
                            }).join(' | ') + `</div>`; // Centering the buttons
                        }
                    },
                    @endif
                ],
                columnDefs: [
                        @if (!empty($columnButtons))
                    {
                        targets: -1,
                        orderable: false,
                        searchable: false
                    },
                    @endif
                ],
                @if (!empty($options))
                    @foreach ($options as $key => $value)
                    {{ $key }}: {!! json_encode($value) !!},
                @endforeach
                @endif
            });
            table.buttons().container().appendTo('#table-header-buttons');

        });


    });

    function refreshTableData(tableId) {
        $('#' + tableId).DataTable().ajax.reload();
    }

    function deleteRow(deleteUrl) {
        Swal.fire({
            title: 'Emin misiniz?',
            text: "Bu kaydı silmek istediğinizden emin misiniz?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Evet, Sil!',
            cancelButtonText: 'İptal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: deleteUrl,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        $('#dataTable').DataTable().ajax.reload();
                        Swal.fire(
                            'Silindi!',
                            'Kayıt başarıyla silindi.',
                            'success'
                        )
                    },
                    error: function (error) {
                        console.error(error);
                        Swal.fire(
                            'Hata!',
                            error && error.responseJSON && error.responseJSON.message ? error.responseJSON.message : 'Bir hata oluştu!',
                            'error'
                        )
                    }
                });
            }
        })
    }
</script>

<style>
    .actions-header {
        width: 100px;
    }
</style>
