<?php

use App\Models\SystemSettingsCategory;
use App\Models\SystemSettings;

function getSystemSettingsCategory()
{
    return SystemSettingsCategory::orderBy('sequence', 'asc')->get();
}

function getSystemSettingsCategoryById($id)
{
    return SystemSettingsCategory::find($id);
}

// kategoriye göre ayarları getir

function getSystemSettingsByCategory($category_id)
{
    return SystemSettings::where('system_settings_category_id', $category_id)->orderBy('sequence', 'asc')->get();
}
