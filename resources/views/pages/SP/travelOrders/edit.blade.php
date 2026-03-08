@extends('layouts.app')
@section('content')
    <div class="main-content-container overflow-hidden">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
            <h3 class="mb-0">
                Edit Data
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb align-items-center mb-0 lh-1">
                    <li class="breadcrumb-item">
                        <a class="d-flex align-items-center text-decoration-none" href="{{ route('dashboard') }}">
                            <i class="ri-home-8-line fs-15 text-primary me-1"></i>
                            <span class="text-body fs-14 hover">Dashboard</span>
                        </a>
                    </li>
                    <li aria-current="page" class="breadcrumb-item active">
                        <span>Surat Perintah (SP)</span>
                    </li>
                    <li aria-current="page" class="breadcrumb-item active">
                        <span>Perjalanan Dinas</span>
                    </li>
                    <li aria-current="page" class="breadcrumb-item active">
                        <span class="text-secondary">Edit Data</span>
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
                                            <span
                                                class="fs-20 fw-bold text-primary wh-48 bg-primary bg-opacity-10 rounded-circle d-inline-block">1</span>
                                            <div class="text-start ms-3 d-none d-lg-block">
                                                <h4 class="fs-18 fw-semibold">Informasi Personal</h4>
                                                <p class="text-gray-light mb-0">Isi Informasi Personal</p>
                                            </div>
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button aria-controls="step6-tab-pane" aria-selected="false"
                                            class="nav-link p-0 d-flex align-items-center" data-bs-target="#step6-tab-pane"
                                            data-bs-toggle="tab" id="step6-tab" role="tab" type="button">
                                            <span
                                                class="fs-20 fw-bold text-primary wh-48 bg-primary bg-opacity-10 rounded-circle d-inline-block">2</span>
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
                                            <span
                                                class="fs-20 fw-bold text-primary wh-48 bg-primary bg-opacity-10 rounded-circle d-inline-block">3</span>
                                            <div class="text-start ms-3 d-none d-lg-block">
                                                <h4 class="fs-18 fw-semibold">Informasi Tambahan</h4>
                                                <p class="text-gray-light mb-0">Isi Informasi Tambahan</p>
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
                                                        <label class="label fs-16">Nomor Surat <span
                                                                class="text-danger">*</span></label>
                                                        <div class="form-group position-relative">
                                                            <input type="text" name="letter_number"
                                                                class="form-control text-dark ps-5 h-55 @error('letter_number') is-invalid @enderror"
                                                                value="{{ old('letter_number', $travelOrder->letter_number) }}"
                                                                placeholder="Masukkan Nomor Surat" required>
                                                            <i
                                                                class="ri-hashtag position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                            @error('letter_number')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">Tujuan</label>
                                                        <div class="position-relative">
                                                            <input name="purpose"
                                                                class="form-control ps-5 text-gray-light h-55 @error('purpose') is-invalid @enderror"
                                                                placeholder="Isi Tujuan"
                                                                value="{{ old('purpose', $travelOrder->purpose) }}">
                                                            <i
                                                                class="ri-todo-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                            @error('purpose')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- BARU: Dasar --}}
                                                <div class="col-lg-12">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">Dasar</label>
                                                        <div class="position-relative">
                                                            <textarea name="base" rows="3" class="form-control ps-5 text-gray-light @error('base') is-invalid @enderror"
                                                                placeholder="Isi Dasar Surat Perintah, contoh: Surat Dinas No. 001/2025...">{{ old('base', $travelOrder->base) }}</textarea>
                                                            <i
                                                                class="ri-file-list-3-line position-absolute top-0 mt-3 start-0 fs-20 text-gray-light ps-20"></i>
                                                            @error('base')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">Ditugaskan kepada <span
                                                                class="text-danger">*</span></label>
                                                        <div class="form-group position-relative">
                                                            <select name="petugas_id[]" id="petugas" multiple required>
                                                                @foreach ($petugasData as $petugas)
                                                                    <option value="{{ $petugas->id }}" selected>
                                                                        {{ $petugas->full_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('petugas_id')
                                                                <div class="invalid-feedback d-block">{{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">Pengikut</label>
                                                        <div class="position-relative">
                                                            <select name="pengikut_ids[]" id="pengikut" multiple
                                                                style="width:100%">
                                                                @foreach ($pengikutData as $pengikut)
                                                                    <option value="{{ $pengikut->id }}" selected>
                                                                        {{ $pengikut->full_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
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
                                                        <label class="label fs-16">Tempat Surat Dikeluarkan</label>
                                                        <div class="form-group position-relative">
                                                            <input name="departure_from"
                                                                class="form-control ps-5 text-gray-light h-55"
                                                                placeholder="Isi Tempat Surat Dikeluarkan"
                                                                value="{{ old('departure_from', $travelOrder->departure_from) }}">
                                                            <i
                                                                class="ri-map-pin-2-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">Tempat Keberangkatan</label>
                                                        <div class="form-group position-relative">
                                                            <input name="departure_place"
                                                                class="form-control ps-5 text-gray-light h-55"
                                                                placeholder="Isi Tempat Keberangkatan"
                                                                value="{{ old('departure_place', $travelOrder->departure_place) }}">
                                                            <i
                                                                class="ri-map-pin-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">Tempat Tujuan</label>
                                                        <div class="form-group position-relative">
                                                            <input name="departure_to"
                                                                class="form-control ps-5 text-gray-light h-55"
                                                                placeholder="Isi Tempat Tujuan"
                                                                value="{{ old('departure_to', $travelOrder->departure_to) }}">
                                                            <i
                                                                class="ri-map-pin-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">Tanggal Keberangkatan</label>
                                                        <div class="form-group position-relative">
                                                            <input name="departure_date" type="date"
                                                                class="form-control ps-5 text-gray-light h-55"
                                                                value="{{ old('departure_date', $travelOrder->departure_date) }}">
                                                            <i
                                                                class="ri-calendar-todo-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">Tanggal Kembali</label>
                                                        <div class="form-group position-relative">
                                                            <input name="return_date" type="date"
                                                                class="form-control ps-5 text-gray-light h-55"
                                                                value="{{ old('return_date', $travelOrder->return_date) }}">
                                                            <i
                                                                class="ri-calendar-check-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Waktu
                                                        </label>
                                                        <div class="form-group position-relative">
                                                            <input name="departure_time" type="time"
                                                                class="form-control ps-5 text-gray-light h-55"
                                                                value="{{ old('departure_time', $travelOrder->departure_time) }}">
                                                            </input>
                                                            <i
                                                                class="ri-time-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20">
                                                            </i>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">Lama Perjalanan Dinas</label>
                                                        <div class="form-group position-relative">
                                                            <input name="duration_days"
                                                                class="form-control ps-5 text-gray-light h-55"
                                                                placeholder="Isi Lama Perjalanan Dinas. Contoh : 5 Hari"
                                                                value="{{ old('duration_days', $travelOrder->duration_days) }}">
                                                            <i
                                                                class="ri-sun-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
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
                                                        <label class="label fs-16">Instansi</label>
                                                        <div class="form-group position-relative">
                                                            <input class="form-control text-dark ps-5 h-55" type="text"
                                                                placeholder="Masukkan Instansi Pembebanan Anggaran"
                                                                name="budget_resources"
                                                                value="{{ old('budget_resources', $travelOrder->budget_resource) }}" />
                                                            <i
                                                                class="ri-building-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">Akun</label>
                                                        <div class="form-group position-relative">
                                                            <input class="form-control text-dark ps-5 h-55"
                                                                placeholder="Masukkan Akun (Opsional)" type="text"
                                                                name="acc"
                                                                value="{{ old('acc', $travelOrder->acc) }}" />
                                                            <i
                                                                class="ri-account-circle-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">Kode Surat</label>
                                                        <div class="form-group position-relative">
                                                            <input class="form-control text-dark ps-5 h-55"
                                                                placeholder="Masukkan Kode Surat (Opsional)"
                                                                name="code" type="text"
                                                                value="{{ old('code', $travelOrder->code) }}" />
                                                            <i
                                                                class="ri-file-code-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">Tanggal Surat Dikeluarkan</label>
                                                        <div class="form-group position-relative">
                                                            <input class="form-control text-dark ps-5 h-55" type="date"
                                                                name="issue_date"
                                                                value="{{ old('issue_date', $travelOrder->issue_date) }}" />
                                                            <i
                                                                class="ri-calendar-schedule-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group d-flex justify-content-end gap-3">
                                                        <a href="{{ route('sp.travelOrders.index') }}"
                                                            class="btn btn-secondary py-3 px-5 fw-semibold">
                                                            Batal
                                                        </a>
                                                        <button class="btn btn-primary py-3 px-5 fw-semibold text-white"
                                                            type="submit">
                                                            Update
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
        $(document).ready(function() {
            // Initialize Select2 for Petugas
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
            });

            // Initialize Select2 for Pengikut
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
        });
    </script>
@endpush
