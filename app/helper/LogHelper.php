<?php



function logHelper($user_id, $type, $module_name, $action, $data)
{
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $ip_info = file_get_contents("http://ip-api.com/json/{$ip_address}");


    $log = new \App\Models\Log();
    $log->user_id = $user_id;
    $log->type = $type;
    $log->module_name = $module_name;
    $log->action = $action;
    $log->data = json_encode($data);
    $log->ip_address = $ip_address;
    $log->ip_address_info = $ip_info;
    $log->save();
}

function logTypeButton($type)
{
   //enum('insert', 'update', 'delete')

    $color = 'primary';
    $title = 'Bilinmeyen';

    if ($type == 'insert') {
        $color = 'success';
        $title = 'Ekleme';

    } elseif ($type == 'update') {
        $color = 'warning';
        $title = 'Güncelleme';
    } elseif ($type == 'delete') {
        $color = 'danger';
        $title = 'Silme';
    }
    return '<span class="badge text-bg-' . $color . '">' . $title . '</span>';
}
