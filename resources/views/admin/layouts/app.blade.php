<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin AGEPIF')</title>

    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap" rel="stylesheet">

    @stack('styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-user"></i>
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="fas fa-sign-out-alt"></i> Déconnexion
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>

        <!-- Sidebar -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="{{ route('admin.dashboard') }}" class="brand-link">
                <span class="brand-text font-weight-light">AGEPIF Admin</span>
            </a>

            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                        <!-- Tableau de bord -->
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Tableau de bord</p>
                            </a>
                        </li>

                        <li class="nav-header">GESTION IMMOBILIÈRE</li>

                        <!-- Biens immobiliers -->
                        <li class="nav-item">
                            <a href="{{ route('admin.properties.index') }}" class="nav-link {{ request()->routeIs('admin.properties.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-building"></i>
                                <p>Biens immobiliers</p>
                            </a>
                        </li>

                        <!-- Catégories -->
                        <li class="nav-item">
                            <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tags"></i>
                                <p>Catégories</p>
                            </a>
                        </li>

                        <li class="nav-header">GESTION CLIENTS</li>

                        <!-- Clients -->
                        <li class="nav-item">
                            <a href="{{ route('admin.clients.index') }}" class="nav-link {{ request()->routeIs('admin.clients.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Clients</p>
                            </a>
                        </li>

                        <!-- Locations avec sous-menu -->
                        <li class="nav-item has-treeview {{ request()->routeIs('admin.rentals.*') || request()->routeIs('admin.payments.*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Locations
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.rentals.index') }}" class="nav-link {{ request()->routeIs('admin.rentals.*') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-file-signature"></i>
                                        <p>Contrats actifs</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.payments.index') }}" class="nav-link {{ request()->routeIs('admin.payments.*') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-credit-card"></i>
                                        <p>Paiements</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-header">COMMUNICATION</li>

                        <!-- Demandes de contact -->
                        <li class="nav-item">
                            <a href="{{ route('admin.inquiries.index') }}" class="nav-link {{ request()->routeIs('admin.inquiries.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-envelope"></i>
                                <p>Demandes de contact</p>
                                @php
                                    $pendingCount = \App\Models\Inquiry::where('status', 'pending')->count();
                                @endphp
                                @if($pendingCount > 0)
                                    <span class="right badge badge-danger">{{ $pendingCount }}</span>
                                @endif
                            </a>
                        </li>

                        <!-- Slides -->
                        <li class="nav-item">
                            <a href="{{ route('admin.slides.index') }}" class="nav-link {{ request()->routeIs('admin.slides.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-images"></i>
                                <p>Slides</p>
                            </a>
                        </li>

                        <li class="nav-header">SYSTÈME</li>

                        <!-- Utilisateurs -->
                        <li class="nav-item">
                            <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-users-cog"></i>
                                <p>Utilisateurs</p>
                            </a>
                        </li>

                        <!-- Paramètres -->
                        <li class="nav-item">
                            <a href="{{ route('admin.settings') }}" class="nav-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>Paramètres</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>@yield('header')</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                @yield('breadcrumb')
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <i class="icon fas fa-check"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <i class="icon fas fa-ban"></i>
                            {{ session('error') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <i class="icon fas fa-ban"></i>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </section>
        </div>

        <footer class="main-footer">
            <strong>Copyright &copy; {{ date('Y') }} AGEPIF.</strong>
            Tous droits réservés.
        </footer>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

    @stack('scripts')
</body>
</html>
