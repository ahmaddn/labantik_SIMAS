@extends('layouts.app')
@section('content')
    <div class="main-content-container overflow-hidden">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
            <h3 class="mb-0">Edit Data</h3>
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
                    <li aria-current="page" class="breadcrumb-item active">
                        <span class="text-secondary">Edit Data</span>
                    </li>
                </ol>
            </nav>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h6 class="alert-heading fw-bold mb-1"><i class="ri-error-warning-line me-1"></i> Periksa kembali inputan Anda:</h6>
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card bg-white border border-white rounded-10 mb-4">
                    <div class="card-body p-20">
                        <h4 class="fs-18 fw-medium mb-20">Edit Data SPPD</h4>

                        <div class="tab-content" id="myTab2Content">
                            <div aria-labelledby="preview2-tab" class="tab-pane fade show active" id="preview2-tab-pane"
                                role="tabpanel" tabindex="0">
                                <ul class="nav nav-tabs justify-content-between border-0 mb-4 wizard-tabs2" id="myTabstep2"
                                    role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button aria-controls="step5-tab-pane" aria-selected="true"
                                            class="nav-link p-0 d-flex align-items-center active"
                                            data-bs-target="#step5-tab-pane" data-bs-toggle="tab" id="step5-tab"
                                            role="tab" type="button">
                                            <span class="fs-20 fw-bold text-primary wh-48 bg-primary bg-opacity-10 rounded-circle d-inline-block">1</span>
                                            <div class="text-start ms-3 d-none d-lg-block">
                                                <h4 class="fs-18 fw-semibold">Informasi Personal</h4>
                                                <p class="text-gray-light mb-0">Isi Informasi Personal & Petugas</p>
                                            </div>
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button aria-controls="step6-tab-pane" aria-selected="false"
                                            class="nav-link p-0 d-flex align-items-center" data-bs-target="#step6-tab-pane"
                                            data-bs-toggle="tab" id="step6-tab" role="tab" type="button">
                                            <span class="fs-20 fw-bold text-primary wh-48 bg-primary bg-opacity-10 rounded-circle d-inline-block">2</span>
                                            <div class="text-start ms-3 d-none d-lg-block">
                                                <h4 class="fs-18 fw-semibold">Detail Perjalanan</h4>
                                                <p class="text-gray-light mb-0">Atur Informasi Perjalanan Dinas</p>
                                            </div>
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button aria-controls="step7-tab-pane" aria-selected="false"
                                            class="nav-link p-0 d-flex align-items-center" data-bs-target="#step7-tab-pane"
                                            data-bs-toggle="tab" id="step7-tab" role="tab" type="button">
                                            <span class="fs-20 fw-bold text-primary wh-48 bg-primary bg-opacity-10 rounded-circle d-inline-block">3</span>
                                            <div class="text-start ms-3 d-none d-lg-block">
                                                <h4 class="fs-18 fw-semibold">Informasi Tambahan</h4>
                                                <p class="text-gray-light mb-0">Isi Informasi Anggaran & Tanggal</p>
                                            </div>
                                        </button>
                                    </li>
                                </ul>

                                <form action="{{ route('sp.travelOrders.update', $travelOrder->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="tab-content" id="myTabstep2Content">
                                        <!-- Step 1: Informasi Personal -->
                                        <div aria-labelledby="step5-tab" class="tab-pane fade show active"
                                            id="step5-tab-pane" role="tabpanel" tabindex="0">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">Nomor Surat <span class="text-danger">*</span></label>
                                                        <div class="form-group position-relative">
                                                            <input type="text" name="letter_number"
                                                                class="form-control text-dark ps-5 h-55 @error('letter_number') is-invalid @enderror"
                                                                value="{{ old('letter_number', $travelOrder->letter_number) }}"
                                                                placeholder="Masukkan Nomor Surat" required>
                                                            <i class="ri-hashtag position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                        </div>
                                                        @error('letter_number')
                                                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">Tujuan (Maksud Perjalanan) <span class="text-danger">*</span></label>
                                                        <div class="position-relative">
                                                            <input name="purpose"
                                                                class="form-control ps-5 text-gray-light h-55 @error('purpose') is-invalid @enderror"
                                                                placeholder="Isi Tujuan"
                                                                value="{{ old('purpose', $travelOrder->purpose) }}" required>
                                                            <i class="ri-todo-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                        </div>
                                                        @error('purpose')
                                                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">Dasar <span class="text-danger">*</span></label>
                                                        <div class="position-relative">
                                                            <textarea name="base" rows="3" class="form-control ps-5 text-gray-light @error('base') is-invalid @enderror"
                                                                placeholder="Isi Dasar Surat Perintah, contoh: Surat Dinas No. 001/2025..." required>{{ old('base', $travelOrder->base) }}</textarea>
                                                            <i class="ri-file-list-3-line position-absolute top-0 mt-3 start-0 fs-20 text-gray-light ps-20"></i>
                                                        </div>
                                                        @error('base')
                                                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">Ditugaskan kepada <span class="text-danger">*</span></label>
                                                        <div class="form-group position-relative">
                                                            <select name="petugas_id[]" id="petugas" multiple style="width:100%" required>
                                                                @foreach ($petugasData as $petugas)
                                                                    <option value="{{ $petugas->id }}" selected>
                                                                        {{ $petugas->full_name }} {{ $petugas->nip ? '(NIP: ' . $petugas->nip . ')' : '' }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        @error('petugas_id')
                                                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">Pengikut</label>
                                                        <div class="position-relative">
                                                            <select name="pengikut_ids[]" id="pengikut" multiple style="width:100%">
                                                                @foreach ($pengikutData as $pengikut)
                                                                    <option value="{{ $pengikut->id }}" selected>
                                                                        {{ $pengikut->full_name }} {{ $pengikut->nip ? '(NIP: ' . $pengikut->nip . ')' : '' }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        @error('pengikut_ids')
                                                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                {{-- BARIS INPUT JABATAN DINAMIS PER PETUGAS --}}
                                                <div class="col-lg-12 mb-4">
                                                    <div id="petugas-positions-card" class="card border rounded-10 p-3 bg-light">
                                                        <h6 class="fw-bold mb-3"><i class="ri-shield-user-line me-1 text-primary"></i> Atur Jabatan untuk yang Ditugaskan:</h6>
                                                        <div id="petugas-positions-container" class="d-flex flex-column gap-3"></div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group d-flex justify-content-between gap-3 mt-3">
                                                        <a href="{{ route('sp.travelOrders.index') }}"
                                                            class="btn btn-secondary py-3 px-5 fw-semibold">
                                                            <i class="ri-arrow-left-line me-1"></i> Kembali ke Daftar
                                                        </a>
                                                        <button type="button" class="btn btn-primary py-3 px-5 fw-semibold text-white btn-next-step" data-next="#step6-tab">
                                                            Lanjut ke Detail Perjalanan <i class="ri-arrow-right-line ms-1"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Step 2: Detail Perjalanan -->
                                        <div aria-labelledby="step6-tab" class="tab-pane fade" id="step6-tab-pane"
                                            role="tabpanel" tabindex="0">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">Tempat Surat Dikeluarkan <span class="text-danger">*</span></label>
                                                        <div class="form-group position-relative">
                                                            <input name="departure_from"
                                                                class="form-control ps-5 text-gray-light h-55 @error('departure_from') is-invalid @enderror"
                                                                placeholder="Isi Tempat Surat Dikeluarkan"
                                                                value="{{ old('departure_from', $travelOrder->departure_from) }}" required>
                                                            <i class="ri-map-pin-2-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                        </div>
                                                        @error('departure_from')
                                                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">Tempat Keberangkatan <span class="text-danger">*</span></label>
                                                        <div class="form-group position-relative">
                                                            <input name="departure_place"
                                                                class="form-control ps-5 text-gray-light h-55 @error('departure_place') is-invalid @enderror"
                                                                placeholder="Isi Tempat Keberangkatan"
                                                                value="{{ old('departure_place', $travelOrder->departure_place) }}" required>
                                                            <i class="ri-map-pin-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                        </div>
                                                        @error('departure_place')
                                                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">Tempat Tujuan <span class="text-danger">*</span></label>
                                                        <div class="form-group position-relative">
                                                            <input name="departure_to"
                                                                class="form-control ps-5 text-gray-light h-55 @error('departure_to') is-invalid @enderror"
                                                                placeholder="Isi Tempat Tujuan"
                                                                value="{{ old('departure_to', $travelOrder->departure_to) }}" required>
                                                            <i class="ri-map-pin-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                        </div>
                                                        @error('departure_to')
                                                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">Tanggal Keberangkatan <span class="text-danger">*</span></label>
                                                        <div class="form-group position-relative">
                                                            <input name="departure_date" id="departure_date" type="date"
                                                                class="form-control ps-5 text-gray-light h-55 @error('departure_date') is-invalid @enderror"
                                                                value="{{ old('departure_date', $travelOrder->departure_date?->format('Y-m-d')) }}" required>
                                                            <i class="ri-calendar-todo-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                        </div>
                                                        @error('departure_date')
                                                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">Tanggal Kembali <span class="text-danger">*</span></label>
                                                        <div class="form-group position-relative">
                                                            <input name="return_date" id="return_date" type="date"
                                                                class="form-control ps-5 text-gray-light h-55 @error('return_date') is-invalid @enderror"
                                                                value="{{ old('return_date', $travelOrder->return_date?->format('Y-m-d')) }}" required>
                                                            <i class="ri-calendar-check-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                        </div>
                                                        @error('return_date')
                                                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">Waktu</label>
                                                        <div class="form-group position-relative">
                                                            <input name="departure_time" type="time"
                                                                class="form-control ps-5 text-gray-light h-55 @error('departure_time') is-invalid @enderror"
                                                                value="{{ old('departure_time', $travelOrder->departure_time ? \Carbon\Carbon::parse($travelOrder->departure_time)->format('H:i') : '') }}">
                                                            <i class="ri-time-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                        </div>
                                                        @error('departure_time')
                                                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">Lama Perjalanan Dinas (Hari) <span class="text-danger">*</span></label>
                                                        <div class="form-group position-relative">
                                                            <input name="duration_days" id="duration_days"
                                                                class="form-control ps-5 text-gray-light h-55 @error('duration_days') is-invalid @enderror"
                                                                placeholder="Isi Lama Perjalanan Dinas"
                                                                value="{{ old('duration_days', $travelOrder->duration_days) }}" required>
                                                            <i class="ri-sun-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                        </div>
                                                        <small id="duration_text_info" class="text-muted d-block mt-1"></small>
                                                    <div class="col-lg-12">
                                                        <div class="form-group d-flex justify-content-between gap-3 mt-3">
                                                            <button type="button" class="btn btn-secondary py-3 px-5 fw-semibold btn-prev-step" data-prev="#step5-tab">
                                                                <i class="ri-arrow-left-line me-1"></i> Kembali ke Info Personal
                                                            </button>
                                                            <button type="button" class="btn btn-primary py-3 px-5 fw-semibold text-white btn-next-step" data-next="#step7-tab">
                                                                Lanjut ke Info Tambahan <i class="ri-arrow-right-line ms-1"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Step 3: Informasi Tambahan -->
                                        <div aria-labelledby="step7-tab" class="tab-pane fade" id="step7-tab-pane"
                                            role="tabpanel" tabindex="0">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">Instansi Pembebanan Anggaran</label>
                                                        <div class="form-group position-relative">
                                                            <input class="form-control text-dark ps-5 h-55 @error('budget_resources') is-invalid @enderror"
                                                                value="{{ old('budget_resources', $travelOrder->budget_resource ?? 'SMKN 1 Talaga') }}"
                                                                type="text" placeholder="Masukkan Instansi Pembebanan Anggaran"
                                                                name="budget_resources" />
                                                            <i class="ri-building-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                        </div>
                                                        @error('budget_resources')
                                                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">Akun</label>
                                                        <div class="form-group position-relative">
                                                            <input class="form-control text-dark ps-5 h-55 @error('acc') is-invalid @enderror"
                                                                placeholder="Masukkan Akun (Opsional)" type="text"
                                                                name="acc" value="{{ old('acc', $travelOrder->acc) }}" />
                                                            <i class="ri-account-circle-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                        </div>
                                                        @error('acc')
                                                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">Kode Surat</label>
                                                        <div class="form-group position-relative">
                                                            <input class="form-control text-dark ps-5 h-55 @error('code') is-invalid @enderror"
                                                                placeholder="Masukkan Kode Surat (Opsional)"
                                                                name="code" type="text"
                                                                value="{{ old('code', $travelOrder->code) }}" />
                                                            <i class="ri-file-code-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                        </div>
                                                        @error('code')
                                                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">Tanggal Surat Dikeluarkan <span class="text-danger">*</span></label>
                                                        <div class="form-group position-relative">
                                                            <input class="form-control text-dark ps-5 h-55 @error('issue_date') is-invalid @enderror"
                                                                type="date" name="issue_date"
                                                                value="{{ old('issue_date', $travelOrder->issue_date?->format('Y-m-d')) }}" required />
                                                            <i class="ri-calendar-schedule-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                        </div>
                                                        @error('issue_date')
                                                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group d-flex justify-content-between gap-3 mt-3">
                                                        <button type="button" class="btn btn-secondary py-3 px-5 fw-semibold btn-prev-step" data-prev="#step6-tab">
                                                            <i class="ri-arrow-left-line me-1"></i> Kembali ke Detail Perjalanan
                                                        </button>
                                                        <button class="btn btn-primary py-3 px-5 fw-semibold text-white"
                                                            type="submit">
                                                            <i class="ri-save-line me-1"></i> Perbarui Data SPPD
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
        const STANDARD_POSITIONS = [
            "Wakasek Kesiswaan",
            "Wakasek Kurikulum",
            "Wakasek Sapras",
            "Wakasek Humasbin",
            "Kaprog",
            "Guru",
            "Tenaga Kependidikan",
            "Lainnya"
        ];

        const savedPositions = @json($petugasPositions ?? []);

        function createPositionRow(petugasId, petugasName, existingPosition = '') {
            let isCustom = existingPosition && !STANDARD_POSITIONS.includes(existingPosition);
            let selectValue = isCustom ? 'Lainnya' : (existingPosition || 'Guru');

            let optionsHtml = STANDARD_POSITIONS.map(pos => {
                let sel = (pos === selectValue) ? 'selected' : '';
                return `<option value="${pos}" ${sel}>${pos}</option>`;
            }).join('');

            return `
                <div class="row align-items-center bg-white p-3 rounded-3 border" id="pos-row-${petugasId}">
                    <div class="col-md-5">
                        <label class="fw-semibold text-dark mb-1 fs-15 d-block">
                            <i class="ri-user-line text-primary me-1"></i> ${petugasName}
                        </label>
                        <small class="text-muted">Nama Petugas Terpilih</small>
                    </div>
                    <div class="col-md-7">
                        <div class="row g-2">
                            <div class="${(selectValue === 'Lainnya') ? 'col-md-6' : 'col-md-12'}" id="col-select-${petugasId}">
                                <select class="form-select position-select" data-id="${petugasId}">
                                    ${optionsHtml}
                                </select>
                            </div>
                            <div class="col-md-6 ${(selectValue === 'Lainnya') ? '' : 'd-none'}" id="col-manual-${petugasId}">
                                <input type="text" class="form-control manual-position-input" 
                                    placeholder="Ketik jabatan..." 
                                    value="${isCustom ? existingPosition : ''}">
                            </div>
                        </div>
                        <input type="hidden" name="petugas_positions[${petugasId}]" id="pos-hidden-${petugasId}" 
                            value="${existingPosition || selectValue}">
                    </div>
                </div>
            `;
        }

        function syncPetugasPositions() {
            const data = $('#petugas').select2('data');
            const container = $('#petugas-positions-container');
            const card = $('#petugas-positions-card');

            if (!data || data.length === 0) {
                card.hide();
                container.empty();
                return;
            }

            card.show();
            const currentIds = data.map(item => String(item.id));

            container.children().each(function() {
                const rowId = $(this).attr('id').replace('pos-row-', '');
                if (!currentIds.includes(rowId)) {
                    $(this).remove();
                }
            });

            data.forEach(item => {
                const id = String(item.id);
                const name = item.name || item.text.split('(')[0].trim();
                if ($(`#pos-row-${id}`).length === 0) {
                    const existingPos = savedPositions[id] || '';
                    container.append(createPositionRow(id, name, existingPos));
                }
            });
        }

        $(document).on('change', '.position-select', function() {
            const id = $(this).data('id');
            const val = $(this).val();
            const colSelect = $(`#col-select-${id}`);
            const colManual = $(`#col-manual-${id}`);
            const hidden = $(`#pos-hidden-${id}`);
            const manualInput = colManual.find('input');

            if (val === 'Lainnya') {
                colSelect.removeClass('col-md-12').addClass('col-md-6');
                colManual.removeClass('d-none');
                hidden.val(manualInput.val() || 'Lainnya');
                manualInput.focus();
            } else {
                colSelect.removeClass('col-md-6').addClass('col-md-12');
                colManual.addClass('d-none');
                hidden.val(val);
            }
        });

        $(document).on('input', '.manual-position-input', function() {
            const row = $(this).closest('.row[id^="pos-row-"]');
            const id = row.attr('id').replace('pos-row-', '');
            const hidden = $(`#pos-hidden-${id}`);
            hidden.val($(this).val().trim() || 'Lainnya');
        });

        $(document).ready(function() {
            $('#petugas').select2({
                placeholder: 'Cari karyawan...',
                allowClear: true,
                multiple: true,
                minimumInputLength: 2,
                ajax: {
                    url: '{{ route('sp.employees.search') }}',
                    dataType: 'json',
                    delay: 300,
                    data: function(params) {
                        return {
                            q: params.term,
                            page: params.page || 1
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.results,
                            pagination: {
                                more: data.pagination.more
                            }
                        };
                    }
                }
            }).on('change', function() {
                syncPetugasPositions();
            });

            $('#pengikut').select2({
                placeholder: 'Cari pengikut...',
                allowClear: true,
                multiple: true,
                minimumInputLength: 2,
                ajax: {
                    url: '{{ route('sp.employees.search') }}',
                    dataType: 'json',
                    delay: 300,
                    data: function(params) {
                        return {
                            q: params.term,
                            page: params.page || 1
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.results,
                            pagination: {
                                more: data.pagination.more
                            }
                        };
                    }
                }
            });

            // Initial sync on page load
            syncPetugasPositions();

            function calculateDuration() {
                const startVal = $('#departure_date').val();
                const endVal = $('#return_date').val();

                if (startVal && endVal) {
                    const startDate = new Date(startVal);
                    const endDate = new Date(endVal);

                    if (endDate >= startDate) {
                        const diffTime = Math.abs(endDate - startDate);
                        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
                        $('#duration_days').val(diffDays);
                        $('#duration_text_info').text(`Terhitung ${diffDays} hari pelaksanaan (${startVal} s/d ${endVal})`);
                    } else {
                        $('#duration_text_info').text('Tanggal kembali tidak boleh sebelum tanggal berangkat');
                    }
                }
            }

            $('#departure_date, #return_date').on('change', calculateDuration);

            // Step Wizard Navigation Handlers
            $(document).on('click', '.btn-next-step', function() {
                const targetTabSelector = $(this).data('next');
                if (targetTabSelector) {
                    const tabTrigger = document.querySelector(targetTabSelector);
                    if (tabTrigger) {
                        const tab = new bootstrap.Tab(tabTrigger);
                        tab.show();
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                    }
                }
            });

            $(document).on('click', '.btn-prev-step', function() {
                const targetTabSelector = $(this).data('prev');
                if (targetTabSelector) {
                    const tabTrigger = document.querySelector(targetTabSelector);
                    if (tabTrigger) {
                        const tab = new bootstrap.Tab(tabTrigger);
                        tab.show();
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                    }
                }
            });
        });
    </script>
@endpush
