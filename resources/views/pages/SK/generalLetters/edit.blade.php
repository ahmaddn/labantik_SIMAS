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
                        <a class="d-flex align-items-center text-decoration-none" href="index.html">
                            <i class="ri-home-8-line fs-15 text-primary me-1">
                            </i>
                            <span class="text-body fs-14 hover">
                                Dashboard
                            </span>
                        </a>
                    </li>
                    <li aria-current="page" class="breadcrumb-item active">
                        <span>
                            Surat Keterangan (SK)
                        </span>
                    </li>
                    <li aria-current="page" class="breadcrumb-item active">
                        <span>
                            Siswa
                        </span>
                    </li>
                    <li aria-current="page" class="breadcrumb-item active">
                        <span class="text-secondary">
                            Edit Data
                        </span>
                    </li>
                </ol>
            </nav>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card bg-white border border-white rounded-10 mb-4">
                    <div class="card-body p-20">
                        <h4 class="fs-18 fw-medium mb-20">
                            Edit Data SKS
                        </h4>
                        <div class="tab-content" id="myTab2Content">
                            <div aria-labelledby="preview2-tab" class="tab-pane fade show active" id="preview2-tab-pane"
                                role="tabpanel" tabindex="0">
                                <ul class="nav nav-tabs justify-content-around border-0 mb-4 wizard-tabs2" id="myTabstep2"
                                    role="tablist">
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
                                                    Isi informasi dibawah ini
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
                                                    Data Surat
                                                </h4>
                                                <p class="text-gray-light mb-0">
                                                    Detail Surat Keterangan
                                                </p>
                                            </div>
                                        </button>
                                    </li>
                                </ul>

                                <form action="{{ route('sk.generalLetters.update', $letter->id) }}" method="POST"
                                    id="mainForm">
                                    @csrf
                                    @method('PUT')
                                    <div class="tab-content" id="myTabstep2Content">
                                        <div aria-labelledby="step5-tab" class="tab-pane fade show active"
                                            id="step5-tab-pane" role="tabpanel" tabindex="0">
                                            <div class="row">
                                                <div class="row mb-4">
                                                    <div class="col-lg-12">
                                                        <div class="card bg-light">
                                                            <div class="card-body">
                                                                <h6 class="card-title fw-semibold">Kepala Sekolah</h6>
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <div>
                                                                        @if (isset($letter->headmaster))
                                                                            <p class="mb-1">
                                                                                <strong>{{ $letter->headmaster->full_name }}</strong>
                                                                            </p>
                                                                            <p class="mb-0 text-muted">
                                                                                NIP:
                                                                                {{ $letter->headmaster->nip ?? '197610012006041011' }}
                                                                                @if ($letter->headmaster->job_name)
                                                                                    | {{ $letter->headmaster->job_name }}
                                                                                @endif
                                                                            </p>
                                                                        @else
                                                                            <p class="mb-1">
                                                                                <strong>Belum dipilih</strong>
                                                                            </p>
                                                                            <p class="mb-0 text-muted">
                                                                                Silahkan pilih kepala sekolah
                                                                            </p>
                                                                        @endif
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
                                                                class="form-select form-control ps-5 h-55" required>
                                                                <option value="">Pilih Kelas :</option>
                                                                @foreach ($classes as $class)
                                                                    <option value="{{ $class->id }}"
                                                                        {{ $letter->student->class_id == $class->id ? 'selected' : '' }}>
                                                                        {{ $class->academic_level }} {{ $class->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <i
                                                                class="ri-map-2-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- siswa - PERBAIKAN: Tampilkan jika ada data siswa sebelumnya --}}
                                                <div class="col-lg-6" id="siswa-container"
                                                    style="display: {{ $letter->student_id ? 'block' : 'none' }}">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Nama Siswa : <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="form-group position-relative">
                                                            <select name="student_id" id="siswa" required>
                                                                <option value="">Pilih Siswa :</option>
                                                                {{-- Tampilkan siswa yang sudah dipilih --}}
                                                                @if ($letter->student_id && $letter->student)
                                                                    <option value="{{ $letter->student->id }}" selected>
                                                                        {{ $letter->student->student->full_name }}
                                                                        @if ($letter->student->student && $letter->student->student->student_number)
                                                                            ({{ $letter->student->student->student_number }})
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
                                                    <div class="form-group d-flex gap-3">
                                                        <a href="{{ route('sk.generalLetters.index') }}"
                                                            class="btn btn-primary bg-primary bg-opacity-10 text-primary py-3 px-5 fw-semibold border-0">
                                                            Back
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div aria-labelledby="step6-tab" class="tab-pane fade" id="step6-tab-pane"
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
                                                                class="form-control text-dark ps-5 h-55"
                                                                value="{{ $letter->letter_number }}" required>
                                                            <i
                                                                class="ri-hashtag position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
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
                                                                class="form-control ps-5 h-55"
                                                                value="{{ \Carbon\Carbon::parse($letter->issue_date)->format('Y-m-d') }}"
                                                                required>
                                                            <i
                                                                class="ri-calendar-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Keterangan / Isi Surat -->
                                                <div class="col-lg-12">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Keterangan / Isi Surat <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="form-group position-relative">
                                                            <textarea name="content" class="form-control ps-5" rows="4"
                                                                placeholder="Contoh: Yang bersangkutan adalah benar siswa di SMK Negeri 1 Talaga Tahun Pelajaran 2025/2026 dan aktif mengikuti kegiatan ekstrakurikuler bola voli."
                                                                required>{{ $letter->content }}</textarea>
                                                            <i
                                                                class="ri-file-text-line position-absolute top-0 start-0 fs-20 text-gray-light ps-20 pt-3"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Template Keterangan Cepat -->
                                                <div class="col-lg-12">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Template Keterangan
                                                        </label>
                                                        <div class="d-flex flex-wrap gap-2 mb-2">
                                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                                onclick="setTemplate('ekstrakurikuler')">
                                                                <i class="ri-team-line me-1"></i> Ekstrakurikuler
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                                onclick="setTemplate('lomba')">
                                                                <i class="ri-trophy-line me-1"></i> Perlombaan
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                                onclick="setTemplate('beasiswa')">
                                                                <i class="ri-award-line me-1"></i> Beasiswa
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                                onclick="setTemplate('administrasi')">
                                                                <i class="ri-file-paper-line me-1"></i> Administrasi
                                                            </button>
                                                        </div>
                                                        <div class="d-flex flex-wrap gap-2">
                                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                                onclick="setTemplate('aktif')">
                                                                <i class="ri-check-line me-1"></i> Siswa Aktif
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                                onclick="setTemplate('prestasi')">
                                                                <i class="ri-medal-line me-1"></i> Prestasi
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

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
        // PERBAIKAN: Inisialisasi Select2 saat halaman dimuat
        $(document).ready(function() {
            // Inisialisasi select2 untuk siswa
            $('#siswa').select2({
                placeholder: 'Cari Siswa...',
                allowClear: true,
                minimumInputLength: 2,
                ajax: {
                    url: '{{ route('sk.students.search') }}',
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
        });

        $('#class_id').on('change', function() {
            var classId = $(this).val();

            if (classId) {
                $('#siswa-container').slideDown();
                $('#siswa').prop('required', true);

                // Reset pilihan siswa jika kelas diganti (opsional)
                // Uncomment baris di bawah jika ingin reset siswa saat ganti kelas
                // $('#siswa').val(null).trigger('change');
            } else {
                $('#siswa-container').slideUp();
                $('#siswa').prop('required', false);
                $('#siswa').val(null).trigger('change');
            }
        });

        // Navigasi antara tab
        $('.next-tab').click(function() {
            // Validasi tab pertama sebelum lanjut
            const classId = $('#class_id').val();
            const siswaId = $('#siswa').val();

            if (!classId) {
                alert('Pilih kelas terlebih dahulu!');
                $('#class_id').focus();
                return false;
            }

            // Lanjut ke tab berikutnya
            $('#step6-tab').tab('show');
        });

        $('.prev-tab').click(function() {
            $('#step5-tab').tab('show');
        });

        // Validasi sebelum submit
        $('#mainForm').on('submit', function(e) {
            // Validasi semua required field
            const classId = $('#class_id').val();
            const siswaId = $('#siswa').val();
            const letterNumber = $('input[name="letter_number"]').val();
            const content = $('textarea[name="content"]').val();

            if (!classId || !siswaId || !letterNumber || !content) {
                alert('Harap lengkapi semua field yang wajib diisi!');
                e.preventDefault();
                return false;
            }
        });
    </script>

    <script>
        function setTemplate(type) {
            const templates = {
                'ekstrakurikuler': 'Yang bersangkutan adalah benar siswa di SMK Negeri 1 Talaga Tahun Pelajaran 2025/2026 dan aktif mengikuti kegiatan ekstrakurikuler bola voli.',
                'lomba': 'Yang bersangkutan adalah benar siswa di SMK Negeri 1 Talaga Tahun Pelajaran 2025/2026 dan akan mewakili sekolah dalam mengikuti perlombaan tingkat kabupaten.',
                'beasiswa': 'Yang bersangkutan adalah benar siswa di SMK Negeri 1 Talaga Tahun Pelajaran 2025/2026 dengan prestasi akademik yang baik untuk mengajukan beasiswa.',
                'administrasi': 'Yang bersangkutan adalah benar siswa di SMK Negeri 1 Talaga Tahun Pelajaran 2025/2026. Surat ini dibuat untuk keperluan administrasi.',
                'aktif': 'Yang bersangkutan adalah benar siswa aktif di SMK Negeri 1 Talaga Tahun Pelajaran 2025/2026.',
                'prestasi': 'Yang bersangkutan adalah benar siswa di SMK Negeri 1 Talaga Tahun Pelajaran 2025/2026 dan berprestasi dalam bidang akademik/non-akademik.'
            };

            $('textarea[name="content"]').val(templates[type] || '');
        }
    </script>
@endpush
