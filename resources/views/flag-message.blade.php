
@if($message = Session::get('success'))
    <div class="alert alert-danger" role="alert"></div>
    <strong>{{ $message }}</strong>
@endif
