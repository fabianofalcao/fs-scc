{!! Form::hidden('person_type_id', 1 ) !!}
@if(isset($role))
{!! Form::hidden('roles[]', $role->id) !!}
@endif
<fieldset>
    <legend>Dados pessoais</legend>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="name">Nome *</label>
                @if(isset($associated))
                {!! Form::text('name', $associated->user->name, ['class' => 'form-control input-sm', 'required']) !!}
                @else
                {!! Form::text('name', null, ['class' => 'form-control input-sm', 'required']) !!}
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="form-group">
                <label for="cnpj">CPF *</label>
                @if(isset($associated))
                {!! Form::text('cpf', $associated->person_physical->cpf, ['class' => 'form-control input-sm', 'required', 'readonly']) !!}
                @else
                {!! Form::text('cpf', null, ['class' => 'form-control input-sm', 'required']) !!}
                @endif
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label for="rg">Indentidade</label>
                @if(isset($associated))
                {!! Form::text('rg', $associated->person_physical->rg, ['class' => 'form-control input-sm']) !!}
                @else
                {!! Form::text('rg', null, ['class' => 'form-control input-sm']) !!}
                @endif
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label for="date_birth">Data Nascimento *</label>
                @if(isset($associated))
                {!! Form::text('date_birth', $associated->person_physical->date_birth, ['class' => 'form-control input-sm', 'required']) !!}
                @else
                {!! Form::text('date_birth', null, ['class' => 'form-control input-sm', 'required']) !!}
                @endif
            </div>
        </div>

        <div class="col-lg-3">
            <div class="form-group">
                <label for="sexo">Sexo *</label>
                @if(isset($associated))
                {!! Form::select('sexo', $sexos, $associated->person_physical->sexo, ['class' => 'form-control input-sm', 'required']) !!}
                @else
                {!! Form::select('sexo', $sexos, null, ['class' => 'form-control input-sm', 'required']) !!}
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2">
            <div class="form-group">
                <label for="admission_date">Data Admissão</label>
                @if(isset($associated))
                {!! Form::text('admission_date', formatDateAndTime($associated->admission_date), ['class' => 'form-control input-sm']) !!}
                @else
                {!! Form::text('admission_date', null, ['class' => 'form-control input-sm']) !!}
                @endif
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <label for="affiliation_date">Data Associação</label>
                @if(isset($associated))
                {!! Form::text('affiliation_date', formatDateAndTime($associated->affiliation_date), ['class' => 'form-control input-sm']) !!}
                @else
                {!! Form::text('affiliation_date', null, ['class' => 'form-control input-sm']) !!}
                @endif
            </div>
        </div>
        <div class="col-lg-8">
            <div class="form-group">
                <label for="role">Cargo</label>
                @if(isset($associated))
                {!! Form::text('role',$associated->role, ['class' => 'form-control input-sm']) !!}
                @else
                {!! Form::text('role', null, ['class' => 'form-control input-sm']) !!}
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
                @if(isset($associated))
                {!! Form::email('email', $associated->user->email, ['class' => 'form-control input-sm', 'required']) !!}
                @else
                {!! Form::email('email', null, ['class' => 'form-control input-sm', 'required']) !!}
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="password">Senha *</label>
                @if(isset($associated))
                {!! Form::password('password', ['class' => 'form-control input-sm']) !!}
                @else
                {!! Form::password('password', ['class' => 'form-control input-sm', 'required']) !!}
                @endif
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="password_confirmation">Confirmar senha *</label>
                @if(isset($associated))
                {!! Form::password('password_confirmation', ['class' => 'form-control input-sm']) !!}
                @else
                {!! Form::password('password_confirmation', ['class' => 'form-control input-sm', 'required']) !!}
                @endif
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
                @if(isset($associated))
                {!! Form::text('address_zipcode', $associated->user->address_zipcode, ['class' => 'form-control input-sm', 'required']) !!}
                @else
                {!! Form::text('address_zipcode', null, ['class' => 'form-control input-sm', 'required']) !!}
                @endif
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="address_street">Logradouro</label>
                @if(isset($associated))
                {!! Form::text('address_street', $associated->user->address_street, ['class' => 'form-control input-sm', 'required']) !!}
                @else
                {!! Form::text('address_street', null, ['class' => 'form-control input-sm', 'required']) !!}
                @endif
            </div>
        </div>
        <div class="col-lg-1">
            <div class="form-group">
                <label for="address_number">Número</label>
                @if(isset($associated))
                {!! Form::text('address_number', $associated->user->address_number, ['class' => 'form-control input-sm']) !!}
                @else
                {!! Form::text('address_number', null, ['class' => 'form-control input-sm']) !!}
                @endif
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label for="address_complement">Complemento</label>
                @if(isset($associated))
                {!! Form::text('address_complement', $associated->user->address_complement, ['class' => 'form-control input-sm']) !!}
                @else
                {!! Form::text('address_complement', null, ['class' => 'form-control input-sm']) !!}
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label for="address_neighborhood">Bairro</label>
                @if(isset($associated))
                {!! Form::text('address_neighborhood', $associated->user->address_neighborhood, ['class' => 'form-control input-sm']) !!}
                @else
                {!! Form::text('address_neighborhood', null, ['class' => 'form-control input-sm']) !!}
                @endif
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="address_city">Cidade *</label>
                @if(isset($associated))
                {!! Form::text('address_city', $associated->user->address_city, ['class' => 'form-control input-sm', 'required', 'readonly']) !!}
                @else
                {!! Form::text('address_city', null, ['class' => 'form-control input-sm', 'required']) !!}
                @endif
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <label for="address_state">Estado *</label>
                @if(isset($associated))
                {!! Form::text('address_state', $associated->user->address_state, ['class' => 'form-control input-sm', 'required', 'maxlenght' => 2, 'readonly']) !!}
                @else
                {!! Form::text('address_state', null, ['class' => 'form-control input-sm', 'required', 'maxlenght' => 2]) !!}
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="phone">Telefone fixo</label>
                @if(isset($associated))
                {!! Form::text('phone', $associated->user->phone, ['class' => 'form-control input-sm']) !!}
                @else
                {!! Form::text('phone', null, ['class' => 'form-control input-sm']) !!}
                @endif
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="cell">Celular</label>
                @if(isset($associated))
                {!! Form::text('cell', $associated->user->cell, ['class' => 'form-control input-sm',]) !!}
                @else
                {!! Form::text('cell', null, ['class' => 'form-control input-sm',]) !!}
                @endif
            </div>
        </div>
    </div>
    
