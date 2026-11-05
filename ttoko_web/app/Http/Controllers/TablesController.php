<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Vendor;
use App\Models\Barang;
use App\Models\Margin;
use App\Models\Unit;

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
                $role = new Role;
                $data = $role->getRoles();
                $view = 'tables.role';
                $page = 'roles';
                break;

            case 'vendor':
                $role = new Vendor;
                $data = $role->getVendors();
                $view = 'tables.vendor';
                $page = 'vendors';
                break;

            case 'vendor-aktif':
                $role = new Vendor;
                $data = $role->getVendorsActive();
                $view = 'tables.vendor';
                $page = 'vendors';
                break;

            case 'barang':
                $role = new Barang;
                $data = $role->getItems();
                $view = 'tables.barang';
                $page = 'items';
                break;

            case 'barang-tersedia':
                $role = new Barang;
                $data = $role->getItemsAvail();
                $view = 'tables.barang';
                $page = 'items';
                break;

            case 'margin':
                $role = new Margin;
                $data = $role->getMargins();
                $view = 'tables.margin';
                $page = 'margins';
                break;

            case 'unit':
                $role = new Unit;
                $data = $role->getUnits();
                $view = 'tables.unit';
                $page = 'units';
                break;

            case 'user':
                $user = new User;
                $data = $user->getUsers();
                $view = 'tables.user';
                $page = 'users'; // ensure fallback sets the active page state
                break;

            case 'user-kasir':
                $user = new User;
                $data = $user->getUsersCashier();
                $view = 'tables.user';
                $page = 'users'; // ensure fallback sets the active page state
                break;

            case 'user-inventaris':
                $user = new User;
                $data = $user->getUsersInventory();
                $view = 'tables.user';
                $page = 'users'; // ensure fallback sets the active page state
                break;

            case 'user-manajer':
                $user = new User;
                $data = $user->getUsersManager();
                $view = 'tables.user';
                $page = 'users'; // ensure fallback sets the active page state
                break;

            default:
                $view = '404';
                 $data = '';
                break;
        }

        return view($view, [
            'data' => $data, //data values passed to the view with $currentPage
            'currentPage' => $page, //access passed to the view with $currentPage
        ]);
    }
}
