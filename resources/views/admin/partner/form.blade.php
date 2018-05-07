{!! Form::hidden('person_type_id', 2 ) !!}
@if(isset($role))
{!! Form::hidden('roles[]', $role->id) !!}
@endif
<fieldset>
    <legend>Dados jurídicos</legend>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="name">Razão Social *</label>
                @if(isset($partner))
                {!! Form::text('name', $partner->user->name, ['class' => 'form-control input-sm', 'required']) !!}
                @else
                {!! Form::text('name', null, ['class' => 'form-control input-sm', 'required']) !!}
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="form-group">
                <label for="cnpj">CNPJ *</label>
                @if(isset($partner))
                {!! Form::text('cnpj', $partner->person_legal->cnpj, ['class' => 'form-control input-sm', 'required', 'readonly']) !!}
                @else
                {!! Form::text('cnpj', null, ['class' => 'form-control input-sm', 'required']) !!}
                @endif
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label for="ie">Insc.Estadual</label>
                @if(isset($partner))
                {!! Form::text('ie', $partner->person_legal->ie, ['class' => 'form-control input-sm']) !!}
                @else
                {!! Form::text('ie', null, ['class' => 'form-control input-sm']) !!}
                @endif
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label for="im">Insc. Municipal</label>
                @if(isset($partner))
                {!! Form::text('im', $partner->person_legal->im, ['class' => 'form-control input-sm']) !!}
                @else
                {!! Form::text('im', null, ['class' => 'form-control input-sm']) !!}
                @endif
            </div>
        </div>

        <div class="col-lg-3">
            <div class="form-group">
                <label for="status">Status *</label>
                @if(isset($partner))
                {!! Form::select('status', $statuses, $partner->status, ['class' => 'form-control input-sm', 'required']) !!}
                @else
                {!! Form::select('status', $statuses, null, ['class' => 'form-control input-sm', 'required']) !!}
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2">
            <div class="form-group">
                <label for="date_start">Data Convênio</label>
                @if(isset($partner))
                {!! Form::text('date_start', formatDateAndTime($partner->date_start), ['class' => 'form-control input-sm']) !!}
                @else
                {!! Form::text('date_start', null, ['class' => 'form-control input-sm']) !!}
                @endif
            </div>
        </div>
        <div class="col-lg-10">
            <div class="form-group">
                <label for="responsible_name">Contato</label>
                @if(isset($partner))
                {!! Form::text('responsible_name',$partner->person_legal->responsible_name, ['class' => 'form-control input-sm']) !!}
                @else
                {!! Form::text('responsible_name', null, ['class' => 'form-control input-sm']) !!}
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
                @if(isset($partner))
                {!! Form::email('email', $partner->user->email, ['class' => 'form-control input-sm', 'required']) !!}
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
                @if(isset($partner))
                {!! Form::password('password', ['class' => 'form-control input-sm']) !!}
                @else
                {!! Form::password('password', ['class' => 'form-control input-sm', 'required']) !!}
                @endif
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="password_confirmation">Confirmar senha *</label>
                @if(isset($partner))
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
                @if(isset($partner))
                {!! Form::text('address_zipcode', $partner->user->address_zipcode, ['class' => 'form-control input-sm', 'required']) !!}
                @else
                {!! Form::text('address_zipcode', null, ['class' => 'form-control input-sm', 'required']) !!}
                @endif
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="address_street">Logradouro</label>
                @if(isset($partner))
                {!! Form::text('address_street', $partner->user->address_street, ['class' => 'form-control input-sm', 'required']) !!}
                @else
                {!! Form::text('address_street', null, ['class' => 'form-control input-sm', 'required']) !!}
                @endif
            </div>
        </div>
        <div class="col-lg-1">
            <div class="form-group">
                <label for="address_number">Número</label>
                @if(isset($partner))
                {!! Form::text('address_number', $partner->user->address_number, ['class' => 'form-control input-sm']) !!}
                @else
                {!! Form::text('address_number', null, ['class' => 'form-control input-sm']) !!}
                @endif
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label for="address_complement">Complemento</label>
                @if(isset($partner))
                {!! Form::text('address_complement', $partner->user->address_complement, ['class' => 'form-control input-sm']) !!}
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
                @if(isset($partner))
                {!! Form::text('address_neighborhood', $partner->user->address_neighborhood, ['class' => 'form-control input-sm']) !!}
                @else
                {!! Form::text('address_neighborhood', null, ['class' => 'form-control input-sm']) !!}
                @endif
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="address_city">Cidade *</label>
                @if(isset($partner))
                {!! Form::text('address_city', $partner->user->address_city, ['class' => 'form-control input-sm', 'required', 'readonly']) !!}
                @else
                {!! Form::text('address_city', null, ['class' => 'form-control input-sm', 'required']) !!}
                @endif
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <label for="address_state">Estado *</label>
                @if(isset($partner))
                {!! Form::text('address_state', $partner->user->address_state, ['class' => 'form-control input-sm', 'required', 'maxlenght' => 2, 'readonly']) !!}
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
                @if(isset($partner))
                {!! Form::text('phone', $partner->user->phone, ['class' => 'form-control input-sm']) !!}
                @else
                {!! Form::text('phone', null, ['class' => 'form-control input-sm']) !!}
                @endif
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="cell">Celular</label>
                @if(isset($partner))
                {!! Form::text('cell', $partner->user->cell, ['class' => 'form-control input-sm',]) !!}
                @else
                {!! Form::text('cell', null, ['class' => 'form-control input-sm',]) !!}
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="comments">Observações</label>
                @if(isset($partner))
                {!! Form::textarea('comments', $partner->user->comments, ['class' => 'form-control input-sm']) !!}
                @else
                {!! Form::textarea('comments', null, ['class' => 'form-control input-sm']) !!}
                @endif
            </div>
        </div>
    </div>
</fieldset>

@push('scripts-user')
    <script src="{{ url('assets/js/input-mask/jquery.inputmask.js') }}"></script>
    <script>
        $(document).ready(function ($) {
            $("input[name='date_start']").inputmask('99/99/9999', { 'placeholder': '' })
            $("input[name='cnpj']").inputmask('99.999.999/9999-99', { 'placeholder': '' })
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