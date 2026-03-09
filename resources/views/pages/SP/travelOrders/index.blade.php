@extends('layouts.app')
@section('content')
    <div class="main-content-container overflow-hidden">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
            <h3 class="mb-0">Tabel Data</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb align-items-center mb-0 lh-1">
                    <li class="breadcrumb-item">
                        <a class="d-flex align-items-center text-decoration-none" href="index.html">
                            <i class="ri-home-8-line fs-15 text-primary me-1"></i>
                            <span class="text-body fs-14 hover">Dashboard</span>
                        </a>
                    </li>
                    <li aria-current="page" class="breadcrumb-item active"><span>Surat Perintah (SP)</span></li>
                    <li aria-current="page" class="breadcrumb-item active"><span>Perjalanan Dinas</span></li>
                    <li aria-current="page" class="breadcrumb-item active"><span class="text-secondary">Tabel Data</span>
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
                <h3>Surat Perintah Perjalanan Dinas</h3>

                {{-- ── Tombol kanan: Export Excel + Tambah Surat ── --}}
                <div class="d-flex align-items-center gap-2">

                    {{-- Tombol Export Excel --}}
                    <button type="button" class="btn bg-success bg-opacity-10 fw-normal fs-16 text-success"
                        data-bs-toggle="modal" data-bs-target="#modalExportExcel">
                        <i class="ri-file-excel-2-line me-1"></i>
                        Export Excel
                    </button>

                    {{-- Tombol Tambah Surat --}}
                    <a href="{{ route('sp.travelOrders.create') }}"
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
                            <button aria-controls="pills-sppd" aria-selected="true" class="nav-link active"
                                data-bs-target="#pills-sppd" data-bs-toggle="pill" id="pills-sppd-tab" role="tab"
                                type="button">
                                <i class="ri-file-text-line me-1"></i>
                                Surat Perintah
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button aria-controls="pills-biaya" aria-selected="false" class="nav-link"
                                data-bs-target="#pills-biaya" data-bs-toggle="pill" id="pills-biaya-tab" role="tab"
                                type="button">
                                <i class="ri-money-dollar-circle-line me-1"></i>
                                Biaya Perjalanan Dinas
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content" id="pills-tabContent">

                        {{-- ==================== TAB 1: SPPD ==================== --}}
                        <div aria-labelledby="pills-sppd-tab" class="tab-pane fade show active" id="pills-sppd"
                            role="tabpanel" tabindex="0">
                            <div class="default-table-area mx-minus-1 table-contact-list">
                                <div class="table-responsive">
                                    <table class="table align-middle" id="myTable">
                                        <thead>
                                            <tr>
                                                <th class="fw-medium pe-0 rtl-pe" scope="col">Nomor Surat</th>
                                                <th class="fw-medium" scope="col">Petugas</th>
                                                <th class="fw-medium" scope="col">Berangkat dari</th>
                                                <th class="fw-medium" scope="col">Tujuan</th>
                                                <th class="fw-medium" scope="col">Durasi</th>
                                                <th class="fw-medium" scope="col">Dibuat oleh</th>
                                                <th class="fw-medium" scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($travelOrders as $sppd)
                                                <tr>
                                                    <td class="text-body pe-0 rtl-pe">{{ $sppd->letter_number }}</td>
                                                    <td>
                                                        <div class="flex-grow-1">
                                                            @foreach ($sppd->employees as $particip)
                                                                <li>
                                                                    <h4 class="fw-medium fs-16 mb-0">
                                                                        {{ $particip->employee->full_name }}
                                                                    </h4>
                                                                </li>
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                    <td class="text-body">{{ $sppd->departure_place }}</td>
                                                    <td class="text-body">{{ $sppd->departure_to }}</td>
                                                    <td class="text-body">{{ $sppd->duration_days }}</td>
                                                    <td>
                                                        <span
                                                            class="text-success bg-success bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                                            {{ $sppd->createdBy->name }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-end align-items-center"
                                                            style="gap: 12px;">

                                                            {{-- Tombol Tambah Biaya --}}
                                                            <a class="bg-transparent p-0 border-0 hover-text-success"
                                                                href="{{ route('sp.travelCosts.create', $sppd->id) }}"
                                                                data-bs-placement="top" data-bs-title="Tambah Biaya"
                                                                data-bs-toggle="tooltip">
                                                                <i
                                                                    class="material-symbols-outlined fs-16 fw-normal text-success">payments</i>
                                                            </a>

                                                            {{-- Print --}}
                                                            <a class="bg-transparent p-0 border-0 hover-text-secondary"
                                                                target="_blank"
                                                                href="{{ route('sp.travelOrders.preview', $sppd->id) }}"
                                                                data-bs-placement="top" data-bs-title="Print"
                                                                data-bs-toggle="tooltip">
                                                                <i
                                                                    class="material-symbols-outlined fs-16 fw-normal text-secondary">print</i>
                                                            </a>

                                                            {{-- Edit --}}
                                                            <a class="bg-transparent p-0 border-0 hover-text-primary"
                                                                href="{{ route('sp.travelOrders.edit', $sppd->id) }}"
                                                                data-bs-placement="top" data-bs-title="Edit"
                                                                data-bs-toggle="tooltip">
                                                                <i
                                                                    class="material-symbols-outlined fs-16 fw-normal text-primary">edit</i>
                                                            </a>

                                                            {{-- Hapus --}}
                                                            <button class="bg-transparent p-0 border-0 hover-text-danger"
                                                                type="button" data-bs-toggle="modal"
                                                                data-bs-target="#deleteSPPD{{ $sppd->id }}">
                                                                <i
                                                                    class="material-symbols-outlined fs-16 fw-normal text-danger">delete</i>
                                                            </button>

                                                            {{-- Modal Hapus --}}
                                                            <div class="modal fade" id="deleteSPPD{{ $sppd->id }}"
                                                                tabindex="-1" aria-labelledby="deleteSPPDLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header border-0">
                                                                            <h5 class="modal-title text-danger">
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
                                                                                Data Surat Perintah Perjalanan Dinas ini
                                                                                akan dihapus secara permanen dan tidak dapat
                                                                                dikembalikan.
                                                                            </p>
                                                                            <p class="text-muted mt-2 mb-0">
                                                                                <strong>Nomor Surat:
                                                                                    <span>{{ $sppd->letter_number }}</span></strong>
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
                                                                                action="{{ route('sp.travelOrders.destroy', $sppd->id) }}"
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
                                                        Tidak Ada Data SPPD
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        {{-- ==================== TAB 2: BIAYA PERJALANAN DINAS ==================== --}}
                        <div aria-labelledby="pills-biaya-tab" class="tab-pane fade" id="pills-biaya" role="tabpanel"
                            tabindex="0">
                            <div class="default-table-area mx-minus-1 table-contact-list">
                                <div class="table-responsive">
                                    <table class="table align-middle" id="myTable2">
                                        <thead>
                                            <tr>
                                                <th class="fw-medium pe-0 rtl-pe" scope="col">Nomor Surat</th>
                                                <th class="fw-medium" scope="col">Petugas</th>
                                                <th class="fw-medium" scope="col">Tujuan</th>
                                                <th class="fw-medium" scope="col">Uang Harian</th>
                                                <th class="fw-medium" scope="col">Transport</th>
                                                <th class="fw-medium" scope="col">Penginapan</th>
                                                <th class="fw-medium" scope="col">Total</th>
                                                <th class="fw-medium" scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($travelCosts as $cost)
                                                @php
                                                    $totalPocketMoney = (float) ($cost->pocketMoney?->amount ?? 0);
                                                    $totalRepresentative =
                                                        (float) ($cost->representativeAllowance?->amount ?? 0);
                                                    $totalDailyAllowance = (float) $cost->dailyAllowances->sum(
                                                        'total_amount',
                                                    );
                                                    $totalTransport = (float) $cost->transports->sum('amount');
                                                    $totalAccommodation = (float) $cost->accommodations->sum(
                                                        'total_amount',
                                                    );
                                                    $grandTotal =
                                                        $totalPocketMoney +
                                                        $totalDailyAllowance +
                                                        $totalRepresentative +
                                                        $totalTransport +
                                                        $totalAccommodation;
                                                @endphp
                                                <tr>
                                                    <td class="text-body pe-0 rtl-pe">{{ $cost->letter_number }}</td>
                                                    <td>
                                                        <div class="flex-grow-1">
                                                            @foreach ($cost->employees as $particip)
                                                                <li>
                                                                    <h4 class="fw-medium fs-14 mb-0">
                                                                        {{ $particip->employee->full_name }}
                                                                    </h4>
                                                                </li>
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                    <td class="text-body">{{ $cost->departure_to }}</td>
                                                    <td class="text-body">
                                                        @if ($totalDailyAllowance > 0)
                                                            Rp {{ number_format($totalDailyAllowance, 0, ',', '.') }}
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-body">
                                                        @if ($totalTransport > 0)
                                                            Rp {{ number_format($totalTransport, 0, ',', '.') }}
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-body">
                                                        @if ($totalAccommodation > 0)
                                                            Rp {{ number_format($totalAccommodation, 0, ',', '.') }}
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-body">
                                                        <span
                                                            class="text-primary bg-primary bg-opacity-10 fs-14 fw-medium d-inline-block px-2 py-1 rounded">
                                                            Rp {{ number_format($grandTotal, 0, ',', '.') }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-end align-items-center"
                                                            style="gap: 12px;">

                                                            {{-- Edit Biaya --}}
                                                            <a class="bg-transparent p-0 border-0 hover-text-primary"
                                                                href="{{ route('sp.travelCosts.edit', $cost->id) }}"
                                                                data-bs-placement="top" data-bs-title="Edit Biaya"
                                                                data-bs-toggle="tooltip">
                                                                <i
                                                                    class="material-symbols-outlined fs-16 fw-normal text-primary">edit</i>
                                                            </a>

                                                            {{-- Print Biaya --}}
                                                            <a class="bg-transparent p-0 border-0 hover-text-secondary"
                                                                target="_blank"
                                                                href="{{ route('sp.travelCosts.preview', $cost->id) }}"
                                                                data-bs-placement="top" data-bs-title="Print"
                                                                data-bs-toggle="tooltip">
                                                                <i
                                                                    class="material-symbols-outlined fs-16 fw-normal text-secondary">print</i>
                                                            </a>

                                                            {{-- Hapus Biaya --}}
                                                            <button class="bg-transparent p-0 border-0 hover-text-danger"
                                                                type="button" data-bs-toggle="modal"
                                                                data-bs-target="#deleteCost{{ $cost->id }}">
                                                                <i
                                                                    class="material-symbols-outlined fs-16 fw-normal text-danger">delete</i>
                                                            </button>

                                                            {{-- Modal Hapus Biaya --}}
                                                            <div class="modal fade" id="deleteCost{{ $cost->id }}"
                                                                tabindex="-1" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header border-0">
                                                                            <h5 class="modal-title text-danger">
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
                                                                                Data biaya perjalanan dinas ini akan dihapus
                                                                                secara permanen dan tidak dapat
                                                                                dikembalikan.
                                                                            </p>
                                                                            <p class="text-muted mt-2 mb-0">
                                                                                <strong>Nomor Surat:
                                                                                    <span>{{ $cost->letter_number }}</span></strong>
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
                                                                                action="{{ route('sp.travelCosts.destroy', $cost->id) }}"
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
                                                    <td class="text-body text-center" colspan="10">
                                                        Tidak Ada Data Biaya Perjalanan Dinas
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

    {{-- ================================================================ --}}
    {{-- MODAL EXPORT EXCEL                                               --}}
    {{-- ================================================================ --}}
    <div class="modal fade" id="modalExportExcel" tabindex="-1" aria-labelledby="modalExportExcelLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fs-18 fw-semibold" id="modalExportExcelLabel">
                        <i class="ri-file-excel-2-line text-success me-2"></i>
                        Export Rekap Perjalanan Dinas
                    </h5>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <form action="{{ route('sp.travelOrders.export-excel') }}" method="GET" id="formExportExcel">
                    <div class="modal-body pt-3 pb-1">
                        <p class="text-muted fs-14 mb-3">
                            Pilih rentang tanggal keberangkatan untuk data yang akan diekspor ke Excel.
                        </p>

                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label class="label fs-15 mb-1" for="export_date_from">
                                    Tanggal Mulai <span class="text-danger">*</span>
                                </label>
                                <div class="form-group position-relative">
                                    <input type="date" id="export_date_from" name="date_from"
                                        class="form-control ps-5 h-55" value="{{ date('Y-01-01') }}" required>
                                    <i
                                        class="ri-calendar-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="label fs-15 mb-1" for="export_date_to">
                                    Tanggal Akhir <span class="text-danger">*</span>
                                </label>
                                <div class="form-group position-relative">
                                    <input type="date" id="export_date_to" name="date_to"
                                        class="form-control ps-5 h-55" value="{{ date('Y-12-31') }}" required>
                                    <i
                                        class="ri-calendar-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-success bg-success bg-opacity-10 border-0 mt-3 mb-0 fs-13 py-2">
                            <i class="ri-information-line me-1"></i>
                            File Excel akan diunduh sesuai format Rekap Perjadin Dalam dan Luar Kota.
                        </div>
                    </div>

                    <div class="modal-footer border-0 pt-2">
                        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                            <i class="ri-close-line me-1"></i>Batal
                        </button>
                        <button type="submit" class="btn btn-success px-4" id="btnExportSubmit">
                            <i class="ri-download-2-line me-1"></i>
                            <span id="btnExportText">Download Excel</span>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi tabel kedua
            if (document.getElementById('myTable2')) {
                const table2 = new RdataTB('myTable2', {
                    ShowSearch: true,
                    ShowSelect: true,
                    ShowPaginate: true,
                    SelectionNumber: [10, 15, 20, 50]
                });
            }

            // Export form: loading state saat submit
            const form = document.getElementById('formExportExcel');
            const btn = document.getElementById('btnExportSubmit');
            const txt = document.getElementById('btnExportText');

            if (form) {
                form.addEventListener('submit', function(e) {
                    const dateFrom = document.getElementById('export_date_from').value;
                    const dateTo = document.getElementById('export_date_to').value;

                    if (!dateFrom || !dateTo) {
                        e.preventDefault();
                        alert('Tanggal mulai dan akhir wajib diisi.');
                        return;
                    }

                    if (new Date(dateTo) < new Date(dateFrom)) {
                        e.preventDefault();
                        alert('Tanggal akhir tidak boleh sebelum tanggal mulai.');
                        return;
                    }

                    // Loading state
                    btn.disabled = true;
                    txt.textContent = 'Memproses...';
                    btn.innerHTML =
                        '<span class="spinner-border spinner-border-sm me-2" role="status"></span>' + txt
                        .textContent;

                    // Re-enable setelah 5 detik (download sudah mulai)
                    setTimeout(function() {
                        btn.disabled = false;
                        btn.innerHTML = '<i class="ri-download-2-line me-1"></i>Download Excel';

                        // Tutup modal setelah download
                        const modal = bootstrap.Modal.getInstance(document.getElementById(
                            'modalExportExcel'));
                        if (modal) modal.hide();
                    }, 5000);
                });
            }
        });
    </script>
@endpush
