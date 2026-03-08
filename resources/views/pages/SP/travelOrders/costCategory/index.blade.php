@extends('layouts.app')
@section('content')
    <div class="main-content-container overflow-hidden">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
            <h3 class="mb-0">Kategori Biaya Perjalanan</h3>
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
                        <span class="text-secondary">Kategori Biaya</span>
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
                <h3>Daftar Kategori Biaya</h3>
                <a href="{{ route('sp.travelCostCategories.create') }}"
                    class="btn bg-primary bg-opacity-10 fw-normal fs-16 text-primary">
                    <i class="ri-add-line"></i>
                    Tambah Kategori
                </a>
            </div>

            <div class="default-table-area mx-minus-1 table-contact-list">
                <div class="table-responsive">
                    <table class="table align-middle" id="myTable">
                        <thead>
                            <tr>
                                <th class="fw-medium" scope="col">No</th>
                                <th class="fw-medium" scope="col">Nama Kategori</th>
                                <th class="fw-medium" scope="col">Tipe</th>
                                <th class="fw-medium" scope="col">Deskripsi</th>
                                <th class="fw-medium" scope="col">Urutan</th>
                                <th class="fw-medium" scope="col">Status</th>
                                <th class="fw-medium" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $cat)
                                <tr>
                                    <td class="text-body">{{ $loop->iteration }}</td>
                                    <td class="text-body fw-medium">{{ $cat->name }}</td>
                                    <td>
                                        @if ($cat->type === 'accommodation')
                                            <span
                                                class="text-warning bg-warning bg-opacity-10 fs-14 fw-normal d-inline-block default-badge">
                                                <i class="ri-hotel-line me-1"></i>Penginapan
                                            </span>
                                        @else
                                            <span
                                                class="text-info bg-info bg-opacity-10 fs-14 fw-normal d-inline-block default-badge">
                                                <i class="ri-car-line me-1"></i>Transport
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-body">{{ $cat->description ?? '-' }}</td>
                                    <td class="text-body text-center">{{ $cat->sort_order }}</td>
                                    <td>
                                        @if ($cat->is_active)
                                            <span
                                                class="text-success bg-success bg-opacity-10 fs-14 fw-normal d-inline-block default-badge">
                                                <i class="ri-checkbox-circle-line me-1"></i>Aktif
                                            </span>
                                        @else
                                            <span
                                                class="text-danger bg-danger bg-opacity-10 fs-14 fw-normal d-inline-block default-badge">
                                                <i class="ri-close-circle-line me-1"></i>Nonaktif
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-end align-items-center" style="gap: 12px;">
                                            {{-- Edit --}}
                                            <a class="bg-transparent p-0 border-0 hover-text-primary"
                                                href="{{ route('sp.travelCostCategories.edit', $cat->id) }}"
                                                data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                                <i class="material-symbols-outlined fs-16 fw-normal text-primary">edit</i>
                                            </a>

                                            {{-- Toggle Aktif/Nonaktif --}}
                                            <form action="{{ route('sp.travelCostCategories.toggle', $cat->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="bg-transparent p-0 border-0 {{ $cat->is_active ? 'hover-text-warning' : 'hover-text-success' }}"
                                                    data-bs-placement="top"
                                                    data-bs-title="{{ $cat->is_active ? 'Nonaktifkan' : 'Aktifkan' }}"
                                                    data-bs-toggle="tooltip">
                                                    <i
                                                        class="material-symbols-outlined fs-16 fw-normal {{ $cat->is_active ? 'text-warning' : 'text-success' }}">
                                                        {{ $cat->is_active ? 'toggle_on' : 'toggle_off' }}
                                                    </i>
                                                </button>
                                            </form>

                                            {{-- Hapus --}}
                                            <button class="bg-transparent p-0 border-0 hover-text-danger" type="button"
                                                data-bs-toggle="modal" data-bs-target="#deleteCategory{{ $cat->id }}">
                                                <i class="material-symbols-outlined fs-16 fw-normal text-danger">delete</i>
                                            </button>

                                            {{-- Modal Hapus --}}
                                            <div class="modal fade" id="deleteCategory{{ $cat->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header border-0">
                                                            <h5 class="modal-title text-danger">
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
                                                                Kategori <strong>{{ $cat->name }}</strong> akan dihapus
                                                                secara permanen.
                                                            </p>
                                                            @if ($cat->accommodations_count > 0 || $cat->transports_count > 0)
                                                                <p class="text-danger mt-2 mb-0 fs-14">
                                                                    <i class="ri-error-warning-line me-1"></i>
                                                                    Kategori ini sudah digunakan dalam data biaya.
                                                                </p>
                                                            @endif
                                                        </div>
                                                        <div class="modal-footer border-0 justify-content-center">
                                                            <button type="button" class="btn btn-secondary px-4"
                                                                data-bs-dismiss="modal">
                                                                <i class="ri-close-line me-1"></i>Batal
                                                            </button>
                                                            <form
                                                                action="{{ route('sp.travelCostCategories.destroy', $cat->id) }}"
                                                                method="POST" style="display:inline;">
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
                                        Tidak Ada Kategori Biaya
                                    </td>
                                    <td class="text-body text-center" colspan="7">

                                    </td>
                                    <td class="text-body text-center" colspan="7">

                                    </td>
                                    <td class="text-body text-center" colspan="7">

                                    </td>
                                    <td class="text-body text-center" colspan="7">

                                    </td>
                                    <td class="text-body text-center" colspan="7">

                                    </td>
                                    <td class="text-body text-center" colspan="7">

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
