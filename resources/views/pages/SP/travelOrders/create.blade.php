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
                            Surat Perintah (SP)
                        </span>
                    </li>
                    <li aria-current="page" class="breadcrumb-item active">
                        <span>
                            Perjalanan Dinas
                        </span>
                    </li>
                    <li aria-current="page" class="breadcrumb-item active">
                        <span class="text-secondary">
                            Tambah Data
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
                            Data SPPD
                        </h4>
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
                                                    Personal Info
                                                </h4>
                                                <p class="text-gray-light mb-0">
                                                    Setup Information
                                                </p>
                                            </div>
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button aria-controls="step7-tab-pane" aria-selected="false"
                                            class="nav-link p-0 d-flex align-items-center" data-bs-target="#step7-tab-pane"
                                            data-bs-toggle="tab" id="step7-tab" role="tab" type="button">
                                            <span
                                                class="fs-20 fw-bold text-primary wh-48 bg-primary bg-opacity-10 rounded-circle d-inline-block">
                                                3
                                            </span>
                                            <div class="text-start ms-3 d-none d-lg-block">
                                                <h4 class="fs-18 fw-semibold">
                                                    Social Links
                                                </h4>
                                                <p class="text-gray-light mb-0">
                                                    Add Social Links
                                                </p>
                                            </div>
                                        </button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabstep2Content">
                                    <div aria-labelledby="step5-tab" class="tab-pane fade show active" id="step5-tab-pane"
                                        role="tabpanel" tabindex="0">
                                        <form>
                                            <div class="row">
                                                {{-- <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Kepala Sekolah
                                                        </label>
                                                        <div class="form-group position-relative">
                                                            <input class="form-control text-dark ps-5 h-55"
                                                                placeholder="Enter Name" type="text" />
                                                            <i
                                                                class="ri-user-2-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20">
                                                            </i>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Nomor Surat
                                                        </label>
                                                        <div class="form-group position-relative">
                                                            <input type="text" class="form-control text-dark ps-5 h-55"
                                                                value="{{ $letterNumber }}"
                                                                placeholder="Masukkan Nomor Surat">

                                                            <i
                                                                class="ri-hashtag position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20">
                                                            </i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Ditugaskan kepada :
                                                        </label>
                                                        <div class="form-group position-relative">
                                                            <select name="petugas_id[]" id="petugas" multiple>
                                                            </select>
                                                            <i
                                                                class="ri-user-2-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20">
                                                            </i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">Pengikut</label>

                                                        <div class="position-relative">
                                                            <select name="pengikut_ids[]" id="pengikut" multiple
                                                                style="width:100%">
                                                            </select>

                                                            <i
                                                                class="ri-user-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group d-flex gap-3">
                                                        <button
                                                            class="btn btn-primary bg-primary bg-opacity-10 text-primary py-3 px-5 fw-semibold border-0">
                                                            Back
                                                        </button>
                                                        <button class="btn btn-primary py-3 px-5 fw-semibold text-white">
                                                            Next
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div aria-labelledby="step6-tab" class="tab-pane fade" id="step6-tab-pane"
                                        role="tabpanel" tabindex="0">
                                        <h4 class="fs-18 fw-semibold">
                                            Personal Information
                                        </h4>
                                        <p class="text-gray-light mb-4">
                                            Fill all Information as below
                                        </p>
                                        <form>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Country
                                                        </label>
                                                        <div class="form-group position-relative">
                                                            <select aria-label="Default select example"
                                                                class="form-select form-control ps-5 h-55">
                                                                <option class="text-dark" selected="">
                                                                    United Kingdom
                                                                </option>
                                                                <option class="text-dark" value="1">
                                                                    United States
                                                                </option>
                                                                <option class="text-dark" value="2">
                                                                    Canada
                                                                </option>
                                                                <option class="text-dark" value="3">
                                                                    France
                                                                </option>
                                                            </select>
                                                            <i
                                                                class="ri-map-2-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20">
                                                            </i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Town/City
                                                        </label>
                                                        <div class="form-group position-relative">
                                                            <select aria-label="Default select example"
                                                                class="form-select form-control ps-5 h-55">
                                                                <option class="text-dark" selected="">
                                                                    California
                                                                </option>
                                                                <option class="text-dark" value="1">
                                                                    United States
                                                                </option>
                                                                <option class="text-dark" value="2">
                                                                    Canada
                                                                </option>
                                                                <option class="text-dark" value="3">
                                                                    France
                                                                </option>
                                                            </select>
                                                            <i
                                                                class="ri-list-ordered position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20">
                                                            </i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            State
                                                        </label>
                                                        <div class="form-group position-relative">
                                                            <select aria-label="Default select example"
                                                                class="form-select form-control ps-5 h-55">
                                                                <option class="text-dark" selected="">
                                                                    South poal evenue state 4C
                                                                </option>
                                                                <option class="text-dark" value="1">
                                                                    United States
                                                                </option>
                                                                <option class="text-dark" value="2">
                                                                    Canada
                                                                </option>
                                                                <option class="text-dark" value="3">
                                                                    France
                                                                </option>
                                                            </select>
                                                            <i
                                                                class="ri-font-size position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20">
                                                            </i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Zip Code
                                                        </label>
                                                        <div class="form-group position-relative">
                                                            <input class="form-control ps-5 text-gray-light h-55"
                                                                placeholder="Enter number" type="number" />
                                                            <i
                                                                class="ri-hashtag position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20">
                                                            </i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Order Notes :
                                                        </label>
                                                        <div class="form-group position-relative">
                                                            <textarea class="form-control ps-5 text-dark" cols="30" placeholder="Some demo text ... " rows="5"></textarea>
                                                            <i
                                                                class="ri-information-line position-absolute top-0 start-0 fs-20 text-gray-light ps-20 pt-2">
                                                            </i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group d-flex gap-3">
                                                        <button
                                                            class="btn btn-primary bg-primary bg-opacity-10 text-primary py-3 px-5 fw-semibold border-0">
                                                            Back
                                                        </button>
                                                        <button class="btn btn-primary py-3 px-5 fw-semibold text-white">
                                                            Next
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div aria-labelledby="step7-tab" class="tab-pane fade" id="step7-tab-pane"
                                        role="tabpanel" tabindex="0">
                                        <h4 class="fs-18 fw-semibold">
                                            Social Information
                                        </h4>
                                        <p class="text-gray-light mb-4">
                                            Fill all Information as below
                                        </p>
                                        <form>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Facebook
                                                        </label>
                                                        <div class="form-group position-relative">
                                                            <input class="form-control text-dark ps-5 h-55"
                                                                placeholder="URL" type="text" />
                                                            <i
                                                                class="ri-facebook-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20">
                                                            </i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Twitter
                                                        </label>
                                                        <div class="form-group position-relative">
                                                            <input class="form-control text-dark ps-5 h-55"
                                                                placeholder="URL" type="text" />
                                                            <i
                                                                class="ri-twitter-x-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20">
                                                            </i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            Linkedin
                                                        </label>
                                                        <div class="form-group position-relative">
                                                            <input class="form-control text-dark ps-5 h-55"
                                                                placeholder="URL" type="email" />
                                                            <i
                                                                class="ri-linkedin-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20">
                                                            </i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label class="label fs-16">
                                                            YouTube
                                                        </label>
                                                        <div class="form-group position-relative">
                                                            <input class="form-control text-dark ps-5 h-55"
                                                                placeholder="URL" type="number" />
                                                            <i
                                                                class="ri-youtube-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20">
                                                            </i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group d-flex gap-3">
                                                        <button
                                                            class="btn btn-primary bg-primary bg-opacity-10 text-primary py-3 px-5 fw-semibold border-0">
                                                            Back
                                                        </button>
                                                        <button class="btn btn-primary py-3 px-5 fw-semibold text-white"
                                                            type="submit">
                                                            Submit
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div aria-labelledby="code2-tab" class="tab-pane fade" id="code2-tab-pane" role="tabpanel"
                                tabindex="0">
                                <button
                                    class="btn btn-outline-primary bg-white btn-sm copy-btn position-absolute top-0 end-0"
                                    data-clipboard-target="#basicAlertsCode2">
                                    Copy
                                </button>
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
    </script>
    <script>
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
    </script>
@endpush
