
@if(session()->has('success'))
    <div class="alert alert-success" role="alert">
        <strong>{{session()->get('success')}}</strong>
    </div>
    @elseif(session()->has('danger'))
    <div class="alert alert-danger" role="alert">
        <strong>{{session()->get('danger')}}</strong>
    </div>
@endif