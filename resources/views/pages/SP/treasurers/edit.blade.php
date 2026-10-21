@extends('layouts.app')
@section('content')
    <div class="main-content-container overflow-hidden">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
            <h3 class="mb-0">Edit Bendahara</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb align-items-center mb-0 lh-1">
                    <li class="breadcrumb-item">
                        <a class="d-flex align-items-center text-decoration-none" href="{{ route('dashboard') }}">
                            <i class="ri-home-8-line fs-15 text-primary me-1"></i>
                            <span class="text-body fs-14 hover">Dashboard</span>
                        </a>
                    </li>
                    <li aria-current="page" class="breadcrumb-item active"><span>Surat Perintah (SP)</span></li>
                    <li aria-current="page" class="breadcrumb-item">
                        <a href="{{ route('sp.treasurers.index') }}" class="text-decoration-none text-body hover">Master Bendahara</a>
                    </li>
                    <li aria-current="page" class="breadcrumb-item active">
                        <span class="text-secondary">Edit Bendahara</span>
                    </li>
                </ol>
            </nav>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card bg-white border border-white rounded-10 mb-4">
            <div class="card-body p-20">
                <h4 class="fs-18 fw-medium mb-20">Form Edit Bendahara</h4>
                <form action="{{ route('sp.treasurers.update', $treasurer->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <label class="label fs-16">Pilih dari Data Pegawai (Opsional)</label>
                            <div class="position-relative">
                                <select id="employee_select" name="employee_id" class="form-select ps-5 h-55">
                                    <option value="">-- Tetapkan Pegawai --</option>
                                    @foreach ($employees as $emp)
                                        <option value="{{ $emp->id }}"
                                            data-name="{{ $emp->full_name }}"
                                            data-nip="{{ $emp->nip }}"
                                            {{ old('employee_id', $treasurer->employee_id) == $emp->id ? 'selected' : '' }}>
                                            {{ $emp->full_name }} {{ $emp->nip ? '— NIP ' . $emp->nip : '' }}
                                        </option>
                                    @endforeach
                                </select>
                                <i class="ri-user-search-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                            </div>
                        </div>

                        <div class="col-lg-6 mb-4">
                            <label class="label fs-16">Nama Bendahara <span class="text-danger">*</span></label>
                            <div class="position-relative">
                                <input type="text" name="name" id="treasurer_name"
                                    class="form-control ps-5 h-55 @error('name') is-invalid @enderror"
                                    placeholder="Masukkan Nama Bendahara beserta gelar"
                                    value="{{ old('name', $treasurer->name) }}" required>
                                <i class="ri-user-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                @error('name')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6 mb-4">
                            <label class="label fs-16">NIP</label>
                            <div class="position-relative">
                                <input type="text" name="nip" id="treasurer_nip"
                                    class="form-control ps-5 h-55 @error('nip') is-invalid @enderror"
                                    placeholder="Masukkan NIP (kosongkan bila tidak ada)"
                                    value="{{ old('nip', $treasurer->nip) }}">
                                <i class="ri-id-card-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                @error('nip')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6 mb-4">
                            <label class="label fs-16">Jabatan <span class="text-danger">*</span></label>
                            <div class="position-relative">
                                <input type="text" name="position"
                                    class="form-control ps-5 h-55 @error('position') is-invalid @enderror"
                                    placeholder="Contoh: Bendahara Pengeluaran / Bendahara"
                                    value="{{ old('position', $treasurer->position) }}" required>
                                <i class="ri-briefcase-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                @error('position')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6 mb-4">
                            <label class="label fs-16">Status <span class="text-danger">*</span></label>
                            <div class="position-relative">
                                <select name="is_active" class="form-select ps-5 h-55 @error('is_active') is-invalid @enderror">
                                    <option value="1" {{ old('is_active', $treasurer->is_active ? '1' : '0') == '1' ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ old('is_active', $treasurer->is_active ? '1' : '0') == '0' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                                <i class="ri-toggle-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                @error('is_active')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12 d-flex justify-content-end gap-3 mt-3">
                            <a href="{{ route('sp.treasurers.index') }}" class="btn btn-secondary py-3 px-4">Batal</a>
                            <button type="submit" class="btn btn-primary py-3 px-5 text-white">Perbarui</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.getElementById('employee_select').addEventListener('change', function() {
        const selected = this.options[this.selectedIndex];
        if (selected.value) {
            document.getElementById('treasurer_name').value = selected.getAttribute('data-name') || '';
            document.getElementById('treasurer_nip').value = selected.getAttribute('data-nip') || '';
        }
    });
</script>
@endpush
