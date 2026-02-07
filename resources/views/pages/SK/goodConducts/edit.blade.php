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
                            Kelakuan Baik
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
                            Data SKKB
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
                                                    Pilih Siswa
                                                </h4>
                                                <p class="text-gray-light mb-0">
                                                    Tentukan kelas dan siswa
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
                                                    Informasi administrasi dan keterangan surat
                                                </p>
                                            </div>
                                        </button>
                                    </li>
                                </ul>

                                <form action="{{ route('sk.goodConducts.update', $good->id) }}" method="POST" id="mainForm">
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
                                                            Kelas <span class="text-danger"></span>
                                                        </label>
                                                        <div class="form-group position-relative">
                                                            <select name="class_id" id="class_id"
                                                                class="form-select form-control ps-5 h-55" required>
                                                                <option value="">Pilih Kelas :</option>
                                                                @foreach ($classes as $class)
                                                                    <option value="{{ $class->id }}"
                                                                        {{ old('class_id', $good->student->class_id) == $class->id ? 'selected' : '' }}>
                                                                        {{ $class->academic_level }} {{ $class->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <i
                                                                class="ri-map-2-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- siswa --}}
                                                <div class="col-lg-6" id="siswa-container">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Nama Siswa : <span class="text-danger"></span>
                                                        </label>
                                                        <div class="form-group position-relative">
                                                            <select name="student_id" id="siswa" required>
                                                                <option value="{{ $good->student_id }}" selected>
                                                                    {{ $good->student->student->full_name ?? '-' }}
                                                                </option>
                                                            </select>
                                                            <i
                                                                class="ri-user-2-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group d-flex gap-3">
                                                        <a href="{{ route('sk.goodConducts.index') }}"
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
                                                            Nomor Surat
                                                        </label>
                                                        <div class="form-group position-relative">
                                                            <input type="text" name="letter_number"
                                                                class="form-control text-dark ps-5 h-55"
                                                                value="{{ old('letter_number', $good->letter_number) }}" required
                                                                id="letterNumberInput" onfocus="this.select()">
                                                            <i
                                                                class="ri-hashtag position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Tanggal Surat -->
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Tanggal Surat <span class="text-danger"></span>
                                                        </label>
                                                        <div class="form-group position-relative">
                                                            <input type="date" name="issue_date"
                                                                class="form-control ps-5 h-55"
                                                                value="{{ old('issue_date', $good->issue_date) }}" required>
                                                            <i
                                                                class="ri-calendar-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Keterangan / Isi Surat -->
                                                <div class="col-lg-12">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Keterangan / Isi Surat <span class="text-danger"></span>
                                                        </label>
                                                        <div class="form-group position-relative">
                                                            <textarea name="content" class="form-control ps-5" rows="4"
                                                                placeholder="Contoh: Yang bersangkutan benar-benar berkelakuan Baik (tidak terlibat kenakalan remaja apapun)."
                                                                required>{{ old('content', $good->content) }}</textarea>
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
                                                                onclick="setTemplate('kelakuan_baik')">
                                                                <i class="ri-shield-check-line me-1"></i> Kelakuan Baik
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                                onclick="setTemplate('kelakuan_baik_umum')">
                                                                <i class="ri-user-star-line me-1"></i> Kelakuan Baik (Umum)
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                                onclick="setTemplate('kelakuan_baik_polisi')">
                                                                <i class="ri-police-badge-line me-1"></i> Kelakuan Baik
                                                                (Polisi)
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                                onclick="setTemplate('kelakuan_baik_beasiswa')">
                                                                <i class="ri-award-line me-1"></i> Kelakuan Baik (Beasiswa)
                                                            </button>
                                                        </div>
                                                        <div class="d-flex flex-wrap gap-2">
                                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                                onclick="setTemplate('kelakuan_baik_kerja')">
                                                                <i class="ri-briefcase-line me-1"></i> Kelakuan Baik
                                                                (Kerja)
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                                onclick="setTemplate('kelakuan_baik_kuliah')">
                                                                <i class="ri-graduation-cap-line me-1"></i> Kelakuan Baik
                                                                (Sekolah)
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
        $('#class_id').on('change', function() {
            var classId = $(this).val();

            if (classId) {
                $('#siswa-container').slideDown();
                $('#siswa').prop('required', true);
                // Reset select2 saat ganti kelas
                $('#siswa').val(null).trigger('change');
            } else {
                $('#siswa-container').slideUp();
                $('#siswa').prop('required', false);
                $('#siswa').val(null).trigger('change');
            }
        });

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
                'kelakuan_baik': 'Yang bersangkutan benar-benar berkelakuan Baik (tidak terlibat kenakalan remaja apapun).',
                'kelakuan_baik_umum': 'Yang bersangkutan benar-benar berkelakuan Baik, sopan santun, dan tidak pernah melakukan pelanggaran peraturan sekolah.',
                'kelakuan_baik_polisi': 'Yang bersangkutan benar-benar berkelakuan Baik (tidak terlibat dalam tindakan kriminal, pelanggaran hukum, maupun penyalahgunaan narkotika).',
                'kelakuan_baik_beasiswa': 'Yang bersangkutan benar-benar berkelakuan Baik, berprestasi, disiplin, dan tidak pernah melakukan pelanggaran tata tertib sekolah.',
                'kelakuan_baik_kerja': 'Yang bersangkutan benar-benar berkelakuan Baik, bertanggung jawab, dan tidak pernah terlibat dalam pelanggaran disiplin maupun tindakan yang melanggar norma.',
                'kelakuan_baik_kuliah': 'Yang bersangkutan benar-benar berkelakuan Baik, disiplin, dan bermoral baik serta tidak pernah melakukan pelanggaran tata tertib sekolah.'
            };

            $('textarea[name="content"]').val(templates[type] || '');
        }
    </script>
@endpush
