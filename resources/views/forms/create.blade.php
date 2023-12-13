{{-- @extends('layouts.app') --}}
<h1>Create New Form</h1>

<form method="POST" action="{{ route('forms.store') }}">
    @csrf

    <div class="mb-3">


        <label for="name" class="form-label">Name:</label>


        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
            value="{{ old('name') }}" required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>



    <div class="mb-3">


        <label for="description" class="form-label">Description (Optional):</label>


        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>


    </div>



    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>


        <label class="form-check-label" for="is_active">Active</label>
    </div>

    <h2 class="mb-3">Questions</h2>

    @foreach (range(1, 1) as $i)
        <div class="card mb-3">
            <div class="card-header">
                <strong>Question #{{ $i }}</strong>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="question{{ $i }}" class="form-label">Question Text:</label>
                    <input type="text" class="form-control @error('questions.question.' . $i) is-invalid @enderror"
                        id="question{{ $i }}" name="questions[{{ $i }}][question]"
                        value="{{ old('questions.question.' . $i) }}" required>
                    @error('questions.question.' . $i)
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>



                <div class="form-check mb-3">


                    <input class="form-check-input" type="checkbox" id="is_required{{ $i }}"
                        name="questions[{{ $i }}][is_required]" value="1" checked>
                    <label class="form-check-label" for="is_required{{ $i }}">Required</label>
                </div>

                <label for="type{{ $i }}">Question Type:</label>
                <select class="form-select mb-3" id="type{{ $i }}"
                    name="questions[{{ $i }}][type]">
                    <option value="text">Text</option>
                    <option value="number">Number</option>
                    <option value="date">Date</option>
                    <option value="single_choice">Single Choice</option>
                </select>

                <div id="options-container{{ $i }}" class="d-none">
                    <label for="options{{ $i }}">Options (Separate by commas):</label>
                    <input type="text" class="form-control" id="options{{ $i }}"
                        name="questions[{{ $i }}][options]" value="{{ old('questions.options.' . $i) }}">
                </div>

                <script>
                    $("#type{{ $i }}").change(function() {
                        if ($(this).val() === "single_choice") {
                            $("#options-container{{ $i }}").removeClass("d-none");
                        } else {
                            $("#options-container{{ $i }}").addClass("d-none");
                        }
                    });
                </script>
            </div>
        </div>
    @endforeach

    <button type="submit" class="btn btn-primary">Create Form</button>
</form>
