<section class="at-main-herader-sec">
    <!-- Header top start -->
    <div class="at-header-topbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <p><i class="icofont icofont-ui-head-phone"></i> +223 79 13 13 95</p>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <p class="at-respo-right"><i class="icofont icofont-email"></i> <a href="mailto:contact@agepif.com">contact@agepif.com</a>
                    </p>
                </div>
                <div class="col-lg-4 col-md-3 col-sm-6">
                    <div class="at-sign-in-up clearfix">
                        @guest
                            {{-- <p><i class="icofont icofont-sign-in"></i><a href="{{ route('login') }}">Connexion</a></p>
                            <p><i class="icofont icofont-pencil-alt-2"></i> <a href="{{ route('register') }}">Inscription</a></p> --}}
                        @else
                            <p><i class="icofont icofont-user"></i><a href="{{ route('admin.dashboard') }}">{{ Auth::user()->name }}</a></p>
                            <p><i class="icofont icofont-logout"></i> <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Déconnexion</a></p>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endguest
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="at-social text-right">
                        <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                        <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        <a href="https://wa.me/22379131395" target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header top end -->

    <!-- Header navbar start -->
    <div class="at-navbar fixed-header">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-6">
                    <div class="main-logo">
                        <a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo.png') }}" alt="AGEPIF Mali"></a>
                    </div>
                </div>
                <div class="col-md-9 col-sm-6 col-6">
                    <div id="main-nav" class="stellarnav">
                        <ul>
                            <li class="{{ request()->routeIs('home') ? 'current-menu-item' : '' }}">
                                <a href="{{ route('home') }}">Accueil</a>
                            </li>
                            <li class="{{ request()->routeIs('about') ? 'current-menu-item' : '' }}">
                                <a href="{{ route('about') }}">À propos</a>
                            </li>
                            <li class="menu-item-has-children {{ request()->routeIs('properties.*') ? 'current-menu-item' : '' }}">
                                <a href="#">Nos biens <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                <ul>
                                    <li><a href="{{ route('properties.index') }}">Tous les biens</a></li>
                                    <li><a href="{{ route('properties.index', ['transaction_type' => 'sale']) }}">À vendre</a></li>
                                    <li><a href="{{ route('properties.index', ['transaction_type' => 'rent']) }}">À louer</a></li>
                                    <li><a href="{{ route('properties.index', ['type' => 'house']) }}">Maisons</a></li>
                                    <li><a href="{{ route('properties.index', ['type' => 'apartment']) }}">Appartements</a></li>
                                    <li><a href="{{ route('properties.index', ['type' => 'land']) }}">Terrains</a></li>
                                    <li><a href="{{ route('properties.index', ['type' => 'commercial']) }}">Commerciaux</a></li>
                                </ul>
                            </li>
                            <li class="{{ request()->routeIs('services') ? 'current-menu-item' : '' }}">
                                <a href="{{ route('services') }}">Services</a>
                            </li>
                            <li class="{{ request()->routeIs('contact') ? 'current-menu-item' : '' }}">
                                <a href="{{ route('contact') }}">Contact</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header navbar end -->
</section>
