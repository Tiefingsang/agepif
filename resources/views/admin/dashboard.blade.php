@extends('admin.layouts.app')

@section('title', 'Tableau de bord')
@section('header', 'Tableau de bord')
@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $totalProperties ?? 0 }}</h3>
                <p>Total biens</p>
            </div>
            <div class="icon">
                <i class="fas fa-building"></i>
            </div>
            <a href="{{ route('admin.properties.index') }}" class="small-box-footer">
                Plus d'infos <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $publishedProperties ?? 0 }}</h3>
                <p>Biens publiés</p>
            </div>
            <div class="icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <a href="{{ route('admin.properties.index') }}?status=published" class="small-box-footer">
                Plus d'infos <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $totalInquiries ?? 0 }}</h3>
                <p>Demandes reçues</p>
            </div>
            <div class="icon">
                <i class="fas fa-envelope"></i>
            </div>
            <a href="{{ route('admin.inquiries.index') }}" class="small-box-footer">
                Plus d'infos <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $pendingInquiries ?? 0 }}</h3>
                <p>Demandes en attente</p>
            </div>
            <div class="icon">
                <i class="fas fa-clock"></i>
            </div>
            <a href="{{ route('admin.inquiries.index') }}?status=pending" class="small-box-footer">
                Plus d'infos <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Bienvenue dans l'administration AGEPIF</h3>
            </div>
            <div class="card-body">
                <p>Interface d'administration du site immobilier AGEPIF.</p>
                <hr>
                <h5>Accès rapides :</h5>
                <div class="row mt-3">
                    <div class="col-md-3">
                        <a href="{{ route('admin.properties.create') }}" class="btn btn-primary btn-block">
                            <i class="fas fa-plus"></i> Ajouter un bien
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('admin.properties.index') }}" class="btn btn-info btn-block">
                            <i class="fas fa-list"></i> Voir les biens
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('admin.inquiries.index') }}" class="btn btn-warning btn-block">
                            <i class="fas fa-envelope"></i> Voir les demandes
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('admin.settings') }}" class="btn btn-secondary btn-block">
                            <i class="fas fa-cog"></i> Paramètres
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
