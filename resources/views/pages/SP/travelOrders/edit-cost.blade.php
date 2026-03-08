@extends('layouts.app')
@section('content')
    <div class="main-content-container overflow-hidden">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
            <h3 class="mb-0">Edit Biaya Perjalanan Dinas</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb align-items-center mb-0 lh-1">
                    <li class="breadcrumb-item">
                        <a class="d-flex align-items-center text-decoration-none" href="{{ route('dashboard') }}">
                            <i class="ri-home-8-line fs-15 text-primary me-1"></i>
                            <span class="text-body fs-14 hover">Dashboard</span>
                        </a>
                    </li>
                    <li aria-current="page" class="breadcrumb-item active"><span>Surat Perintah (SP)</span></li>
                    <li aria-current="page" class="breadcrumb-item active"><span>Perjalanan Dinas</span></li>
                    <li aria-current="page" class="breadcrumb-item active"><span class="text-secondary">Edit Biaya</span>
                    </li>
                </ol>
            </nav>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Info Surat Perintah --}}
        <div class="card bg-white border border-white rounded-10 mb-4">
            <div class="card-body p-20">
                <h5 class="fs-16 fw-semibold mb-3">
                    <i class="ri-file-list-3-line text-primary me-2"></i>Surat Perintah
                </h5>
                <div class="row g-3">
                    <div class="col-lg-4">
                        <p class="text-muted mb-1 fs-14">Nomor Surat</p>
                        <p class="fw-semibold mb-0">{{ $travelOrder->letter_number }}</p>
                    </div>
                    <div class="col-lg-4">
                        <p class="text-muted mb-1 fs-14">Tujuan</p>
                        <p class="fw-semibold mb-0">{{ $travelOrder->departure_to ?? '-' }}</p>
                    </div>
                    <div class="col-lg-4">
                        <p class="text-muted mb-1 fs-14">Tanggal Keberangkatan</p>
                        <p class="fw-semibold mb-0">
                            {{ $travelOrder->departure_date ? $travelOrder->departure_date->isoFormat('D MMMM YYYY') : '-' }}
                        </p>
                    </div>
                    <div class="col-lg-12">
                        <p class="text-muted mb-1 fs-14">Petugas</p>
                        <p class="fw-semibold mb-0">
                            {{ $travelOrder->employees->map(fn($e) => $e->employee->full_name)->join(', ') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('sp.travelCosts.update', $travelOrder->id) }}" method="POST" id="costForm">
            @csrf
            @method('PUT')

            {{-- ============================================================ --}}
            {{-- INFO PENANDATANGAN                                           --}}
            {{-- ============================================================ --}}
            <div class="card bg-white border border-white rounded-10 mb-4">
                <div class="card-body p-20">
                    <h5 class="fs-16 fw-semibold mb-3">
                        <i class="ri-user-star-line text-primary me-2"></i>Penandatangan
                    </h5>
                    <div class="row g-3">

                        {{-- Kepala Sekolah — readonly, otomatis --}}
                        <div class="col-lg-6">
                            <label class="label fs-16">Kepala Sekolah <span
                                    class="text-muted fs-13">(otomatis)</span></label>
                            <div class="form-group position-relative">
                                <input type="text" class="form-control text-dark ps-5 h-55 bg-light"
                                    value="{{ $headmaster?->employee?->full_name ?? ($headmaster?->name ?? 'Tidak ditemukan') }}"
                                    readonly>
                                <i
                                    class="ri-user-crown-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                            </div>
                            @if ($headmaster)
                                <small class="text-muted">NIP: {{ $headmaster->employee?->nip ?? '-' }}</small>
                            @else
                                <small class="text-danger">Kepala sekolah dengan role yang sesuai tidak ditemukan.</small>
                            @endif
                        </div>

                        {{-- Bendahara — select --}}
                        <div class="col-lg-6">
                            <label class="label fs-16">Bendahara <span class="text-danger">*</span></label>
                            <div class="form-group position-relative">
                                <select name="treasurer_id"
                                    class="form-select text-dark ps-5 h-55 @error('treasurer_id') is-invalid @enderror">
                                    <option value="">-- Pilih Bendahara --</option>
                                    @foreach ($treasurers as $treasurer)
                                        <option value="{{ $treasurer->id }}" {{-- Untuk edit: cek apakah ini bendahara yang sudah dipilih --}}
                                            {{ old('treasurer_id', $travelOrder->treasurer_id ?? '') == $treasurer->id ? 'selected' : '' }}>
                                            {{ $treasurer->employee?->full_name ?? $treasurer->name }}
                                            @if ($treasurer->employee?->nip)
                                                — NIP {{ $treasurer->employee->nip }}
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                                <i class="ri-user-received-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"
                                    style="pointer-events:none;"></i>
                            </div>
                            @error('treasurer_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>

            {{-- ============================================================ --}}
            {{-- 1. UANG HARIAN                                               --}}
            {{-- ============================================================ --}}
            <div class="card bg-white border border-white rounded-10 mb-4">
                <div class="card-body p-20">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fs-16 fw-semibold mb-0">
                            <i class="ri-calendar-check-line text-primary me-2"></i>Uang Harian
                        </h5>
                        <button type="button" class="btn bg-primary bg-opacity-10 text-primary btn-sm fw-normal"
                            onclick="addDailyRow()">
                            <i class="ri-add-line me-1"></i> Tambah Baris
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle" id="dailyTable">
                            <thead class="table-light">
                                <tr>
                                    <th class="fw-medium">Nama Pegawai</th>
                                    <th class="fw-medium" style="width: 180px;">Nominal/Hari (Rp)</th>
                                    <th class="fw-medium" style="width: 110px;">Jumlah Hari</th>
                                    <th class="fw-medium" style="width: 190px;">Total (Rp)</th>
                                    <th class="fw-medium" style="width: 50px;"></th>
                                </tr>
                            </thead>
                            <tbody id="dailyBody">
                                @forelse ($travelOrder->dailyAllowances as $i => $daily)
                                    <tr id="daily-row-{{ $i }}">
                                        <td>
                                            <input type="text" name="daily[{{ $i }}][employee_name]"
                                                class="form-control h-45"
                                                value="{{ old('daily.' . $i . '.employee_name', $daily->employee_name) }}">
                                        </td>
                                        <td>
                                            <input type="number" name="daily[{{ $i }}][amount_per_day]"
                                                class="form-control h-45 amount-per-day" placeholder="0" min="0"
                                                step="1000"
                                                value="{{ old('daily.' . $i . '.amount_per_day', $daily->amount_per_day) }}"
                                                oninput="calcDaily({{ $i }})">
                                        </td>
                                        <td>
                                            <input type="number" name="daily[{{ $i }}][days]"
                                                class="form-control h-45 days-input" placeholder="0" min="1"
                                                value="{{ old('daily.' . $i . '.days', $daily->days) }}"
                                                oninput="calcDaily({{ $i }})">
                                        </td>
                                        <td>
                                            <input type="number" name="daily[{{ $i }}][total_amount]"
                                                class="form-control h-45 daily-total bg-light" placeholder="0" readonly
                                                value="{{ old('daily.' . $i . '.total_amount', $daily->total_amount) }}">
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-danger p-1"
                                                onclick="removeRow('daily-row-{{ $i }}')">
                                                <i class="ri-delete-bin-line fs-14"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    {{-- Jika belum ada data, tampilkan 1 baris kosong per pegawai --}}
                                    @foreach ($travelOrder->employees as $i => $particip)
                                        <tr id="daily-row-{{ $i }}">
                                            <td>
                                                <input type="text" name="daily[{{ $i }}][employee_name]"
                                                    class="form-control h-45"
                                                    value="{{ $particip->employee->full_name }}">
                                            </td>
                                            <td>
                                                <input type="number" name="daily[{{ $i }}][amount_per_day]"
                                                    class="form-control h-45 amount-per-day" placeholder="0"
                                                    min="0" step="1000"
                                                    oninput="calcDaily({{ $i }})">
                                            </td>
                                            <td>
                                                <input type="number" name="daily[{{ $i }}][days]"
                                                    class="form-control h-45 days-input" placeholder="0" min="1"
                                                    value="{{ $travelOrder->duration_days }}"
                                                    oninput="calcDaily({{ $i }})">
                                            </td>
                                            <td>
                                                <input type="number" name="daily[{{ $i }}][total_amount]"
                                                    class="form-control h-45 daily-total bg-light" placeholder="0"
                                                    readonly>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-sm btn-danger p-1"
                                                    onclick="removeRow('daily-row-{{ $i }}')">
                                                    <i class="ri-delete-bin-line fs-14"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- ============================================================ --}}
            {{-- 2. UANG SAKU                                                 --}}
            {{-- ============================================================ --}}
            <div class="card bg-white border border-white rounded-10 mb-4">
                <div class="card-body p-20">
                    <h5 class="fs-16 fw-semibold mb-3">
                        <i class="ri-wallet-line text-primary me-2"></i>Uang Saku
                    </h5>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label fs-16">Jumlah (Rp)</label>
                                <div class="form-group position-relative">
                                    <input type="number" name="pocket_money[amount]"
                                        class="form-control text-dark ps-5 h-55" placeholder="0" min="0"
                                        step="1000"
                                        value="{{ old('pocket_money.amount', $travelOrder->pocketMoney?->amount ?? 0) }}">
                                    <i
                                        class="ri-money-dollar-box-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label fs-16">Keterangan</label>
                                <div class="form-group position-relative">
                                    <input type="text" name="pocket_money[note]"
                                        class="form-control text-dark ps-5 h-55" placeholder="Keterangan (opsional)"
                                        value="{{ old('pocket_money.note', $travelOrder->pocketMoney?->note) }}">
                                    <i
                                        class="ri-sticky-note-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ============================================================ --}}
            {{-- 3. PENGINAPAN                                                --}}
            {{-- ============================================================ --}}
            <div class="card bg-white border border-white rounded-10 mb-4">
                <div class="card-body p-20">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fs-16 fw-semibold mb-0">
                            <i class="ri-hotel-line text-primary me-2"></i>Penginapan
                        </h5>
                        <button type="button" class="btn bg-primary bg-opacity-10 text-primary btn-sm fw-normal"
                            onclick="addAccommodationRow()">
                            <i class="ri-add-line me-1"></i> Tambah Baris
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="fw-medium" style="width: 180px;">Kategori</th>
                                    <th class="fw-medium">Nama Hotel</th>
                                    <th class="fw-medium" style="width: 170px;">Harga/Malam (Rp)</th>
                                    <th class="fw-medium" style="width: 120px;">Lama Menginap</th>
                                    <th class="fw-medium" style="width: 180px;">Total (Rp)</th>
                                    <th class="fw-medium" style="width: 50px;"></th>
                                </tr>
                            </thead>
                            <tbody id="accommodationBody">
                                @forelse ($travelOrder->accommodations as $i => $acc)
                                    <tr id="acc-row-{{ $i }}">
                                        <td>
                                            <select name="accommodations[{{ $i }}][category_id]"
                                                class="form-select h-45">
                                                <option value="">-- Pilih --</option>
                                                @foreach ($accommodationCategories as $cat)
                                                    <option value="{{ $cat->id }}"
                                                        {{ old('accommodations.' . $i . '.category_id', $acc->category_id) == $cat->id ? 'selected' : '' }}>
                                                        {{ $cat->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="accommodations[{{ $i }}][hotel_name]"
                                                class="form-control h-45" placeholder="Nama hotel/penginapan"
                                                value="{{ old('accommodations.' . $i . '.hotel_name', $acc->hotel_name) }}">
                                        </td>
                                        <td>
                                            <input type="number"
                                                name="accommodations[{{ $i }}][price_per_night]"
                                                class="form-control h-45 price-per-night" placeholder="0" min="0"
                                                step="1000"
                                                value="{{ old('accommodations.' . $i . '.price_per_night', $acc->price_per_night) }}"
                                                oninput="calcAccommodation({{ $i }})">
                                        </td>
                                        <td>
                                            <input type="number"
                                                name="accommodations[{{ $i }}][duration_nights]"
                                                class="form-control h-45 duration-nights" placeholder="0" min="1"
                                                value="{{ old('accommodations.' . $i . '.duration_nights', $acc->duration_nights) }}"
                                                oninput="calcAccommodation({{ $i }})">
                                        </td>
                                        <td>
                                            <input type="number"
                                                name="accommodations[{{ $i }}][total_amount]"
                                                class="form-control h-45 acc-total bg-light" placeholder="0" readonly
                                                value="{{ old('accommodations.' . $i . '.total_amount', $acc->total_amount) }}">
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-danger p-1"
                                                onclick="removeRow('acc-row-{{ $i }}')">
                                                <i class="ri-delete-bin-line fs-14"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr id="acc-row-0">
                                        <td>
                                            <select name="accommodations[0][category_id]" class="form-select h-45">
                                                <option value="">-- Pilih --</option>
                                                @foreach ($accommodationCategories as $cat)
                                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="accommodations[0][hotel_name]"
                                                class="form-control h-45" placeholder="Nama hotel/penginapan">
                                        </td>
                                        <td>
                                            <input type="number" name="accommodations[0][price_per_night]"
                                                class="form-control h-45 price-per-night" placeholder="0" min="0"
                                                step="1000" oninput="calcAccommodation(0)">
                                        </td>
                                        <td>
                                            <input type="number" name="accommodations[0][duration_nights]"
                                                class="form-control h-45 duration-nights" placeholder="0" min="1"
                                                oninput="calcAccommodation(0)">
                                        </td>
                                        <td>
                                            <input type="number" name="accommodations[0][total_amount]"
                                                class="form-control h-45 acc-total bg-light" placeholder="0" readonly>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-danger p-1"
                                                onclick="removeRow('acc-row-0')">
                                                <i class="ri-delete-bin-line fs-14"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- ============================================================ --}}
            {{-- 4. TRANSPORT                                                  --}}
            {{-- ============================================================ --}}
            <div class="card bg-white border border-white rounded-10 mb-4">
                <div class="card-body p-20">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fs-16 fw-semibold mb-0">
                            <i class="ri-car-line text-primary me-2"></i>Transport
                        </h5>
                        <button type="button" class="btn bg-primary bg-opacity-10 text-primary btn-sm fw-normal"
                            onclick="addTransportRow()">
                            <i class="ri-add-line me-1"></i> Tambah Baris
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="fw-medium" style="width: 170px;">Kategori</th>
                                    <th class="fw-medium" style="width: 160px;">Biaya (Rp)</th>
                                    <th class="fw-medium" style="width: 160px;">Nama Maskapai</th>
                                    <th class="fw-medium" style="width: 160px;">Kode Booking</th>
                                    <th class="fw-medium" style="width: 160px;">No. Tiket</th>
                                    <th class="fw-medium">Keterangan</th>
                                    <th class="fw-medium" style="width: 50px;"></th>
                                </tr>
                            </thead>
                            <tbody id="transportBody">
                                @forelse ($travelOrder->transports as $i => $trans)
                                    @php $isPesawat = $trans->category?->name && str_contains(strtolower($trans->category->name), 'pesawat'); @endphp
                                    <tr id="trans-row-{{ $i }}">
                                        <td>
                                            <select name="transports[{{ $i }}][category_id]"
                                                class="form-select h-45 transport-category"
                                                onchange="toggleAirlineFields({{ $i }}, this.value)">
                                                <option value="">-- Pilih --</option>
                                                @foreach ($transportCategories as $cat)
                                                    <option value="{{ $cat->id }}" data-name="{{ $cat->name }}"
                                                        {{ old('transports.' . $i . '.category_id', $trans->category_id) == $cat->id ? 'selected' : '' }}>
                                                        {{ $cat->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="transports[{{ $i }}][amount]"
                                                class="form-control h-45" placeholder="0" min="0" step="1000"
                                                value="{{ old('transports.' . $i . '.amount', $trans->amount) }}">
                                        </td>
                                        <td>
                                            <input type="text" name="transports[{{ $i }}][airline_name]"
                                                class="form-control h-45 airline-field"
                                                placeholder="Maskapai (jika pesawat)"
                                                value="{{ old('transports.' . $i . '.airline_name', $trans->airline_name) }}"
                                                style="opacity: {{ $isPesawat ? '1' : '0.4' }};"
                                                {{ $isPesawat ? '' : 'disabled' }}>
                                        </td>
                                        <td>
                                            <input type="text" name="transports[{{ $i }}][booking_code]"
                                                class="form-control h-45 booking-field" placeholder="Kode booking"
                                                value="{{ old('transports.' . $i . '.booking_code', $trans->booking_code) }}"
                                                style="opacity: {{ $isPesawat ? '1' : '0.4' }};"
                                                {{ $isPesawat ? '' : 'disabled' }}>
                                        </td>
                                        <td>
                                            <input type="text" name="transports[{{ $i }}][ticket_number]"
                                                class="form-control h-45 ticket-field" placeholder="No. tiket"
                                                value="{{ old('transports.' . $i . '.ticket_number', $trans->ticket_number) }}"
                                                style="opacity: {{ $isPesawat ? '1' : '0.4' }};"
                                                {{ $isPesawat ? '' : 'disabled' }}>
                                        </td>
                                        <td>
                                            <input type="text" name="transports[{{ $i }}][note]"
                                                class="form-control h-45" placeholder="Keterangan (opsional)"
                                                value="{{ old('transports.' . $i . '.note', $trans->note) }}">
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-danger p-1"
                                                onclick="removeRow('trans-row-{{ $i }}')">
                                                <i class="ri-delete-bin-line fs-14"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr id="trans-row-0">
                                        <td>
                                            <select name="transports[0][category_id]"
                                                class="form-select h-45 transport-category"
                                                onchange="toggleAirlineFields(0, this.value)">
                                                <option value="">-- Pilih --</option>
                                                @foreach ($transportCategories as $cat)
                                                    <option value="{{ $cat->id }}" data-name="{{ $cat->name }}">
                                                        {{ $cat->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="transports[0][amount]" class="form-control h-45"
                                                placeholder="0" min="0" step="1000">
                                        </td>
                                        <td>
                                            <input type="text" name="transports[0][airline_name]"
                                                class="form-control h-45 airline-field"
                                                placeholder="Maskapai (jika pesawat)" style="opacity: 0.4;" disabled>
                                        </td>
                                        <td>
                                            <input type="text" name="transports[0][booking_code]"
                                                class="form-control h-45 booking-field" placeholder="Kode booking"
                                                style="opacity: 0.4;" disabled>
                                        </td>
                                        <td>
                                            <input type="text" name="transports[0][ticket_number]"
                                                class="form-control h-45 ticket-field" placeholder="No. tiket"
                                                style="opacity: 0.4;" disabled>
                                        </td>
                                        <td>
                                            <input type="text" name="transports[0][note]" class="form-control h-45"
                                                placeholder="Keterangan (opsional)">
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-danger p-1"
                                                onclick="removeRow('trans-row-0')">
                                                <i class="ri-delete-bin-line fs-14"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- ============================================================ --}}
            {{-- 5. UANG REPRESENTATIF                                        --}}
            {{-- ============================================================ --}}
            <div class="card bg-white border border-white rounded-10 mb-4">
                <div class="card-body p-20">
                    <h5 class="fs-16 fw-semibold mb-3">
                        <i class="ri-vip-crown-line text-primary me-2"></i>Uang Representatif
                    </h5>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label fs-16">Jumlah (Rp)</label>
                                <div class="form-group position-relative">
                                    <input type="number" name="representative[amount]"
                                        class="form-control text-dark ps-5 h-55" placeholder="0" min="0"
                                        step="1000"
                                        value="{{ old('representative.amount', $travelOrder->representativeAllowance?->amount ?? 0) }}">
                                    <i
                                        class="ri-money-dollar-circle-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label fs-16">Keterangan</label>
                                <div class="form-group position-relative">
                                    <input type="text" name="representative[note]"
                                        class="form-control text-dark ps-5 h-55" placeholder="Keterangan (opsional)"
                                        value="{{ old('representative.note', $travelOrder->representativeAllowance?->note) }}">
                                    <i
                                        class="ri-sticky-note-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ============================================================ --}}
            {{-- TOMBOL SUBMIT                                                 --}}
            {{-- ============================================================ --}}
            <div class="card bg-white border border-white rounded-10 mb-4">
                <div class="card-body p-20">
                    <div class="d-flex justify-content-end gap-3">
                        <a href="{{ route('sp.travelOrders.index') }}"
                            class="btn btn-secondary py-3 px-5 fw-semibold">Batal</a>
                        <button type="submit" class="btn btn-primary py-3 px-5 fw-semibold text-white">
                            <i class="ri-save-line me-1"></i>Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>

        </form>
    </div>
@endsection

@push('scripts')
    <script>
        // Counter mulai dari jumlah baris yang sudah di-render
        let dailyCount = {{ max($travelOrder->dailyAllowances->count(), $travelOrder->employees->count(), 1) }};
        let accCount = {{ max($travelOrder->accommodations->count(), 1) }};
        let transportCount = {{ max($travelOrder->transports->count(), 1) }};

        // Kategori transport dari server (untuk toggle field pesawat)
        const transportCategories = @json($transportCategories->keyBy('id'));

        // ============================================================
        // UANG HARIAN
        // ============================================================
        function calcDaily(index) {
            const row = document.getElementById('daily-row-' + index);
            if (!row) return;
            const perDay = parseFloat(row.querySelector('.amount-per-day').value) || 0;
            const days = parseFloat(row.querySelector('.days-input').value) || 0;
            row.querySelector('.daily-total').value = perDay * days;
        }

        function addDailyRow() {
            const idx = dailyCount++;
            const body = document.getElementById('dailyBody');
            body.insertAdjacentHTML('beforeend', `
                <tr id="daily-row-${idx}">
                    <td><input type="text" name="daily[${idx}][employee_name]" class="form-control h-45" placeholder="Nama pegawai"></td>
                    <td><input type="number" name="daily[${idx}][amount_per_day]" class="form-control h-45 amount-per-day" placeholder="0" min="0" step="1000" oninput="calcDaily(${idx})"></td>
                    <td><input type="number" name="daily[${idx}][days]" class="form-control h-45 days-input" placeholder="0" min="1" oninput="calcDaily(${idx})"></td>
                    <td><input type="number" name="daily[${idx}][total_amount]" class="form-control h-45 daily-total bg-light" placeholder="0" readonly></td>
                    <td class="text-center"><button type="button" class="btn btn-sm btn-danger p-1" onclick="removeRow('daily-row-${idx}')"><i class="ri-delete-bin-line fs-14"></i></button></td>
                </tr>`);
        }

        // ============================================================
        // PENGINAPAN
        // ============================================================
        function calcAccommodation(index) {
            const row = document.getElementById('acc-row-' + index);
            if (!row) return;
            const price = parseFloat(row.querySelector('.price-per-night').value) || 0;
            const nights = parseFloat(row.querySelector('.duration-nights').value) || 0;
            row.querySelector('.acc-total').value = price * nights;
        }

        function addAccommodationRow() {
            const idx = accCount++;
            const body = document.getElementById('accommodationBody');
            const opts = @json($accommodationCategories->map(fn($c) => ['id' => $c->id, 'name' => $c->name]));
            const options = opts.map(c => `<option value="${c.id}">${c.name}</option>`).join('');
            body.insertAdjacentHTML('beforeend', `
                <tr id="acc-row-${idx}">
                    <td><select name="accommodations[${idx}][category_id]" class="form-select h-45"><option value="">-- Pilih --</option>${options}</select></td>
                    <td><input type="text" name="accommodations[${idx}][hotel_name]" class="form-control h-45" placeholder="Nama hotel/penginapan"></td>
                    <td><input type="number" name="accommodations[${idx}][price_per_night]" class="form-control h-45 price-per-night" placeholder="0" min="0" step="1000" oninput="calcAccommodation(${idx})"></td>
                    <td><input type="number" name="accommodations[${idx}][duration_nights]" class="form-control h-45 duration-nights" placeholder="0" min="1" oninput="calcAccommodation(${idx})"></td>
                    <td><input type="number" name="accommodations[${idx}][total_amount]" class="form-control h-45 acc-total bg-light" placeholder="0" readonly></td>
                    <td class="text-center"><button type="button" class="btn btn-sm btn-danger p-1" onclick="removeRow('acc-row-${idx}')"><i class="ri-delete-bin-line fs-14"></i></button></td>
                </tr>`);
        }

        // ============================================================
        // TRANSPORT
        // ============================================================
        function toggleAirlineFields(index, categoryId) {
            const row = document.getElementById('trans-row-' + index);
            if (!row) return;
            const cat = transportCategories[categoryId];
            const isPesawat = cat && cat.name.toLowerCase().includes('pesawat');
            ['airline-field', 'booking-field', 'ticket-field'].forEach(cls => {
                const el = row.querySelector('.' + cls);
                if (isPesawat) {
                    el.disabled = false;
                    el.style.opacity = '1';
                } else {
                    el.disabled = true;
                    el.style.opacity = '0.4';
                    el.value = '';
                }
            });
        }

        function addTransportRow() {
            const idx = transportCount++;
            const body = document.getElementById('transportBody');
            const opts = @json($transportCategories->map(fn($c) => ['id' => $c->id, 'name' => $c->name]));
            const options = opts.map(c => `<option value="${c.id}" data-name="${c.name}">${c.name}</option>`).join('');
            body.insertAdjacentHTML('beforeend', `
                <tr id="trans-row-${idx}">
                    <td><select name="transports[${idx}][category_id]" class="form-select h-45 transport-category" onchange="toggleAirlineFields(${idx}, this.value)"><option value="">-- Pilih --</option>${options}</select></td>
                    <td><input type="number" name="transports[${idx}][amount]" class="form-control h-45" placeholder="0" min="0" step="1000"></td>
                    <td><input type="text" name="transports[${idx}][airline_name]" class="form-control h-45 airline-field" placeholder="Maskapai" style="opacity:0.4;" disabled></td>
                    <td><input type="text" name="transports[${idx}][booking_code]" class="form-control h-45 booking-field" placeholder="Kode booking" style="opacity:0.4;" disabled></td>
                    <td><input type="text" name="transports[${idx}][ticket_number]" class="form-control h-45 ticket-field" placeholder="No. tiket" style="opacity:0.4;" disabled></td>
                    <td><input type="text" name="transports[${idx}][note]" class="form-control h-45" placeholder="Keterangan"></td>
                    <td class="text-center"><button type="button" class="btn btn-sm btn-danger p-1" onclick="removeRow('trans-row-${idx}')"><i class="ri-delete-bin-line fs-14"></i></button></td>
                </tr>`);
        }

        // ============================================================
        // HAPUS BARIS
        // ============================================================
        function removeRow(rowId) {
            const row = document.getElementById(rowId);
            if (row) row.remove();
        }
    </script>
@endpush
