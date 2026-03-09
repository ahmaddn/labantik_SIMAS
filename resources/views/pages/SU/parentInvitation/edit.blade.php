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
                        <span>Surat Undangan (SU)</span>
                    </li>
                    <li aria-current="page" class="breadcrumb-item active">
                        <span>Undangan Orang Tua</span>
                    </li>
                    <li aria-current="page" class="breadcrumb-item active">
                        <span class="text-secondary">Edit Data</span>
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
                            Edit Surat Undangan Orang Tua
                        </h4>
                        <div class="tab-content" id="myTab2Content">
                            <div aria-labelledby="preview2-tab" class="tab-pane fade show active" id="preview2-tab-pane"
                                role="tabpanel" tabindex="0">

                                {{-- Wizard Tab Navigation --}}
                                <ul class="nav nav-tabs justify-content-around border-0 mb-4 mt-5 wizard-tabs2"
                                    id="myTabstep2" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button aria-controls="step5-tab-pane" aria-selected="true"
                                            class="nav-link p-0 d-flex align-items-center active"
                                            data-bs-target="#step5-tab-pane" data-bs-toggle="tab" id="step5-tab"
                                            role="tab" type="button">
                                            <span
                                                class="fs-20 fw-bold text-primary wh-48 bg-primary bg-opacity-10 rounded-circle d-inline-block">
                                                1
                                            </span>
                                            <div class="text-start ms-3 d-none d-lg-block">
                                                <h4 class="fs-18 fw-semibold">
                                                    Informasi Umum
                                                </h4>
                                                <p class="text-gray-light mb-0">
                                                    Pilih kategori dan penerima
                                                </p>
                                            </div>
                                        </button>
                                    </li>

                                    <li class="nav-item" role="presentation">
                                        <button aria-controls="step6-tab-pane" aria-selected="false"
                                            class="nav-link p-0 d-flex align-items-center" data-bs-target="#step6-tab-pane"
                                            data-bs-toggle="tab" id="step6-tab" role="tab" type="button">
                                            <span
                                                class="fs-20 fw-bold text-primary wh-48 bg-primary bg-opacity-10 rounded-circle d-inline-block">
                                                2
                                            </span>
                                            <div class="text-start ms-3 d-none d-lg-block">
                                                <h4 class="fs-18 fw-semibold">
                                                    Detail Undangan
                                                </h4>
                                                <p class="text-gray-light mb-0">
                                                    Isi detail surat undangan
                                                </p>
                                            </div>
                                        </button>
                                    </li>
                                </ul>

                                {{-- Main Form --}}
                                <form action="{{ route('su.parentInvitations.update', $invitation->id) }}" id="mainForm"
                                    method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="tab-content" id="myTabstep2Content">

                                        {{-- ===== STEP 1: Informasi Umum ===== --}}
                                        <div aria-labelledby="step5-tab" class="tab-pane fade show active"
                                            id="step5-tab-pane" role="tabpanel" tabindex="0">
                                            <div class="row">

                                                {{-- Kategori Undangan --}}
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Kategori Undangan <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="form-group position-relative">
                                                            <select name="categories" id="categories"
                                                                class="form-select form-control ps-5 h-55 @error('categories') is-invalid @enderror"
                                                                required>
                                                                <option value="">Pilih Kategori</option>
                                                                <option value="Individu"
                                                                    {{ old('categories', $invitation->categories) == 'Individu' ? 'selected' : '' }}>
                                                                    Individual
                                                                </option>
                                                                <option value="Jamak"
                                                                    {{ old('categories', $invitation->categories) == 'Jamak' ? 'selected' : '' }}>
                                                                    Umum / Jamak
                                                                </option>
                                                            </select>
                                                            <i
                                                                class="ri-folder-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                            @error('categories')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- INDIVIDU: Kelas --}}
                                                <div class="col-lg-6" id="kelas-container"
                                                    style="display: {{ old('categories', $invitation->categories) == 'Individu' ? 'block' : 'none' }};">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Kelas <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="form-group position-relative">
                                                            <select name="class_id" id="class_id"
                                                                class="form-select form-control ps-5 h-55">
                                                                <option value="">Pilih Kelas :</option>
                                                                @foreach ($classes as $class)
                                                                    <option value="{{ $class->id }}"
                                                                        {{ old('class_id', $invitation->student->class_id ?? '') == $class->id ? 'selected' : '' }}>
                                                                        {{ $class->academic_level }} {{ $class->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <i
                                                                class="ri-map-2-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- INDIVIDU: Siswa --}}
                                                <div class="col-lg-6" id="siswa-container"
                                                    style="display: {{ old('categories', $invitation->categories) == 'Individu' && $invitation->student_id ? 'block' : 'none' }};">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Nama Siswa <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="form-group position-relative">
                                                            <select name="student_id" id="siswa">
                                                                @if ($invitation->student_id && $invitation->student)
                                                                    <option value="{{ $invitation->student->id }}"
                                                                        selected>
                                                                        {{ $invitation->student->student->name ?? 'Siswa Tidak Ditemukan' }}
                                                                    </option>
                                                                @endif
                                                            </select>
                                                            <i
                                                                class="ri-user-2-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- JAMAK: Kepada --}}
                                                <div class="col-lg-6" id="kepada-container"
                                                    style="display: {{ old('categories', $invitation->categories) == 'Jamak' ? 'block' : 'none' }};">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Kepada <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="form-group position-relative">
                                                            <input type="text" name="to" id="kepada"
                                                                class="form-control ps-5 h-55 @error('to') is-invalid @enderror"
                                                                placeholder="Contoh: Seluruh Orang Tua / Wali Murid Kelas X, XI, dan XII"
                                                                value="{{ old('to', $invitation->to) }}">
                                                            <i
                                                                class="ri-contacts-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                            @error('to')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="d-flex justify-content-start">
                                                <a href="{{ route('su.parentInvitations.index') }}"
                                                    class="btn btn-primary bg-primary bg-opacity-10 text-primary py-3 px-5 fw-semibold border-0">
                                                    <i class="ri-arrow-left-line me-1"></i> Kembali
                                                </a>
                                            </div>
                                        </div>

                                        {{-- ===== STEP 2: Detail Undangan ===== --}}
                                        <div aria-labelledby="step6-tab" class="tab-pane fade" id="step6-tab-pane"
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
                                                                value="{{ old('letter_number', $invitation->letter_number) }}"
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

                                                {{-- Tanggal Surat --}}
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Tanggal Surat <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="form-group position-relative">
                                                            <input type="date" name="issue_date"
                                                                class="form-control ps-5 h-55 @error('issue_date') is-invalid @enderror"
                                                                value="{{ old('issue_date', $invitation->issue_date) }}"
                                                                required>
                                                            <i
                                                                class="ri-calendar-check-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                            @error('issue_date')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Template Tujuan: INDIVIDU --}}
                                                <div class="col-lg-12" id="template-individu"
                                                    style="display: {{ old('categories', $invitation->categories) == 'Individu' ? 'block' : 'none' }};">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Template Tujuan
                                                        </label>
                                                        <div class="d-flex flex-wrap gap-2 mb-2">
                                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                                onclick="setTemplate('konsultasi')">
                                                                <i class="ri-question-answer-line me-1"></i> Konsultasi
                                                                Belajar
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                                onclick="setTemplate('pelanggaran')">
                                                                <i class="ri-error-warning-line me-1"></i> Pelanggaran
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                                onclick="setTemplate('prestasi')">
                                                                <i class="ri-trophy-line me-1"></i> Prestasi
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                                onclick="setTemplate('kesehatan')">
                                                                <i class="ri-heart-pulse-line me-1"></i> Kesehatan
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                                onclick="setTemplate('keuangan')">
                                                                <i class="ri-money-dollar-circle-line me-1"></i> Keuangan
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Template Tujuan: JAMAK --}}
                                                <div class="col-lg-12" id="template-jamak"
                                                    style="display: {{ old('categories', $invitation->categories) == 'Jamak' ? 'block' : 'none' }};">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Template Tujuan
                                                        </label>
                                                        <div class="d-flex flex-wrap gap-2 mb-2">
                                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                                onclick="setTemplate('program-sekolah')">
                                                                <i class="ri-school-line me-1"></i> Program Sekolah
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                                onclick="setTemplate('pertemuan-rutin')">
                                                                <i class="ri-group-line me-1"></i> Pertemuan Rutin
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                                onclick="setTemplate('keuangan-umum')">
                                                                <i class="ri-money-dollar-circle-line me-1"></i> Keuangan
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                                onclick="setTemplate('kegiatan-sekolah')">
                                                                <i class="ri-calendar-event-line me-1"></i> Kegiatan
                                                                Sekolah
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                                onclick="setTemplate('umum-jamak')">
                                                                <i class="ri-file-text-line me-1"></i> Umum
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Tujuan --}}
                                                <div class="col-lg-12">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Tujuan <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="form-group position-relative">
                                                            <textarea name="purpose" class="form-control ps-5 @error('purpose') is-invalid @enderror" rows="4"
                                                                placeholder="Contoh: Mengundang Bapak/Ibu untuk hadir dalam rangka konsultasi mengenai perkembangan belajar putra/putri."
                                                                required>{{ old('purpose', $invitation->purpose) }}</textarea>
                                                            <i
                                                                class="ri-file-text-line position-absolute top-0 start-0 fs-20 text-gray-light ps-20 pt-3"></i>
                                                            @error('purpose')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Bertemu dengan --}}
                                                <div class="col-lg-6" id="with-container"
                                                    style="display: {{ old('categories', $invitation->categories) == 'Individu' ? 'block' : 'none' }};">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">Bertemu dengan</label>
                                                        <div class="form-group position-relative">
                                                            <input type="text" name="meeting_with"
                                                                class="form-control ps-5 h-55 @error('meeting_with') is-invalid @enderror"
                                                                placeholder="Contoh: Wali Kelas, Kepala Sekolah"
                                                                value="{{ old('meeting_with', $invitation->meeting_with) }}">
                                                            <i
                                                                class="ri-user-3-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                            @error('meeting_with')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Tempat Pertemuan --}}
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">Tempat Pertemuan</label>
                                                        <div class="form-group position-relative">
                                                            <input type="text" name="meeting_place"
                                                                class="form-control ps-5 h-55 @error('meeting_place') is-invalid @enderror"
                                                                placeholder="Contoh: Ruang BK, Ruang Kelas"
                                                                value="{{ old('meeting_place', $invitation->meeting_place) }}">
                                                            <i
                                                                class="ri-map-pin-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                            @error('meeting_place')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Hari Pertemuan --}}
                                                <div class="col-lg-4">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">Hari</label>
                                                        <div class="form-group position-relative">
                                                            <input type="text" name="meeting_day"
                                                                class="form-control ps-5 h-55 @error('meeting_day') is-invalid @enderror"
                                                                placeholder="Contoh: Senin"
                                                                value="{{ old('meeting_day', $invitation->meeting_day) }}">
                                                            <i
                                                                class="ri-sun-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                            @error('meeting_day')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Tanggal Pertemuan --}}
                                                <div class="col-lg-4">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">Tanggal Pertemuan</label>
                                                        <div class="form-group position-relative">
                                                            <input type="date" name="meeting_date"
                                                                class="form-control ps-5 h-55 @error('meeting_date') is-invalid @enderror"
                                                                value="{{ old('meeting_date', $invitation->meeting_date) }}">
                                                            <i
                                                                class="ri-calendar-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                            @error('meeting_date')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Waktu Pertemuan --}}
                                                <div class="col-lg-4">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">Waktu Pertemuan</label>
                                                        <div class="form-group position-relative">
                                                            <input type="time" name="meeting_time"
                                                                class="form-control ps-5 h-55 @error('meeting_time') is-invalid @enderror"
                                                                value="{{ old('meeting_time', $invitation->meeting_time) }}">
                                                            <i
                                                                class="ri-time-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                            @error('meeting_time')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
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

        // Variabel untuk menyimpan data awal
        const initialCategory = '{{ old('categories', $invitation->categories) }}';
        const initialStudentId = '{{ old('student_id', $invitation->student_id) }}';
        const initialClassId = '{{ old('class_id', $invitation->student->class_id ?? '') }}';

        $(document).ready(function() {
            // Inisialisasi tampilan berdasarkan kategori yang sudah ada
            if (initialCategory === 'Individu' && initialClassId) {
                initSiswaSelect2();
                siswaSelectInitialized = true;
            }
        });

        // ─── Toggle tampilan berdasarkan Kategori ────────────────────────
        $('#categories').on('change', function() {
            const val = $(this).val();

            if (val === 'Individu') {
                $('#kelas-container').slideDown();
                $('#kepada-container').slideUp();
                $('#template-individu').slideDown();
                $('#template-jamak').slideUp();
                $('#with-container').slideDown();

                $('#kepada').val('');
                $('#class_id').prop('required', true);
                $('#kepada').prop('required', false);
            } else if (val === 'Jamak') {
                $('#kepada-container').slideDown();
                $('#kelas-container').slideUp();
                $('#siswa-container').slideUp();
                $('#with-container').slideUp();
                $('#template-jamak').slideDown();
                $('#template-individu').slideUp();

                $('#kepada').prop('required', true);
                $('#class_id').prop('required', false);
                $('#siswa').prop('required', false);
                $('#class_id').val('');
                $('#siswa').val(null).trigger('change');
            } else {
                $('#kelas-container').slideUp();
                $('#siswa-container').slideUp();
                $('#kepada-container').slideUp();
                $('#template-individu').slideUp();
                $('#template-jamak').slideUp();

                $('#class_id').prop('required', false);
                $('#siswa').prop('required', false);
                $('#kepada').prop('required', false);
            }
        });

        // ─── Kelas berubah → tampilkan / sembunyikan Siswa ──────────────
        $('#class_id').on('change', function() {
            var classId = $(this).val();

            if (classId) {
                $('#siswa-container').slideDown();
                $('#siswa').prop('required', true);

                if (!siswaSelectInitialized) {
                    initSiswaSelect2();
                    siswaSelectInitialized = true;
                } else {
                    // Reset select2 jika kelas berubah (kecuali saat pertama kali load)
                    if (classId != initialClassId) {
                        $('#siswa').val(null).trigger('change');
                    }
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
                    url: '{{ route('su.students.search') }}',
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

        // ─── Template tujuan undangan ─────────────────────────────────────
        function setTemplate(type) {
            const kategori = $('#categories').val();

            const individu = {
                'konsultasi': 'Disampaikan dengan hormat, sehubungan dengan adanya permasalahan yang perlu diketahui dan dimusyawarahkan mengenai keberlangsungan pendidikan Putra (i) Bapak/Ibu/Saudara (i) maka kami harapkan kehadirannya pada:',
                'pelanggaran': 'Disampaikan dengan hormat, sehubungan dengan adanya permasalahan tata tertib yang perlu diketahui dan dimusyawarahkan mengenai perilaku Putra (i) Bapak/Ibu/Saudara (i) di sekolah, maka kami harapkan kehadirannya pada:',
                'prestasi': 'Disampaikan dengan hormat, sehubungan dengan pencapaian prestasi yang diraih oleh Putra (i) Bapak/Ibu/Saudara (i) dan perlu disampaikan langsung, maka kami harapkan kehadirannya pada:',
                'kesehatan': 'Disampaikan dengan hormat, sehubungan dengan kondisi kesehatan Putra (i) Bapak/Ibu/Saudara (i) yang perlu diketahui dan dimusyawarahkan, maka kami harapkan kehadirannya pada:',
                'keuangan': 'Disampaikan dengan hormat, sehubungan dengan hal administrasi keuangan yang berkaitan dengan Putra (i) Bapak/Ibu/Saudara (i) yang perlu dimusyawarahkan, maka kami harapkan kehadirannya pada:'
            };

            const jamak = {
                'program-sekolah': 'Sehubungan ada beberapa informasi yang perlu disampaikan dan dimusyawarahkan mengenai Program Sekolah SMK Negeri 1 Talaga, maka kami mengundang Bapak/Ibu Orang Tua/Wali Siswa/i untuk hadir dalam kegiatan tersebut.',
                'pertemuan-rutin': 'Sehubungan akan diadakannya pertemuan rutin orang tua/wali murid untuk membahas perkembangan dan kebutuhan sekolah SMK Negeri 1 Talaga, maka kami mengundang Bapak/Ibu Orang Tua/Wali Siswa/i untuk hadir dalam kegiatan tersebut.',
                'keuangan-umum': 'Sehubungan ada beberapa informasi yang perlu disampaikan dan dimusyawarahkan mengenai administrasi keuangan Sekolah SMK Negeri 1 Talaga, maka kami mengundang Bapak/Ibu Orang Tua/Wali Siswa/i untuk hadir dalam kegiatan tersebut.',
                'kegiatan-sekolah': 'Sehubungan akan diadakannya kegiatan sekolah yang memerlukan dukungan dan partisipasi orang tua/wali murid di SMK Negeri 1 Talaga, maka kami mengundang Bapak/Ibu Orang Tua/Wali Siswa/i untuk hadir dalam kegiatan tersebut.',
                'umum-jamak': 'Sehubungan ada beberapa hal yang perlu disampaikan dan dimusyawarahkan mengenai kegiatan dan program SMK Negeri 1 Talaga, maka kami mengundang Bapak/Ibu Orang Tua/Wali Siswa/i untuk hadir dalam kegiatan tersebut.'
            };

            // Reset semua button template ke outline
            $('[onclick^="setTemplate"]')
                .removeClass('btn-primary')
                .addClass('btn-outline-primary');

            // Set button yang dipilih jadi aktif (biru solid)
            $(`[onclick="setTemplate('${type}')"]`)
                .removeClass('btn-outline-primary')
                .addClass('btn-primary');

            const templates = (kategori === 'Individu') ? individu : jamak;
            $('textarea[name="purpose"]').val(templates[type] || '');
        }
    </script>
@endpush
