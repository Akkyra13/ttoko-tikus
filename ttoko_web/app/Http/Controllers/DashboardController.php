<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //currently not in use /!\
    public function index(Request $req)
    {
        // reads the tab query parameter named 'page'; defaults to dashboard
        $page = $req->query('page', 'dashboard');

        //array of allowd pages
        //'query param' => 'blade view file'
        $views = [
            'users' => 'role',
            'roles' => 'role',
        ];

        //default
        $output = $views[$page] ?? 'dashboard';

        // output
        return view($output, [
            'currentPage' => $page, //access passed to the view with $currentPage
        ]);
    }
}
