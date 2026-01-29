<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport" />
    <!-- Links Of CSS File -->
    <link href="{{ asset('assets/css/sidebar-menu.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/prism.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/quill.snow.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/remixicon.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/swiper-bundle.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/jsvectormap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Favicon -->
    <link href="{{ asset('assets/images/favicon.ico') }}" rel="icon" type="image/png" />
    <!-- Title -->


    <title>
        SIMAS - SMKN 1 Talaga
    </title>

    <style>
        /* Wrapper */
        .select2-container {
            width: 100% !important;
            box-sizing: border-box;
        }

        /* =================================================
   SINGLE SELECT
   ================================================= */
        .select2-container--default .select2-selection--single {
            height: 55px;
            border-radius: 0.375rem;
            border: 1px solid #ced4da;
            padding-left: 2.5rem;
            display: flex;
            align-items: center;
            box-sizing: border-box;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 55px;
            padding-left: 0.70rem;
            padding-right: 40px;
            font-size: 0.875rem;
            color: #212529;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 55px;
            right: 10px;
        }

        /* Focus */
        .select2-container--default.select2-container--focus .select2-selection--single,
        .select2-container--default.select2-container--open .select2-selection--single {
            border-color: #86b7fe;
            box-shadow: 0 0 0 .25rem rgba(13, 110, 253, .25);
        }

        /* =================================================
   SELECT2 CUSTOM STYLING
   Single & Multiple TEXT UNIFIED
   ================================================= */

        /* =================================================
/* Geser select2 karena icon */
        .position-relative .select2-container--default .select2-selection--multiple {
            min-height: 55px;
            /* ✅ UBAH dari height ke min-height */
            height: auto;
            /* ✅ TAMBAHKAN ini */
            padding-left: 2.5rem;
            padding-top: 8px;
            /* ✅ TAMBAHKAN padding vertikal */
            padding-bottom: 8px;
            /* ✅ TAMBAHKAN padding vertikal */
            padding-right: 8px;
            border-radius: 0.375rem;
            border: 1px solid #ced4da;
            display: flex;
            align-items: center;
        }

        /* ✅ PERBAIKI CSS INI */
        .select2-container--default .select2-selection--multiple .select2-selection__rendered {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            padding: 0 !important;
            margin: 0 !important;
            gap: 5px;
            width: 100%;
            /* ✅ TAMBAHKAN ini */
        }

        /* ✅ ATUR MARGIN TAG */
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            margin: 0 !important;
        }

        /* ✅ TAMBAHKAN CSS UNTUK INPUT SEARCH */
        .select2-container--default .select2-selection--multiple .select2-search--inline .select2-search__field {
            margin: 0 !important;
            padding: 0 !important;
            min-width: 150px;
        }


        /* Icon */
        .position-relative>i {
            pointer-events: none;
        }


        /* =================================================
   DROPDOWN
   ================================================= */
        .select2-dropdown {
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, .15);
        }

        .select2-search--dropdown .select2-search__field {
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            padding: 8px 12px;
            font-size: 0.875rem;
        }

        .select2-results__option {
            padding: 8px 12px;
            font-size: 0.875rem;
        }

        .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
            background-color: #0d6efd;
            color: #fff;
        }

        .select2-container--default .select2-results__option--selected {
            background-color: #e9ecef;
            color: #212529;
        }

        /* =================================================
   PARENT FIX
   ================================================= */
        .form-group.position-relative {
            position: relative;
            overflow: hidden;
            width: 100%;
        }

        .form-group.position-relative>i {
            position: absolute;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
            z-index: 10;
            pointer-events: none;
        }

        /* =================================================
   RESPONSIVE
   ================================================= */
        @media (max-width: 768px) {

            .select2-container--default .select2-selection--single,
            .select2-container--default .select2-selection--multiple {
                padding-left: 2rem;
            }

            .select2-container--default .select2-selection--multiple .select2-selection__choice {
                font-size: 0.8125rem;
            }
        }

        /* =================================================
   PREVENT HORIZONTAL SCROLL
   ================================================= */
        body {
            overflow-x: hidden !important;
        }
    </style>

</head>
