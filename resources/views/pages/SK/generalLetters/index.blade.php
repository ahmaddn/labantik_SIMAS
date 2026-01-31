@extends('layouts.app')
@section('title', 'Surat Keterangan Siswa')
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
                            Surat Keterangan (SK)
                        </span>
                    </li>
                    <li aria-current="page" class="breadcrumb-item active">
                        <span>
                            Siswa
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
                    Surat Keterangan
                </h3>
                <div class="dropdown select-dropdown without-border">
                    <a href="{{ route('sk.generalLetters.create') }}">
                        <button type="button" class="btn bg-primary bg-opacity-10 fw-normal fs-16 text-primary">+ Tambah
                            Surat</button>
                    </a>
                </div>
            </div>
            <div class="default-table-area mx-minus-1 table-contact-list">
                <div class="table-responsive">
                    <table class="table align-middle" id="myTable">
                        <thead>
                            <tr>
                                <th class="fw-medium" scope="col">
                                    Nomor Surat
                                </th>
                                <th class="fw-medium" scope="col">
                                    Nama Siswa
                                </th>
                                <th class="fw-medium" scope="col">
                                    NIS
                                </th>
                                <th class="fw-medium" scope="col">
                                    Kelas
                                </th>
                                <th class="fw-medium" scope="col">
                                    Dibuat Oleh
                                </th>
                                <th class="fw-medium" scope="col">
                                    Tanggal
                                </th>
                                <th class="fw-medium" scope="col">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($letters as $letter)
                                <tr>

                                    <td class="text-body">
                                        {{ $letter->letter_number ?? '-' }}
                                    </td>
                                    <td class="text-body">
                                        {{ $letter->student->student->full_name ?? '-' }}
                                    </td>
                                    <td class="text-body">
                                        {{ $letter->student->student->student_number ?? '-' }}
                                    </td>
                                    <td class="text-body">
                                        {{ $letter->student->class->name ?? '-' }}
                                    </td>
                                    <td class="text-body">
                                        <span
                                            class="text-success bg-success bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">

                                            {{ $letter->createdBy->name ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="text-body">
                                        @if ($letter->issue_date)
                                            {{ \Carbon\Carbon::parse($letter->issue_date)->format('d/m/Y') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-end" style="gap: 12px;">
                                            <!-- Tombol Lihat -->
                                            <a href="{{ route('sk.generalLetters.show', $letter->id) }}"
                                                class="bg-transparent p-0 border-0 hover-text-success"
                                                data-bs-placement="top" data-bs-title="Lihat" data-bs-toggle="tooltip">
                                                <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                                    visibility
                                                </i>
                                            </a>

                                            <!-- Tombol Edit -->
                                            <a href="{{ route('sk.generalLetters.edit', $letter->id) }}"
                                                class="bg-transparent p-0 border-0 hover-text-success"
                                                data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                                <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                                    edit
                                                </i>
                                            </a>

                                            <!-- Tombol Hapus -->
                                                <button class="bg-transparent p-0 border-0 hover-text-danger" type="button"
                                                data-bs-toggle="modal" data-bs-target="#deleteletter{{ $letter->id }}">
                                                <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                                    delete
                                                </i>
                                            </button>

                                            <div class="modal fade" id="deleteletter{{ $letter->id }}" tabindex="-1"
                                                aria-labelledby="deleteletterLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header border-0">
                                                            <h5 class="modal-title text-danger" id="deleteletterLabel">
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
                                                                Data Surat Keterangan Siswa ini akan dihapus secara
                                                                permanen dan tidak dapat dikembalikan.
                                                            </p>
                                                            <p class="text-muted mt-2 mb-0">
                                                                <strong>Nomor Surat:
                                                                    <span>{{ $letter->letter_number }}</span></strong>
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer border-0 justify-content-center">
                                                            <button type="button" class="btn btn-secondary px-4"
                                                                data-bs-dismiss="modal">
                                                                <i class="ri-close-line me-1"></i>Batal
                                                            </button>
                                                            <form
                                                                action="{{ route('sp.travelOrders.destroy', $letter->id) }}"
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
                                        Tidak Ada Data SK Siswa
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
