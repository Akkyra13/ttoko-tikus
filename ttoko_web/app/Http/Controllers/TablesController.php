<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TablesController extends Controller
{
    //
    public function index(Request $req)
    {
        // reads the tab query parameter named 'page'; defaults to dashboard
        $page = $req->query('page', 'dashboard');

        //array of allowd pages
        //'query param' => 'blade view file'
        $views = [
            'user' => 'tables.user',
            'role' => 'tables.role',
        ];

        //default
        $output = $views[$page] ?? 'dashboard';

        // output
        return view($output, [
            'currentPage' => $page, //access passed to the view with $currentPage
        ]);
    }
}
