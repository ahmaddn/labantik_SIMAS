@extends('layouts.app')
@section('content')
    <div class="main-content-container overflow-hidden">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
            <h3 class="mb-0">
                Tabel Data
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb align-items-center mb-0 lh-1">
                    <li class="breadcrumb-item">
                        <a class="d-flex align-items-center text-decoration-none" href="index.html">
                            <i class="ri-home-8-line fs-15 text-primary me-1">
                            </i>
                            <span class="text-body fs-14 hover">
                                Dashboard
                            </span>
                        </a>
                    </li>
                    <li aria-current="page" class="breadcrumb-item active">
                        <span>
                            Surat Perintah (SP)
                        </span>
                    </li>
                    <li aria-current="page" class="breadcrumb-item active">
                        <span>
                            Perjalanan Dinas
                        </span>
                    </li>
                    <li aria-current="page" class="breadcrumb-item active">
                        <span class="text-secondary">
                            Tabel Data
                        </span>
                    </li>
                </ol>
            </nav>
        </div>
        <div class="card bg-white rounded-10 border border-white mb-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 p-20 pb-0">
                <h3>
                    Surat Perintah Perjalanan Dinas
                </h3>
                <div class="dropdown select-dropdown without-border">
                    <a href="{{ route('sp.travelOrders.create') }}"
                        class="btn bg-primary bg-opacity-10 fw-normal fs-16 text-primary">
                        <i class="ri-add-line"></i>
                        Tambah Surat
                    </a>
                </div>
            </div>
            <div class="default-table-area mx-minus-1 table-contact-list">
                <div class="table-responsive">
                    <table class="table align-middle" id="myTable">
                        <thead>
                            <tr>
                                <th class="fw-medium pe-0 rtl-pe" scope="col">
                                    Nomor Surat
                                </th>
                                <th class="fw-medium" scope="col">
                                    Petugas
                                </th>
                                <th class="fw-medium" scope="col">
                                    Berangkat dari
                                </th>
                                <th class="fw-medium" scope="col">
                                    Tujuan
                                </th>
                                <th class="fw-medium" scope="col">
                                    Durasi
                                </th>
                                <th class="fw-medium" scope="col">
                                    Dibuat oleh
                                </th>
                                <th class="fw-medium" scope="col">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-body pe-0 rtl-pe">
                                    #ARP-1217
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <img alt="user15" class="rounded-circle" src="assets/images/user15.jpg"
                                                style="width: 35px; height: 35px;" />
                                        </div>
                                        <div class="flex-grow-1 ms-12">
                                            <h4 class="fw-medium fs-16 mb-0">
                                                Marcia Baker
                                            </h4>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-body">
                                    +1 555-123-4567
                                </td>
                                <td class="text-body">
                                    Nov 10, 2025
                                </td>
                                <td class="text-body">
                                    ABC Corporation
                                </td>
                                <td>
                                    <span
                                        class="text-success bg-success bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                        Active
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-end" style="gap: 12px;">
                                        <button class="bg-transparent p-0 border-0 hover-text-success"
                                            data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                            <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                                visibility
                                            </i>
                                        </button>
                                        <button class="bg-transparent p-0 border-0 hover-text-success"
                                            data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                            <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                                edit
                                            </i>
                                        </button>
                                        <button class="bg-transparent p-0 border-0 hover-text-danger"
                                            data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                            <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                                delete
                                            </i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="flex-grow-1">
    </div>
@endsection
