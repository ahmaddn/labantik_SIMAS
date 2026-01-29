@extends('layouts.app')
@section('title', 'Surat Keterangan Siswa')
@section('content')
    <div class="main-content-container overflow-hidden">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
            <h3 class="mb-0">
                Data Table
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
                        <span class="text-secondary">
                            Data Table
                        </span>
                    </li>
                </ol>
            </nav>
        </div>
        <div class="card bg-white rounded-10 border border-white mb-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 p-20 pb-0">
                <h3>
                    Users
                </h3>
                <div class="dropdown select-dropdown without-border">
                    <a href="{{ route('sk.generalLetters.create') }}">
                    <button type="button" class="btn bg-primary bg-opacity-10 fw-normal fs-16 text-primary">+ Tambah Surat</button>
                    </a>
                </div>
            </div>
            <div class="default-table-area mx-minus-1 table-contact-list">
                <div class="table-responsive">
                    <table class="table align-middle" id="myTable">
                        <thead>
                            <tr>
                                <th class="fw-medium pe-0 rtl-pe" scope="col">
                                    No
                                </th>
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
                                    <td class="text-body pe-0 rtl-pe">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="text-body">
                                        {{ $letter->letter_number ?? '-' }}
                                    </td>
                                    <td class="text-body">
                                        {{ $letter->student->name ?? '-' }}
                                    </td>
                                    <td class="text-body">
                                        {{ $letter->student->nis ?? '-' }}
                                    </td>
                                    <td class="text-body">
                                        {{ $letter->student->class ?? '-' }}
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
                                            <form action="{{ route('sk.generalLetters.destroy', $letter->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-transparent p-0 border-0 hover-text-danger"
                                                    data-bs-placement="top" data-bs-title="Hapus" data-bs-toggle="tooltip"
                                                    onclick="return confirm('Hapus data ini?');">
                                                    <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                                        delete
                                                    </i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">
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
