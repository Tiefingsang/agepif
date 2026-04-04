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
                        <a href="#" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        <a href="#" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        <a href="#" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                        <a href="#" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        <a href="#" target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
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
                        <li><a href="{{ route('properties.index', ['transaction_type' => 'sale']) }}">Vente</a></li>
                        <li><a href="{{ route('properties.index', ['transaction_type' => 'rent']) }}">Location</a></li>
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
                        <ul class="at-contact-list">
                            <li><i class="fa fa-map-marker"></i> Abidjan, Côte d'Ivoire</li>
                            <li><i class="fa fa-phone"></i> <a href="tel:+22501234567">+225 01 23 45 67</a></li>
                            <li><i class="fa fa-whatsapp"></i> <a href="https://wa.me/22501234567" target="_blank">+225 01 23 45 67</a></li>
                            <li><i class="fa fa-envelope"></i> <a href="mailto:contact@agepif.com">contact@agepif.com</a></li>
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

@push('styles')
<style>
    .at-footer-gallery-col .at-contact-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .at-footer-gallery-col .at-contact-list li {
        padding: 8px 0;
        color: #ccc;
        display: flex;
        align-items: center;
    }
    .at-footer-gallery-col .at-contact-list li i {
        width: 30px;
        font-size: 16px;
        color: #ffd700;
    }
    .at-footer-gallery-col .at-contact-list li a {
        color: #ccc;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    .at-footer-gallery-col .at-contact-list li a:hover {
        color: #ffd700;
        padding-left: 5px;
    }
    .at-social a {
        display: inline-block;
        width: 35px;
        height: 35px;
        line-height: 35px;
        text-align: center;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        margin-right: 8px;
        color: #fff;
        transition: all 0.3s ease;
    }
    .at-social a:hover {
        background: #ffd700;
        color: #1a2a3a;
        transform: translateY(-3px);
    }
    .at-footer-link-col ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .at-footer-link-col ul li {
        padding: 8px 0;
    }
    .at-footer-link-col ul li a {
        color: #ccc;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    .at-footer-link-col ul li a:hover {
        color: #ffd700;
        padding-left: 5px;
    }
    .at-heading-under-line {
        width: 50px;
        height: 2px;
        background: rgba(255,255,255,0.2);
        margin: 15px 0 20px;
        position: relative;
    }
    .at-heading-inside-line {
        width: 30px;
        height: 2px;
        background: #ffd700;
        position: absolute;
        left: 0;
        top: 0;
    }
    .at-footer-about-col hr {
        background: rgba(255,255,255,0.1);
        margin: 15px 0;
    }
    .at-footer-about-col p {
        color: #ccc;
        line-height: 1.6;
    }
    .at-copyright {
        background: #0f1a24;
        padding: 15px 0;
        text-align: center;
    }
    .at-copyright p {
        color: #ccc;
        margin: 0;
    }
    .at-copyright a {
        color: #ffd700;
    }
    .at-copyright a:hover {
        text-decoration: underline;
    }
    .at-tag-group a {
        display: inline-block;
        padding: 5px 12px;
        margin: 0 5px 8px 0;
        background: rgba(255,255,255,0.1);
        border-radius: 3px;
        color: #fff;
        font-size: 12px;
        transition: all 0.3s ease;
    }
    .at-tag-group a:hover {
        background: #ffd700;
        color: #1a2a3a;
    }
</style>
@endpush
