<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Database Dashboard Website' }}</title>
    <style>
        nav { background: #333; padding: 1rem; }
        nav a { color: white; margin-right: 15px; text-decoration: none; }
        nav a.active { font-weight: bold; color: #4aa3df; }
        main { padding: 2rem; }
        body { font-family: system-ui, -apple-system, sans-serif; margin: 2rem; background: #f8fafc; }
        table { width: 100%; border-collapse: collapse; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        th, td { padding: 12px 16px; text-align: left; border-bottom: 1px solid #e2e8f0; }
        th { background-color: #f1f5f9; font-weight: 600; color: #334155; }
        tr:hover { background-color: #f8fafc; }
        .no-data { text-align: center; color: #64748b; font-style: italic; }
    </style>
</head>
<body>

    <!-- Persistent Navigation Bar -->
    <nav>
        <a href="{{ route('dashboard') }}"
            class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            Dashboard
        </a>
        <a href="{{ route('tables', ['page' => 'user']) }}"
            class="nav-link {{ ( request()->query('page') === 'user' || request()->query('page') === 'user-kasir' || request()->query('page') === 'user-inventaris' || request()->query('page') === 'user-manajer' ) && request()->is('tables') ? 'active' : '' }}">
            User
        </a>
        <a href="{{ route('tables', ['page' => 'role']) }}"
            class="nav-link {{ request()->query('page') === 'role' && request()->is('tables') ? 'active' : '' }}">
            Roles
        </a>
        <a href="{{ route('tables', ['page' => 'vendor']) }}"
            class="nav-link {{ ( request()->query('page') === 'vendor' || request()->query('page') === 'vendor-aktif' ) && request()->is('tables') ? 'active' : '' }}">
            Vendors
        </a>
        <a href="{{ route('barang.index') }}"
            class="nav-link {{ request()->is('barang*') ? 'active' : '' }}">
            Inventory
        </a>
        <a href="{{ route('tables', ['page' => 'margin']) }}"
            class="nav-link {{ request()->query('page') === 'margin' && request()->is('tables') ? 'active' : '' }}">
            Margins
        </a>
        <a href="{{ route('tables', ['page' => 'unit']) }}"
            class="nav-link {{ request()->query('page') === 'unit' && request()->is('tables') ? 'active' : '' }}">
            Unit
        </a>
    </nav>

    <!-- Page Content Slot -->
    <main>
        @yield('content')
    </main>

</body>
</html>
