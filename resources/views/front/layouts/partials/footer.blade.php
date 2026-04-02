<footer class="at-main-footer at-over-layer-black">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="at-footer-about-col at-col-default-mar">
                    <div class="at-footer-logo">
                        <img src="{{ asset('assets/images/footer-logo.png') }}" alt="AGEPIF">
                    </div>
                    <hr>
                    <p>AGEPIF est une agence immobilière de premier plan en Côte d'Ivoire. Nous vous accompagnons dans vos projets immobiliers avec professionnalisme et transparence.</p>
                    <div class="at-social text-left">
                        <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                        <a href="#"><i class="fa fa-dribbble" aria-hidden="true"></i></a>
                        <a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-6 col-md-6 col-sm-12">
                <div class="at-footer-link-col at-col-default-mar">
                    <h4>Liens rapides</h4>
                    <div class="at-heading-under-line">
                        <div class="at-heading-inside-line"></div>
                    </div>
                    <ul>
                        <li><a href="{{ route('home') }}">Accueil</a></li>
                        <li><a href="{{ route('about') }}">À propos</a></li>
                        <li><a href="{{ route('properties.index') }}">Nos biens</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="at-footer-Tag-col at-col-default-mar">
                    <h4>Catégories</h4>
                    <div class="at-heading-under-line">
                        <div class="at-heading-inside-line"></div>
                    </div>
                    <div class="at-tag-group clearfix">
                        @php
                            $categories = App\Models\Category::where('is_active', true)->limit(8)->get();
                        @endphp
                        @foreach($categories as $category)
                            <a href="{{ route('properties.index', ['category' => $category->slug]) }}" class="hvr-bounce-to-right at-bg-hvr">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                <div class="at-footer-gallery-col at-col-default-mar">
                    <h4>Nous contacter</h4>
                    <div class="at-heading-under-line">
                        <div class="at-heading-inside-line"></div>
                    </div>
                    <div class="at-gallery clearfix">
                        <ul>
                            <li><i class="fa fa-map-marker"></i> Abidjan, Côte d'Ivoire</li>
                            <li><i class="fa fa-phone"></i> +225 01 23 45 67</li>
                            <li><i class="fa fa-envelope"></i> contact@agepif.com</li>
                            <li><i class="fa fa-clock-o"></i> Lun - Sam: 8h - 18h</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Copyright start from here -->
<section class="at-copyright">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <p>Copyright © {{ date('Y') }} <a href="{{ route('home') }}">AGEPIF Immobilier</a> Tous droits réservés</p>
            </div>
        </div>
    </div>
</section>
