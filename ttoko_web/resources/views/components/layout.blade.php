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

        /* Forms (create / edit pages) */
        form { max-width: 480px; margin-top: 1rem; padding: 1.5rem; background: #fff; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        form br { display: none; }
        form label { display: block; margin: 1rem 0 0.35rem; font-weight: 600; color: #334155; font-size: 0.9rem; }
        form label:first-of-type { margin-top: 0; }
        form input, form select { display: block; width: 100%; box-sizing: border-box; padding: 0.55rem 0.75rem; border: 1px solid #cbd5e1; border-radius: 6px; background: #fff; font: inherit; color: #0f172a; }
        form input:focus, form select:focus { outline: none; border-color: #4aa3df; box-shadow: 0 0 0 3px rgba(74,163,223,0.25); }
        form button { margin-top: 1.5rem; padding: 0.6rem 1.4rem; border: none; border-radius: 6px; background: #4aa3df; color: #fff; font: inherit; font-weight: 600; cursor: pointer; }
        form button:hover { background: #2f8bc9; }

        /* Small inline forms (e.g. delete button in a table row): no card, red button */
        form.inline { display: inline; max-width: none; margin: 0; padding: 0; background: none; border-radius: 0; box-shadow: none; }
        form.inline button { margin: 0.25rem 0.25rem 0.25rem 0; padding: 0.4rem 0.9rem; font-size: 0.9rem; background: #e5484d; border: 1px solid #e5484d; }
        form.inline button:hover { background: #c9353a; border-color: #c9353a; }

        /* Links inside page content look like buttons (navbar is outside <main>, so it's not affected) */
        main a { display: inline-block; margin: 0.25rem 0.25rem 0.25rem 0; padding: 0.4rem 0.9rem; border: 1px solid #4aa3df; border-radius: 6px; background: #fff; color: #2f8bc9; font-size: 0.9rem; font-weight: 600; text-decoration: none; }
        main a:hover { background: #4aa3df; color: #fff; }
    </style>
</head>
<body>

    <!-- Persistent Navigation Bar -->
    <nav>
        <a href="{{ route('dashboard') }}"
            class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            Dashboard
        </a>
        <a href="{{ route('user.index') }}"
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
