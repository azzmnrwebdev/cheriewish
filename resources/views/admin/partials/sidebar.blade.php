<aside id="sidebar" class="d-flex flex-column gap-0">
    <div class="sidebar-logo d-flex align-items-center justify-content-between">
        <a href="{{ route('home') }}">{{ $company ? $company->name : 'Cheriewish' }}</a>

        <i class="bi bi-caret-left-fill d-lg-none text-white" id="sidebarToggle"></i>
    </div>

    <div class="sidebar-input my-4">
        <input type="search" class="form-control" placeholder="Search...">
    </div>

    <ul class="sidebar-nav h-100 overflow-y-scroll flex-grow-1">
        <li class="sidebar-item">
            <a href="{{ route('dashboard') }}"
                class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-house-fill me-2 fs-5"></i>
                Dashboard
            </a>
        </li>

        <li class="sidebar-item">
            <a href="{{ route('category.index') }}"
                class="sidebar-link {{ request()->routeIs('category.*') ? 'active' : '' }}">
                <i class="bi bi-tags-fill me-2 fs-5"></i>
                Category
            </a>
        </li>

        <li class="sidebar-item">
            <a href="{{ route('product.index') }}"
                class="sidebar-link {{ request()->routeIs('product.*') ? 'active' : '' }}">
                <i class="bi bi-box-fill me-2 fs-5"></i>
                Product
            </a>
        </li>

        <li class="sidebar-item">
            <a href="{{ route('testimony.index') }}"
                class="sidebar-link {{ request()->routeIs('testimony.*') ? 'active' : '' }}">
                <i class="bi bi-chat-quote-fill me-2 fs-5"></i>
                Testimony
            </a>
        </li>

        <li class="sidebar-item">
            <a href="{{ route('company.index') }}"
                class="sidebar-link {{ request()->routeIs('company.*') ? 'active' : '' }}">
                <i class="bi bi-building-fill me-2 fs-5"></i>
                Company
            </a>
        </li>
    </ul>

    <ul class="sidebar-nav">
        <li class="sidebar-item">
            <a href="#" class="sidebar-link" data-bs-toggle="modal" data-bs-target="#logoutModal">
                <i class="bi bi-box-arrow-right me-2 fs-5"></i>
                Logout
            </a>
        </li>
    </ul>
</aside>

<!-- Logout Modal -->
<div class="modal fade" id="logoutModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-5">
                {{-- Title --}}
                <h4 class="text-center fw-medium mb-4">Are you sure you want to exit?</h4>

                {{-- Button --}}
                <div class="d-flex justify-content-center">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf

                        <button type="submit" class="btn btn-danger me-3">Logout</button>
                    </form>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
