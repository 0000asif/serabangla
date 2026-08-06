<!-- BEGIN: Sidebar-->
<div class="page-sidebar custom-scroll" id="sidebar">
    <div class="sidebar-header"><a class="sidebar-brand" href="{{ URL::to('dashboard') }}">{{ Auth()->user()->name }}</a><a
            class="sidebar-brand-mini" href="{{ URL::to('dashboard') }}">AH</a><span class="sidebar-points"><span
                class="badge badge-success badge-point mr-2"></span><span
                class="badge badge-danger badge-point mr-2"></span><span
                class="badge badge-warning badge-point"></span></span></div>

    <ul class="sidebar-menu metismenu">


        {{-- DASHBOARD --}}
        <li class="heading"><span>DASHBOARDS</span></li>
        <li class="{{ request()->is('dashboard') ? 'mm-active' : '' }}">
            <a href="{{ URL::to('/dashboard') }}">
                <i class="sidebar-item-icon ft-home"></i>
                <span class="nav-label">Dashboard</span>
            </a>
        </li>
        @php
            $user = auth()->user();
        @endphp
        @if ($user->type == 'admin')

            {{-- <li>
                <a href="javascript:;">
                    <i class="sidebar-item-icon ft-users"></i>
                    <span class="nav-label">Heroes</span>
                    <i class="arrow la la-angle-right"></i>
                </a>
                <ul class="nav-2-level">
                    <li><a href="{{ route('hero.edit') }}">Edit Hero</a></li>

                </ul>
            </li>

            <li>
                <a href="javascript:;">
                    <i class="sidebar-item-icon ft-book"></i>
                    <span class="nav-label">Cards</span>
                    <i class="arrow la la-angle-right"></i>
                </a>
                <ul class="nav-2-level">
                    <li><a href="{{ route('cards.edit') }}">Edit Card</a></li>

                </ul>
            </li>



            <li>
                <a href="javascript:;">
                    <i class="sidebar-item-icon ft-star"></i>
                    <span class="nav-label">Reviews</span>
                    <i class="arrow la la-angle-right"></i>
                </a>
                <ul class="nav-2-level">
                    <li><a href="{{ route('reviews.create') }}">Add Review</a></li>
                    <li><a href="{{ route('reviews.index') }}">All Reviews</a></li>
                </ul>
            </li> --}}

            {{-- SETTINGS --}}
            <li>
                <a href="javascript:;">
                    <i class="sidebar-item-icon ft-settings"></i>
                    <span class="nav-label">Settings</span>
                    <i class="arrow la la-angle-right"></i>
                </a>
                <ul class="nav-2-level">
                    <li><a href="{{ route('settings.edit') }}">General Settings</a></li>
                </ul>
            </li>


            <li>
                <a href="javascript:;">
                    <i class="sidebar-item-icon ft-settings"></i>
                    <span class="nav-label">Policy</span>
                    <i class="arrow la la-angle-right"></i>
                </a>

                <ul class="nav-2-level">
                    <li>
                        <a href="{{ route('admin.policies.edit', 'terms') }}">
                            Terms & Conditions
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.policies.edit', 'privacy') }}">
                            Privacy Policy
                        </a>
                    </li>
                </ul>
            </li>


            {{-- PRODUCTS --}}
            {{-- <li>
                <a href="javascript:;">
                    <i class="sidebar-item-icon ft-box"></i>
                    <span class="nav-label">Products</span>
                    <i class="arrow la la-angle-right"></i>
                </a>
                <ul class="nav-2-level">
                    <li><a href="{{ route('admin.product.create') }}">New Product Add</a></li>
                    <li><a href="{{ route('admin.product.index') }}">All Product List</a></li>
                </ul>
            </li> --}}

            <li>
                <a href="javascript:;">
                    <i class="sidebar-item-icon ft-box"></i>
                    <span class="nav-label">Users</span>
                    <i class="arrow la la-angle-right"></i>
                </a>
                <ul class="nav-2-level">
                    <li><a href="{{ route('user.create') }}">Add New</a></li>
                    <li><a href="{{ route('user.index') }}">All User List</a></li>
                    <li><a href="{{ route('gift.import.view') }}">Import Scratch Card</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="sidebar-item-icon ft-box"></i>
                    <span class="nav-label">Gifts</span>
                    <i class="arrow la la-angle-right"></i>
                </a>
                <ul class="nav-2-level">
                    <li><a href="{{ route('gift.index') }}">Scratch Card</a></li>
                    <li><a href="{{ route('gift.import.view') }}">Import Scratch Card</a></li>
                </ul>
            </li>
            {{-- <li>
                <a href="javascript:;">
                    <i class="sidebar-item-icon ft-box"></i>
                    <span class="nav-label">Reports</span>
                    <i class="arrow la la-angle-right"></i>
                </a>
                <ul class="nav-2-level">
                    <li><a href="{{ route('admin.reports') }}">Order Reports</a></li>
                </ul>
            </li> --}}
        @endif
        @if (in_array($user->type, ['admin', 'agent']))
            {{-- ORDERS --}}
            <li>
                <a href="javascript:;">
                    <i class="sidebar-item-icon ft-shopping-cart"></i>
                    <span class="nav-label">Orders</span>
                    <i class="arrow la la-angle-right"></i>
                </a>
                <ul class="nav-2-level">
                    <li><a href="{{ route('admin.orders') }}">All Orders</a></li>
                </ul>
            </li>
        @endif
    </ul>

</div><!-- END: Sidebar-->
