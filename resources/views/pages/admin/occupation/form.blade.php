<div class="form-group mb-3">
    <label for="name" class="mb-2">
        Name
        <span class="required">*</span>
    </label>
    <input
        type="text"
        class="form-control @error('name')
            is-invalid
        @enderror"
        id="name"
        name="name"
        value="{{ old('name', $occupation->name) }}"
    >
    @error('name')
        <p class="text-danger text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="d-flex justify-content-end">
    <button type="submit" class="btn btn-sm btn-success">Save</button>
</div>
