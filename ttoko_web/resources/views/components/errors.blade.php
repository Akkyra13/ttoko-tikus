@if ($errors->any())
<div class="error-card">
    <ul>
        @foreach ($errors->all() as $e)
            <li> {{ $e }} </li>
        @endforeach
    </ul>
</div>
@endif
