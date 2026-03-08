@extends('layouts.app')
@section('content')
    <div class="main-content-container overflow-hidden">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
            <h3 class="mb-0">Edit Kategori Biaya</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb align-items-center mb-0 lh-1">
                    <li class="breadcrumb-item">
                        <a class="d-flex align-items-center text-decoration-none" href="{{ route('dashboard') }}">
                            <i class="ri-home-8-line fs-15 text-primary me-1"></i>
                            <span class="text-body fs-14 hover">Dashboard</span>
                        </a>
                    </li>
                    <li aria-current="page" class="breadcrumb-item active"><span>Surat Perintah (SP)</span></li>
                    <li aria-current="page" class="breadcrumb-item active">
                        <a href="{{ route('sp.travelCostCategories.index') }}" class="text-decoration-none text-body">
                            Kategori Biaya
                        </a>
                    </li>
                    <li aria-current="page" class="breadcrumb-item active">
                        <span class="text-secondary">Edit</span>
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
            <div class="col-lg-8">
                <div class="card bg-white border border-white rounded-10 mb-4">
                    <div class="card-body p-20">
                        <h4 class="fs-18 fw-medium mb-20">Edit Kategori: <span
                                class="text-primary">{{ $category->name }}</span></h4>

                        <form action="{{ route('sp.travelCostCategories.update', $category->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            {{-- Nama --}}
                            <div class="form-group mb-4">
                                <label class="label fs-16">Nama Kategori <span class="text-danger">*</span></label>
                                <div class="form-group position-relative">
                                    <input type="text" name="name"
                                        class="form-control text-dark ps-5 h-55 @error('name') is-invalid @enderror"
                                        placeholder="Contoh: Hotel, BBM, Tol, Pesawat..."
                                        value="{{ old('name', $category->name) }}" required>
                                    <i
                                        class="ri-price-tag-3-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Tipe --}}
                            <div class="form-group mb-4">
                                <label class="label fs-16">Tipe <span class="text-danger">*</span></label>
                                <div class="form-group position-relative">
                                    <select name="type"
                                        class="form-select form-control ps-5 h-55 @error('type') is-invalid @enderror"
                                        required>
                                        <option value="">-- Pilih Tipe --</option>
                                        <option value="accommodation"
                                            {{ old('type', $category->type) === 'accommodation' ? 'selected' : '' }}>
                                            🏨 Penginapan (Hotel, Guest House, dll)
                                        </option>
                                        <option value="transport"
                                            {{ old('type', $category->type) === 'transport' ? 'selected' : '' }}>
                                            🚗 Transport (BBM, Tol, Pesawat, dll)
                                        </option>
                                    </select>
                                    <i
                                        class="ri-stack-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Deskripsi --}}
                            <div class="form-group mb-4">
                                <label class="label fs-16">Deskripsi</label>
                                <div class="form-group position-relative">
                                    <textarea name="description" rows="3"
                                        class="form-control ps-5 text-gray-light @error('description') is-invalid @enderror"
                                        placeholder="Deskripsi singkat kategori (opsional)">{{ old('description', $category->description) }}</textarea>
                                    <i
                                        class="ri-file-text-line position-absolute top-0 mt-3 start-0 fs-20 text-gray-light ps-20"></i>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                {{-- Urutan --}}
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label fs-16">Urutan Tampil</label>
                                        <div class="form-group position-relative">
                                            <input type="number" name="sort_order"
                                                class="form-control text-dark ps-5 h-55 @error('sort_order') is-invalid @enderror"
                                                placeholder="0" min="0"
                                                value="{{ old('sort_order', $category->sort_order) }}">
                                            <i
                                                class="ri-sort-asc position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                            @error('sort_order')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <small class="text-muted">Angka lebih kecil tampil lebih dulu.</small>
                                    </div>
                                </div>

                                {{-- Status --}}
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label fs-16">Status</label>
                                        <div class="d-flex align-items-center gap-4 mt-2" style="height: 45px;">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="is_active"
                                                    id="activeYes" value="1"
                                                    {{ old('is_active', $category->is_active ? '1' : '0') == '1' ? 'checked' : '' }}>
                                                <label class="form-check-label text-success fw-medium" for="activeYes">
                                                    <i class="ri-checkbox-circle-line me-1"></i>Aktif
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="is_active"
                                                    id="activeNo" value="0"
                                                    {{ old('is_active', $category->is_active ? '1' : '0') == '0' ? 'checked' : '' }}>
                                                <label class="form-check-label text-danger fw-medium" for="activeNo">
                                                    <i class="ri-close-circle-line me-1"></i>Nonaktif
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Tombol --}}
                            <div class="form-group d-flex justify-content-end gap-3 mt-2">
                                <a href="{{ route('sp.travelCostCategories.index') }}"
                                    class="btn btn-secondary py-3 px-5 fw-semibold">Batal</a>
                                <button type="submit" class="btn btn-primary py-3 px-5 fw-semibold text-white">
                                    <i class="ri-save-line me-1"></i>Update
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
