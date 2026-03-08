@extends('layouts.app')

@section('content')
    <div class="main-content-container overflow-hidden">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
            <h3 class="mb-0">Surat Pindah Sekolah</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb align-items-center mb-0 lh-1">
                    <li class="breadcrumb-item">
                        <a class="d-flex align-items-center text-decoration-none" href="{{ route('dashboard') }}">
                            <i class="ri-home-8-line fs-15 text-primary me-1"></i>
                            <span class="text-body fs-14 hover">Dashboard</span>
                        </a>
                    </li>
                    <li aria-current="page" class="breadcrumb-item active">
                        <span>Surat Pengantar</span>
                    </li>
                    <li aria-current="page" class="breadcrumb-item active">
                        <span class="text-secondary">Pindah Sekolah</span>
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
                <h3>Daftar Surat Pindah Sekolah</h3>
                <div class="dropdown select-dropdown without-border">
                    <a href="{{ route('s_peng.schoolTransfers.create') }}"
                        class="btn bg-primary bg-opacity-10 fw-normal fs-16 text-primary">
                        <i class="ri-add-line"></i>
                        Tambah Surat
                    </a>
                </div>
            </div>

            <div class="tab-content mt-3" id="myTabContent">
                <div aria-labelledby="preview-tab" class="tab-pane fade show active" id="preview-tab-pane" role="tabpanel"
                    tabindex="0">
                    <div class="default-table-area mx-minus-1 table-contact-list">
                        <div class="table-responsive">
                            <table class="table align-middle" id="myTable">
                                <thead>
                                    <tr>
                                        <th class="fw-medium pe-0 rtl-pe" scope="col">Nomor Surat</th>
                                        <th class="fw-medium" scope="col">Nama Siswa</th>
                                        <th class="fw-medium" scope="col">Sekolah Tujuan</th>
                                        <th class="fw-medium" scope="col">Alasan</th>
                                        <th class="fw-medium" scope="col">Tanggal</th>
                                        <th class="fw-medium" scope="col">Dibuat oleh</th>
                                        <th class="fw-medium" scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($schoolTransfers as $letter)
                                        <tr>
                                            <td class="text-body pe-0 rtl-pe">{{ $letter->letter_number }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1">
                                                        <div class="mb-1">
                                                            <h4 class="fw-medium fs-14 mb-0">
                                                                {{ $letter->student->student->full_name }}
                                                            </h4>
                                                            <span class="fs-12 text-muted">
                                                                {{ $letter->student->student->student_number }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-body">{{ $letter->destination_school }}</td>
                                            <td class="text-body">
                                                <span class="text-truncate d-inline-block" style="max-width: 200px;"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="{{ $letter->reason }}">
                                                    {{ Str::limit($letter->reason, 50) }}
                                                </span>
                                            </td>
                                            <td class="text-body">
                                                {{ $letter->issue_date ? \Carbon\Carbon::parse($letter->issue_date)->format('d/m/Y') : '-' }}
                                            </td>
                                            <td>
                                                <span
                                                    class="text-success bg-success bg-opacity-10 fs-15 fw-normal d-inline-block px-2 py-1 rounded">
                                                    {{ $letter->createdby->name }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                                    <a class="bg-transparent p-0 border-0 hover-text-secondary"
                                                        href="{{ route('s_peng.schoolTransfers.print', $letter->id) }}"
                                                        data-bs-placement="top" data-bs-title="Print"
                                                        data-bs-toggle="tooltip">
                                                        <i class="material-symbols-outlined fs-16 fw-normal text-secondary">
                                                            print
                                                        </i>
                                                    </a>
                                                    <a class="bg-transparent p-0 border-0 hover-text-primary"
                                                        href="{{ route('s_peng.schoolTransfers.edit', $letter->id) }}"
                                                        data-bs-placement="top" data-bs-title="Edit"
                                                        data-bs-toggle="tooltip">
                                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                                            edit
                                                        </i>
                                                    </a>
                                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                                        type="button" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $letter->id }}">
                                                        <i class="material-symbols-outlined fs-16 fw-normal text-danger">
                                                            delete
                                                        </i>
                                                    </button>

                                                    <!-- Modal Delete -->
                                                    <div class="modal fade" id="deleteModal{{ $letter->id }}"
                                                        tabindex="-1" aria-labelledby="deleteModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header border-0">
                                                                    <h5 class="modal-title text-danger"
                                                                        id="deleteModalLabel">
                                                                        <i class="ri-alert-line me-2"></i>Konfirmasi
                                                                        Hapus
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body text-center py-4">
                                                                    <div class="mb-3">
                                                                        <i class="ri-delete-bin-line text-danger"
                                                                            style="font-size: 64px;"></i>
                                                                    </div>
                                                                    <h5 class="mb-2">Apakah Anda yakin?</h5>
                                                                    <p class="text-muted mb-0">
                                                                        Data Surat Pindah Sekolah ini akan dihapus
                                                                        secara permanen dan tidak dapat dikembalikan.
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
                                                                        action="{{ route('s_peng.schoolTransfers.destroy', $letter->id) }}"
                                                                        method="POST" style="display: inline;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="btn btn-danger px-4">
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
                                                Tidak Ada Data Surat Pindah Sekolah
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
        </div>
    </div>
@endsection
