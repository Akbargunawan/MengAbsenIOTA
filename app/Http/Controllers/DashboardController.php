<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total userr
        $totalUsers = User::count();

        // Bisa juga hitung total cuti, surat tugas, dsb jika ada model masing-masing
        // $totalCuti = Cuti::count();

        return view('layout.dashboard', compact('totalUsers'));
    }
}
