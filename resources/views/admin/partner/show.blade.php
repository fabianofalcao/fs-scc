@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Detalhes do parceiro: <b>{{ $partner->user->name }}</b></h1>
    
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index')}}">Home</a></li>
        <li><a href="{{ route('company.index') }}">Parceiros</a></li>
        <li>Detalhar</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                
                @include('admin.includes.errors')
                
                <div class="box-body">

                    <fieldset>
                        <legend>Dados principais</legend>
                        <dl class="dl-horizontal">
                            <dt>Código:</dt>
                            <dd>{{ $partner->id }}</dd>
                            <dt>Razão social:</dt>
                            <dd>{{ $partner->user->name }}</dd>
                            <dt>CNPJ:</dt>
                            <dd>{{ formatString('cnpj', $partner->person_legal->cnpj) }}</dd>
                            <dt>Insc. Estadual:</dt>
                            <dd>{{ $partner->person_legal->ie }}</dd>
                            <dt>Insc. Municipal:</dt>
                            <dd>{{ $partner->person_legal->im }}</dd>
                            <dt>E-mail:</dt>
                            <dd>{{ $partner->user->email }}</dd>
                            <dt>Contato:</dt>
                            <dd>{{ $partner->person_legal->responsible_name }}</dd>
                            <dt>Data do convênio:</dt>
                            <dd>{{ formatDateAndTime($partner->date_start) }}</dd>
                            <dt>Status:</dt>
                            <dd>{{ $partner->status }}</dd>
                        </dl>
                    </fieldset>
                        
                    <fieldset>
                        <legend>Endereço</legend>
                        <dl class="dl-horizontal">
                            <dt>Logradouro:</dt>
                            <dd>{{ $partner->user->address_street }}</dd>
                            <dt>Número:</dt>
                            <dd>{{ $partner->user->address_number}}</dd>
                            <dt>Complmento:</dt>
                            <dd>{{ $partner->user->address_complement}}</dd>
                            <dt>Bairo:</dt>
                            <dd>{{ $partner->user->address_neighborhood }}</dd>
                            <dt>CEP:</dt>
                            <dd>{{ formatString('cep', $partner->user->address_zipcode) }}</dd>
                            <dt>Cidade/Estado:</dt>
                            <dd>{{ $partner->user->address_city }}/{{$partner->user->address_state }}</dd>
                            <dt>Telefone:</dt>
                            <dd>{{ formatString('fone', $partner->user->phone, 10) }}</dd>
                            <dt>Celular:</dt>
                            <dd>{{ formatString('fone', $partner->user->cell, 11) }}</dd>
                            <dt>Observações:</dt>
                            <dd>{{ $partner->comments }}</dd>
                        </dl>
                    </fieldset>
                        
                </div><!-- /.box-body -->

                {!! Form::open(['route' => ['partner.destroy', $partner->id], 'method' => 'DELETE', 'name' => 'form_del']) !!}
                <div class="box-footer text-right">
                    <a href="{{ route('partner.index') }}" class="btn btn-sm btn-default"><i class="fa fa-undo" aria-hidden="true"></i> Voltar</a>
                    <button type="submit" class="btn btn-sm btn-danger" title="Excluir registro" onclick="javascript: return confirm('Tem certeza que deseja excluir usuário? Esta exclusão implicará na perda de todas as informações referentes a este parceiro.');">
                        <i class="fa fa-trash-o" aria-hidden="true"></i> Excluir
                    </button>
                </div>
                {!! Form::close() !!}

            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@stop