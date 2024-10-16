<?php

use App\Models\User;

function dashboardHelperTotalUsers()
{
    return User::count();
}
