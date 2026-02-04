@extends('layouts.app')

@section('content')
    <div class="main-content-container overflow-hidden">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
            <h3 class="mb-0">Edit Surat Pengantar</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb align-items-center mb-0 lh-1">
                    <li class="breadcrumb-item">
                        <a class="d-flex align-items-center text-decoration-none" href="{{ route('dashboard') }}">
                            <i class="ri-home-8-line fs-15 text-primary me-1"></i>
                            <span class="text-body fs-14 hover">Dashboard</span>
                        </a>
                    </li>
                    <li aria-current="page" class="breadcrumb-item active">
                        <span>Surat Pengantar (SP)</span>
                    </li>
                    <li aria-current="page" class="breadcrumb-item active">
                        <span>Daftar Surat</span>
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
                            Data Surat Pengantar
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
                                                    Informasi Umum
                                                </h4>
                                                <p class="text-gray-light mb-0">
                                                    Data surat pengantar
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
                                                    Detail Naskah
                                                </h4>
                                                <p class="text-gray-light mb-0">
                                                    Isi detail naskah yang dikirim
                                                </p>
                                            </div>
                                        </button>
                                    </li>
                                </ul>

                                {{-- Main Form --}}
                                <form action="{{ route('s_peng.coverLetters.update', $coverLetter->id) }}" id="mainForm"
                                    method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="tab-content" id="myTabstep2Content">

                                        {{-- ===== STEP 1: Informasi Umum ===== --}}
                                        <div aria-labelledby="step1-tab" class="tab-pane fade show active"
                                            id="step1-tab-pane" role="tabpanel" tabindex="0">
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
                                                                value="{{ old('letter_number', $coverLetter->letter_number) }}"
                                                                placeholder="Masukkan Nomor Surat" required>
                                                            <i
                                                                class="ri-hashtag position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
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
                                                                value="{{ old('issue_date', $coverLetter->issue_date) }}"
                                                                required>
                                                            <i
                                                                class="ri-calendar-check-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                            @error('issue_date')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Kepada --}}
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Kepada <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="form-group position-relative">
                                                            <input type="text" name="towards"
                                                                class="form-control ps-5 h-55 @error('towards') is-invalid @enderror"
                                                                value="{{ old('towards', $coverLetter->towards) }}"
                                                                required>
                                                            <i
                                                                class="ri-user-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                            @error('towards')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Kepala Sekolah --}}
                                                {{-- <div class="col-lg-12">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Kepala Sekolah
                                                        </label>
                                                        <div class="form-group position-relative">
                                                            <select name="headmaster_id"
                                                                class="form-select form-control ps-5 h-55 @error('headmaster_id') is-invalid @enderror">
                                                                <option value="">Pilih Kepala Sekolah (Opsional)</option>
                                                                @foreach ($headmasters as $headmaster)
                                                                    <option value="{{ $headmaster->id }}"
                                                                        {{ old('headmaster_id', $coverLetter->headmaster_id) == $headmaster->id ? 'selected' : '' }}>
                                                                        {{ $headmaster->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <i
                                                                class="ri-user-star-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                            @error('headmaster_id')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>

                                        {{-- ===== STEP 2: Detail Naskah ===== --}}
                                        <div aria-labelledby="step2-tab" class="tab-pane fade" id="step2-tab-pane"
                                            role="tabpanel" tabindex="0">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h5 class="fs-16 fw-semibold mb-0">
                                                    <i class="ri-file-list-3-line me-2"></i>Detail Naskah/Surat yang
                                                    Dikirim
                                                </h5>
                                                <div class="d-flex gap-2">
                                                    <span class="badge bg-primary">
                                                        Total: <span
                                                            id="total-naskah">{{ $coverLetter->details->count() }}</span>
                                                        Naskah
                                                    </span>
                                                    <button type="button" class="btn btn-sm btn-success"
                                                        id="btn-add-naskah">
                                                        <i class="ri-add-line"></i> Tambah Naskah
                                                    </button>
                                                </div>
                                            </div>

                                            <div id="naskah-container">
                                                @foreach ($coverLetter->details as $index => $detail)
                                                    <div class="card border mb-3 naskah-item"
                                                        data-index="{{ $index + 1 }}">
                                                        <div
                                                            class="card-header bg-white d-flex justify-content-between align-items-center">
                                                            <h6 class="mb-0 fw-semibold">
                                                                <i class="ri-file-text-line me-2"></i>Naskah ke-<span
                                                                    class="naskah-number">{{ $index + 1 }}</span>
                                                            </h6>
                                                            @if ($index > 0)
                                                                <button type="button"
                                                                    class="btn btn-sm btn-danger btn-remove-naskah">
                                                                    <i class="ri-delete-bin-line"></i>
                                                                </button>
                                                            @endif
                                                        </div>
                                                        <div class="card-body">
                                                            <input type="hidden" name="details[{{ $index + 1 }}][id]"
                                                                value="{{ $detail->id }}">
                                                            <div class="row">
                                                                {{-- Dokumen yang Dikirim --}}
                                                                <div class="col-lg-6">
                                                                    <div class="form-group mb-3">
                                                                        <label class="label fs-14">
                                                                            Dokumen yang Dikirim <span
                                                                                class="text-danger">*</span>
                                                                        </label>
                                                                        <div class="form-group position-relative">
                                                                            <input type="text"
                                                                                name="details[{{ $index + 1 }}][document_sent]"
                                                                                class="form-control ps-5 h-55 @error('details.' . ($index + 1) . '.document_sent') is-invalid @enderror"
                                                                                placeholder="Contoh: Surat Keputusan Kepala Sekolah"
                                                                                value="{{ old('details.' . ($index + 1) . '.document_sent', $detail->document_sent) }}"
                                                                                required>
                                                                            <i
                                                                                class="ri-file-text-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                                            @error('details.' . ($index + 1) .
                                                                                '.document_sent')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                {{-- Jumlah --}}
                                                                <div class="col-lg-6">
                                                                    <div class="form-group mb-3">
                                                                        <label class="label fs-14">
                                                                            Jumlah <span class="text-danger">*</span>
                                                                        </label>
                                                                        <div class="form-group position-relative">
                                                                            <input type="number"
                                                                                name="details[{{ $index + 1 }}][qty]"
                                                                                class="form-control ps-5 h-55 @error('details.' . ($index + 1) . '.qty') is-invalid @enderror"
                                                                                placeholder="Contoh: 2" min="1"
                                                                                value="{{ old('details.' . ($index + 1) . '.qty', $detail->qty) }}"
                                                                                required>
                                                                            <i
                                                                                class="ri-hashtag position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                                            @error('details.' . ($index + 1) . '.qty')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                {{-- Catatan --}}
                                                                <div class="col-lg-12">
                                                                    <div class="form-group mb-0">
                                                                        <label class="label fs-14">
                                                                            Catatan (Opsional)
                                                                        </label>
                                                                        <div class="form-group position-relative">
                                                                            <textarea name="details[{{ $index + 1 }}][notes]"
                                                                                class="form-control ps-5 @error('details.' . ($index + 1) . '.notes') is-invalid @enderror" rows="3"
                                                                                placeholder="Tambahkan catatan jika diperlukan">{{ old('details.' . ($index + 1) . '.notes', $detail->notes) }}</textarea>
                                                                            <i
                                                                                class="ri-sticky-note-line position-absolute top-0 start-0 fs-20 text-gray-light ps-20 pt-3"></i>
                                                                            @error('details.' . ($index + 1) . '.notes')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                    </div>

                                    {{-- Tombol Aksi di Bawah Form --}}
                                    <div class="row mt-4">
                                        <div class="col-lg-12">
                                            <div class="form-group d-flex justify-content-between gap-3">
                                                <a href="{{ route('s_peng.coverLetters.index') }}"
                                                    class="btn btn-primary bg-primary bg-opacity-10 text-primary py-3 px-5 fw-semibold border-0">
                                                    <i class="ri-arrow-left-line me-1"></i> Kembali
                                                </a>
                                                <button type="submit"
                                                    class="btn btn-primary py-3 px-5 fw-semibold text-white">
                                                    <i class="ri-save-line me-1"></i> Update
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
        let naskahCounter = {{ $coverLetter->details->count() }};

        // Fungsi untuk update nomor naskah
        function updateNaskahNumbers() {
            const naskahItems = document.querySelectorAll('.naskah-item');
            naskahItems.forEach((item, index) => {
                const numberSpan = item.querySelector('.naskah-number');
                if (numberSpan) {
                    numberSpan.textContent = index + 1;
                }
                item.setAttribute('data-index', index + 1);

                // Update name attributes
                const inputs = item.querySelectorAll('input, textarea');
                inputs.forEach(input => {
                    const name = input.getAttribute('name');
                    if (name) {
                        const newName = name.replace(/details\[\d+\]/, `details[${index + 1}]`);
                        input.setAttribute('name', newName);
                    }
                });
            });

            // Update total count
            document.getElementById('total-naskah').textContent = naskahItems.length;
        }

        // Tambah naskah baru
        document.getElementById('btn-add-naskah').addEventListener('click', function() {
            naskahCounter++;
            const container = document.getElementById('naskah-container');
            const newNaskah = document.createElement('div');
            newNaskah.className = 'card border mb-3 naskah-item';
            newNaskah.setAttribute('data-index', naskahCounter);
            newNaskah.innerHTML = `
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-semibold">
                        <i class="ri-file-text-line me-2"></i>Naskah ke-<span class="naskah-number">${naskahCounter}</span>
                    </h6>
                    <button type="button" class="btn btn-sm btn-danger btn-remove-naskah">
                        <i class="ri-delete-bin-line"></i>
                    </button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="label fs-14">
                                    Dokumen yang Dikirim <span class="text-danger">*</span>
                                </label>
                                <div class="form-group position-relative">
                                    <input type="text" name="details[${naskahCounter}][document_sent]"
                                        class="form-control ps-5 h-55"
                                        placeholder="Contoh: Surat Keputusan Kepala Sekolah" required>
                                    <i class="ri-file-text-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="label fs-14">
                                    Jumlah <span class="text-danger">*</span>
                                </label>
                                <div class="form-group position-relative">
                                    <input type="number" name="details[${naskahCounter}][qty]"
                                        class="form-control ps-5 h-55" placeholder="Contoh: 2" min="1" value="1" required>
                                    <i class="ri-hashtag position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mb-0">
                                <label class="label fs-14">
                                    Catatan (Opsional)
                                </label>
                                <div class="form-group position-relative">
                                    <textarea name="details[${naskahCounter}][notes]" class="form-control ps-5" rows="3"
                                        placeholder="Tambahkan catatan jika diperlukan"></textarea>
                                    <i class="ri-sticky-note-line position-absolute top-0 start-0 fs-20 text-gray-light ps-20 pt-3"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            container.appendChild(newNaskah);
            updateNaskahNumbers();
        });

        // Hapus naskah
        document.addEventListener('click', function(e) {
            if (e.target.closest('.btn-remove-naskah')) {
                if (confirm('Apakah Anda yakin ingin menghapus naskah ini?')) {
                    const naskahItem = e.target.closest('.naskah-item');
                    naskahItem.remove();
                    updateNaskahNumbers();
                }
            }
        });

        // Validasi form sebelum submit
        document.getElementById('mainForm').addEventListener('submit', function(e) {
            let valid = true;
            const naskahItems = document.querySelectorAll('.naskah-item');

            naskahItems.forEach((item) => {
                const documentInput = item.querySelector('input[name*="[document_sent]"]');
                const qtyInput = item.querySelector('input[name*="[qty]"]');

                if (!documentInput.value.trim()) {
                    valid = false;
                    documentInput.classList.add('is-invalid');
                } else {
                    documentInput.classList.remove('is-invalid');
                }

                if (!qtyInput.value || qtyInput.value < 1) {
                    valid = false;
                    qtyInput.classList.add('is-invalid');
                } else {
                    qtyInput.classList.remove('is-invalid');
                }
            });

            if (!valid) {
                e.preventDefault();
                alert('Mohon lengkapi semua data naskah yang wajib diisi');
            }
        });
    </script>
@endpush
