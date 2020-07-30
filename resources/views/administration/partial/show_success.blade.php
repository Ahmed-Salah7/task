@if (session()->has('success'))
    <div class="alert alert-success">
        <ul>
            <h5>{{ session()->get('success') }}</h5>
        </ul>
    </div>
@endif
