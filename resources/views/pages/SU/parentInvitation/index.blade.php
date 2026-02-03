@extends('layouts.app')

@section('content')
    <div class="main-content-container overflow-hidden">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
            <h3 class="mb-0">Surat Undangan Orang Tua</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb align-items-center mb-0 lh-1">
                    <li class="breadcrumb-item">
                        <a class="d-flex align-items-center text-decoration-none" href="{{ route('dashboard') }}">
                            <i class="ri-home-8-line fs-15 text-primary me-1"></i>
                            <span class="text-body fs-14 hover">Dashboard</span>
                        </a>
                    </li>
                    <li aria-current="page" class="breadcrumb-item active">
                        <span>Surat Undangan (SP)</span>
                    </li>
                    <li aria-current="page" class="breadcrumb-item active">
                        <span class="text-secondary">Undangan Orang Tua</span>
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
                <h3>Surat Undangan Orang Tua</h3>
                <div class="dropdown select-dropdown without-border">
                    <a href="{{ route('su.parentInvitations.create') }}"
                        class="btn bg-primary bg-opacity-10 fw-normal fs-16 text-primary">
                        <i class="ri-add-line"></i>
                        Tambah Surat
                    </a>
                </div>
            </div>

            <div class="tab-content mt-3" id="myTabContent3">
                <div aria-labelledby="preview3-tab" class="tab-pane fade show active" id="preview3-tab-pane" role="tabpanel"
                    tabindex="0">
                    <ul class="nav nav-pills mb-3 px-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button aria-controls="pills-home" aria-selected="true" class="nav-link active"
                                data-bs-target="#pills-home" data-bs-toggle="pill" id="pills-home-tab" role="tab"
                                type="button">
                                Individual
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button aria-controls="pills-profile" aria-selected="false" class="nav-link"
                                data-bs-target="#pills-profile" data-bs-toggle="pill" id="pills-profile-tab" role="tab"
                                type="button">
                                Umum
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content" id="pills-tabContent">
                        <!-- TAB INDIVIDUAL -->
                        <div aria-labelledby="pills-home-tab" class="tab-pane fade show active" id="pills-home"
                            role="tabpanel" tabindex="0">
                            <div class="default-table-area mx-minus-1 table-contact-list">
                                <div class="table-responsive">
                                    <table class="table align-middle" id="myTable">
                                        <thead>
                                            <tr>
                                                <th class="fw-medium pe-0 rtl-pe" scope="col">Nomor Surat</th>
                                                <th class="fw-medium" scope="col">Nama Siswa</th>
                                                <th class="fw-medium" scope="col">Bertemu dengan</th>
                                                <th class="fw-medium" scope="col">Tempat</th>
                                                <th class="fw-medium" scope="col">Tanggal</th>
                                                <th class="fw-medium" scope="col">Dibuat oleh</th>
                                                <th class="fw-medium" scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($parentInvitations as $pi)
                                                <tr>
                                                    <td class="text-body pe-0 rtl-pe">{{ $pi->letter_number }}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-grow-1">
                                                                <div class="mb-1">
                                                                    <h4 class="fw-medium fs-14 mb-0">
                                                                        {{ $pi->student->student->full_name }}
                                                                    </h4>
                                                                    <span class="fs-12 text-muted">
                                                                        {{ $pi->student->student->student_number }}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-body">{{ $pi->meeting_with }}</td>
                                                    <td class="text-body">{{ $pi->meeting_place }}</td>
                                                    <td class="text-body">
                                                        {{ $pi->meeting_date ? \Carbon\Carbon::parse($pi->meeting_date)->format('d/m/Y') : '-' }}
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="text-success bg-success bg-opacity-10 fs-15 fw-normal d-inline-block px-2 py-1 rounded">
                                                            {{ $pi->createdBy->name }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-end" style="gap: 12px;">
                                                            <a class="bg-transparent p-0 border-0 hover-text-secondary"
                                                                href="{{ route('su.parentInvitation.print', $pi->id) }}"
                                                                data-bs-placement="top" data-bs-title="View"
                                                                data-bs-toggle="tooltip">
                                                                <i
                                                                    class="material-symbols-outlined fs-16 fw-normal text-secondary">
                                                                    print
                                                                </i>
                                                            </a>
                                                            <a class="bg-transparent p-0 border-0 hover-text-primary"
                                                                href="{{ route('su.parentInvitations.edit', $pi->id) }}"
                                                                data-bs-placement="top" data-bs-title="Edit"
                                                                data-bs-toggle="tooltip">
                                                                <i
                                                                    class="material-symbols-outlined fs-16 fw-normal text-primary">
                                                                    edit
                                                                </i>
                                                            </a>
                                                            <button class="bg-transparent p-0 border-0 hover-text-danger"
                                                                type="button" data-bs-toggle="modal"
                                                                data-bs-target="#deleteSPUO{{ $pi->id }}">
                                                                <i
                                                                    class="material-symbols-outlined fs-16 fw-normal text-danger">
                                                                    delete
                                                                </i>
                                                            </button>

                                                            <!-- Modal Delete -->
                                                            <div class="modal fade" id="deleteSPUO{{ $pi->id }}"
                                                                tabindex="-1" aria-labelledby="deleteSPUOLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header border-0">
                                                                            <h5 class="modal-title text-danger"
                                                                                id="deleteSPUOLabel">
                                                                                <i
                                                                                    class="ri-alert-line me-2"></i>Konfirmasi
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
                                                                                Data Surat Undangan Orang Tua ini akan
                                                                                dihapus
                                                                                secara permanen dan tidak dapat
                                                                                dikembalikan.
                                                                            </p>
                                                                            <p class="text-muted mt-2 mb-0">
                                                                                <strong>Nomor Surat:
                                                                                    <span>{{ $pi->letter_number }}</span></strong>
                                                                            </p>
                                                                        </div>
                                                                        <div
                                                                            class="modal-footer border-0 justify-content-center">
                                                                            <button type="button"
                                                                                class="btn btn-secondary px-4"
                                                                                data-bs-dismiss="modal">
                                                                                <i class="ri-close-line me-1"></i>Batal
                                                                            </button>
                                                                            <form
                                                                                action="{{ route('su.parentInvitations.destroy', $pi->id) }}"
                                                                                method="POST" style="display: inline;">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit"
                                                                                    class="btn btn-danger px-4">
                                                                                    <i
                                                                                        class="ri-delete-bin-line me-1"></i>Hapus
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
                                                        Tidak Ada Data Surat Undangan Individual
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- TAB UMUM -->
                        <div aria-labelledby="pills-profile-tab" class="tab-pane fade" id="pills-profile"
                            role="tabpanel" tabindex="0">
                            <div class="default-table-area mx-minus-1 table-contact-list">
                                <div class="table-responsive">
                                    <table class="table align-middle" id="myTable3">
                                        <thead>
                                            <tr>
                                                <th class="fw-medium pe-0 rtl-pe" scope="col">Nomor Surat</th>
                                                <th class="fw-medium" scope="col">Kepada</th>
                                                <th class="fw-medium" scope="col">Tujuan</th>
                                                <th class="fw-medium" scope="col">Tempat</th>
                                                <th class="fw-medium" scope="col">Tanggal</th>
                                                <th class="fw-medium" scope="col">Dibuat oleh</th>
                                                <th class="fw-medium" scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($generalInvitation as $gi)
                                                <tr>
                                                    <td class="text-body pe-0 rtl-pe">{{ $gi->letter_number }}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-grow-1">
                                                                <span class="badge bg-info">
                                                                    {{ $gi->to }} Siswa
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-body">{{ $gi->purpose }}</td>
                                                    <td class="text-body">{{ $gi->meeting_place }}</td>
                                                    <td class="text-body">
                                                        {{ $gi->meeting_date ? \Carbon\Carbon::parse($gi->meeting_date)->format('d/m/Y') : '-' }}
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="text-success bg-success bg-opacity-10 fs-15 fw-normal d-inline-block px-2 py-1 rounded">
                                                            {{ $gi->createdBy->name }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-end" style="gap: 12px;">
                                                            <a class="bg-transparent p-0 border-0 hover-text-secondary"
                                                                href="{{ route('su.parentInvitation.print', $gi->id) }}"
                                                                data-bs-placement="top" data-bs-title="View"
                                                                data-bs-toggle="tooltip">
                                                                <i
                                                                    class="material-symbols-outlined fs-16 fw-normal text-secondary">
                                                                    print
                                                                </i>
                                                            </a>
                                                            <a class="bg-transparent p-0 border-0 hover-text-primary"
                                                                href="{{ route('su.parentInvitations.edit', $gi->id) }}"
                                                                data-bs-placement="top" data-bs-title="Edit"
                                                                data-bs-toggle="tooltip">
                                                                <i
                                                                    class="material-symbols-outlined fs-16 fw-normal text-primary">
                                                                    edit
                                                                </i>
                                                            </a>
                                                            <button class="bg-transparent p-0 border-0 hover-text-danger"
                                                                type="button" data-bs-toggle="modal"
                                                                data-bs-target="#deleteSPUO{{ $gi->id }}">
                                                                <i
                                                                    class="material-symbols-outlined fs-16 fw-normal text-danger">
                                                                    delete
                                                                </i>
                                                            </button>

                                                            <!-- Modal Delete -->
                                                            <div class="modal fade" id="deleteSPUO{{ $gi->id }}"
                                                                tabindex="-1" aria-labelledby="deleteSPUOLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header border-0">
                                                                            <h5 class="modal-title text-danger"
                                                                                id="deleteSPUOLabel">
                                                                                <i
                                                                                    class="ri-alert-line me-2"></i>Konfirmasi
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
                                                                                Data Surat Undangan Orang Tua ini akan
                                                                                dihapus
                                                                                secara permanen dan tidak dapat
                                                                                dikembalikan.
                                                                            </p>
                                                                            <p class="text-muted mt-2 mb-0">
                                                                                <strong>Nomor Surat:
                                                                                    <span>{{ $gi->letter_number }}</span></strong>
                                                                            </p>
                                                                        </div>
                                                                        <div
                                                                            class="modal-footer border-0 justify-content-center">
                                                                            <button type="button"
                                                                                class="btn btn-secondary px-4"
                                                                                data-bs-dismiss="modal">
                                                                                <i class="ri-close-line me-1"></i>Batal
                                                                            </button>
                                                                            <form
                                                                                action="{{ route('su.parentInvitations.destroy', $gi->id) }}"
                                                                                method="POST" style="display: inline;">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit"
                                                                                    class="btn btn-danger px-4">
                                                                                    <i
                                                                                        class="ri-delete-bin-line me-1"></i>Hapus
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
                                                        Tidak Ada Data Surat Undangan Umum
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
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi tabel pertama (Tab Individual)

            // Inisialisasi tabel kedua (Tab Umum)
            if (document.getElementById('myTable3')) {
                const table2 = new RdataTB('myTable3', {
                    ShowSearch: true,
                    ShowSelect: true,
                    ShowPaginate: true,
                    SelectionNumber: [5, 10, 20, 50]
                });
            }
        });
    </script>
@endpush
