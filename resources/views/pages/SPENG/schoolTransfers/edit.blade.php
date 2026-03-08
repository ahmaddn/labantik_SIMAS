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
                        <span>Surat Pengantar</span>
                    </li>
                    <li aria-current="page" class="breadcrumb-item active">
                        <span>Pindah Sekolah</span>
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
                            Edit Data Surat Pindah Sekolah
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
                                                    Pilih siswa yang akan pindah
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
                                                    Isi detail surat pindah
                                                </p>
                                            </div>
                                        </button>
                                    </li>
                                </ul>

                                {{-- Main Form --}}
                                <form action="{{ route('s_peng.schoolTransfers.update', $transferLetter->id) }}"
                                    id="mainForm" method="POST">
                                    @csrf
                                    @method('PUT')

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
                                                                        {{ old('class_id', $transferLetter->student->class_id) == $class->id ? 'selected' : '' }}>
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
                                                <div class="col-lg-6" id="siswa-container">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Nama Siswa <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="form-group position-relative">
                                                            <select name="student_id" id="siswa"
                                                                class="form-select form-control ps-5 h-55 @error('student_id') is-invalid @enderror"
                                                                required>
                                                                <option value="{{ $transferLetter->student_id }}">
                                                                    {{ $transferLetter->student->student->full_name }} -
                                                                    {{ $transferLetter->student->student->student_number }}
                                                                </option>
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
                                                <a href="{{ route('s_peng.schoolTransfers.index') }}"
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
                                                                value="{{ old('letter_number', $transferLetter->letter_number) }}"
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
                                                                value="{{ old('issue_date', $transferLetter->issue_date) }}"
                                                                required>
                                                            <i
                                                                class="ri-calendar-check-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                            @error('issue_date')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>


                                                {{-- Sekolah Tujuan --}}
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Sekolah Tujuan <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="form-group position-relative">
                                                            <input type="text" name="destination_school"
                                                                class="form-control ps-5 h-55 @error('destination_school') is-invalid @enderror"
                                                                placeholder="Contoh: SMK Negeri 2 Majalengka"
                                                                value="{{ old('destination_school', $transferLetter->destination_school) }}"
                                                                required>
                                                            <i
                                                                class="ri-school-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                            @error('destination_school')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Template Alasan --}}
                                                {{-- <div class="col-lg-12">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Template Alasan
                                                        </label>
                                                        <div class="d-flex flex-wrap gap-2 mb-2">
                                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                                onclick="setReason('pindah-domisili')">
                                                                <i class="ri-home-line me-1"></i> Pindah Domisili
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                                onclick="setReason('orang-tua')">
                                                                <i class="ri-parent-line me-1"></i> Permintaan Orang Tua
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                                onclick="setReason('ekonomi')">
                                                                <i class="ri-money-dollar-circle-line me-1"></i> Alasan
                                                                Ekonomi
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                                onclick="setReason('jurusan')">
                                                                <i class="ri-book-line me-1"></i> Pindah Jurusan
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div> --}}

                                                {{-- Alasan --}}
                                                {{-- <div class="col-lg-12">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Alasan Pindah <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="form-group position-relative">
                                                            <textarea name="reason" id="reason" class="form-control ps-5 @error('reason') is-invalid @enderror"
                                                                rows="4" placeholder="Masukkan alasan pindah sekolah" required>{{ old('reason', $transferLetter->reason) }}</textarea>
                                                            <i
                                                                class="ri-file-text-line position-absolute top-0 start-0 fs-20 text-gray-light ps-20 pt-3"></i>
                                                            @error('reason')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div> --}}

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

        // ─── Kelas berubah → tampilkan / sembunyikan Siswa ──────────────
        $('#class_id').on('change', function() {
            var classId = $(this).val();

            if (classId) {
                if (!siswaSelectInitialized) {
                    initSiswaSelect2();
                    siswaSelectInitialized = true;
                }
            } else {
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
                    url: '{{ route('s_peng.students.search') }}',
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

        // // ─── Template alasan pindah ─────────────────────────────────────
        // function setReason(type) {
        //     const reasons = {
        //         'pindah-domisili': 'Siswa yang bersangkutan mengajukan pindah sekolah dikarenakan orang tua/wali pindah domisili ke daerah lain yang mengharuskan siswa untuk melanjutkan pendidikan di sekolah yang lebih dekat dengan tempat tinggal baru.',
        //         'orang-tua': 'Siswa yang bersangkutan mengajukan pindah sekolah atas permintaan orang tua/wali untuk melanjutkan pendidikan di sekolah lain yang dianggap lebih sesuai dengan kebutuhan dan kondisi keluarga.',
        //         'ekonomi': 'Siswa yang bersangkutan mengajukan pindah sekolah dikarenakan kondisi ekonomi keluarga yang mengharuskan untuk mencari alternatif sekolah yang lebih terjangkau atau dekat dengan tempat tinggal untuk menghemat biaya transportasi.',
        //         'jurusan': 'Siswa yang bersangkutan mengajukan pindah sekolah untuk melanjutkan pendidikan dengan jurusan/program keahlian yang lebih sesuai dengan minat dan bakat siswa yang tidak tersedia di sekolah ini.'
        //     };

        //     $('#reason').val(reasons[type] || '');
        // }

        // // Initialize Select2 on page load
        // $(document).ready(function() {
        //     initSiswaSelect2();
        //     siswaSelectInitialized = true;
        // });
    </script>
@endpush
