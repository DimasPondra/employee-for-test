<div class="row">
    <div class="col-6">
        <div class="form-group mb-3">
            <label for="start_date" class="mb-2">
                Start Date
                <span class="required">*</span>
            </label>
            <input
                type="date"
                class="form-control @error('start_date')
                    is-invalid
                @enderror"
                id="start_date"
                name="start_date"
                value="{{ old('start_date', $submissionFurlough->start_date) }}"
            >
            @error('start_date')
                <p class="text-danger text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="col-6">
        <div class="form-group mb-3">
            <label for="last_date" class="mb-2">
                Last Date
                <span class="required">*</span>
            </label>
            <input
                type="date"
                class="form-control @error('last_date')
                    is-invalid
                @enderror"
                id="last_date"
                name="last_date"
                value="{{ old('last_date', $submissionFurlough->last_date) }}"
            >
            @error('last_date')
                <p class="text-danger text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>

<div class="form-group mb-3">
    <label for="name" class="mb-2">
        Furlough Type
        <span class="required">*</span>
    </label>
    <select
        class="form-select @error('furlough_type')
            is-invalid
        @enderror"
        name="furlough_type"
        id="furlough_type"
    >
        <option selected disabled>Select furlough type</option>
        @foreach ($furloughTypes as $furloughType)
            <option
                value="{{ $furloughType->name }}"
                @if (old('furlough_type', $submissionFurlough->furlough_type) == $furloughType->name)
                    selected
                @endif
            >{{ $furloughType->name }}</option>
        @endforeach
    </select>
    @error('furlough_type')
        <p class="text-danger text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="reason" class="mb-2">
        Reason
    </label>
    <textarea
        class="form-control @error('reason')
            is-invalid
        @enderror"
        name="reason"
        id="reason"
        cols="30"
        rows="10"
    >{{ old('reason', $submissionFurlough->reason) }}</textarea>
    @error('reason')
        <p class="text-danger text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="d-flex justify-content-end">
    <button type="submit" class="btn btn-sm btn-success">Save</button>
</div>
