<aside id="sidebar" class="d-flex flex-column gap-0">
    <div class="sidebar-logo d-flex align-items-center justify-content-between">
        <a href="{{ route('home') }}">{{ $company ? $company->name : 'Cheriewish' }}</a>

        <i class="bi bi-caret-left-fill d-lg-none text-white" id="sidebarToggle"></i>
    </div>

    <div class="sidebar-input my-4">
        <input type="search" class="form-control" placeholder="Search...">
    </div>

    <ul class="sidebar-nav h-100 overflow-y-scroll">
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
</aside>
