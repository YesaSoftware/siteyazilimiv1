<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SystemSettings as SystemSettings;
use App\Models\SystemSettingsCategory;

class SystemSettingsController extends Controller
{
    public function list()
    {
        return view('panel.system_settings.list');
    }

    public function update(Request $request, $categoryId)
    {
        $settingsData = $request->input('settings');


        if (!$settingsData) {
            return redirect()->back()->with('error', 'Ayarlar bulunamadı.');
        }
        if (!is_array($settingsData)) {
            return redirect()->back()->with('error', 'Ayarlar doğru formatta değil.');
        }

        $category = SystemSettingsCategory::find($categoryId);

        $categoryName = $category->name ?? 'Ayarlar';


        foreach ($settingsData as $settingId => $value) {
            $setting = SystemSettings::where('id', $settingId)->where('system_settings_category_id', $categoryId)->first();
            if ($setting) {
                if ($setting->type == 'toggle_switch') {
                    $value = $value == 1 ? 1 : 0; // Checkbox için değeri 0 ya da 1 yap
                }
                $setting->value = $value;
                $setting->save();
            }
        }


        logHelper(auth()->user()->id, 'update', 'Ayarlar güncellendi', $categoryName . ' kategorisindeki ayarlar güncellendi.', $settingsData);


        return redirect()->back()->with('success', $categoryName .' başarıyla güncellendi.');
    }

    public function store(Request $request)
    {

        //title , kategori , type , value , sequence

        $request->validate([
            'title' => 'required',
            'type' => 'required',
            'category' => 'required',
        ]);

        $category = SystemSettingsCategory::find($request->category);
        if (!$category) {
            return redirect()->back()->with('error', 'Kategori bulunamadı.');
        }

        $settingName = cevir2($request->title);

        $check = SystemSettings::where('name', $settingName)->first();

        if ($check) {
            return redirect()->back()->with('error', 'Ayar zaten mevcut.');
        }

        $setting = new SystemSettings();
        $setting->name = $settingName;
        $setting->title = $request->title;
        $setting->type = $request->type;
        $setting->value = $request->value;
        $setting->sequence = $request->sequence ?? 0;
        $setting->readonly = $request->readonly ?? 0;
        $setting->system_settings_category_id = $request->category;
        $setting->save();


        logHelper(auth()->user()->id, 'insert', 'Ayarlar kategorisi eklendi', $category->name . ' kategorisi eklendi.', $category->toArray());

        return redirect()->back()->with('success', 'Kategori başarıyla eklendi.');
    }
}
