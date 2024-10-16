
# Laravel DataTable and Menu Component Documentation

## Overview

This documentation covers the implementation of a reusable DataTable component and a dynamic menu component in Laravel using Blade templates. The DataTable is powered by Yajra DataTables and is designed for easy integration across different modules. The menu component provides dropdown functionality for navigation.

---

## DataTable Component

### Blade Template: `resources/views/components/data-table.blade.php`

This component creates a DataTable that supports server-side processing, action buttons, and customizable columns.

```blade
<table id="dataTable" class="table table-striped table-bordered">
    <thead>
    <tr>
        @foreach ($columns as $column)
            <th>{{ $column }}</th>
        @endforeach
        @if (!empty($columnButtons))
            <th class="actions-header">İşlemler</th> <!-- Butonlar için başlık -->
        @endif
    </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $(document).ready(function() {
            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route($route) !!}',
                columns: [
                    @foreach ($columns as $column)
                        { data: '{{ $column }}', name: '{{ $column }}' },
                    @endforeach
                    @if (!empty($columnButtons))
                        { data: null, render: function(data, type, row) {
                            return @json($columnButtons).map(button => {
                                let url = button.url ? button.url.replace(':id', row.id) : '#';
                                if (button.function) {
                                    return `<button class="${button.class}" onclick="${button.function}(${row.id})">${button.title}</button>`;
                                } else {
                                    return `<a href="${url}" class="${button.class}">${button.title}</a>`;
                                }
                            }).join(' ');
                        }},
                    @endif
                ],
                columnDefs: [
                    @if (!empty($columnButtons))
                        {
                            targets: -1, // Aksiyon butonları için son sütun
                            orderable: false // Sıralamayı devre dışı bırak
                        },
                    @endif
                ],
                @if (!empty($options))
                    @foreach ($options as $key => $value)
                        {{ $key }}: {!! json_encode($value) !!},
                    @endforeach
                @endif
            });
        });
    });
</script>

<style>
    .actions-header {
        width: 15%; /* Bu alanda istediğin genişliği ayarlayabilirsin */
    }
</style>
```

### Parameters

- **$columns**: DataTable'da gösterilecek sütun adları.
- **$route**: AJAX isteği için kullanılacak route ismi.
- **$options**: DataTable ayarları (örneğin, sıralama, sayfalama).
- **$columnButtons**: Aksiyon butonları bilgileri, class, URL ve buton başlıkları içerir.

### Example Usage

```blade
<x-data-table
    :data="$data"
    :columns="['id', 'name']"
    route="panel.roles.list.data"
    :options="[
        'order' => [[0, 'asc']], // Sıralama
        'paging' => true, // Sayfalama
        'searching' => true, // Arama
    ]"
    :columnButtons="[
        ['class' => 'btn btn-primary', 'title' => 'Düzenle', 'url' => route('panel.roles.edit', ':id')],
        ['class' => 'btn btn-danger', 'title' => 'Sil', 'function' => 'deleteRole']
    ]"
/>
```

---

## Dynamic Menu Component

### Blade Template: `resources/views/components/menu.blade.php`

This component creates a dynamic menu with dropdown capabilities.

```blade
<li>
    @if(isset($items) && count($items) > 0)
        <a href="#{{ $id }}" data-bs-toggle="collapse">
            <i data-feather="{{ $icon }}"></i>
            <span> {{ $title }} </span>
            <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="{{ $id }}">
            <ul class="nav-second-level">
                @foreach ($items as $item)
                    <li>
                        <a href="{{ $item['link'] }}" class="tp-link">{{ $item['name'] }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    @else
        <a href="{{ $link }}">
            <i data-feather="{{ $icon }}"></i>
            <span> {{ $title }} </span>
        </a>
    @endif
</li>
```

### Parameters

- **$items**: Menüdeki alt öğeleri içeren dizi.
- **$id**: Dropdown menünün benzersiz kimliği.
- **$icon**: Menü simgesi.
- **$title**: Menü başlığı.
- **$link**: Tekli öğe için kullanılan URL.

### Example Usage

```blade
<x-menu
    :items="[
        ['link' => route('panel.roles.index'), 'name' => 'Roller'],
        ['link' => route('panel.users.index'), 'name' => 'Kullanıcılar']
    ]"
    id="menu1"
    icon="home"
    title="Ana Menü"
/>
```

---

## Conclusion

Bu belgede, Laravel uygulamanızda yeniden kullanılabilir DataTable ve dinamik menü bileşenlerini nasıl oluşturabileceğiniz ve kullanabileceğiniz anlatılmıştır. Her iki bileşen de projelerinizdeki modüller arasında kolaylıkla entegre edilebilir.
