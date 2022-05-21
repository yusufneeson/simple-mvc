<?php

namespace App\Controllers;

use App\Models\User;

class HomeController
{
    public function index()
    {
        $user = new User;
        $user = $user
            ->raw("SELECT * FROM user WHERE id=? AND role=?", [2, 'admin'])
            ->first();

        return view('user.index', compact('user'));
    }

    public function about()
    {
        echo "ABUT";
    }
}
