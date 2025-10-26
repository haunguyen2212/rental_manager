<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('libs/select2/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('libs/select2/css/select2-bootstrap-5-theme.min.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-confirm/dist/jquery-confirm.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/loader.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    @stack('styles')
</head>
    
<body>
    <div id="loader-wrapper">
        <div id="loader"></div>
    </div>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div>
            <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="./index.html" class="text-nowrap logo-img">
                <img src="{{ asset('images/logos/logo.svg') }}" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-6"></i>
            </div>
            </div>
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                <a class="sidebar-link" href="./index.html" aria-expanded="false">
                    <i class="ti ti-atom"></i>
                    <span class="hide-menu">Dashboard</span>
                </a>
                </li>
                <!-- ---------------------------------- -->
                <!-- Dashboard -->
                <!-- ---------------------------------- -->
                <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <div class="d-flex align-items-center gap-3">
                        <span class="d-flex">
                            <i class="ti ti-user"></i>
                        </span>
                        <span class="hide-menu">Tài khoản</span>
                        </div>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a class="sidebar-link justify-content-between"
                                href="{{ route('admin.user.index') }}">
                                <div class="d-flex align-items-center gap-3">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">Danh sách</span>
                                </div>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link justify-content-between" 
                                href="{{ route('admin.user.create') }}">
                                <div class="d-flex align-items-center gap-3">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">Thêm mới</span>
                                </div>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link justify-content-between" 
                                href="{{ route('admin.user.excel') }}">
                                <div class="d-flex align-items-center gap-3">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">Import excel</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <span class="sidebar-divider lg"></span>
                </li>

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">UI</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./ui-buttons.html" aria-expanded="false">
                        <i class="ti ti-layers-subtract"></i>
                        <span class="hide-menu">Buttons</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./ui-alerts.html" aria-expanded="false">
                        <i class="ti ti-alert-circle"></i>
                        <span class="hide-menu">Alerts</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./ui-card.html" aria-expanded="false">
                        <i class="ti ti-cards"></i>
                        <span class="hide-menu">Card</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./ui-forms.html" aria-expanded="false">
                        <i class="ti ti-file-text"></i>
                        <span class="hide-menu">Forms</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./ui-typography.html" aria-expanded="false">
                        <i class="ti ti-typography"></i>
                        <span class="hide-menu">Typography</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <div class="d-flex align-items-center gap-3">
                        <span class="d-flex">
                            <i class="ti ti-layout-grid"></i>
                        </span>
                        <span class="hide-menu">Ui Elements</span>
                        </div>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                        <a class="sidebar-link justify-content-between" target="_blank"
                            href="https://bootstrapdemos.adminmart.com/modernize/dist/main/ui-accordian.html">
                            <div class="d-flex align-items-center gap-3">
                            <div class="round-16 d-flex align-items-center justify-content-center">
                                <i class="ti ti-circle"></i>
                            </div>
                            <span class="hide-menu">Accordian</span>
                            </div>
                            <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                        </a>
                        </li>
                        <li class="sidebar-item">
                        <a class="sidebar-link justify-content-between" target="_blank"
                            href="https://bootstrapdemos.adminmart.com/modernize/dist/main/ui-badge.html">
                            <div class="d-flex align-items-center gap-3">
                            <div class="round-16 d-flex align-items-center justify-content-center">
                                <i class="ti ti-circle"></i>
                            </div>
                            <span class="hide-menu">Badge</span>
                            </div>
                            <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                        </a>
                        </li>
                        <li class="sidebar-item">
                        <a class="sidebar-link justify-content-between" target="_blank"
                            href="https://bootstrapdemos.adminmart.com/modernize/dist/main/ui-dropdowns.html">
                            <div class="d-flex align-items-center gap-3">
                            <div class="round-16 d-flex align-items-center justify-content-center">
                                <i class="ti ti-circle"></i>
                            </div>
                            <span class="hide-menu">Dropdowns</span>
                            </div>
                            <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                        </a>
                        </li>
                        <li class="sidebar-item">
                        <a class="sidebar-link justify-content-between" target="_blank"
                            href="https://bootstrapdemos.adminmart.com/modernize/dist/main/ui-modals.html">
                            <div class="d-flex align-items-center gap-3">
                            <div class="round-16 d-flex align-items-center justify-content-center">
                                <i class="ti ti-circle"></i>
                            </div>
                            <span class="hide-menu">Modals</span>
                            </div>
                            <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                        </a>
                        </li>
                        <li class="sidebar-item">
                        <a class="sidebar-link justify-content-between" target="_blank"
                            href="https://bootstrapdemos.adminmart.com/modernize/dist/main/ui-tab.html">
                            <div class="d-flex align-items-center gap-3">
                            <div class="round-16 d-flex align-items-center justify-content-center">
                                <i class="ti ti-circle"></i>
                            </div>
                            <span class="hide-menu">Tab</span>
                            </div>
                            <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                        </a>
                        </li>
                        <li class="sidebar-item">
                        <a class="sidebar-link justify-content-between" target="_blank"
                            href="https://bootstrapdemos.adminmart.com/modernize/dist/main/ui-tooltip-popover.html">
                            <div class="d-flex align-items-center gap-3">
                            <div class="round-16 d-flex align-items-center justify-content-center">
                                <i class="ti ti-circle"></i>
                            </div>
                            <span class="hide-menu">Tooltip & Popover</span>
                            </div>
                            <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                        </a>
                        </li>
                        <li class="sidebar-item">
                        <a class="sidebar-link justify-content-between" target="_blank"
                            href="https://bootstrapdemos.adminmart.com/modernize/dist/main/ui-notification.html">
                            <div class="d-flex align-items-center gap-3">
                            <div class="round-16 d-flex align-items-center justify-content-center">
                                <i class="ti ti-circle"></i>
                            </div>
                            <span class="hide-menu">Notification</span>
                            </div>
                            <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                        </a>
                        </li>
                        <li class="sidebar-item">
                        <a class="sidebar-link justify-content-between" target="_blank"
                            href="https://bootstrapdemos.adminmart.com/modernize/dist/main/ui-progressbar.html">
                            <div class="d-flex align-items-center gap-3">
                            <div class="round-16 d-flex align-items-center justify-content-center">
                                <i class="ti ti-circle"></i>
                            </div>
                            <span class="hide-menu">Progressbar</span>
                            </div>
                            <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                        </a>
                        </li>
                        <li class="sidebar-item">
                        <a class="sidebar-link justify-content-between" target="_blank"
                            href="https://bootstrapdemos.adminmart.com/modernize/dist/main/ui-pagination.html">
                            <div class="d-flex align-items-center gap-3">
                            <div class="round-16 d-flex align-items-center justify-content-center">
                                <i class="ti ti-circle"></i>
                            </div>
                            <span class="hide-menu">Pagination</span>
                            </div>
                            <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                        </a>
                        </li>
                        <li class="sidebar-item">
                        <a class="sidebar-link justify-content-between" target="_blank"
                            href="https://bootstrapdemos.adminmart.com/modernize/dist/main/ui-bootstrap-ui.html">
                            <div class="d-flex align-items-center gap-3">
                            <div class="round-16 d-flex align-items-center justify-content-center">
                                <i class="ti ti-circle"></i>
                            </div>
                            <span class="hide-menu">Bootstrap UI</span>
                            </div>
                            <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                        </a>
                        </li>
                        <li class="sidebar-item">
                        <a class="sidebar-link justify-content-between" target="_blank"
                            href="https://bootstrapdemos.adminmart.com/modernize/dist/main/ui-breadcrumb.html">
                            <div class="d-flex align-items-center gap-3">
                            <div class="round-16 d-flex align-items-center justify-content-center">
                                <i class="ti ti-circle"></i>
                            </div>
                            <span class="hide-menu">Breadcrumb</span>
                            </div>
                            <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                        </a>
                        </li>
                        <li class="sidebar-item">
                        <a class="sidebar-link justify-content-between" target="_blank"
                            href="https://bootstrapdemos.adminmart.com/modernize/dist/main/ui-offcanvas.html">
                            <div class="d-flex align-items-center gap-3">
                            <div class="round-16 d-flex align-items-center justify-content-center">
                                <i class="ti ti-circle"></i>
                            </div>
                            <span class="hide-menu">Offcanvas</span>
                            </div>
                            <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                        </a>
                        </li>
                        <li class="sidebar-item">
                        <a class="sidebar-link justify-content-between" target="_blank"
                            href="https://bootstrapdemos.adminmart.com/modernize/dist/main/ui-lists.html">
                            <div class="d-flex align-items-center gap-3">
                            <div class="round-16 d-flex align-items-center justify-content-center">
                                <i class="ti ti-circle"></i>
                            </div>
                            <span class="hide-menu">Lists</span>
                            </div>
                            <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                        </a>
                        </li>
                        <li class="sidebar-item">
                        <a class="sidebar-link justify-content-between" target="_blank"
                            href="https://bootstrapdemos.adminmart.com/modernize/dist/main/ui-grid.html">
                            <div class="d-flex align-items-center gap-3">
                            <div class="round-16 d-flex align-items-center justify-content-center">
                                <i class="ti ti-circle"></i>
                            </div>
                            <span class="hide-menu">Grid</span>
                            </div>
                            <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                        </a>
                        </li>
                        <li class="sidebar-item">
                        <a class="sidebar-link justify-content-between" target="_blank"
                            href="https://bootstrapdemos.adminmart.com/modernize/dist/main/ui-carousel.html">
                            <div class="d-flex align-items-center gap-3">
                            <div class="round-16 d-flex align-items-center justify-content-center">
                                <i class="ti ti-circle"></i>
                            </div>
                            <span class="hide-menu">Carousel</span>
                            </div>
                            <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                        </a>
                        </li>
                        <li class="sidebar-item">
                        <a class="sidebar-link justify-content-between" target="_blank"
                            href="https://bootstrapdemos.adminmart.com/modernize/dist/main/ui-scrollspy.html">
                            <div class="d-flex align-items-center gap-3">
                            <div class="round-16 d-flex align-items-center justify-content-center">
                                <i class="ti ti-circle"></i>
                            </div>
                            <span class="hide-menu">Scrollspy</span>
                            </div>
                            <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                        </a>
                        </li>
                        <li class="sidebar-item">
                        <a class="sidebar-link justify-content-between" target="_blank"
                            href="https://bootstrapdemos.adminmart.com/modernize/dist/main/ui-spinner.html">
                            <div class="d-flex align-items-center gap-3">
                            <div class="round-16 d-flex align-items-center justify-content-center">
                                <i class="ti ti-circle"></i>
                            </div>
                            <span class="hide-menu">Spinner</span>
                            </div>
                            <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                        </a>
                        </li>
                        <li class="sidebar-item">
                        <a class="sidebar-link justify-content-between" target="_blank"
                            href="https://bootstrapdemos.adminmart.com/modernize/dist/main/ui-link.html">
                            <div class="d-flex align-items-center gap-3">
                            <div class="round-16 d-flex align-items-center justify-content-center">
                                <i class="ti ti-circle"></i>
                            </div>
                            <span class="hide-menu">Link</span>
                            </div>
                            <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                        </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <span class="sidebar-divider lg"></span>
                </li>
                <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">Pages</span>
                </li>
                <li class="sidebar-item">
                <a class="sidebar-link justify-content-between has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <div class="d-flex align-items-center gap-3">
                    <span class="d-flex">
                        <i class="ti ti-layout"></i>
                    </span>
                    <span class="hide-menu">Widgets</span>
                    </div>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/widgets-cards.html">
                        <div class="d-flex align-items-center gap-3">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Cards</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/widgets-banners.html">
                        <div class="d-flex align-items-center gap-3">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Banner</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/widgets-charts.html">
                        <div class="d-flex align-items-center gap-3">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Charts</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/widgets-feeds.html">
                        <div class="d-flex align-items-center gap-3">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Feeds</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/widgets-apps.html">
                        <div class="d-flex align-items-center gap-3">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Apps</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/widgets-data.html">
                        <div class="d-flex align-items-center gap-3">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Data</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                </ul>
                </li>
                <li class="sidebar-item">
                <a class="sidebar-link justify-content-between has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <div class="d-flex align-items-center gap-3">
                    <span class="d-flex">
                        <i class="ti ti-files"></i>
                    </span>
                    <span class="hide-menu">Pages</span>
                    </div>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/pages-animation.html"
                        aria-expanded="false">
                        <div class="d-flex align-items-center gap-3">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Animation</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/pages-search-result.html"
                        aria-expanded="false">
                        <div class="d-flex align-items-center gap-3">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Search Result</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/pages-gallery.html"
                        aria-expanded="false">
                        <div class="d-flex align-items-center gap-3">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Gallery</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/pages-treeview.html"
                        aria-expanded="false">
                        <div class="d-flex align-items-center gap-3">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Treeview</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/pages-block-ui.html"
                        aria-expanded="false">
                        <div class="d-flex align-items-center gap-3">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Block-Ui</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/pages-session-timeout.html"
                        aria-expanded="false">
                        <div class="d-flex align-items-center gap-3">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Session Timeout</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/page-pricing.html"
                        aria-expanded="false">
                        <div class="d-flex align-items-center gap-3">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Pricing</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/page-faq.html" aria-expanded="false">
                        <div class="d-flex align-items-center gap-3">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">FAQ</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/page-account-settings.html"
                        aria-expanded="false">
                        <div class="d-flex align-items-center gap-3">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Account Setting</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/landingpage/index.html"
                        aria-expanded="false">
                        <div class="d-flex align-items-center gap-3">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Landingpage</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                </ul>
                </li>


                <li>
                <span class="sidebar-divider lg"></span>
                </li>

                <li>
                <span class="sidebar-divider lg"></span>
                </li>
                <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">Forms</span>
                </li>
                <li class="sidebar-item">
                <a class="sidebar-link justify-content-between has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <div class="d-flex align-items-center gap-3">
                    <span class="d-flex">
                        <i class="ti ti-file-text"></i>
                    </span>
                    <span class="hide-menu">Elements</span>
                    </div>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/form-inputs.html">
                        <div class="d-flex align-items-center gap-3">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Forms Input</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/form-input-groups.html">
                        <div class="d-flex align-items-center gap-3">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Input Groups</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/form-input-grid.html">
                        <div class="d-flex align-items-center gap-3">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Input Grid</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/form-checkbox-radio.html">
                        <div class="d-flex align-items-center gap-3">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Checkbox & Radios</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/form-bootstrap-switch.html">
                        <div class="d-flex align-items-center gap-3">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Bootstrap Switch</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/form-select2.html">
                        <div class="d-flex align-items-center gap-3">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Select2</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                </ul>
                </li>
                <li class="sidebar-item">
                <a class="sidebar-link justify-content-between has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <div class="d-flex align-items-center gap-3">
                    <span class="d-flex">
                        <i class="ti ti-qrcode"></i>
                    </span>
                    <span class="hide-menu">Form Addons</span>
                    </div>
                </a>
                <ul aria-expanded="false" class="collapse first-level">

                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/form-dropzone.html">
                        <div class="d-flex align-items-center gap-3">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Dropzone</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/form-mask.html">
                        <div class="d-flex align-items-center gap-3">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Form Mask</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/form-typeahead.html">
                        <div class="d-flex align-items-center gap-3">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Form Typehead</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                </ul>
                </li>
                <li class="sidebar-item">
                <a class="sidebar-link justify-content-between has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <div class="d-flex align-items-center gap-3">
                    <span class="d-flex">
                        <i class="ti ti-files"></i>
                    </span>
                    <span class="hide-menu">Forms Inputs</span>
                    </div>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/form-basic.html">
                        <div class="d-flex align-items-center gap-3">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Basic Form</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/form-horizontal.html">
                        <div class="d-flex align-items-center gap-3">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Form Horizontal</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/form-actions.html">
                        <div class="d-flex align-items-center gap-3">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Form Actions</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/form-row-separator.html">
                        <div class="d-flex align-items-center gap-3">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Row Separator</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/form-bordered.html">
                        <div class="d-flex align-items-center gap-3">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Form Bordered</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/form-detail.html">
                        <div class="d-flex align-items-center gap-3">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Form Detail</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/form-striped-row.html">
                        <div class="d-flex align-items-center gap-3">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Striped Rows</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/form-floating-input.html">
                        <div class="d-flex align-items-center gap-3">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Form Floating Input</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                </ul>
                </li>
                <li class="sidebar-item">
                <a class="sidebar-link justify-content-between has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <div class="d-flex align-items-center gap-3">
                    <span class="d-flex">
                        <i class="ti ti-alert-circle"></i>
                    </span>
                    <span class="hide-menu">Validation</span>
                    </div>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/form-bootstrap-validation.html">
                        <div class="d-flex align-items-center gap-3">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Bootstrap Validation</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/form-custom-validation.html">
                        <div class="d-flex align-items-center gap-3">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Custom Validation</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                </ul>
                </li>
                <li class="sidebar-item">
                <a class="sidebar-link justify-content-between has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <div class="d-flex align-items-center gap-3">
                    <span class="d-flex">
                        <i class="ti ti-file-pencil"></i>
                    </span>
                    <span class="hide-menu">Form Pickers</span>
                    </div>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/form-picker-colorpicker.html">
                        <div class="d-flex align-items-center gap-3">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Colorpicker</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/form-picker-bootstrap-rangepicker.html">
                        <div class="d-flex align-items-center gap-3">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Rangepicker</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/form-picker-bootstrap-datepicker.html">
                        <div class="d-flex align-items-center gap-3">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">BT Datepicker</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/form-picker-material-datepicker.html">
                        <div class="d-flex align-items-center gap-3">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">MT Datepicker</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                </ul>
                </li>
                <li class="sidebar-item">
                <a class="sidebar-link justify-content-between has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <div class="d-flex align-items-center gap-3">
                    <span class="d-flex">
                        <i class="ti ti-dna"></i>
                    </span>
                    <span class="hide-menu">Form Editors</span>
                    </div>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/form-editor-quill.html">
                        <div class="d-flex align-items-center gap-3">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Quill Editor</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/form-editor-tinymce.html">
                        <div class="d-flex align-items-center gap-3">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Tinymce Edtor</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                </ul>
                </li>
                <li class="sidebar-item">
                <a class="sidebar-link justify-content-between" target="_blank"
                    href="https://bootstrapdemos.adminmart.com/modernize/dist/main/form-wizard.html" aria-expanded="false">
                    <div class="d-flex align-items-center gap-3">
                    <span class="d-flex">
                        <i class="ti ti-files"></i>
                    </span>
                    <span class="hide-menu">Form Wizard</span>
                    </div>
                    <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                </a>
                </li>
                <li class="sidebar-item">
                <a class="sidebar-link justify-content-between" target="_blank"
                    href="https://bootstrapdemos.adminmart.com/modernize/dist/main/form-repeater.html"
                    aria-expanded="false">
                    <div class="d-flex align-items-center gap-3">
                    <span class="d-flex">
                        <i class="ti ti-topology-star-3"></i>
                    </span>
                    <span class="hide-menu">Form Repeater</span>
                    </div>
                    <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                </a>
                </li>

                <li>
                <span class="sidebar-divider lg"></span>
                </li>
                <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">Bootstrap Tables</span>
                </li>
                <li class="sidebar-item">
                <a class="sidebar-link justify-content-between" target="_blank"
                    href="https://bootstrapdemos.adminmart.com/modernize/dist/main/table-basic.html" aria-expanded="false">
                    <div class="d-flex align-items-center gap-3">
                    <span class="d-flex">
                        <i class="ti ti-layout-sidebar"></i>
                    </span>
                    <span class="hide-menu">Basic Table</span>
                    </div>
                    <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                </a>
                </li>
                <li class="sidebar-item">
                <a class="sidebar-link justify-content-between" target="_blank"
                    href="https://bootstrapdemos.adminmart.com/modernize/dist/main/table-dark-basic.html"
                    aria-expanded="false">
                    <div class="d-flex align-items-center gap-3">
                    <span class="d-flex">
                        <i class="ti ti-layout-sidebar"></i>
                    </span>
                    <span class="hide-menu">Dark Table</span>
                    </div>
                    <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                </a>
                </li>
                <li class="sidebar-item">
                <a class="sidebar-link justify-content-between" target="_blank"
                    href="https://bootstrapdemos.adminmart.com/modernize/dist/main/table-sizing.html" aria-expanded="false">
                    <div class="d-flex align-items-center gap-3">
                    <span class="d-flex">
                        <i class="ti ti-layout-sidebar"></i>
                    </span>
                    <span class="hide-menu">Sizing Table</span>
                    </div>
                    <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                </a>
                </li>
                <li class="sidebar-item">
                <a class="sidebar-link justify-content-between" target="_blank"
                    href="https://bootstrapdemos.adminmart.com/modernize/dist/main/table-layout-coloured.html"
                    aria-expanded="false">
                    <div class="d-flex align-items-center gap-3">
                    <span class="d-flex">
                        <i class="ti ti-layout-sidebar"></i>
                    </span>
                    <span class="hide-menu">Coloured Table</span>
                    </div>
                    <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                </a>
                </li>

                <li>
                <span class="sidebar-divider lg"></span>
                </li>
                <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">Datatables</span>
                </li>
                <li class="sidebar-item">
                <a class="sidebar-link justify-content-between" target="_blank"
                    href="https://bootstrapdemos.adminmart.com/modernize/dist/main/table-datatable-basic.html"
                    aria-expanded="false">
                    <div class="d-flex align-items-center gap-3">
                    <span class="d-flex">
                        <i class="ti ti-air-conditioning-disabled"></i>
                    </span>
                    <span class="hide-menu">Basic</span>
                    </div>
                    <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                </a>
                </li>
                <li class="sidebar-item">
                <a class="sidebar-link justify-content-between" target="_blank"
                    href="https://bootstrapdemos.adminmart.com/modernize/dist/main/table-datatable-api.html"
                    aria-expanded="false">
                    <div class="d-flex align-items-center gap-3">
                    <span class="d-flex">
                        <i class="ti ti-air-conditioning-disabled"></i>
                    </span>
                    <span class="hide-menu">API</span>
                    </div>
                    <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                </a>
                </li>
                <li class="sidebar-item">
                <a class="sidebar-link justify-content-between" target="_blank"
                    href="https://bootstrapdemos.adminmart.com/modernize/dist/main/table-datatable-advanced.html"
                    aria-expanded="false">
                    <div class="d-flex align-items-center gap-3">
                    <span class="d-flex">
                        <i class="ti ti-air-conditioning-disabled"></i>
                    </span>
                    <span class="hide-menu">Advanced</span>
                    </div>
                    <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                </a>
                </li>

                <li>
                <span class="sidebar-divider lg"></span>
                </li>
                <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">Charts</span>
                </li>
                <li class="sidebar-item">
                <a class="sidebar-link justify-content-between" target="_blank"
                    href="https://bootstrapdemos.adminmart.com/modernize/dist/main/chart-apex-line.html"
                    aria-expanded="false">
                    <div class="d-flex align-items-center gap-3">
                    <span class="d-flex">
                        <i class="ti ti-chart-line"></i>
                    </span>
                    <span class="hide-menu">Line Chart</span>
                    </div>
                    <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                </a>
                </li>
                <li class="sidebar-item">
                <a class="sidebar-link justify-content-between" target="_blank"
                    href="https://bootstrapdemos.adminmart.com/modernize/dist/main/chart-apex-area.html"
                    aria-expanded="false">
                    <div class="d-flex align-items-center gap-3">
                    <span class="d-flex">
                        <i class="ti ti-chart-area"></i>
                    </span>
                    <span class="hide-menu">Area Chart</span>
                    </div>
                    <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                </a>
                </li>
                <li class="sidebar-item">
                <a class="sidebar-link justify-content-between" target="_blank"
                    href="https://bootstrapdemos.adminmart.com/modernize/dist/main/chart-apex-bar.html"
                    aria-expanded="false">
                    <div class="d-flex align-items-center gap-3">
                    <span class="d-flex">
                        <i class="ti ti-chart-bar"></i>
                    </span>
                    <span class="hide-menu">Bar Chart</span>
                    </div>
                    <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                </a>
                </li>
                <li class="sidebar-item">
                <a class="sidebar-link justify-content-between" target="_blank"
                    href="https://bootstrapdemos.adminmart.com/modernize/dist/main/chart-apex-pie.html"
                    aria-expanded="false">
                    <div class="d-flex align-items-center gap-3">
                    <span class="d-flex">
                        <i class="ti ti-chart-bar"></i>
                    </span>
                    <span class="hide-menu">Pie Chart</span>
                    </div>
                    <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                </a>
                </li>
                <li class="sidebar-item">
                <a class="sidebar-link justify-content-between" target="_blank"
                    href="https://bootstrapdemos.adminmart.com/modernize/dist/main/chart-apex-radial.html"
                    aria-expanded="false">
                    <div class="d-flex align-items-center gap-3">
                    <span class="d-flex">
                        <i class="ti ti-chart-arcs"></i>
                    </span>
                    <span class="hide-menu">Radial Chart</span>
                    </div>
                    <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                </a>
                </li>
                <li class="sidebar-item">
                <a class="sidebar-link justify-content-between" target="_blank"
                    href="https://bootstrapdemos.adminmart.com/modernize/dist/main/chart-apex-radar.html"
                    aria-expanded="false">
                    <div class="d-flex align-items-center gap-3">
                    <span class="d-flex">
                        <i class="ti ti-chart-radar"></i>
                    </span>
                    <span class="hide-menu">Radar Chart</span>
                    </div>
                    <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                </a>
                </li>


                <li>
                <span class="sidebar-divider lg"></span>
                </li>
                <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">Auth</span>
                </li>
                <li class="sidebar-item">
                <a class="sidebar-link" href="./authentication-login.html" aria-expanded="false">
                    <i class="ti ti-login"></i>
                    <span class="hide-menu">Login</span>
                </a>
                </li>
                <li class="sidebar-item">
                <a class="sidebar-link" href="./authentication-register.html" aria-expanded="false">
                    <i class="ti ti-user-plus"></i>
                    <span class="hide-menu">Register</span>
                </a>
                </li>
                <li class="sidebar-item">
                <a class="sidebar-link justify-content-between has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <div class="d-flex align-items-center gap-3">
                    <span class="d-flex">
                        <i class="ti ti-users"></i>
                    </span>
                    <span class="hide-menu">Auth Pages</span>
                    </div>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/authentication-login.html"
                        aria-expanded="false">
                        <div class="d-flex align-items-center gap-3">
                        <span class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </span>
                        <span class="hide-menu">Side Login</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/authentication-register.html"
                        aria-expanded="false">
                        <div class="d-flex align-items-center gap-3">
                        <span class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </span>
                        <span class="hide-menu">Side Register</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/authentication-forgot-password.html"
                        aria-expanded="false">
                        <div class="d-flex align-items-center gap-3">
                        <span class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </span>
                        <span class="hide-menu">Side Forgot Pwd</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/authentication-forgot-password2.html"
                        aria-expanded="false">
                        <div class="d-flex align-items-center gap-3">
                        <span class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </span>
                        <span class="hide-menu">Boxed Forgot Pwd</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/authentication-two-steps.html"
                        aria-expanded="false">
                        <div class="d-flex align-items-center gap-3">
                        <span class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </span>
                        <span class="hide-menu">Side Two Steps</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/authentication-two-steps2.html"
                        aria-expanded="false">
                        <div class="d-flex align-items-center gap-3">
                        <span class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </span>
                        <span class="hide-menu">Boxed Two Steps</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/authentication-error.html"
                        aria-expanded="false">
                        <div class="d-flex align-items-center gap-3">
                        <span class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </span>
                        <span class="hide-menu">Error</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" target="_blank"
                        href="https://bootstrapdemos.adminmart.com/modernize/dist/main/authentication-maintenance.html"
                        aria-expanded="false">
                        <div class="d-flex align-items-center gap-3">
                        <span class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </span>
                        <span class="hide-menu">Maintenance</span>
                        </div>
                        <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                    </a>
                    </li>
                </ul>
                </li>

                <li>
                <span class="sidebar-divider lg"></span>
                </li>
                <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">Extra</span>
                </li>
                <li class="sidebar-item">
                <a class="sidebar-link justify-content-between" target="_blank"
                    href="https://bootstrapdemos.adminmart.com/modernize/dist/main/icon-solar.html" aria-expanded="false">
                    <div class="d-flex align-items-center gap-3">
                    <span class="d-flex">
                        <i class="ti ti-mood-smile"></i>
                    </span>
                    <span class="hide-menu">Solar Icon</span>
                    </div>
                    <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1">Pro</span>
                </a>
                </li>
                <li class="sidebar-item">
                <a class="sidebar-link" href="./icon-tabler.html" aria-expanded="false">
                    <i class="ti ti-archive"></i>
                    <span class="hide-menu">Tabler Icon</span>
                </a>
                </li>
                <li class="sidebar-item">
                <a class="sidebar-link" href="./sample-page.html" aria-expanded="false">
                    <i class="ti ti-file"></i>
                    <span class="hide-menu">Sample Page</span>
                </a>
                </li>
            </ul>
            <div class="unlimited-access hide-menu bg-light-secondary position-relative mb-7 mt-5 rounded">
                <div class="d-flex">
                <div class="unlimited-access-title me-3">
                    <h6 class="fw-semibold fs-4 mb-6 text-dark w-85">Check Pro Version</h6>
                    <a href="https://adminmart.com/product/modernize-bootstrap-5-admin-template/?ref=56#product-demo-section" target="_blank"
                    class="btn btn-secondary fs-2 fw-semibold">Check</a>
                </div>
                <div class="unlimited-access-img">
                    <img src="{{ asset('images/backgrounds/rocket.png') }}" alt="" class="img-fluid">
                </div>
                </div>
            </div>
            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
        <!--  Header Start -->
        <header class="app-header">
            <nav class="navbar navbar-expand-lg navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item d-block d-xl-none">
                <a class="nav-link sidebartoggler " id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                </a>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link " href="javascript:void(0)" id="drop1" data-bs-toggle="dropdown" aria-expanded="false">
                    <iconify-icon icon="solar:bell-linear" class="fs-6"></iconify-icon>
                    <div class="notification bg-primary rounded-circle"></div>
                </a>
                <div class="dropdown-menu dropdown-menu-animate-up" aria-labelledby="drop1">
                    <div class="message-body">
                    <a href="javascript:void(0)" class="dropdown-item">
                        Item 1
                    </a>
                    <a href="javascript:void(0)" class="dropdown-item">
                        Item 2
                    </a>
                    </div>
                </div>
                </li>
            </ul>
            <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                <a href="https://adminmart.com/product/modernize-bootstrap-5-admin-template/?ref=56#product-demo-section" target="_blank"
                    class="btn btn-primary">Check Pro Template</a>
                <li class="nav-item dropdown">
                    <a class="nav-link " href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <img src="{{ asset('images/profile/user-1.jpg') }}" alt="" width="35" height="35" class="rounded-circle">
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                    <div class="message-body">
                        <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                        <i class="ti ti-user fs-6"></i>
                        <p class="mb-0 fs-3">My Profile</p>
                        </a>
                        <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                        <i class="ti ti-mail fs-6"></i>
                        <p class="mb-0 fs-3">My Account</p>
                        </a>
                        <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                        <i class="ti ti-list-check fs-6"></i>
                        <p class="mb-0 fs-3">My Task</p>
                        </a>
                        <a href="./authentication-login.html" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                    </div>
                    </div>
                </li>
                </ul>
            </div>
            </nav>
        </header>
        <!--  Header End -->
        <div class="body-wrapper-inner">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div id="msg">
                            <div class="alert customize-alert alert-dismissible text-success alert-light-success bg-success-subtle fade show remove-close-icon {{ session('success') ? '' : 'd-none' }}" id="alert-success" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <div class="d-flex align-items-center  me-3 me-md-0">
                                    <i class="ti ti-info-circle fs-5 me-2 text-success"></i>
                                    <span class="message-text">{{ session('success') ?? '' }}</span>
                                </div>
                            </div>
                            <div class="alert customize-alert alert-dismissible alert-light-danger bg-danger-subtle text-danger fade show remove-close-icon {{ session('error') ? '' : 'd-none' }}" id="alert-error" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <div class="d-flex align-items-center  me-3 me-md-0">
                                    <i class="ti ti-info-circle fs-5 me-2 text-danger"></i>
                                    <span class="message-text">{{ session('error') ?? '' }}</span>
                                </div>
                            </div>
                        </div>
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    <script src="{{ asset('libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('js/app.min.js') }}"></script>
    <script src="{{ asset('libs/simplebar/dist/simplebar.js') }}"></script>
    <!-- solar icons -->
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
    <script src="{{ asset('libs/select2/js/select2.full.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-confirm/dist/jquery-confirm.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>

</html>