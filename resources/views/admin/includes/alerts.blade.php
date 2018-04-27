@if(session('success'))
<div class="row margin-top20">
    <div class="col-md-10 col-md-offset-1">
        <div class="alert alert-success" role="alert">{{ session('success') }}</div>
    </div>
</div>
@endif

@if(session('error'))
<div class="row margin-top20">
    <div class="col-md-10 col-md-offset-1">
        <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
    </div>
</div>
@endif

@if(session('message'))
<div class="row margin-top20">
    <div class="col-md-10 col-md-offset-1">
        <div class="alert alert-info" role="alert">{{ session('message') }}</div>
    </div>
</div>
@endif