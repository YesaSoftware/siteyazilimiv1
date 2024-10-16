<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscordMember extends Model
{
    protected $table = 'discord_members';
    protected $fillable = [
        'discord_id', 'username', 'discriminator', 'roles',
    ];

    protected $casts = [
        'roles' => 'array', // Rolleri array olarak sakla ve array olarak al
    ];
}
