@extends('layouts.app')
@section('content')
    <div class="main-content-container overflow-hidden">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
            <h3 class="mb-0">Master Bendahara</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb align-items-center mb-0 lh-1">
                    <li class="breadcrumb-item">
                        <a class="d-flex align-items-center text-decoration-none" href="{{ route('dashboard') }}">
                            <i class="ri-home-8-line fs-15 text-primary me-1"></i>
                            <span class="text-body fs-14 hover">Dashboard</span>
                        </a>
                    </li>
                    <li aria-current="page" class="breadcrumb-item active"><span>Surat Perintah (SP)</span></li>
                    <li aria-current="page" class="breadcrumb-item active">
                        <span class="text-secondary">Master Bendahara</span>
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

        @if (session('error'))
            <div class="alert fs-16 alert-danger alert-dismissible" role="alert">
                <i class="ri-error-warning-line fs-18 me-1"></i>
                {{ session('error') }}
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card bg-white rounded-10 border border-white mb-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 p-20 pb-0">
                <h3>Daftar Bendahara</h3>
                <a href="{{ route('sp.treasurers.create') }}"
                    class="btn bg-primary bg-opacity-10 fw-normal fs-16 text-primary">
                    <i class="ri-add-line"></i>
                    Tambah Bendahara
                </a>
            </div>

            <div class="default-table-area mx-minus-1 table-contact-list">
                <div class="table-responsive">
                    <table class="table align-middle" id="myTable">
                        <thead>
                            <tr>
                                <th class="fw-medium" scope="col">No</th>
                                <th class="fw-medium" scope="col">Nama Bendahara</th>
                                <th class="fw-medium" scope="col">NIP</th>
                                <th class="fw-medium" scope="col">Jabatan</th>
                                <th class="fw-medium" scope="col">Status</th>
                                <th class="fw-medium" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($treasurers as $t)
                                <tr>
                                    <td class="text-body">{{ $loop->iteration }}</td>
                                    <td class="text-body fw-medium">
                                        {{ $t->name }}
                                        @if ($t->employee)
                                            <span class="badge bg-secondary-subtle text-secondary fs-12 ms-1">Tersinkron Pegawai</span>
                                        @endif
                                    </td>
                                    <td class="text-body">{{ $t->nip ?? '-' }}</td>
                                    <td class="text-body">{{ $t->position }}</td>
                                    <td>
                                        @if ($t->is_active)
                                            <span class="text-success bg-success bg-opacity-10 fs-14 fw-normal d-inline-block default-badge">
                                                <i class="ri-checkbox-circle-line me-1"></i>Aktif
                                            </span>
                                        @else
                                            <span class="text-danger bg-danger bg-opacity-10 fs-14 fw-normal d-inline-block default-badge">
                                                <i class="ri-close-circle-line me-1"></i>Nonaktif
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-end align-items-center" style="gap: 12px;">
                                            <a class="bg-transparent p-0 border-0 hover-text-primary"
                                                href="{{ route('sp.treasurers.edit', $t->id) }}"
                                                data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                                <i class="ri-edit-line fs-18 text-primary"></i>
                                            </a>
                                            <form action="{{ route('sp.treasurers.destroy', $t->id) }}" method="POST"
                                                class="d-inline m-0 p-0"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus bendahara ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="bg-transparent p-0 border-0 hover-text-danger"
                                                    data-bs-placement="top" data-bs-title="Hapus" data-bs-toggle="tooltip">
                                                    <i class="ri-delete-bin-line fs-18 text-danger"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-gray-light">
                                        Belum ada data bendahara.
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
