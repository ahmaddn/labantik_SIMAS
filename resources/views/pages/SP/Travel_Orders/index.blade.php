@extends('layouts.app')
@section('title', 'Surat Perjalanan Dinas - SIMAS SMKN 1 Talaga')
<div class="main-content-container overflow-hidden">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
        <h3 class="mb-0">
            Data Table
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
                        Modules
                    </span>
                </li>
                <li aria-current="page" class="breadcrumb-item active">
                    <span>
                        UI Elements
                    </span>
                </li>
                <li aria-current="page" class="breadcrumb-item active">
                    <span class="text-secondary">
                        Data Table
                    </span>
                </li>
            </ol>
        </nav>
    </div>
    <div class="card bg-white rounded-10 border border-white mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 p-20 pb-0">
            <h3>
                Users
            </h3>
            <div class="dropdown select-dropdown without-border">
                <button aria-expanded="false" class="dropdown-toggle bg-transparent text-secondary fs-15"
                    data-bs-toggle="dropdown">
                    This Week
                </button>
                <ul class="dropdown-menu dropdown-menu-end bg-white border-0 box-shadow rounded-10" data-simplebar="">
                    <li>
                        <button class="dropdown-item text-secondary">
                            This Day
                        </button>
                    </li>
                    <li>
                        <button class="dropdown-item text-secondary">
                            This Week
                        </button>
                    </li>
                    <li>
                        <button class="dropdown-item text-secondary">
                            This Month
                        </button>
                    </li>
                    <li>
                        <button class="dropdown-item text-secondary">
                            This Year
                        </button>
                    </li>
                </ul>
            </div>
        </div>
        <div class="default-table-area mx-minus-1 table-contact-list">
            <div class="table-responsive">
                <table class="table align-middle" id="myTable">
                    <thead>
                        <tr>
                            <th class="fw-medium pe-0 rtl-pe" scope="col">
                                ID
                            </th>
                            <th class="fw-medium" scope="col">
                                User
                            </th>
                            <th class="fw-medium" scope="col">
                                Email
                            </th>
                            <th class="fw-medium" scope="col">
                                Phone
                            </th>
                            <th class="fw-medium" scope="col">
                                Last Contacted
                            </th>
                            <th class="fw-medium" scope="col">
                                Company
                            </th>
                            <th class="fw-medium" scope="col">
                                Status
                            </th>
                            <th class="fw-medium" scope="col">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-1217
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user15" class="rounded-circle" src="assets/images/user15.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Marcia Baker
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="523f3320313b3312372a333f223e377c313d3f"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-123-4567
                            </td>
                            <td class="text-body">
                                Nov 10, 2025
                            </td>
                            <td class="text-body">
                                ABC Corporation
                            </td>
                            <td>
                                <span
                                    class="text-success bg-success bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Active
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-1364
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user2" class="rounded-circle" src="assets/images/user2.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Carolyn Barnes
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="6a080b18040f192a0f120b071a060f44090507"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-987-6543
                            </td>
                            <td class="text-body">
                                Nov 11, 2025
                            </td>
                            <td class="text-body">
                                XYZ Ltd
                            </td>
                            <td>
                                <span
                                    class="text-success bg-success bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Active
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-2951
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user12" class="rounded-circle" src="assets/images/user12.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Donna Miller
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="94f0fbfafaf5d4f1ecf5f9e4f8f1baf7fbf9"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-456-7890
                            </td>
                            <td class="text-body">
                                Nov 12, 2025
                            </td>
                            <td class="text-body">
                                Tech Solutions
                            </td>
                            <td>
                                <span
                                    class="text-danger bg-danger bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Deactive
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-7342
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user5" class="rounded-circle" src="assets/images/user5.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Barbara Cross
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="e281908d9191a2879a838f928e87cc818d8f"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-369-7878
                            </td>
                            <td class="text-body">
                                Nov 13, 2025
                            </td>
                            <td class="text-body">
                                Global Solutions
                            </td>
                            <td>
                                <span
                                    class="text-success bg-success bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Active
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-4619
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user16" class="rounded-circle" src="assets/images/user16.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Rebecca Block
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="5a38363539311a3f223b372a363f74393537"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-658-4488
                            </td>
                            <td class="text-body">
                                Nov 14, 2025
                            </td>
                            <td class="text-body">
                                Acma Industries
                            </td>
                            <td>
                                <span
                                    class="text-danger bg-danger bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Deactive
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-7346
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user9" class="rounded-circle" src="assets/images/user9.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Ramiro McCarty
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="2755464a4e554867425f464a574b420944484a"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-558-9966
                            </td>
                            <td class="text-body">
                                Nov 15, 2025
                            </td>
                            <td class="text-body">
                                Synergy Ltd
                            </td>
                            <td>
                                <span
                                    class="text-success bg-success bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Active
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-7612
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user1" class="rounded-circle" src="assets/images/user1.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Robert Fairweather
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="cfbda0adaabdbb8faab7aea2bfa3aae1aca0a2"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-357-5888
                            </td>
                            <td class="text-body">
                                Nov 16, 2025
                            </td>
                            <td class="text-body">
                                Summit Solutions
                            </td>
                            <td>
                                <span
                                    class="text-success bg-success bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Active
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-7642
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user6" class="rounded-circle" src="assets/images/user6.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Marcelino Haddock
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="bfd7dedbdbd0dcd4ffdac7ded2cfd3da91dcd0d2"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-456-8877
                            </td>
                            <td class="text-body">
                                Nov 17, 2025
                            </td>
                            <td class="text-body">
                                Strategies Ltd
                            </td>
                            <td>
                                <span
                                    class="text-success bg-success bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Active
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-4652
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user13" class="rounded-circle" src="assets/images/user13.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Thomas Wilson
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="c8bfa1a4aca7a688adb0a9a5b8a4ade6aba7a5"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-622-4488
                            </td>
                            <td class="text-body">
                                Nov 18, 2025
                            </td>
                            <td class="text-body">
                                Tech Enterprises
                            </td>
                            <td>
                                <span
                                    class="text-danger bg-danger bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Deactive
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-7895
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user14" class="rounded-circle" src="assets/images/user14.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Nathaniel Hulsey
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="5a322f36293f231a3f223b372a363f74393537"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-225-4488
                            </td>
                            <td class="text-body">
                                Nov 19, 2025
                            </td>
                            <td class="text-body">
                                Synetic Solutions
                            </td>
                            <td>
                                <span
                                    class="text-success bg-success bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Active
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-1217
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user15" class="rounded-circle" src="assets/images/user15.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Marcia Baker
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="b9d4d8cbdad0d8f9dcc1d8d4c9d5dc97dad6d4"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-123-4567
                            </td>
                            <td class="text-body">
                                Nov 10, 2025
                            </td>
                            <td class="text-body">
                                ABC Corporation
                            </td>
                            <td>
                                <span
                                    class="text-success bg-success bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Active
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-1364
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user2" class="rounded-circle" src="assets/images/user2.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Carolyn Barnes
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="7715160519120437120f161a071b125914181a"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-987-6543
                            </td>
                            <td class="text-body">
                                Nov 11, 2025
                            </td>
                            <td class="text-body">
                                XYZ Ltd
                            </td>
                            <td>
                                <span
                                    class="text-success bg-success bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Active
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-2951
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user12" class="rounded-circle" src="assets/images/user12.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Donna Miller
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="1f7b7071717e5f7a677e726f737a317c7072"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-456-7890
                            </td>
                            <td class="text-body">
                                Nov 12, 2025
                            </td>
                            <td class="text-body">
                                Tech Solutions
                            </td>
                            <td>
                                <span
                                    class="text-danger bg-danger bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Deactive
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-7342
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user5" class="rounded-circle" src="assets/images/user5.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Barbara Cross
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="abc8d9c4d8d8ebced3cac6dbc7ce85c8c4c6"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-369-7878
                            </td>
                            <td class="text-body">
                                Nov 13, 2025
                            </td>
                            <td class="text-body">
                                Global Solutions
                            </td>
                            <td>
                                <span
                                    class="text-success bg-success bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Active
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-4619
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user16" class="rounded-circle" src="assets/images/user16.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Rebecca Block
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="d3b1bfbcb0b893b6abb2bea3bfb6fdb0bcbe"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-658-4488
                            </td>
                            <td class="text-body">
                                Nov 14, 2025
                            </td>
                            <td class="text-body">
                                Acma Industries
                            </td>
                            <td>
                                <span
                                    class="text-danger bg-danger bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Deactive
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-7346
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user9" class="rounded-circle" src="assets/images/user9.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Ramiro McCarty
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="b1c3d0dcd8c3def1d4c9d0dcc1ddd49fd2dedc"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-558-9966
                            </td>
                            <td class="text-body">
                                Nov 15, 2025
                            </td>
                            <td class="text-body">
                                Synergy Ltd
                            </td>
                            <td>
                                <span
                                    class="text-success bg-success bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Active
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-7612
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user1" class="rounded-circle" src="assets/images/user1.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Robert Fairweather
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="f3819c91968187b3968b929e839f96dd909c9e"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-357-5888
                            </td>
                            <td class="text-body">
                                Nov 16, 2025
                            </td>
                            <td class="text-body">
                                Summit Solutions
                            </td>
                            <td>
                                <span
                                    class="text-success bg-success bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Active
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-7642
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user6" class="rounded-circle" src="assets/images/user6.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Marcelino Haddock
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="cda5aca9a9a2aea68da8b5aca0bda1a8e3aea2a0"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-456-8877
                            </td>
                            <td class="text-body">
                                Nov 17, 2025
                            </td>
                            <td class="text-body">
                                Strategies Ltd
                            </td>
                            <td>
                                <span
                                    class="text-success bg-success bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Active
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-4652
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user13" class="rounded-circle" src="assets/images/user13.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Thomas Wilson
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="67100e0b03080927021f060a170b024904080a"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-622-4488
                            </td>
                            <td class="text-body">
                                Nov 18, 2025
                            </td>
                            <td class="text-body">
                                Tech Enterprises
                            </td>
                            <td>
                                <span
                                    class="text-danger bg-danger bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Deactive
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-7895
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user14" class="rounded-circle" src="assets/images/user14.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Nathaniel Hulsey
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="f8908d948b9d81b89d80999588949dd69b9795"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-225-4488
                            </td>
                            <td class="text-body">
                                Nov 19, 2025
                            </td>
                            <td class="text-body">
                                Synetic Solutions
                            </td>
                            <td>
                                <span
                                    class="text-success bg-success bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Active
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-1217
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user15" class="rounded-circle" src="assets/images/user15.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Marcia Baker
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="2e434f5c4d474f6e4b564f435e424b004d4143"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-123-4567
                            </td>
                            <td class="text-body">
                                Nov 10, 2025
                            </td>
                            <td class="text-body">
                                ABC Corporation
                            </td>
                            <td>
                                <span
                                    class="text-success bg-success bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Active
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-1364
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user2" class="rounded-circle" src="assets/images/user2.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Carolyn Barnes
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="402221322e2533002538212d302c256e232f2d"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-987-6543
                            </td>
                            <td class="text-body">
                                Nov 11, 2025
                            </td>
                            <td class="text-body">
                                XYZ Ltd
                            </td>
                            <td>
                                <span
                                    class="text-success bg-success bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Active
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-2951
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user12" class="rounded-circle" src="assets/images/user12.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Donna Miller
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="197d76777778597c61787469757c377a7674"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-456-7890
                            </td>
                            <td class="text-body">
                                Nov 12, 2025
                            </td>
                            <td class="text-body">
                                Tech Solutions
                            </td>
                            <td>
                                <span
                                    class="text-danger bg-danger bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Deactive
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-7342
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user5" class="rounded-circle" src="assets/images/user5.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Barbara Cross
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="5033223f2323103528313d203c357e333f3d"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-369-7878
                            </td>
                            <td class="text-body">
                                Nov 13, 2025
                            </td>
                            <td class="text-body">
                                Global Solutions
                            </td>
                            <td>
                                <span
                                    class="text-success bg-success bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Active
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-4619
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user16" class="rounded-circle" src="assets/images/user16.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Rebecca Block
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="ea8886858981aa8f928b879a868fc4898587"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-658-4488
                            </td>
                            <td class="text-body">
                                Nov 14, 2025
                            </td>
                            <td class="text-body">
                                Acma Industries
                            </td>
                            <td>
                                <span
                                    class="text-danger bg-danger bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Deactive
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-7346
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user9" class="rounded-circle" src="assets/images/user9.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Ramiro McCarty
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="1d6f7c70746f725d78657c706d7178337e7270"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-558-9966
                            </td>
                            <td class="text-body">
                                Nov 15, 2025
                            </td>
                            <td class="text-body">
                                Synergy Ltd
                            </td>
                            <td>
                                <span
                                    class="text-success bg-success bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Active
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-7612
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user1" class="rounded-circle" src="assets/images/user1.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Robert Fairweather
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="daa8b5b8bfa8ae9abfa2bbb7aab6bff4b9b5b7"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-357-5888
                            </td>
                            <td class="text-body">
                                Nov 16, 2025
                            </td>
                            <td class="text-body">
                                Summit Solutions
                            </td>
                            <td>
                                <span
                                    class="text-success bg-success bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Active
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-7642
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user6" class="rounded-circle" src="assets/images/user6.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Marcelino Haddock
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="7c141d1818131f173c19041d110c1019521f1311"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-456-8877
                            </td>
                            <td class="text-body">
                                Nov 17, 2025
                            </td>
                            <td class="text-body">
                                Strategies Ltd
                            </td>
                            <td>
                                <span
                                    class="text-success bg-success bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Active
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-4652
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user13" class="rounded-circle" src="assets/images/user13.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Thomas Wilson
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="4f3826232b20210f2a372e223f232a612c2022"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-622-4488
                            </td>
                            <td class="text-body">
                                Nov 18, 2025
                            </td>
                            <td class="text-body">
                                Tech Enterprises
                            </td>
                            <td>
                                <span
                                    class="text-danger bg-danger bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Deactive
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-7895
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user14" class="rounded-circle" src="assets/images/user14.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Nathaniel Hulsey
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="88e0fde4fbedf1c8edf0e9e5f8e4eda6ebe7e5"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-225-4488
                            </td>
                            <td class="text-body">
                                Nov 19, 2025
                            </td>
                            <td class="text-body">
                                Synetic Solutions
                            </td>
                            <td>
                                <span
                                    class="text-success bg-success bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Active
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-1217
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user15" class="rounded-circle" src="assets/images/user15.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Marcia Baker
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="f09d9182939991b09588919d809c95de939f9d"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-123-4567
                            </td>
                            <td class="text-body">
                                Nov 10, 2025
                            </td>
                            <td class="text-body">
                                ABC Corporation
                            </td>
                            <td>
                                <span
                                    class="text-success bg-success bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Active
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-1364
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user2" class="rounded-circle" src="assets/images/user2.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Carolyn Barnes
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="c5a7a4b7aba0b685a0bda4a8b5a9a0eba6aaa8"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-987-6543
                            </td>
                            <td class="text-body">
                                Nov 11, 2025
                            </td>
                            <td class="text-body">
                                XYZ Ltd
                            </td>
                            <td>
                                <span
                                    class="text-success bg-success bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Active
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-2951
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user12" class="rounded-circle" src="assets/images/user12.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Donna Miller
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="7b1f1415151a3b1e031a160b171e55181416"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-456-7890
                            </td>
                            <td class="text-body">
                                Nov 12, 2025
                            </td>
                            <td class="text-body">
                                Tech Solutions
                            </td>
                            <td>
                                <span
                                    class="text-danger bg-danger bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Deactive
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-7342
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user5" class="rounded-circle" src="assets/images/user5.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Barbara Cross
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="66051409151526031e070b160a034805090b"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-369-7878
                            </td>
                            <td class="text-body">
                                Nov 13, 2025
                            </td>
                            <td class="text-body">
                                Global Solutions
                            </td>
                            <td>
                                <span
                                    class="text-success bg-success bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Active
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-4619
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user16" class="rounded-circle" src="assets/images/user16.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Rebecca Block
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="9efcf2f1fdf5defbe6fff3eef2fbb0fdf1f3"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-658-4488
                            </td>
                            <td class="text-body">
                                Nov 14, 2025
                            </td>
                            <td class="text-body">
                                Acma Industries
                            </td>
                            <td>
                                <span
                                    class="text-danger bg-danger bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Deactive
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-7346
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user9" class="rounded-circle" src="assets/images/user9.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Ramiro McCarty
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="354754585c475a75504d54584559501b565a58"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-558-9966
                            </td>
                            <td class="text-body">
                                Nov 15, 2025
                            </td>
                            <td class="text-body">
                                Synergy Ltd
                            </td>
                            <td>
                                <span
                                    class="text-success bg-success bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Active
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-7612
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user1" class="rounded-circle" src="assets/images/user1.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Robert Fairweather
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="b3c1dcd1d6c1c7f3d6cbd2dec3dfd69dd0dcde"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-357-5888
                            </td>
                            <td class="text-body">
                                Nov 16, 2025
                            </td>
                            <td class="text-body">
                                Summit Solutions
                            </td>
                            <td>
                                <span
                                    class="text-success bg-success bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Active
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-7642
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user6" class="rounded-circle" src="assets/images/user6.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Marcelino Haddock
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="bad2dbdeded5d9d1fadfc2dbd7cad6df94d9d5d7"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-456-8877
                            </td>
                            <td class="text-body">
                                Nov 17, 2025
                            </td>
                            <td class="text-body">
                                Strategies Ltd
                            </td>
                            <td>
                                <span
                                    class="text-success bg-success bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Active
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-4652
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user13" class="rounded-circle" src="assets/images/user13.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Thomas Wilson
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="cabda3a6aea5a48aafb2aba7baa6afe4a9a5a7"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-622-4488
                            </td>
                            <td class="text-body">
                                Nov 18, 2025
                            </td>
                            <td class="text-body">
                                Tech Enterprises
                            </td>
                            <td>
                                <span
                                    class="text-danger bg-danger bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Deactive
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-7895
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user14" class="rounded-circle" src="assets/images/user14.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Nathaniel Hulsey
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="533b263f20362a13362b323e233f367d303c3e"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-225-4488
                            </td>
                            <td class="text-body">
                                Nov 19, 2025
                            </td>
                            <td class="text-body">
                                Synetic Solutions
                            </td>
                            <td>
                                <span
                                    class="text-success bg-success bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Active
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-1217
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user15" class="rounded-circle" src="assets/images/user15.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Marcia Baker
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="2944485b4a4048694c51484459454c074a4644"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-123-4567
                            </td>
                            <td class="text-body">
                                Nov 10, 2025
                            </td>
                            <td class="text-body">
                                ABC Corporation
                            </td>
                            <td>
                                <span
                                    class="text-success bg-success bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Active
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-1364
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user2" class="rounded-circle" src="assets/images/user2.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Carolyn Barnes
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="294b485b474c5a694c51484459454c074a4644"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-987-6543
                            </td>
                            <td class="text-body">
                                Nov 11, 2025
                            </td>
                            <td class="text-body">
                                XYZ Ltd
                            </td>
                            <td>
                                <span
                                    class="text-success bg-success bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Active
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-2951
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user12" class="rounded-circle" src="assets/images/user12.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Donna Miller
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="e78388898986a7829f868a978b82c984888a"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-456-7890
                            </td>
                            <td class="text-body">
                                Nov 12, 2025
                            </td>
                            <td class="text-body">
                                Tech Solutions
                            </td>
                            <td>
                                <span
                                    class="text-danger bg-danger bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Deactive
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-7342
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user5" class="rounded-circle" src="assets/images/user5.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Barbara Cross
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="a2c1d0cdd1d1e2c7dac3cfd2cec78cc1cdcf"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-369-7878
                            </td>
                            <td class="text-body">
                                Nov 13, 2025
                            </td>
                            <td class="text-body">
                                Global Solutions
                            </td>
                            <td>
                                <span
                                    class="text-success bg-success bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Active
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-4619
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user16" class="rounded-circle" src="assets/images/user16.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Rebecca Block
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="63010f0c000823061b020e130f064d000c0e"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-658-4488
                            </td>
                            <td class="text-body">
                                Nov 14, 2025
                            </td>
                            <td class="text-body">
                                Acma Industries
                            </td>
                            <td>
                                <span
                                    class="text-danger bg-danger bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Deactive
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-7346
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user9" class="rounded-circle" src="assets/images/user9.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Ramiro McCarty
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="ea988b87839885aa8f928b879a868fc4898587"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-558-9966
                            </td>
                            <td class="text-body">
                                Nov 15, 2025
                            </td>
                            <td class="text-body">
                                Synergy Ltd
                            </td>
                            <td>
                                <span
                                    class="text-success bg-success bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Active
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-7612
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user1" class="rounded-circle" src="assets/images/user1.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Robert Fairweather
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="ea9885888f989eaa8f928b879a868fc4898587"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-357-5888
                            </td>
                            <td class="text-body">
                                Nov 16, 2025
                            </td>
                            <td class="text-body">
                                Summit Solutions
                            </td>
                            <td>
                                <span
                                    class="text-success bg-success bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Active
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-7642
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user6" class="rounded-circle" src="assets/images/user6.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Marcelino Haddock
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="f29a9396969d9199b2978a939f829e97dc919d9f"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-456-8877
                            </td>
                            <td class="text-body">
                                Nov 17, 2025
                            </td>
                            <td class="text-body">
                                Strategies Ltd
                            </td>
                            <td>
                                <span
                                    class="text-success bg-success bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Active
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-4652
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user13" class="rounded-circle" src="assets/images/user13.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Thomas Wilson
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="bbccd2d7dfd4d5fbdec3dad6cbd7de95d8d4d6"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-622-4488
                            </td>
                            <td class="text-body">
                                Nov 18, 2025
                            </td>
                            <td class="text-body">
                                Tech Enterprises
                            </td>
                            <td>
                                <span
                                    class="text-danger bg-danger bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Deactive
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-body pe-0 rtl-pe">
                                #ARP-7895
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="user14" class="rounded-circle" src="assets/images/user14.jpg"
                                            style="width: 35px; height: 35px;" />
                                    </div>
                                    <div class="flex-grow-1 ms-12">
                                        <h4 class="fw-medium fs-16 mb-0">
                                            Nathaniel Hulsey
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-body">
                                <a class="__cf_email__" data-cfemail="3b534e57485e427b5e435a564b575e15585456"
                                    href="/cdn-cgi/l/email-protection">
                                    [email protected]
                                </a>
                            </td>
                            <td class="text-body">
                                +1 555-225-4488
                            </td>
                            <td class="text-body">
                                Nov 19, 2025
                            </td>
                            <td class="text-body">
                                Synetic Solutions
                            </td>
                            <td>
                                <span
                                    class="text-success bg-success bg-opacity-10 fs-15 fw-normal d-inline-block default-badge">
                                    Active
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end" style="gap: 12px;">
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="View" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-primary">
                                            visibility
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-success"
                                        data-bs-placement="top" data-bs-title="Edit" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            edit
                                        </i>
                                    </button>
                                    <button class="bg-transparent p-0 border-0 hover-text-danger"
                                        data-bs-placement="top" data-bs-title="Delete" data-bs-toggle="tooltip">
                                        <i class="material-symbols-outlined fs-16 fw-normal text-body">
                                            delete
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="flex-grow-1">
</div>
@endsection
