@if (\Session::has('success'))
<div class="alert alert-success">
    <ul>
        <li>{!! \Session::get('success') !!}</li>
    </ul>
</div>
@endif

@if (\Session::has('status'))
<div class="alert alert-success">
    <ul>
        <li>{!! \Session::get('success') !!}</li>
    </ul>
</div>
@endif

@if (\Session::has('info'))
<div class="alert alert-info">
    <ul>
        <li>{!! \Session::get('info') !!}</li>
    </ul>
</div>
@endif

@if (\Session::has('warning'))
<div class="alert alert-warning">
    <ul>
        <li>{!! \Session::get('warning') !!}</li>
    </ul>
</div>
@endif

@if (\Session::has('danger'))
<div class="alert alert-danger">
    <ul>
        <li>{!! \Session::get('danger') !!}</li>
    </ul>
</div>
@endif