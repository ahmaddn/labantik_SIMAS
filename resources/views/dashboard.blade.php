@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="main-content-container overflow-hidden">
        <!-- Header Section -->
        <div class="mb-4">
            <h2 class="fw-semibold mb-2">Dashboard</h2>
            <p class="text-secondary mb-0 fs-15">Kelola dan pantau semua jenis surat</p>
        </div>

        <!-- Letter Stats Grid -->
        <div class="row">

            <!-- Summary Section -->
            <div class="row">
                <!-- Total Surat -->
                <div class="col-lg-4">
                    <div class="card bg-white p-20 rounded-10 border border-white mb-4">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="d-flex align-items-center justify-content-center bg-light rounded-10"
                                    style="width: 50px; height: 50px;">
                                    <i class="material-symbols-outlined fs-28 text-secondary">description</i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <p class="text-secondary fs-12 mb-1 text-uppercase fw-medium"
                                    style="letter-spacing: 0.5px;">
                                    Total Surat</p>
                                <h3 class="fs-28 fw-bold mb-0">{{ array_sum(array_column($letterStats, 'count')) }}</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Unduhan -->
                <div class="col-lg-4">
                    <div class="card bg-white p-20 rounded-10 border border-white mb-4">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="d-flex align-items-center justify-content-center bg-light rounded-10"
                                    style="width: 50px; height: 50px;">
                                    <i class="material-symbols-outlined fs-28 text-primary">cloud_download</i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <p class="text-secondary fs-12 mb-1 text-uppercase fw-medium"
                                    style="letter-spacing: 0.5px;">
                                    Total Unduhan</p>
                                <h3 class="fs-28 fw-bold mb-0">
                                    {{ array_sum(array_column($letterStats, 'download_count')) }}</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Jenis Surat -->
                <div class="col-lg-4">
                    <div class="card bg-white p-20 rounded-10 border border-white mb-4">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="d-flex align-items-center justify-content-center bg-light rounded-10"
                                    style="width: 50px; height: 50px;">
                                    <i class="material-symbols-outlined fs-28 text-success">category</i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <p class="text-secondary fs-12 mb-1 text-uppercase fw-medium"
                                    style="letter-spacing: 0.5px;">
                                    Jenis Surat</p>
                                <h3 class="fs-28 fw-bold mb-0">{{ count($letterStats) }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @foreach ($letterStats as $stat)
                <div class="col-lg-4 col-md-6">
                    <div class="card bg-white p-20 rounded-10 border border-white mb-4">
                        <!-- Icon -->
                        <div class="mb-3">
                            <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-10"
                                style="width: 50px; height: 50px;">
                                <i class="material-symbols-outlined fs-28 text-secondary">{{ $stat['icon'] }}</i>
                            </div>
                        </div>

                        <!-- Title -->
                        <h3 class="fs-15 text-secondary mb-2">{{ $stat['name'] }}</h3>

                        <!-- Count -->
                        <div class="mb-2">
                            <h2 class="fs-32 fw-semibold mb-0 lh-1 text-dark d-inline-block">{{ $stat['count'] }}</h2>
                            <span class="fs-14 text-secondary ms-2">surat</span>
                        </div>

                        <!-- Download Info -->
                        <p class="mb-3 fs-14 text-secondary">
                            <strong class="text-body">{{ $stat['download_count'] }}</strong> kali diunduh
                        </p>

                        <!-- Action Button -->
                        <a href="{{ $stat['route'] }}"
                            class="btn btn-dark btn-sm w-100 d-flex align-items-center justify-content-center gap-2">
                            <i class="material-symbols-outlined fs-18">add</i>
                            <span>Buat Surat</span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

    <div class="flex-grow-1"></div>

    <style>
        /* Material Icons */
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;
        }

        /* Custom Button Dark */
        .btn-dark {
            background-color: #1a1a1a;
            border-color: #1a1a1a;
            color: #ffffff;
        }

        .btn-dark:hover {
            background-color: #000000;
            border-color: #000000;
            color: #ffffff;
        }

        /* Hover effect untuk card */
        .card {
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08) !important;
        }
    </style>
@endsection
