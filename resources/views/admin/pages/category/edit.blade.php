<x-admin>
    {{-- CSS Custom --}}
    @prepend('styles')
        {{--  --}}
    @endprepend

    {{-- title --}}
    <h4 class="mb-2 fw-semibold d-inline-flex">Edit Category</h4>

    {{-- Breadcrumbs --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="text-decoration-none" href="{{ route('category.index') }}">Category</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>

    <div class="card mt-4 shadow">
        <div class="card-header bg-white fw-medium py-3">
            Category: {{ $category->name }}
        </div>

        <div class="card-body p-lg-4">
            <div class="row justify-content-md-center">
                <div class="col-md-10 col-lg-8 col-xl-6">
                    {{-- Form --}}
                    <form action="{{ route('category.update', ['category' => $category->id]) }}" method="POST"
                        class="row g-3">
                        @csrf
                        @method('PUT')

                        <div class="col-12">
                            <label for="name" class="form-label"><i class="bi bi-tags-fill me-2"></i>Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" value="{{ old('name', $category->name) }}"
                                placeholder="Category name">

                            @error('name')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="description" class="form-label"><i class="bi bi-card-text me-2"></i>Short
                                Description (optional)</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                rows="5" maxlength="250" placeholder="Short description">{{ old('description', $category->description) }}</textarea>

                            <div id="charCount" class="form-text">0/250</div>

                            @error('description')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>

                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-warning">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- JS Custom --}}
    @prepend('scripts')
        <script>
            $(document).ready(function() {
                const updateCharacterCount = () => {
                    const description = $('#description').val() || '';
                    const currentLength = description.length;
                    const maxLength = $('#description').attr('maxlength');
                    $('#charCount').text(`${currentLength}/${maxLength}`);
                };

                $('#description').on('input', updateCharacterCount);

                updateCharacterCount();
            });
        </script>
    @endprepend
</x-admin>
