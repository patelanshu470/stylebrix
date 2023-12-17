
<div class="sidebar-wrapper" style="background: #417394 !important;">
    <div id="sidebarEffect"></div>
    <div>
        <div class="logo-wrapper logo-wrapper-center">
            <a href="{{route('dashboard')}}" data-bs-original-title="" title="">
                <img class="img-fluid for-white" src="{{ asset(getenv('WEBSTIE_LOGO')) }}" alt="logo">
            </a>
            <div class="back-btn">
                <i class="fa fa-angle-left"></i>
            </div>
            <div class="toggle-sidebar">
                <i class="ri-apps-line status_toggle middle sidebar-toggle"></i>
            </div>
        </div>
        <div class="logo-icon-wrapper">
            <a href="{{route('dashboard')}}">
                <img class="img-fluid main-logo main-white" src="{{ asset(getenv('FAVICON_ICON')) }}" alt="logo">
                <img class="img-fluid main-logo main-dark" src="{{ asset(getenv('FAVICON_ICON')) }}" alt="logo">
            </a>
        </div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow">
                <i data-feather="arrow-left"></i>
            </div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn"></li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() === 'dashboard' ? 'custom-active' : '' }}" href="{{ route('dashboard') }}">
                            <i class="ri-home-line"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title 
                        {{ Route::currentRouteName() === 'category' ? 'custom-active' : '' }}
                        {{ Route::currentRouteName() === 'category.add' ? 'custom-active' : '' }}
                        "  href="javascript:void(0)">
                            <i class="ri-list-check-2"></i>
                            <span>Category</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{ route('category') }}" >Category List</a>
                            </li>

                            <li>
                                <a href="{{ route('category.add') }}">Add New Category</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title 
                        {{ Route::currentRouteName() === 'subCategory' ? 'custom-active' : '' }}
                        {{ Route::currentRouteName() === 'subCategory.add' ? 'custom-active' : '' }}
                        " href="javascript:void(0)">
                            <i class="ri-list-check"></i>
                            <span>Sub-Category</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{ route('subCategory') }}">Sub-Category List</a>
                            </li>

                            <li>
                                <a href="{{ route('subCategory.add') }}">Add New Sub-Category</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title
                         {{ Route::currentRouteName() === 'product' ? 'custom-active' : '' }}
                         {{ Route::currentRouteName() === 'product.add' ? 'custom-active' : '' }}
                         " href="javascript:void(0)">
                            <i class="ri-store-3-line"></i>
                            <span>Product</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{ route('product') }}">Product List</a>
                            </li>

                            <li>
                                <a href="{{ route('product.add') }}">Add New Products</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title 
                        {{ Route::currentRouteName() === 'all.orders' ? 'custom-active' : '' }}
                        {{ Route::currentRouteName() === 'pending.orders' ? 'custom-active' : '' }}
                        {{ Route::currentRouteName() === 'confirmed.orders' ? 'custom-active' : '' }}
                        {{ Route::currentRouteName() === 'complete.orders' ? 'custom-active' : '' }}
                        {{ Route::currentRouteName() === 'canceled.orders' ? 'custom-active' : '' }}
                        " href="javascript:void(0)">
                            <i class="ri-archive-line"></i>
                            <span>Orders</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{ route('all.orders') }}">All-Order</a>
                            </li>
                            <li>
                                <a href="{{route('pending.orders')}}">Pending-Orders</a>
                            </li>
                            <li>
                                <a href="{{route('confirmed.orders')}}">Confirmed-Orders</a>
                            </li>
                            <li>
                                <a href="{{route('complete.orders')}}">Completed-Orders</a>
                            </li>
                            <li>
                                <a href="#">Return-Orders</a>
                            </li>
                            <li>
                                <a href="{{route('canceled.orders')}}">Canceled-Orders</a>
                            </li>
                          
                        </ul>
                    </li>


                    {{-- <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() === 'banner' ? 'custom-active' : '' }}" href="{{ route('banner') }}">
                            <i class="ri-price-tag-3-line"></i>
                            <span>Banners</span>
                        </a>
                    </li> --}}
                    {{-- <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() === 'coupon' ? 'custom-active' : '' }}" href="{{ route('coupon') }}">
                            <svg xmlns="http://www.w3.org/2000/svg"  style="width: 23px !important;height:23px !important" viewBox="0 0 24 24"><path fill="white" d="M14.8 8L16 9.2L9.2 16L8 14.8L14.8 8M4 4h16c1.11 0 2 .89 2 2v4a2 2 0 1 0 0 4v4c0 1.11-.89 2-2 2H4a2 2 0 0 1-2-2v-4c1.11 0 2-.89 2-2a2 2 0 0 0-2-2V6a2 2 0 0 1 2-2m0 2v2.54a3.994 3.994 0 0 1 0 6.92V18h16v-2.54a3.994 3.994 0 0 1 0-6.92V6H4m5.5 2c.83 0 1.5.67 1.5 1.5S10.33 11 9.5 11S8 10.33 8 9.5S8.67 8 9.5 8m5 5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5s-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5Z"/></svg>
                            <span>Coupon</span>
                        </a>
                    </li> --}}

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() === 'review' ? 'custom-active' : '' }}" href="{{route('review')}}">
                            <i class="ri-star-line"></i>
                            <span>Product Review</span>
                            
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() === 'user' ? 'custom-active' : '' }}" href="{{route('user')}}">
                            <i class="ri-user-3-line"></i>
                            <span>Users</span>
                            
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() === 'admin.newsletter' ? 'custom-active' : '' }}" href="{{route('admin.newsletter')}}">
                            <i class="ri-newspaper-line"></i>
                            <span>NewsLetter</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() === 'admin.payment' ? 'custom-active' : '' }}" href="{{route('admin.payment')}}">
                            <i class="ri-secure-payment-line"></i>
                            <span>Payments</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() === 'report' ? 'custom-active' : '' }}" href="{{route('report')}}">
                            <i class="ri-file-chart-line"></i>
                            <span>Reports</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title 
                        {{ Route::currentRouteName() === 'profile.setting' ? 'custom-active' : '' }}
                        {{ Route::currentRouteName() === 'password.setting' ? 'custom-active' : '' }}
                        {{ Route::currentRouteName() === 'coupon' ? 'custom-active' : '' }}
                        {{ Route::currentRouteName() === 'banner' ? 'custom-active' : '' }}
                        " href="javascript:void(0)">
                            <i class="ri-settings-line"></i>
                            <span>Settings</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{route('profile.setting')}}">Profile Setting</a>
                                <a href="{{route('password.setting')}}">Password Setting</a>
                                <a href="{{ route('coupon') }}">Coupon</a>
                                <a href="{{ route('banner') }}">Banners</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

            <div class="right-arrow" id="right-arrow">
                <i data-feather="arrow-right"></i>
            </div>
        </nav>
    </div>
</div>
