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
        <a href="{{ route('tables', ['page' => 'barang']) }}"
            class="nav-link {{ (request()->query('page') === 'barang' || request()->query('page') === 'barang-tersedia')  && request()->is('tables') ? 'active' : '' }}">
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
        {{ $slot }}
    </main>

</body>
</html>
