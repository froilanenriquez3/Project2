@if (Session::has('error'))

<div class="alert alert-danger alert-dismissible fade show log-feedback" role="alert">
    {{ Session::get('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

@endif

@if( Session::has('mensaje'))

<div class="alert alert-success alert-dismissible fade show log-feedback" role="alert">
    {{ Session::get('mensaje') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

@endif

@if( Session::has('message'))

<div class="alert alert-success alert-dismissible fade show log-feedback" role="alert">
    {{ Session::get('message') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

@endif

