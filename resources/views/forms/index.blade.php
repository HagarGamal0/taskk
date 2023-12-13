
@endif

@if ($forms->count() > 0)
    <ul>
        @foreach ($forms as $form)
            <li>{{ $form->name }}</a></li>
        @endforeach
    </ul>
@else
    <div class="alert alert-info">No forms found.</div>
@endif