</fieldset>

@push('scripts-user')
    <script src="{{ url('assets/js/input-mask/jquery.inputmask.js') }}"></script>
    <script>
        $(document).ready(function ($) {
            $("input[name='affiliation_date']").inputmask('99/99/9999', { 'placeholder': '' })
            $("input[name='admission_date']").inputmask('99/99/9999', { 'placeholder': '' })
            $("input[name='cpf']").inputmask('99.999.999/9999-99', { 'placeholder': '' })
            $("input[name='phone']").inputmask('(99)9999-9999', { 'placeholder': '' })
            $("input[name='cell']").inputmask('(99)99999-9999', { 'placeholder': '' })
            $("input[name='address_zipcode']").inputmask('99999-999', { 'placeholder': '' })

             /**
            * Integração com os correios API assim que digita o CEP
            */
            $("input[name='address_zipcode']").blur(function(){
                var cep = $(this).val();
                var cepLimpo = cep.replace(/[^\d]+/g,'');
                    
                $.ajax({
                    url: 'https://viacep.com.br/ws/'+cepLimpo+'/json/',
                    type: 'GET',
                    dataType: 'json',
                    success:function(json){
                        console.log(json);
                        if(!json.erro){
                            $("input[name='address_street']").val(json.logradouro);
                            if(json.bairro == ""){
                                $("input[name='address_neighborhood']").val('Centro');
                            }
                            else 
                                $("input[name='address_neighborhood']").val(json.bairro);
                            $("input[name='address_city']").val(json.localidade);
                            $("input[name='address_state']").val(json.uf);
                            $("input[name='address_city']").prop('readonly', true);
                            $("input[name='address_state']").prop('readonly', true);
                            
                        } else {
                            alert('CEP inválido!');
                            $('#CEP').val('');
                        }
                    },
                    error:function(r){
                        alert('CEP inválido!');
                        $("input[name='address_zipcode']").val('');
                    },
                });
            });

        });  
    </script>
@endpush