<fieldset>
    <legend>Dados pessoais</legend>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="name">Nome *</label>
                {!! Form::text('name', null, ['class' => 'form-control input-sm', 'autofocus', 'required']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2">
            <div class="form-group">
                <label for="cnpj">CNPJ *</label>
                @if(isset($company))
                {!! Form::text('cnpj', $company->cnpj, ['class' => 'form-control input-sm', 'required']) !!}
                @else
                {!! Form::text('cnpj', null, ['class' => 'form-control input-sm', 'required']) !!}
                @endif
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <label for="ie">Inscrição estadual</label>
                @if(isset($company))
                {!! Form::text('ie', $company->ie, ['class' => 'form-control input-sm']) !!}
                @else
                {!! Form::text('ie', null, ['class' => 'form-control input-sm']) !!}
                @endif
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <label for="im">Inscrição municipal </label>
                @if(isset($company))
                {!! Form::text('im', $company->im, ['class' => 'form-control input-sm']) !!}
                @else
                {!! Form::text('im', null, ['class' => 'form-control input-sm']) !!}
                @endif
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="responsible_name">Responsável *</label>
                @if(isset($company))
                {!! Form::text('responsible_name', $company->responsible_name, ['class' => 'form-control input-sm', 'required']) !!}
                @else
                {!! Form::text('responsible_name', null, ['class' => 'form-control input-sm', 'required']) !!}
                @endif
            </div>
        </div>
    </div>
</fieldset>

<fieldset style="margin-top: 10px;">
    <legend>Endereço:</legend>
    <div class="row">
        <div class="col-lg-2">
            <div class="form-group">
                <label for="address_zipcode">CEP *</label>
                {!! Form::text('address_zipcode', null, ['class' => 'form-control input-sm', 'required']) !!}
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="address_street">Logradouro</label>
                {!! Form::text('address_street', null, ['class' => 'form-control input-sm', 'required']) !!}
            </div>
        </div>
        <div class="col-lg-1">
            <div class="form-group">
                <label for="address_number">Número</label>
                {!! Form::text('address_number', null, ['class' => 'form-control input-sm']) !!}
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label for="address_complement">Complemento</label>
                {!! Form::text('address_complement', null, ['class' => 'form-control input-sm']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label for="address_neighborhood">Bairro</label>
                {!! Form::text('address_neighborhood', null, ['class' => 'form-control input-sm']) !!}
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="address_city">Cidade *</label>
                {!! Form::text('address_city', null, ['class' => 'form-control input-sm', 'required']) !!}
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <label for="address_state">Estado *</label>
                {!! Form::text('address_state', null, ['class' => 'form-control input-sm', 'required', 'maxlenght' => 2]) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="phone">Telefone fixo</label>
                {!! Form::text('phone', null, ['class' => 'form-control input-sm']) !!}
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="cell">Celular</label>
                {!! Form::text('cell', null, ['class' => 'form-control input-sm',]) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="email">E-mail *</label>
                {!! Form::email('email', null, ['class' => 'form-control input-sm', 'required']) !!}
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="site">Site </label>
                {!! Form::text('site', null, ['class' => 'form-control input-sm']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="path_logo">Logo </label>
                {!! Form::text('path_logo', null, ['class' => 'form-control input-sm']) !!}
            </div>
        </div>
    </div>
</fieldset>

@push('scripts-company')
    <script src="{{ url('assets/js/input-mask/jquery.inputmask.js') }}"></script>
    <script>
        $(document).ready(function ($) {
            $("input[name='cnpj']").inputmask('99.999.999/9999-99', { 'placeholder': '' });
            $("input[name='phone']").inputmask('(99)9999-9999', { 'placeholder': '' });
            $("input[name='cell']").inputmask('(99)99999-9999', { 'placeholder': '' });
            $("input[name='address_zipcode']").inputmask('99999-999', { 'placeholder': '' });
        });  
    </script>
@endpush