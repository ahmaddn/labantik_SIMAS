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
        @if (session('success'))
            <div class="alert fs-16 alert-primary alert-dismissible" role="alert">
                <i class="ri-check-line fs-18 me-1"></i>
                {{ session('success') }}
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
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
                            @forelse ($travelOrders as $sppd)
                                <tr>
                                    <td class="text-body pe-0 rtl-pe">
                                        {{ $sppd->letter_number }}
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 ms-12">
                                                @foreach ($sppd->employees as $particip)
                                                    <li>
                                                        <h4 class="fw-medium fs-16 mb-0">
                                                            {{ $particip->employee->full_name }}
                                                        </h4>
                                                    </li>
                                                @endforeach

                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-body">
                                        {{ $sppd->departure_place }}
                                    </td>
                                    <td class="text-body">
                                        {{ $sppd->departure_to }}
                                    </td>
                                    <td class="text-body">
                                        {{ $sppd->duration_days }}
                                    </td>
                                    <td>
                                        <span
                                            class="text-success bg-success bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                            {{ $sppd->createdBy->name }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-end" style="gap: 12px;">
                                            <a class="bg-transparent p-0 border-0 hover-text-secondary"
                                                href="{{ route('sp.travelOrders.preview', $sppd->id) }}"
                                                data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                                <i class="material-symbols-outlined fs-16 fw-normal text-secondary">
                                                    print
                                                </i>
                                            </a>
                                            <a class="bg-transparent p-0 border-0 hover-text-primary"
                                                href="{{ route('sp.travelOrders.edit', $sppd->id) }}"
                                                data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                                <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                                    edit
                                                </i>
                                            </a>
                                            <button class="bg-transparent p-0 border-0 hover-text-danger" type="button"
                                                data-bs-toggle="modal" data-bs-target="#deleteSPPD{{ $sppd->id }}">
                                                <i class="material-symbols-outlined fs-16 fw-normal text-danger">
                                                    delete
                                                </i>
                                            </button>

                                            <div class="modal fade" id="deleteSPPD{{ $sppd->id }}" tabindex="-1"
                                                aria-labelledby="deleteSPPDLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header border-0">
                                                            <h5 class="modal-title text-danger" id="deleteSPPDLabel">
                                                                <i class="ri-alert-line me-2"></i>Konfirmasi Hapus
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-center py-4">
                                                            <div class="mb-3">
                                                                <i class="ri-delete-bin-line text-danger"
                                                                    style="font-size: 64px;"></i>
                                                            </div>
                                                            <h5 class="mb-2">Apakah Anda yakin?</h5>
                                                            <p class="text-muted mb-0">
                                                                Data Surat Perintah Perjalanan Dinas ini akan dihapus secara
                                                                permanen dan tidak dapat dikembalikan.
                                                            </p>
                                                            <p class="text-muted mt-2 mb-0">
                                                                <strong>Nomor Surat:
                                                                    <span>{{ $sppd->letter_number }}</span></strong>
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer border-0 justify-content-center">
                                                            <button type="button" class="btn btn-secondary px-4"
                                                                data-bs-dismiss="modal">
                                                                <i class="ri-close-line me-1"></i>Batal
                                                            </button>
                                                            <form
                                                                action="{{ route('sp.travelOrders.destroy', $sppd->id) }}"
                                                                method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger px-4">
                                                                    <i class="ri-delete-bin-line me-1"></i>Hapus
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-body text-center" colspan="7">
                                        Tidak Ada Data SPPD
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="flex-grow-1">
    </div>
@endsection
