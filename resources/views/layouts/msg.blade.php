@if ($errors->any())
@foreach ($errors->all() as $error)
<div class="alert alert-danger">
    <button type="button" aria-hidden="true" class="close" onclick="this.parentElement.style.display='none'">×</button>
    <span>
        <b> Error - </b>
        {{ $error }}</span>
</div>
@endforeach
@endif

@if(session('successMsg'))
<div class="alert alert-success">
    <button type="button" aria-hidden="true" class="close" onclick="this.parentElement.style.display='none'">×</button>
    <span>
        <b> Success - </b> {{ session('successMsg') }}</span>
</div>
@endif
@if(session('infoMsg'))
<div class="alert alert-warning">
    <button type="button" aria-hidden="true" class="close" onclick="this.parentElement.style.display='none'">×</button>
    <span>
        <b> Info - </b> {{ session('infoMsg') }}</span>
</div>
@endif