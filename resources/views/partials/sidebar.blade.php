 <!-- Start Sidebar Area -->
 <div class="sidebar-area" id="sidebar-area">
     <div class="logo position-relative d-flex align-items-center justify-content-between">
         <a class="d-block text-decoration-none position-relative" href="#">
             <img alt="logo-icon" src="assets/images/logo-icon.png" />
             <span class="logo-text text-secondary fw-semibold">StarCode</span>
         </a>
         <button
             class="sidebar-burger-menu-close bg-transparent py-3 border-0 opacity-0 z-n1 position-absolute top-50 end-0 translate-middle-y"
             id="sidebar-burger-menu-close">
             <span class="border-1 d-block for-dark-burger"
                 style="border-bottom: 1px solid #475569; height: 1px; width: 25px; transform: rotate(45deg);">
             </span>
             <span class="border-1 d-block for-dark-burger"
                 style="border-bottom: 1px solid #475569; height: 1px; width: 25px; transform: rotate(-45deg);">
             </span>
         </button>
         <button class="sidebar-burger-menu bg-transparent p-0 border-0" id="sidebar-burger-menu">
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
             <li class="menu-item open">
                 <a class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                     href="{{ route('dashboard') }}">
                     <span class="material-symbols-outlined menu-icon">
                         quick_reorder
                     </span>
                     <span class="title">
                         Perjalanan Dinas
                     </span>
                 </a>
             </li>
             <li class="menu-title small text-uppercase">
                 <span class="menu-title-text">
                     Surat Undangan (SU)
                 </span>
             </li>
             <li class="menu-item open">
                 <a class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                     href="{{ route('dashboard') }}">
                     <span class="material-symbols-outlined menu-icon">
                         contact_mail
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
                 <a class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                     href="{{ route('dashboard') }}">
                     <span class="material-symbols-outlined menu-icon">
                         contact_mail
                     </span>
                     <span class="title">
                         Pengantar
                     </span>
                 </a>
             </li>
             <li class="menu-item open">
                 <a class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                     href="{{ route('dashboard') }}">
                     <span class="material-symbols-outlined menu-icon">
                         contact_mail
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
                 <a class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="javascript:void(0);">
                     <span class="material-symbols-outlined menu-icon">
                         stacked_email
                     </span>
                     <span class="title">
                         Kelakuan Baik
                     </span>
                 </a>
             </li>
             <li class="menu-item open">
                 <a class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="javascript:void(0);">
                     <span class="material-symbols-outlined menu-icon">
                         stacked_email
                     </span>
                     <span class="title">
                         Penerimaan Siswa
                     </span>
                 </a>
             </li>
             <li class="menu-item open">
                 <a class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="javascript:void(0);">
                     <span class="material-symbols-outlined menu-icon">
                         stacked_email
                     </span>
                     <span class="title">
                         Kesalahan Penulisan Ijazah
                     </span>
                 </a>
             </li>
             <li class="menu-item open">
                 <a class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="javascript:void(0);">
                     <span class="material-symbols-outlined menu-icon">
                         stacked_email
                     </span>
                     <span class="title">
                         Kehilangan Ijazah
                     </span>
                 </a>
             </li>
             <li class="menu-item open">
                 <a class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="javascript:void(0);">
                     <span class="material-symbols-outlined menu-icon">
                         stacked_email
                     </span>
                     <span class="title">
                         Siswa
                     </span>
                 </a>
             </li>
             <li class="menu-title small text-uppercase">
                 <span class="menu-title-text">
                     Surat Lain
                 </span>
             </li>
             <li class="menu-item open">
                 <a class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                     href="{{ route('dashboard') }}">
                     <span class="material-symbols-outlined menu-icon">
                         contact_mail
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
