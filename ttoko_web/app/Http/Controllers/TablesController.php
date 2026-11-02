<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class TablesController extends Controller
{
    //
    public function index(Request $req)
    {
        // reads the tab query parameter named 'page'; defaults to dashboard
        $page = $req->query('page', 'dashboard');

        //array of allowd pages
        //'query param' => 'blade view file'
        // $views = [
        //     'user' => 'tables.user',
        //     'role' => 'tables.role',
        // ];
        //
        // $data = [
        //     'user' => User::getUsers()
        // ];

        switch ($page) {
            case 'role':
                $data = Role::all(); // Or your custom model method
                $view = 'tables.roles';
                break;

            case 'user':
            default:
                $user = new User;
                $data = $user->getUsers();
                $view = 'tables.user';
                $page = 'users'; // Ensure fallback sets the active page state
                break;
        }

        //default
        // $output = $views[$page] ?? 'dashboard';

        // output
        return view($view, [
            'data' => $data, //access passed to the view with $currentPage
            'currentPage' => $page, //access passed to the view with $currentPage
        ]);
    }
}
