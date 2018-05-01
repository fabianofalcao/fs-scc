@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Detalhes da empresa: <b>{{ $company->name }}</b></h1>
    
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index')}}">Home</a></li>
        <li><a href="{{ route('company.index') }}">Empresas</a></li>
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
                            <dd>{{ $company->id }}</dd>
                            <dt>Nome:</dt>
                            <dd>{{ $company->name }}</dd>
                            <dt>CPF:</dt>
                            <dd>{{ formatString('cnpj', $company->cnpj) }}</dd>
                            <dt>Insc. Estadual:</dt>
                            <dd>{{ $company->ie }}</dd>
                            <dt>Insc. Municipal:</dt>
                            <dd>{{ $company->im }}</dd>
                            <dt>Responsável:</dt>
                            <dd>{{ $company->responsible_name }}</dd>
                        </dl>
                    </fieldset>
                        
                    <fieldset>
                        <legend>Endereço</legend>
                        <dl class="dl-horizontal">
                            <dt>Logradouro:</dt>
                            <dd>{{ $company->address_street }}</dd>
                            <dt>Número:</dt>
                            <dd>{{ $company->address_number}}</dd>
                            <dt>Complmento:</dt>
                            <dd>{{ $company->address_complement}}</dd>
                            <dt>Bairo:</dt>
                            <dd>{{ $company->address_neighborhood }}</dd>
                            <dt>CEP:</dt>
                            <dd>{{ formatString('cep', $company->address_zipcode) }}</dd>
                            <dt>Cidade/Estado:</dt>
                            <dd>{{ $company->address_city }}/{{$company->address_state }}</dd>
                            <dt>E-mail:</dt>
                            <dd>{{ $company->email }}</dd>
                            <dt>Site:</dt>
                            <dd>{{ $company->site }}</dd>
                            <dt>Telefone:</dt>
                            <dd>{{ formatString('fone', $company->phone, 10) }}</dd>
                            <dt>Celular:</dt>
                            <dd>{{ formatString('fone', $company->cell, 11) }}</dd>
                            <dt>Logo:</dt>
                            <dd>{{ $company->path_logo }}</dd>
                        </dl>
                    </fieldset>
                        
                </div><!-- /.box-body -->

                {!! Form::open(['route' => ['company.destroy', $company->id], 'method' => 'DELETE', 'name' => 'form_del']) !!}
                <div class="box-footer text-right">
                    <a href="{{ route('company.index') }}" class="btn btn-sm btn-default"><i class="fa fa-undo" aria-hidden="true"></i> Voltar</a>
                    <button type="submit" class="btn btn-sm btn-danger" title="Excluir registro" onclick="javascript: return confirm('Tem certeza que deseja excluir usuário? Esta exclusão implicará na perda de todas as informações referentes a este usuário.');">
                        <i class="fa fa-trash-o" aria-hidden="true"></i> Excluir
                    </button>
                </div>
                {!! Form::close() !!}

            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@stop