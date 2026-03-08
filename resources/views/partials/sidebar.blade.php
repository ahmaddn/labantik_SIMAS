 <!-- Start Sidebar Area -->
 <div class="sidebar-area" id="sidebar-area">
     <div class="logo position-relative d-flex align-items-center justify-content-between">
         <a class="d-block text-decoration-none position-relative" href="#">
             <img alt="logo-icon" src="{{ asset('assets/images/logosmk.png') }}" style="width: 40px;" />
             <span class="logo-text text-secondary fw-semibold">SIMAS</span>
         </a>
         <button
             class="sidebar-burger-menu-close z-n1 position-absolute top-50 translate-middle-y end-0 border-0 bg-transparent py-3 opacity-0"
             id="sidebar-burger-menu-close">
             <span class="border-1 d-block for-dark-burger"
                 style="border-bottom: 1px solid #475569; height: 1px; width: 25px; transform: rotate(45deg);">
             </span>
             <span class="border-1 d-block for-dark-burger"
                 style="border-bottom: 1px solid #475569; height: 1px; width: 25px; transform: rotate(-45deg);">
             </span>
         </button>
         <button class="sidebar-burger-menu border-0 bg-transparent p-0" id="sidebar-burger-menu">
             <span class="border-1 d-block for-dark-burger"
                 style="border-bottom: 1px solid #475569; height: 1px; width: 25px;">
             </span>
             <span class="border-1 d-block for-dark-burger"
                 style="border-bottom: 1px solid #475569; height: 1px; width: 25px; margin: 6px 0;">
             </span>
             <span class="border-1 d-block for-dark-burger"
                 style="border-bottom: 1px solid #475569; height: 1px; width: 25px;">
             </span>
         </button>
     </div>
     <aside class="layout-menu menu-vertical menu active" data-simplebar="" id="layout-menu">
         <ul class="menu-inner">
             <li class="menu-title small text-uppercase">
                 <span class="menu-title-text">
                     Main
                 </span>
             </li>
             <li class="menu-item open">
                 <a class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                     href="{{ route('dashboard') }}">
                     <span class="material-symbols-outlined menu-icon">
                         dashboard
                     </span>
                     <span class="title">
                         Dashboard
                     </span>
                 </a>
             </li>
             <li class="menu-title small text-uppercase">
                 <span class="menu-title-text">
                     Surat Perintah (SP)
                 </span>
             </li>

             <li class="menu-item {{ request()->routeIs('sp.*') ? 'open' : '' }}">
                 <a class="menu-link menu-toggle {{ request()->routeIs('sp.*') ? 'active' : '' }}"
                     href="javascript:void(0);">
                     <span class="material-symbols-outlined menu-icon">
                         quick_reorder
                     </span>
                     <span class="title">
                         Perjalanan Dinas
                     </span>
                 </a>

                 <ul class="menu-sub">
                     <li class="menu-item">
                         <a class="menu-link {{ request()->routeIs('sp.travelOrders.index') ? 'active' : '' }}"
                             href="{{ route('sp.travelOrders.index') }}">
                             Index
                         </a>
                     </li>

                     <li class="menu-item">
                         <a class="menu-link {{ request()->routeIs('sp.travelCostCategories.index') ? 'active' : '' }}"
                             href="{{ route('sp.travelCostCategories.index') }}">
                             Kategori Biaya SPPD
                         </a>
                     </li>
                 </ul>
             </li>
             <li class="menu-title small text-uppercase">
                 <span class="menu-title-text">
                     Surat Undangan (SU)
                 </span>
             </li>
             <li class="menu-item open">
                 <a class="menu-link {{ request()->routeIs('su.parentInvitations.index') ? 'active' : '' }}"
                     href="{{ route('su.parentInvitations.index') }}">
                     <span class="material-symbols-outlined menu-icon">
                         account_child_invert
                     </span>
                     <span class="title">
                         Orang Tua
                     </span>
                 </a>
             </li>
             <li class="menu-title small text-uppercase">
                 <span class="menu-title-text">
                     Surat Pengantar
                 </span>
             </li>
             <li class="menu-item open">
                 <a class="menu-link {{ request()->routeIs('s_peng.coverLetters.index') ? 'active' : '' }}"
                     href="{{ route('s_peng.coverLetters.index') }}">
                     <span class="material-symbols-outlined menu-icon">
                         full_coverage
                     </span>
                     <span class="title">
                         Pengantar
                     </span>
                 </a>
             </li>
             <li class="menu-item open">
                 <a class="menu-link {{ request()->routeIs('s_peng.schoolTransfers.index') ? 'active' : '' }}"
                     href="{{ route('s_peng.schoolTransfers.index') }}">
                     <span class="material-symbols-outlined menu-icon">
                         move_location
                     </span>
                     <span class="title">
                         Pengantar Pindah
                     </span>
                 </a>
             </li>
             <li class="menu-title small text-uppercase">
                 <span class="menu-title-text">
                     Surat Keterangan (SK)
                 </span>
             </li>
             <li class="menu-item open">
                 <a class="menu-link {{ request()->routeIs('sk.goodConducts.index') ? 'active' : '' }}"
                     href="{{ route('sk.goodConducts.index') }}">
                     <span class="material-symbols-outlined menu-icon">
                         person_check
                     </span>
                     <span class="title">
                         Kelakuan Baik
                     </span>
                 </a>
             </li>
             <li class="menu-item open">
                 <a class="menu-link {{ request()->routeIs('sk.admissionLetters.index') ? 'active' : '' }}"
                     href="{{ route('sk.admissionLetters.index') }}">
                     <span class="material-symbols-outlined menu-icon">
                         assignment_turned_in
                     </span>
                     <span class="title">
                         Penerimaan Siswa
                     </span>
                 </a>
             </li>
             <li class="menu-item open">
                 <a class="menu-link {{ request()->routeIs('sk.dataCorrections.index') ? 'active' : '' }}"
                     href="{{ route('sk.dataCorrections.index') }}">
                     <span class="material-symbols-outlined menu-icon">
                         scan_delete
                     </span>
                     <span class="title">
                         Kesalahan Penulisan Ijazah
                     </span>
                 </a>
             </li>
             {{-- <li class="menu-item open">
                 <a class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="javascript:void(0);">
                     <span class="material-symbols-outlined menu-icon">
                         stacked_email
                     </span>
                     <span class="title">
                         Kehilangan Ijazah
                     </span>
                 </a>
             </li> --}}
             <li class="menu-item open">
                 <a class="menu-link {{ request()->routeIs('sk.generalLetters.index') ? 'active' : '' }}"
                     href="{{ route('sk.generalLetters.index') }}">
                     <span class="material-symbols-outlined menu-icon">
                         user_attributes
                     </span>
                     <span class="title">
                         Siswa ( Umum )
                     </span>
                 </a>
             </li>
             <li class="menu-title small text-uppercase">
                 <span class="menu-title-text">
                     Surat Lain
                 </span>
             </li>
             <li class="menu-item open">
                 <a class="menu-link {{ request()->routeIs('others.studentReturns.index') ? 'active' : '' }}"
                     href="{{ route('others.studentReturns.index') }}">
                     <span class="material-symbols-outlined menu-icon">
                         assignment_return
                     </span>
                     <span class="title">
                         Pengembalian Siswa
                     </span>
                 </a>
             </li>
         </ul>
     </aside>
 </div>
 <!-- End Sidebar Area -->
