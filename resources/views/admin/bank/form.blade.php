<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label for="number">Número</label>
            {!! Form::text('number', null, ['class' => 'form-control input-sm', 'autofocus', 'required', 'maxlength' => 3]) !!}
        </div>
    </div>
    <div class="col-lg-12">
        <div class="form-group">
            <label for="name">Nome / Razão Social</label>
            {!! Form::text('name', null, ['class' => 'form-control input-sm', 'required']) !!}
        </div>
    </div>
</div>