@extends('layouts.app')
@section('title', 'Surat Keterangan Siswa')
@section('content')
    <div class="main-content-container overflow-hidden">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
            <h3 class="mb-0">
                Siswa
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
                            Surat Keterangan Siswa
                        </span>
                    </li>
                    <li aria-current="page" class="breadcrumb-item active">
                        <span>
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
                            Form Siswa
                        </h4>

                        <div class="tab-content" id="myTabContent">
                            <div aria-labelledby="preview-tab" class="tab-pane fade show active" id="preview-tab-pane"
                                role="tabpanel" tabindex="0">
                                <ul class="nav nav-tabs justify-content-around border-0 mb-4 wizard-tabs2" id="myTabstep2"
                                    role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link p-0 d-flex align-items-center active" id="step5-tab"
                                            data-bs-toggle="tab" data-bs-target="#step5-tab-pane" type="button"
                                            role="tab" aria-controls="step5-tab-pane" aria-selected="true">
                                            <span
                                                class="fs-20 fw-bold text-primary wh-48 bg-primary bg-opacity-10 rounded-circle d-inline-block">1</span>
                                            <div class="text-start ms-3">
                                                <h4 class="fs-18 fw-semibold">General Information</h4>
                                                <p class="text-gray-light mb-0">Fill all Information as
                                                    below</p>
                                            </div>
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link p-0 d-flex align-items-center" id="step6-tab"
                                            data-bs-toggle="tab" data-bs-target="#step6-tab-pane" type="button"
                                            role="tab" aria-controls="step6-tab-pane" aria-selected="false">
                                            <span
                                                class="fs-20 fw-bold text-primary wh-48 bg-primary bg-opacity-10 rounded-circle d-inline-block">2</span>
                                            <div class="text-start ms-3">
                                                <h4 class="fs-18 fw-semibold">Personal Info</h4>
                                                <p class="text-gray-light mb-0">Setup Information</p>
                                            </div>
                                        </button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabstepContent">
                                    <div aria-labelledby="step1-tab" class="tab-pane fade show active" id="step1-tab-pane"
                                        role="tabpanel" tabindex="0">
                                        <h4 class="fs-18 fw-semibold">
                                            Informasi Umum
                                        </h4>
                                        <p class="text-gray-light mb-4">
                                            {{-- isi kalo ada --}}
                                        </p>
                                        <!-- Display informasi kepala sekolah (readonly) -->
                                        <div class="row mb-4">
                                            <div class="col-lg-12">
                                                <div class="card bg-light">
                                                    <div class="card-body">
                                                        <h6 class="card-title fw-semibold">Kepala Sekolah</h6>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <p class="mb-1">
                                                                    <strong>{{ $headmaster->full_name ?? 'MUCHAMAD EKI S.A., S.Kom' }}</strong>
                                                                </p>
                                                                <p class="mb-0 text-muted">
                                                                    NIP: {{ $headmaster->nip ?? '197610012006041011' }}
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
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-4">
                                                    <label class="label fs-16">Pilih Kelas</label>
                                                    <div class="form-group position-relative">
                                                        <select name="class_id" id="class_id"
                                                            class="form-select form-control ps-5 h-55" required>
                                                            <option value="">PILIH KELAS</option>
                                                            @foreach ($classes as $class)
                                                                <option value="{{ $class->id }}">
                                                                    {{ $class->academic_level }} {{ $class->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <i
                                                            class="ri-building-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">

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
                                        </form action="{{ route('sk.generalLetters.store') }}">
                                        @csrf
                                    </div>
                                    <div aria-labelledby="step2-tab" class="tab-pane fade" id="step2-tab-pane"
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
                                    <div aria-labelledby="step3-tab" class="tab-pane fade" id="step3-tab-pane"
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
                                                                placeholder="URL" type="url" />
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
                                                                placeholder="URL" type="url" />
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
                                                                placeholder="URL" type="url" />
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
                                                                placeholder="URL" type="url" />
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
                                                        <button class="btn btn-primary py-3 px-5 fw-semibold text-white">
                                                            Next
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div aria-labelledby="step4-tab" class="tab-pane fade" id="step4-tab-pane"
                                        role="tabpanel" tabindex="0">
                                        <h4 class="fs-18 fw-semibold">
                                            Any Note
                                        </h4>
                                        <p class="text-gray-light mb-4">
                                            Fill all Information as below
                                        </p>
                                        <form>
                                            <div class="row">
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
                                                    <div class="form-group">
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
                            <div aria-labelledby="code-tab" class="tab-pane fade" id="code-tab-pane" role="tabpanel"
                                tabindex="0">
                                <button
                                    class="btn btn-outline-primary bg-white btn-sm copy-btn position-absolute top-0 end-0"
                                    data-clipboard-target="#basicAlertsCode">
                                    Copy
                                </button>
                                <pre class="line-numbers pt-0 pb-0 ps-25 pe-25 mb-0">
                                </pre>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @endsection
