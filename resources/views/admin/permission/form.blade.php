<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label for="name">Nome</label>
            {!! Form::text('name', null, ['class' => 'form-control input-sm', 'autofocus', 'required']) !!}
        </div>
    </div>
    <div class="col-lg-12">
        <div class="form-group">
            <label for="description">Descrição</label>
            {!! Form::textarea('description', null, ['class' => 'form-control input-sm', 'required']) !!}
        </div>
    </div>
</div>