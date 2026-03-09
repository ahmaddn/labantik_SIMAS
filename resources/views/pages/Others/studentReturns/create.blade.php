@extends('layouts.app')

@section('content')
    <div class="main-content-container overflow-hidden">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
            <h3 class="mb-0">
                Tambah Data
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
                        <span>Surat Pengantar</span>
                    </li>
                    <li aria-current="page" class="breadcrumb-item active">
                        <span>Pengembalian Siswa</span>
                    </li>
                    <li aria-current="page" class="breadcrumb-item active">
                        <span class="text-secondary">Tambah Data</span>
                    </li>
                </ol>
            </nav>
        </div>

        {{-- Alert Error --}}
        @if ($errors->any())
            <div class="alert fs-16 alert-danger alert-dismissible" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
                <button aria-label="Close" class="btn-close shadow-none" data-bs-dismiss="alert" type="button">
                </button>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card bg-white border border-white rounded-10 mb-4">
                    <div class="card-body p-20">
                        <h4 class="fs-18 fw-medium mb-20">
                            Data Surat Pengembalian Siswa
                        </h4>
                        <div class="tab-content" id="myTab2Content">
                            <div aria-labelledby="preview2-tab" class="tab-pane fade show active" id="preview2-tab-pane"
                                role="tabpanel" tabindex="0">

                                {{-- Wizard Tab Navigation --}}
                                <ul class="nav nav-tabs justify-content-around border-0 mb-4 mt-5 wizard-tabs2"
                                    id="myTabstep2" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button aria-controls="step1-tab-pane" aria-selected="true"
                                            class="nav-link p-0 d-flex align-items-center active"
                                            data-bs-target="#step1-tab-pane" data-bs-toggle="tab" id="step1-tab"
                                            role="tab" type="button">
                                            <span
                                                class="fs-20 fw-bold text-primary wh-48 bg-primary bg-opacity-10 rounded-circle d-inline-block">
                                                1
                                            </span>
                                            <div class="text-start ms-3 d-none d-lg-block">
                                                <h4 class="fs-18 fw-semibold">
                                                    Informasi Siswa
                                                </h4>
                                                <p class="text-gray-light mb-0">
                                                    Pilih siswa yang akan dikembalikan
                                                </p>
                                            </div>
                                        </button>
                                    </li>

                                    <li class="nav-item" role="presentation">
                                        <button aria-controls="step2-tab-pane" aria-selected="false"
                                            class="nav-link p-0 d-flex align-items-center" data-bs-target="#step2-tab-pane"
                                            data-bs-toggle="tab" id="step2-tab" role="tab" type="button">
                                            <span
                                                class="fs-20 fw-bold text-primary wh-48 bg-primary bg-opacity-10 rounded-circle d-inline-block">
                                                2
                                            </span>
                                            <div class="text-start ms-3 d-none d-lg-block">
                                                <h4 class="fs-18 fw-semibold">
                                                    Detail Surat
                                                </h4>
                                                <p class="text-gray-light mb-0">
                                                    Isi detail surat pengembalian
                                                </p>
                                            </div>
                                        </button>
                                    </li>

                                    <li class="nav-item" role="presentation">
                                        <button aria-controls="step3-tab-pane" aria-selected="false"
                                            class="nav-link p-0 d-flex align-items-center" data-bs-target="#step3-tab-pane"
                                            data-bs-toggle="tab" id="step3-tab" role="tab" type="button">
                                            <span
                                                class="fs-20 fw-bold text-primary wh-48 bg-primary bg-opacity-10 rounded-circle d-inline-block">
                                                3
                                            </span>
                                            <div class="text-start ms-3 d-none d-lg-block">
                                                <h4 class="fs-18 fw-semibold">
                                                    Alasan Pengembalian
                                                </h4>
                                                <p class="text-gray-light mb-0">
                                                    Tambahkan alasan pengembalian
                                                </p>
                                            </div>
                                        </button>
                                    </li>
                                </ul>

                                {{-- Main Form --}}
                                <form action="{{ route('others.studentReturns.store') }}" id="mainForm" method="POST">
                                    @csrf

                                    <div class="tab-content" id="myTabstep2Content">

                                        {{-- ===== STEP 1: Informasi Siswa ===== --}}
                                        <div aria-labelledby="step1-tab" class="tab-pane fade show active"
                                            id="step1-tab-pane" role="tabpanel" tabindex="0">
                                            <div class="row">

                                                {{-- Kelas --}}
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Kelas <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="form-group position-relative">
                                                            <select name="class_id" id="class_id"
                                                                class="form-select form-control ps-5 h-55 @error('class_id') is-invalid @enderror"
                                                                required>
                                                                <option value="">Pilih Kelas</option>
                                                                @foreach ($classes as $class)
                                                                    <option value="{{ $class->id }}"
                                                                        {{ old('class_id') == $class->id ? 'selected' : '' }}>
                                                                        {{ $class->academic_level }} {{ $class->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <i
                                                                class="ri-map-2-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                            @error('class_id')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Siswa --}}
                                                <div class="col-lg-6" id="siswa-container" style="display: none;">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Nama Siswa <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="form-group position-relative">
                                                            <select name="student_id" id="siswa"
                                                                class="form-select form-control ps-5 h-55 @error('student_id') is-invalid @enderror"
                                                                required>
                                                            </select>
                                                            <i
                                                                class="ri-user-2-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                            @error('student_id')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="d-flex justify-content-start">
                                                <a href="{{ route('others.studentReturns.index') }}"
                                                    class="btn btn-primary bg-primary bg-opacity-10 text-primary py-3 px-5 fw-semibold border-0">
                                                    <i class="ri-arrow-left-line me-1"></i> Kembali
                                                </a>
                                            </div>
                                        </div>

                                        {{-- ===== STEP 2: Detail Surat ===== --}}
                                        <div aria-labelledby="step2-tab" class="tab-pane fade" id="step2-tab-pane"
                                            role="tabpanel" tabindex="0">
                                            <div class="row">
                                                {{-- Nomor Surat --}}
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Nomor Surat <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="form-group position-relative">
                                                            <input type="text" name="letter_number"
                                                                class="form-control text-dark ps-5 h-55 @error('letter_number') is-invalid @enderror"
                                                                value="{{ old('letter_number', $letterNumber) }}"
                                                                placeholder="Masukkan Nomor Surat" required>
                                                            <i
                                                                class="ri-hashtag position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20">
                                                            </i>
                                                            @error('letter_number')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Tanggal Pengembalian --}}
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Tanggal Pengembalian <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="form-group position-relative">
                                                            <input type="date" name="return_date"
                                                                class="form-control ps-5 h-55 @error('return_date') is-invalid @enderror"
                                                                value="{{ old('return_date', date('Y-m-d')) }}" required>
                                                            <i
                                                                class="ri-calendar-check-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                            @error('return_date')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        {{-- ===== STEP 3: Alasan Pengembalian ===== --}}
                                        <div aria-labelledby="step3-tab" class="tab-pane fade" id="step3-tab-pane"
                                            role="tabpanel" tabindex="0">
                                            <div class="row">
                                                {{-- Template Alasan --}}
                                                <div class="col-lg-12">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16 mb-2">
                                                            Template Alasan (Opsional)
                                                        </label>
                                                        <div class="d-flex flex-wrap gap-2">
                                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                                onclick="addReasonTemplate('pelanggaran')">
                                                                <i class="ri-error-warning-line me-1"></i> Pelanggaran Tata
                                                                Tertib
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                                onclick="addReasonTemplate('kesehatan')">
                                                                <i class="ri-heart-pulse-line me-1"></i> Masalah Kesehatan
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                                onclick="addReasonTemplate('keluarga')">
                                                                <i class="ri-parent-line me-1"></i> Permintaan Keluarga
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                                onclick="addReasonTemplate('akademik')">
                                                                <i class="ri-book-line me-1"></i> Prestasi Akademik Menurun
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Daftar Alasan --}}
                                                <div class="col-lg-12">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Alasan Pengembalian <span class="text-danger">*</span>
                                                            <small class="text-muted">(Minimal 1 alasan)</small>
                                                        </label>
                                                        <div id="reasons-container">
                                                            {{-- Alasan pertama --}}
                                                            <div class="reason-item mb-3">
                                                                <div class="input-group">
                                                                    <span class="input-group-text">
                                                                        <i class="ri-file-text-line"></i>
                                                                    </span>
                                                                    <textarea name="reasons[]" class="form-control @error('reasons.0') is-invalid @enderror" rows="3"
                                                                        placeholder="Masukkan alasan pengembalian siswa" required>{{ old('reasons.0') }}</textarea>
                                                                    <button type="button" class="btn btn-danger"
                                                                        onclick="removeReason(this)" disabled>
                                                                        <i class="ri-delete-bin-line"></i>
                                                                    </button>
                                                                </div>
                                                                @error('reasons.0')
                                                                    <div class="text-danger fs-14 mt-1">{{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <button type="button" class="btn btn-sm btn-primary mt-2"
                                                            onclick="addReason()">
                                                            <i class="ri-add-line me-1"></i> Tambah Alasan
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <button type="submit"
                                                    class="btn btn-primary py-3 px-5 fw-semibold text-white">
                                                    <i class="ri-save-line me-1"></i> Submit
                                                </button>
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
        let siswaSelectInitialized = false;
        let reasonCounter = 1;

        // ─── Kelas berubah → tampilkan / sembunyikan Siswa ──────────────
        $('#class_id').on('change', function() {
            var classId = $(this).val();

            if (classId) {
                $('#siswa-container').slideDown();
                $('#siswa').prop('required', true);

                if (!siswaSelectInitialized) {
                    initSiswaSelect2();
                    siswaSelectInitialized = true;
                }
            } else {
                $('#siswa-container').slideUp();
                $('#siswa').prop('required', false);
                $('#siswa').val(null).trigger('change');
            }
        });

        // ─── Inisialisasi Select2 AJAX siswa ─────────────────────────────
        function initSiswaSelect2() {
            $('#siswa').select2({
                placeholder: 'Cari Siswa...',
                allowClear: true,
                minimumInputLength: 2,
                ajax: {
                    url: '{{ route('others.students.search') }}',
                    dataType: 'json',
                    delay: 300,
                    data: function(params) {
                        return {
                            q: params.term,
                            class_id: $('#class_id').val(),
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
        }

        // ─── Tambah Alasan Baru ──────────────────────────────────────────
        function addReason() {
            const container = document.getElementById('reasons-container');
            const newReason = document.createElement('div');
            newReason.className = 'reason-item mb-3';
            newReason.innerHTML = `
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="ri-file-text-line"></i>
                    </span>
                    <textarea name="reasons[]" class="form-control" rows="3"
                        placeholder="Masukkan alasan pengembalian siswa" required></textarea>
                    <button type="button" class="btn btn-danger" onclick="removeReason(this)">
                        <i class="ri-delete-bin-line"></i>
                    </button>
                </div>
            `;
            container.appendChild(newReason);
            updateRemoveButtons();
            reasonCounter++;
        }

        // ─── Hapus Alasan ────────────────────────────────────────────────
        function removeReason(button) {
            button.closest('.reason-item').remove();
            updateRemoveButtons();
        }

        // ─── Update tombol hapus (disable jika hanya 1 alasan) ──────────
        function updateRemoveButtons() {
            const items = document.querySelectorAll('.reason-item');
            items.forEach((item, index) => {
                const btn = item.querySelector('.btn-danger');
                if (items.length === 1) {
                    btn.disabled = true;
                } else {
                    btn.disabled = false;
                }
            });
        }

        // ─── Template Alasan ─────────────────────────────────────────────
        function addReasonTemplate(type) {
            const templates = {
                'pelanggaran': 'Siswa yang bersangkutan telah melakukan pelanggaran tata tertib sekolah secara berulang dan tidak menunjukkan perbaikan perilaku meskipun telah diberikan pembinaan.',
                'kesehatan': 'Berdasarkan kondisi kesehatan siswa yang memerlukan perhatian khusus dari keluarga dan tidak memungkinkan untuk melanjutkan pembelajaran di sekolah saat ini.',
                'keluarga': 'Atas permintaan orang tua/wali siswa dengan pertimbangan kondisi keluarga yang memerlukan kehadiran siswa di rumah untuk jangka waktu yang tidak dapat ditentukan.',
                'akademik': 'Siswa mengalami penurunan prestasi akademik yang signifikan dan memerlukan pendampingan intensif dari keluarga untuk dapat melanjutkan pembelajaran dengan lebih baik.'
            };

            // Reset semua button template ke outline
            $('[onclick^="addReasonTemplate"]')
                .removeClass('btn-primary')
                .addClass('btn-outline-primary');

            // Set button yang dipilih jadi aktif (biru solid)
            $(`[onclick="addReasonTemplate('${type}')"]`)
                .removeClass('btn-outline-primary')
                .addClass('btn-primary');

            const container = document.getElementById('reasons-container');
            const textareas = container.querySelectorAll('textarea[name="reasons[]"]');
            const lastTextarea = textareas[textareas.length - 1];

            if (lastTextarea.value.trim() === '') {
                lastTextarea.value = templates[type] || '';
            } else {
                addReason();
                const newTextareas = container.querySelectorAll('textarea[name="reasons[]"]');
                newTextareas[newTextareas.length - 1].value = templates[type] || '';
            }
        }

        // Trigger change jika ada old value
        $(document).ready(function() {
            if ($('#class_id').val()) {
                $('#class_id').trigger('change');
            }
        });
    </script>
@endpush
