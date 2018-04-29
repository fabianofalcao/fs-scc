@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Detalhes do usuário: <b>{{ $user->name }}</b></h1>
    
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index')}}">Home</a></li>
        <li><a href="{{ route('user.index') }}">Usuários</a></li>
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
                        <legend>Dados pessoais</legend>
                        <dl class="dl-horizontal">
                            <dt>Código:</dt>
                            <dd>{{ $user->id }}</dd>
                            <dt>Nome:</dt>
                            <dd>{{ $user->name }}</dd>
                            <dt>CPF:</dt>
                            <dd>{{ formatString('cpf', $user->person_physical->cpf) }}</dd>
                            <dt>RG:</dt>
                            <dd>{{ $user->person_physical->rg }}</dd>
                            <dt>Data de nascimento:</dt>
                            <dd>{{ formatDateAndTime($user->person_physical->date_birth) }}</dd>
                            <dt>Sexo:</dt>
                            <dd>{{ $user->person_physical->sexo }}</dd>
                        </dl>
                    </fieldset>
                        
                    <fieldset>
                        <legend>Dados de acesso</legend>
                        <dl class="dl-horizontal">
                            <dt>E-mail:</dt>
                            <dd>{{ $user->email }}</dd>
                        </dl>
                    </fieldset>

                    <fieldset>
                        <legend>Endereço</legend>
                        <dl class="dl-horizontal">
                            <dt>Logradouro:</dt>
                            <dd>{{ $user->address_street }}</dd>
                            <dt>Número:</dt>
                            <dd>{{ $user->address_number}}</dd>
                            <dt>Complmento:</dt>
                            <dd>{{ $user->address_complement}}</dd>
                            <dt>Bairo:</dt>
                            <dd>{{ $user->address_neighborhood }}</dd>
                            <dt>CEP:</dt>
                            <dd>{{ formatString('cep', $user->address_zipcode) }}</dd>
                            <dt>Cidade/Estado:</dt>
                            <dd>{{ $user->address_city }}/{{$user->address_state }}</dd>
                        </dl>
                    </fieldset>
                        
                </div><!-- /.box-body -->

                {!! Form::open(['route' => ['user.destroy', $user->id], 'method' => 'DELETE', 'name' => 'form_del']) !!}
                <div class="box-footer text-right">
                    <a href="{{ route('user.index') }}" class="btn btn-sm btn-default"><i class="fa fa-undo" aria-hidden="true"></i> Voltar</a>
                    <button type="submit" class="btn btn-sm btn-danger" title="Excluir registro" onclick="javascript: return confirm('Tem certeza que deseja excluir usuário? Esta exclusão implicará na perda de todas as informações referentes a este usuário.');">
                        <i class="fa fa-trash-o" aria-hidden="true"></i> Excluir
                    </button>
                </div>
                {!! Form::close() !!}

            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@stop