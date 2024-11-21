<x-admin>
    {{-- CSS Custom --}}
    @prepend('styles')
        {{--  --}}
    @endprepend

    {{-- title --}}
    <h4 class="mb-2 fw-semibold d-inline-flex">Dashboard</h4>

    {{-- Breadcrumbs --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>

    {{-- JS Custom --}}
    @prepend('scripts')
        {{--  --}}
    @endprepend
</x-admin>
