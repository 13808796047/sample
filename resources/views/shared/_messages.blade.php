
@if(session()->has('success'))
    <div class="alert alert-success" role="alert">
        <strong>{{session()->get('success')}}</strong>
    </div>
@endif