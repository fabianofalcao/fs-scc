{!! Form::hidden('person_type_id', 1 ) !!}
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
        <div class="col-lg-3">
            <div class="form-group">
                <label for="cpf">CPF *</label>
                @if(isset($user))
                {!! Form::text('cpf', $user->person_physical->cpf, ['class' => 'form-control input-sm', 'required']) !!}
                @else
                {!! Form::text('cpf', null, ['class' => 'form-control input-sm', 'required']) !!}
                @endif
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label for="rg">Identidade</label>
                @if(isset($user))
                {!! Form::text('rg', $user->person_physical->rg, ['class' => 'form-control input-sm']) !!}
                @else
                {!! Form::text('rg', null, ['class' => 'form-control input-sm']) !!}
                @endif
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label for="date_birth">Data Nascimento *</label>
                @if(isset($user))
                {!! Form::text('date_birth', formatDateAndTime($user->person_physical->date_birth), ['class' => 'form-control input-sm', 'required']) !!}
                @else
                {!! Form::text('date_birth', null, ['class' => 'form-control input-sm', 'required']) !!}
                @endif
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label for="sexo">Sexo *</label>
                @if(isset($user))
                {!! Form::select('sexo', $sexos, $user->person_physical->sexo, ['class' => 'form-control input-sm', 'required']) !!}
                @else
                {!! Form::select('sexo', $sexos, null, ['class' => 'form-control input-sm', 'required']) !!}
                @endif
            </div>
        </div>
    </div>
</fieldset>
<fieldset>
    <legend>Dados de acesso</legend>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="email">E-mail *</label>
                {!! Form::email('email', null, ['class' => 'form-control input-sm', 'required']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="password">Senha *</label>
                @if(isset($user))
                {!! Form::password('password', ['class' => 'form-control input-sm']) !!}
                @else
                {!! Form::password('password', ['class' => 'form-control input-sm', 'required']) !!}
                @endif
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="password_confirmation">Confirmar senha *</label>
                @if(isset($user))
                {!! Form::password('password_confirmation', ['class' => 'form-control input-sm']) !!}
                @else
                {!! Form::password('password_confirmation', ['class' => 'form-control input-sm', 'required']) !!}
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="checkbox form-group">
                <label>
                    <input type="checkbox" name="is_admin" value="1"> É administrador?
                </label>
            </div>
        </div>
    </div>
</fildset>

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
</fieldset>

@push('scripts-user')
    <script src="{{ url('assets/js/input-mask/jquery.inputmask.js') }}"></script>
    <script>
        $(document).ready(function ($) {
            $("input[name='date_birth']").inputmask('99/99/9999', { 'placeholder': '' })
            $("input[name='cpf']").inputmask('999.999.999-99', { 'placeholder': '' })
            $("input[name='phone']").inputmask('(99)9999-9999', { 'placeholder': '' })
            $("input[name='cell']").inputmask('(99)99999-9999', { 'placeholder': '' })
            $("input[name='address_zipcode']").inputmask('99999-999', { 'placeholder': '' })
        });  
    </script>
@endpush