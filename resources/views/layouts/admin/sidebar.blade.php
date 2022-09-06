<!-- [ navigation menu ] start -->
<nav class="pcoded-navbar">
        <div class="navbar-wrapper">
            <div class="navbar-brand header-logo">
                <a href="{{route('admin_dashboard')}}" class="b-brand">
                    <div class="b-bg">
                        <i class="feather icon-trending-up"></i>
                    </div>
                    <span class="b-title">Bulk Ammo</span>
                </a>
                <a class="mobile-menu" id="mobile-collapse" href="javascript:"><span></span></a>
            </div>
            <div class="navbar-content scroll-div">
                <ul class="nav pcoded-inner-navbar">
                    <li class="nav-item pcoded-menu-caption">
                        <label>Navigation</label>
                    </li>
                    <li data-username="dashboard Default Ecommerce CRM Analytics Crypto Project" class="nav-item active">
                        <a href="{{route('admin_dashboard')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                    </li>
                    <li class="nav-item pcoded-menu-caption">
                        <label>Ammunition Elements</label>
                    </li>
                    <li data-username="basic components Button Alert Badges breadcrumb Paggination progress Tooltip popovers Carousel Cards Collapse Tabs pills Modal Grid System Typography Extra Shadows Embeds" class="nav-item pcoded-hasmenu">
                        <a href="javascript:" class="nav-link "><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">Ammunition Components</span></a>
                        <ul class="pcoded-submenu">
                            <li class=""><a href="{{route('admin_ammunition_brands')}}" class="">Brands</a></li>
                            <li class=""><a href="{{route('admin_ammunition_bullettype')}}" class="">Bullet Type</a></li>
                            <li class=""><a href="{{route('admin_ammunition_caliber')}}" class="">Caliber</a></li>
                            <li class=""><a href="{{route('admin_ammunition_casing')}}" class="">Casings</a></li>
                            <li class=""><a href="{{route('admin_ammunition_retailer')}}" class="">Retailers</a></li>
                            <li class=""><a href="{{route('admin_ammunition_rounds')}}" class="">Rounds</a></li>
                            <li class=""><a href="{{route('admin_ammunition_bulletweight')}}" class="">Bullet Weight</a></li>
                            <li class=""><a href="{{route('admin_ammunition_category')}}" class="">Category</a></li>
                            <li class=""><a href="{{route('admin_ammunition_subcategory')}}" class="">Sub-Category</a></li>
                            <li class=""><a href="{{route('admin_ammunition_manufacturer')}}" class="">Manufacturer</a></li>
                        </ul>
                    </li>
                    <li class="nav-item pcoded-menu-caption">
                        <label>Product Management</label>
                    </li>
                    <li data-username="form elements advance componant validation masking wizard picker select" class="nav-item">
                        <a href="{{route('admin_calender_setup')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">test</span></a>
                    </li>
                   <!--  <li class="nav-item pcoded-menu-caption">
                        <label>Chart & Maps</label>
                    </li>
                    <li data-username="Charts Morris" class="nav-item"><a href="chart-morris.html" class="nav-link "><span class="pcoded-micon"><i class="feather icon-pie-chart"></i></span><span class="pcoded-mtext">Chart</span></a></li>
                    <li data-username="Maps Google" class="nav-item"><a href="map-google.html" class="nav-link "><span class="pcoded-micon"><i class="feather icon-map"></i></span><span class="pcoded-mtext">Maps</span></a></li>
                    <li class="nav-item pcoded-menu-caption">
                        <label>Pages</label>
                    </li>
                    <li data-username="Sample Page" class="nav-item"><a href="sample-page.html" class="nav-link"><span class="pcoded-micon"><i class="feather icon-sidebar"></i></span><span class="pcoded-mtext">Sample page</span></a></li> -->
                    <li data-username="Disabled Menu" class="nav-item "><a href="{{route('admin_logout')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-power"></i></span><span class="pcoded-mtext">Logout</span></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- [ navigation menu ] end -->