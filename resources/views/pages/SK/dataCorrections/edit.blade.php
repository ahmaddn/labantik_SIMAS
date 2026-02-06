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
                    <li aria-current="page" class="breadcrumb-item active">
                        <span>Surat Keterangan (SK)</span>
                    </li>
                    <li aria-current="page" class="breadcrumb-item active">
                        <span>Koreksi Data Ijazah</span>
                    </li>
                    <li aria-current="page" class="breadcrumb-item active">
                        <span class="text-secondary">Edit Data</span>
                    </li>
                </ol>
            </nav>
        </div>

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
                            Data SKKPI
                        </h4>

                        <div class="tab-content" id="myTab2Content">
                            <div aria-labelledby="preview2-tab" class="tab-pane fade show active" id="preview2-tab-pane"
                                role="tabpanel" tabindex="0">
                                <ul class="nav nav-tabs justify-content-around border-0 mb-4 wizard-tabs2" id="myTabstep2"
                                    role="tablist">
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
                                                <h4 class="fs-18 fw-semibold">Pilih Siswa</h4>
                                                <p class="text-gray-light mb-0">Data siswa & kelas</p>
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
                                                <h4 class="fs-18 fw-semibold">Data Surat</h4>
                                                <p class="text-gray-light mb-0">Informasi surat</p>
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
                                                <h4 class="fs-18 fw-semibold">Detail Koreksi</h4>
                                                <p class="text-gray-light mb-0">Data salah & benar</p>
                                            </div>
                                        </button>
                                    </li>
                                </ul>

                                <form action="{{ route('sk.dataCorrections.update', $correction->id) }}" method="POST"
                                    id="mainForm">
                                    @csrf
                                    @method('PUT')

                                    <input type="hidden" name="student_id" id="hidden_student_id"
                                        value="{{ old('student_id', $correction->student_id) }}">
                                    <div class="tab-content" id="myTabstep2Content">
                                        <div aria-labelledby="step1-tab" class="tab-pane fade show active"
                                            id="step1-tab-pane" role="tabpanel" tabindex="0">
                                            <div class="row">
                                                <div class="row mb-4">
                                                    <div class="col-lg-12">
                                                        <div class="card bg-light">
                                                            <div class="card-body">
                                                                <h6 class="card-title fw-semibold">Kepala Sekolah</h6>
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <div>
                                                                        <p class="mb-1">
                                                                            <strong>{{ $headmaster->full_name ?? 'MUCHAMAD EKI S.A., S.Kom' }}</strong>
                                                                        </p>
                                                                        <p class="mb-0 text-muted">
                                                                            NIP:
                                                                            {{ $headmaster->nip ?? '197610012006041011' }}
                                                                            @if (isset($headmaster->job_name))
                                                                                | {{ $headmaster->job_name }}
                                                                            @endif
                                                                        </p>
                                                                    </div>
                                                                    <div class="text-success">
                                                                        <i class="ri-checkbox-circle-line fs-20"></i>
                                                                        <small>Telah ditetapkan</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- kelas --}}
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Kelas <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="form-group position-relative">
                                                            <select name="class_id" id="class_id"
                                                                class="form-select form-control ps-5 h-55 @error('class_id') is-invalid @enderror"
                                                                required>
                                                                <option value="">Pilih Kelas :</option>
                                                                @foreach ($classes as $class)
                                                                    <option value="{{ $class->id }}"
                                                                        {{ old('class_id', $correction->student->class_id ?? '') == $class->id ? 'selected' : '' }}>
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

                                                {{-- siswa --}}
                                                <div class="col-lg-6" id="siswa-container" style="display: block;">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Nama Siswa : <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="form-group position-relative">
                                                            <select name="student_id" id="siswa" required>
                                                                <option value="">Pilih Siswa :</option>
                                                                {{-- Tampilkan siswa yang sudah dipilih --}}
                                                                @if ($correction->student_id && $correction->student)
                                                                    <option value="{{ $correction->student->id }}"
                                                                        selected>
                                                                        {{ $correction->student->student->full_name }}
                                                                        @if ($correction->student->student && $correction->student->student->student_number)
                                                                            ({{ $correction->student->student->student_number }})
                                                                        @endif
                                                                    </option>
                                                                @endif
                                                            </select>
                                                            <i
                                                                class="ri-user-2-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-lg-12">
                                                    <div class="form-group d-flex justify-content-between gap-3">
                                                        <a href="{{ route('sk.dataCorrections.index') }}"
                                                            class="btn btn-primary bg-primary bg-opacity-10 text-primary py-3 px-5 fw-semibold border-0">
                                                            Back
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div aria-labelledby="step2-tab" class="tab-pane fade" id="step2-tab-pane"
                                            role="tabpanel" tabindex="0">
                                            <div class="row">
                                                <!-- Nomor Surat -->
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Nomor Surat <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="form-group position-relative">
                                                            <input type="text" name="letter_number"
                                                                class="form-control text-dark ps-5 h-55 @error('letter_number') is-invalid @enderror"
                                                                value="{{ old('letter_number', $correction->letter_number) }}"
                                                                required>
                                                            <i
                                                                class="ri-hashtag position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                            @error('letter_number')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Tahun Kelulusan -->
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Tahun Kelulusan <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="form-group position-relative">
                                                            <input type="text" name="graduation_year"
                                                                class="form-control ps-5 h-55 @error('graduation_year') is-invalid @enderror"
                                                                value="{{ old('graduation_year', $correction->graduation_year) }}"
                                                                placeholder="Contoh: 2024" required>
                                                            <i
                                                                class="ri-calendar-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                            @error('graduation_year')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Tanggal Surat -->
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Tanggal Surat <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="form-group position-relative">
                                                            <input type="date" name="issue_date"
                                                                class="form-control ps-5 h-55 @error('issue_date') is-invalid @enderror"
                                                                value="{{ old('issue_date', $correction->issue_date) }}"
                                                                required>
                                                            <i
                                                                class="ri-calendar-check-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                            @error('issue_date')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Kompetensi Keahlian -->
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Kompetensi Keahlian <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="form-group position-relative">
                                                            <input type="text" name="kompetensi_keahlian"
                                                                id="kompetensi_keahlian"
                                                                class="form-control ps-5 h-55 @error('kompetensi_keahlian') is-invalid @enderror"
                                                                placeholder="Akan otomatis terisi"
                                                                value="{{ old('kompetensi_keahlian', $correction->student->class->expertiseConcentration->name) }}"
                                                                readonly>
                                                            <i
                                                                class="ri-briefcase-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                            @error('kompetensi_keahlian')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <small class="text-muted">
                                                            <i class="ri-information-line me-1"></i>
                                                            Akan otomatis terisi berdasarkan siswa yang dipilih
                                                        </small>
                                                    </div>
                                                </div>

                                                <!-- Hidden Input untuk Correction Type -->
                                                <input type="hidden" name="correction_type" id="correction_type_hidden"
                                                    value="{{ old('correction_type', $correction->correction_type ?? 'general') }}">

                                                <!-- Isi Koreksi / Keterangan -->
                                                <div class="col-lg-12">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Isi Koreksi / Keterangan <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="form-group position-relative">
                                                            <input name="content" id="content_textarea" class="form-control ps-5 @error('content') is-invalid @enderror"
                                                                rows="4" placeholder="Gunakan template di bawah atau tulis manual..."  value="{{ old('content', $correction->content) }}" required></input>
                                                            <i
                                                                class="ri-file-text-line position-absolute top-0 start-0 fs-20 text-gray-light ps-20 pt-3"></i>
                                                            @error('content')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Template Koreksi Cepat -->
                                                <div class="col-lg-12">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Template Koreksi Cepat
                                                        </label>
                                                        <div class="d-flex flex-wrap gap-2 mb-2">
                                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                                onclick="setTemplate('nama-siswa')">
                                                                <i class="ri-user-line me-1"></i> Nama Siswa
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                                onclick="setTemplate('nama-orangtua')">
                                                                <i class="ri-parent-line me-1"></i> Nama Orang Tua
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                                onclick="setTemplate('tanggal-lahir')">
                                                                <i class="ri-calendar-line me-1"></i> Tanggal Lahir
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                                onclick="setTemplate('tempat-lahir')">
                                                                <i class="ri-map-pin-line me-1"></i> Tempat Lahir
                                                            </button>
                                                        </div>
                                                        <div class="d-flex flex-wrap gap-2">
                                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                                onclick="setTemplate('nomor-ijazah')">
                                                                <i class="ri-file-text-line me-1"></i> Nomor Ijazah
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                                onclick="setTemplate('tahun-lulus')">
                                                                <i class="ri-graduation-cap-line me-1"></i> Tahun Lulus
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                                onclick="setTemplate('kompetensi-keahlian')">
                                                                <i class="ri-briefcase-line me-1"></i> Kompetensi Keahlian
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                                onclick="setTemplate('umum-koreksi')">
                                                                <i class="ri-edit-line me-1"></i> Koreksi Umum
                                                            </button>
                                                        </div>
                                                        <small class="text-muted mt-2 d-block">
                                                            <i class="ri-information-line me-1"></i> Template akan mengisi
                                                            bagian "Isi Koreksi" dengan format standar
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div aria-labelledby="step3-tab" class="tab-pane fade" id="step3-tab-pane"
                                            role="tabpanel" tabindex="0">
                                            <div class="row">
                                                <!-- Nama Field yang Dikoreksi -->
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Nama Field yang Dikoreksi <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="form-group position-relative">
                                                            <input type="text" name="field_name"
                                                                class="form-control ps-5 h-55 @error('field_name') is-invalid @enderror"
                                                                value="{{ old('field_name', $correction->field_name) }}"
                                                                placeholder="Contoh: Nama Ibu Kandung" required>
                                                            <i
                                                                class="ri-file-edit-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                            @error('field_name')
                                                                <div class="invalid-feedback">{{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Dokumen Referensi (Opsional) -->
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Dokumen Referensi (Opsional)
                                                        </label>
                                                        <div class="form-group position-relative">
                                                            <input type="text" name="reference_document"
                                                                class="form-control ps-5 h-55 @error('reference_document') is-invalid @enderror"
                                                                value="{{ old('reference_document', $correction->reference_document) }}"
                                                                placeholder="Contoh: Akta Kelahiran No. 1234/2005">
                                                            <i
                                                                class="ri-file-text-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                            @error('reference_document')
                                                                <div class="invalid-feedback">{{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Data yang SALAH -->
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Data yang SALAH (di Ijazah) <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="form-group position-relative">
                                                            <input type="text" name="incorrect_data"
                                                                class="form-control ps-5 h-55 border-danger bg-danger bg-opacity-10 @error('incorrect_data') is-invalid @enderror"
                                                                value="{{ old('incorrect_data', $correction->incorrect_data) }}"
                                                                placeholder="Tulis data yang SALAH" required>
                                                            <i
                                                                class="ri-close-circle-line position-absolute top-50 start-0 translate-middle-y fs-20 text-danger ps-20"></i>
                                                            @error('incorrect_data')
                                                                <div class="invalid-feedback">{{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <small class="text-danger">
                                                            <i class="ri-error-warning-line"></i> Data ini yang
                                                            tertulis
                                                            SALAH di ijazah
                                                        </small>
                                                    </div>
                                                </div>

                                                <!-- Data yang BENAR -->
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Data yang BENAR (Seharusnya) <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="form-group position-relative">
                                                            <input type="text" name="correct_data"
                                                                class="form-control ps-5 h-55 border-success bg-success bg-opacity-10 @error('correct_data') is-invalid @enderror"
                                                                value="{{ old('correct_data', $correction->correct_data) }}"
                                                                placeholder="Tulis data yang BENAR" required>
                                                            <i
                                                                class="ri-check-line position-absolute top-50 start-0 translate-middle-y fs-20 text-success ps-20"></i>
                                                            @error('correct_data')
                                                                <div class="invalid-feedback">{{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <small class="text-success">
                                                            <i class="ri-checkbox-circle-line"></i> Data yang
                                                            seharusnya
                                                            benar
                                                        </small>
                                                    </div>
                                                </div>


                                                <!-- Catatan Penting -->
                                                <div class="col-lg-12">
                                                    <div class="alert alert-warning">
                                                        <h6 class="alert-heading">
                                                            <i class="ri-alert-line me-2"></i>Penting!
                                                        </h6>
                                                        <p class="mb-2">Pastikan data yang dimasukkan sudah
                                                            sesuai dengan
                                                            dokumen asli (Akte, KK, dll).</p>
                                                        <p class="mb-0">Surat koreksi ini akan menjadi dokumen
                                                            resmi
                                                            untuk pembetulan data di ijazah.</p>
                                                    </div>
                                                </div>

                                                <!-- Tombol Aksi Final -->
                                                <div class="col-lg-12">
                                                    <div class="form-group d-flex justify-content-end gap-3">
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
            // Variabel untuk menyimpan data awal
            var initialClassId = '{{ $correction->student->class_id ?? '' }}';
            var initialStudentId = '{{ $correction->student_id ?? '' }}';
            var initialKompetensi = '{{ $correction->kompetensi_keahlian ?? '' }}';

            // Set nilai awal untuk kompetensi keahlian
            if (initialKompetensi) {
                $('#kompetensi_keahlian').val(initialKompetensi);
            }

            // Initialize select2 untuk siswa jika ada data
            if (initialClassId && initialStudentId) {
                initStudentSelect2();
            }

            // Handler untuk perubahan kelas
            $('#class_id').on('change', function() {
                var classId = $(this).val();

                if (classId) {
                    $('#siswa-container').slideDown();

                    // Hanya reset jika kelas berubah dari nilai awal
                    if (classId != initialClassId) {
                        $('#siswa').empty().trigger('change');
                        $('#hidden_student_id').val('');
                    }

                    fetchClassDetail(classId);
                    initStudentSelect2();
                } else {
                    $('#siswa-container').slideUp();
                    $('#siswa').empty().trigger('change');
                    $('#kompetensi_keahlian').val('');
                    $('#hidden_student_id').val('');
                }
            });

            // Fungsi untuk fetch detail kelas
            function fetchClassDetail(classId) {
                const baseUrl = '{{ url('sk/class/detail') }}';

                $.ajax({
                    url: baseUrl + '/' + classId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            $('#kompetensi_keahlian').val(response.data.expertiseConcentration);
                        }
                    },
                    error: function(xhr) {
                        console.error('Error fetching class detail:', xhr);
                        // Jika error dan ada nilai awal, gunakan nilai awal
                        if (classId == initialClassId && initialKompetensi) {
                            $('#kompetensi_keahlian').val(initialKompetensi);
                        }
                    }
                });
            }

            // Fungsi inisialisasi select2 untuk siswa
            function initStudentSelect2() {
                // Destroy dulu jika sudah ada
                if ($('#siswa').hasClass("select2-hidden-accessible")) {
                    $('#siswa').select2('destroy');
                }

                $('#siswa').select2({
                    placeholder: 'Cari atau pilih siswa...',
                    allowClear: true,
                    minimumInputLength: 0,
                    ajax: {
                        url: '{{ route('sk.student.search') }}',
                        dataType: 'json',
                        delay: 300,
                        data: function(params) {
                            return {
                                q: params.term || '',
                                class_id: $('#class_id').val(),
                                _token: '{{ csrf_token() }}',
                                page: params.page || 1
                            };
                        },
                        processResults: function(data) {
                            return {
                                results: data.results || [],
                                pagination: {
                                    more: (data.pagination && data.pagination.more) || false
                                }
                            };
                        },
                        cache: true
                    }
                }).on('select2:select', function(e) {
                    $('#hidden_student_id').val(e.params.data.id);
                }).on('select2:clear', function() {
                    $('#hidden_student_id').val('');
                });

                // Set selected student jika ada data awal
                @if ($correction->student_id && $correction->student)
                    var studentText = "{{ $correction->student->student->full_name ?? '' }}";
                    @if ($correction->student->student && $correction->student->student->student_number)
                        studentText += " ({{ $correction->student->student->student_number }})";
                    @endif

                    var studentOption = new Option(
                        studentText,
                        "{{ $correction->student_id }}",
                        true,
                        true
                    );
                    $('#siswa').append(studentOption).trigger('change');
                    $('#hidden_student_id').val("{{ $correction->student_id }}");
                @endif
            }

            // Tab Navigation Logic
            let currentTab = 1;
            const totalTabs = 3;

            // Fungsi untuk menampilkan tab tertentu
            function showTab(tabNumber) {
                // Sembunyikan semua tab
                $('.tab-pane').removeClass('show active');
                $('.nav-link').removeClass('active');

                // Tampilkan tab yang dipilih
                $(`#step${tabNumber}-tab`).addClass('active');
                $(`#step${tabNumber}-tab-pane`).addClass('show active');

                currentTab = tabNumber;
            }

            // Validasi sebelum pindah tab
            function validateTab(tabNumber) {
                let isValid = true;

                if (tabNumber === 2) { // Validasi dari tab 1 ke tab 2
                    if (!$('#class_id').val()) {
                        alert('Silakan pilih kelas terlebih dahulu!');
                        $('#class_id').focus();
                        isValid = false;
                    } else if (!$('#hidden_student_id').val()) {
                        alert('Silakan pilih siswa terlebih dahulu!');
                        $('#siswa').focus();
                        isValid = false;
                    }
                } else if (tabNumber === 3) { // Validasi dari tab 2 ke tab 3
                    if (!$('input[name="letter_number"]').val()) {
                        alert('Nomor surat harus diisi!');
                        $('input[name="letter_number"]').focus();
                        isValid = false;
                    } else if (!$('input[name="graduation_year"]').val()) {
                        alert('Tahun kelulusan harus diisi!');
                        $('input[name="graduation_year"]').focus();
                        isValid = false;
                    } else if (!$('input[name="issue_date"]').val()) {
                        alert('Tanggal surat harus diisi!');
                        $('input[name="issue_date"]').focus();
                        isValid = false;
                    } else if (!$('#kompetensi_keahlian').val()) {
                        alert('Kompetensi keahlian harus diisi!');
                        isValid = false;
                    } else if (!$('#content_textarea').val()) {
                        alert('Isi koreksi harus diisi!');
                        $('#content_textarea').focus();
                        isValid = false;
                    }
                }

                return isValid;
            }

            // Tombol Next Tab 1
            $('#btn-next-tab').on('click', function() {
                if (validateTab(2)) {
                    showTab(2);
                }
            });

            // Tombol Next Tab 2
            $('#btn-next-tab2').on('click', function() {
                if (validateTab(3)) {
                    showTab(3);
                }
            });

            // Tombol Previous Tab 2
            $('#btn-prev-tab').on('click', function() {
                showTab(1);
            });

            // Tombol Previous Tab 3
            $('#btn-prev-tab2').on('click', function() {
                showTab(2);
            });

            // Validasi final sebelum submit
            $('#mainForm').on('submit', function(e) {
                const incorrectData = $('input[name="incorrect_data"]').val();
                const correctData = $('input[name="correct_data"]').val();
                const fieldName = $('input[name="field_name"]').val();

                if (!fieldName) {
                    e.preventDefault();
                    alert('Nama field yang dikoreksi harus diisi!');
                    showTab(3);
                    $('input[name="field_name"]').focus();
                    return false;
                }

                if (!incorrectData) {
                    e.preventDefault();
                    alert('Data yang salah harus diisi!');
                    showTab(3);
                    $('input[name="incorrect_data"]').focus();
                    return false;
                }

                if (!correctData) {
                    e.preventDefault();
                    alert('Data yang benar harus diisi!');
                    showTab(3);
                    $('input[name="correct_data"]').focus();
                    return false;
                }

                if (incorrectData === correctData) {
                    e.preventDefault();
                    alert('Data yang salah dan data yang benar tidak boleh sama!');
                    showTab(3);
                    $('input[name="correct_data"]').focus();
                    return false;
                }

                // Pastikan correction_type terisi
                if (!$('#correction_type_hidden').val()) {
                    $('#correction_type_hidden').val('general');
                }
            });
        });
    </script>

    <script>
        function setTemplate(type) {
            const templates = {
                'nama-siswa': 'Perbedaan Nama Siswa pada Ijazah & Akte.',
                'nama-orangtua': 'Perbedaan Nama Orang Tua pada Ijazah & Akte.',
                'tanggal-lahir': 'Perbedaan Tanggal Lahir pada Ijazah & Akte.',
                'tempat-lahir': 'Perbedaan Tempat Lahir pada Ijazah & Akte.',
                'nomor-ijazah': 'Perbedaan Nomor Ijazah pada Arsip & Dokumen Asli.',
                'tahun-lulus': 'Perbedaan Tahun Lulus pada Ijazah & Arsip.',
                'kompetensi-keahlian': 'Perbedaan Jurusan pada Ijazah & Arsip.',
                'umum-koreksi': 'Perbedaan data antara Ijazah dan dokumen resmi lainnya.'
            };

            const fieldMappings = {
                'nama-siswa': 'Nama Siswa',
                'nama-orangtua': 'Nama Orang Tua',
                'tanggal-lahir': 'Tanggal Lahir',
                'tempat-lahir': 'Tempat Lahir',
                'nomor-ijazah': 'Nomor Ijazah',
                'tahun-lulus': 'Tahun Lulus',
                'kompetensi-keahlian': 'Kompetensi Keahlian',
                'umum-koreksi': 'Data Umum Ijazah'
            };

            const correctionTypeMapping = {
                'nama-siswa': 'student_name',
                'nama-orangtua': 'parent_name',
                'tanggal-lahir': 'birth_date',
                'tempat-lahir': 'birth_place',
                'nomor-ijazah': 'other',
                'tahun-lulus': 'other',
                'kompetensi-keahlian': 'other',
                'umum-koreksi': 'other'
            };

            const graduationYear = $('input[name="graduation_year"]').val() || '[Tahun]';
            const kompetensiKeahlian = $('#kompetensi_keahlian').val() || '[Jurusan]';

            if (templates[type]) {
                let templateText = templates[type];
                templateText = templateText.replace(/\[Tahun\]/g, graduationYear);
                templateText = templateText.replace(/\[Jurusan\]/g, kompetensiKeahlian);

                const incorrectData = $('input[name="incorrect_data"]').val();
                const correctData = $('input[name="correct_data"]').val();

                if (incorrectData && correctData) {
                    templateText += `\n\nDalam Ijazah Tertulis **${incorrectData}** Seharusnya **${correctData}**.`;
                } else {
                    templateText += '\n\nDalam Ijazah Tertulis **[Data yang Salah]** Seharusnya **[Data yang Benar]**.';
                }

                $('#content_textarea').val(templateText);

                if (fieldMappings[type]) {
                    $('input[name="field_name"]').val(fieldMappings[type]);
                }

                if (correctionTypeMapping[type]) {
                    $('#correction_type_hidden').val(correctionTypeMapping[type]);
                }

                $('#content_textarea').addClass('border-success');
                setTimeout(function() {
                    $('#content_textarea').removeClass('border-success');
                }, 1000);
            }
        }
    </script>
@endpush
