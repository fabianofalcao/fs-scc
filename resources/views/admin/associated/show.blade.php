@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Detalhes do associado: <b>{{ $associated->user->name }}</b></h1>
    
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index')}}">Home</a></li>
        <li><a href="{{ route('associated.index') }}">Associados</a></li>
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
                            <dd>{{ $associated->id }}</dd>
                            <dt>Razão social:</dt>
                            <dd>{{ $associated->user->name }}</dd>
                            <dt>CPF:</dt>
                            <dd>{{ formatString('cpf', $associated->person_physical->cpf) }}</dd>
                            <dt>Identidade:</dt>
                            <dd>{{ $associated->person_physical->rg }}</dd>
                            <dt>Sexo:</dt>
                            <dd>{{ $associated->person_physical->sexo }}</dd>
                            <dt>Data de Nascimento:</dt>
                            <dd>{{ formatDateAndTime($associated->person_physical->date_birth) }}</dd>
                            <dt>Estado civil:</dt>
                            <dd>{{ $associated->marital_status->description }}</dd>
                            <dt>Inf. bancárias:</dt>
                            <dd>Banco: {{ $associated->bank->name }} - Agência: {{ $associated->bank_branch }} - Conta: {{ $associated->bank_account }} - Tipo: {{ $associated->bank_type_account }}</dd>
                            <dt>Data de Admissão:</dt>
                            <dd>{{ formatDateAndTime($associated->admission_date) }}</dd>
                            <dt>Cargo no IFMG:</dt>
                            <dd>{{ $associated->role }}</dd>
                            <dt>Data de Associação:</dt>
                            <dd>{{ formatDateAndTime($associated->affiliation_date) }}</dd>
                            <dt>Cód. Débito Automático:</dt>
                            <dd>{{ $associated->automatic_debit_code }}</dd>
                            <dt>Limite de crédito:</dt>
                            <dd>{{ 'R$ '.number_format($associated->credit_limit, 2, ',','.') }}</dd>
                            <dt>Status:</dt>
                            <dd>{{ $associated->status }}</dd>
                            <dt>E-mail:</dt>
                            <dd>{{ $associated->user->email }}</dd>
                            
                        </dl>
                    </fieldset>
                        
                    <fieldset>
                        <legend>Endereço</legend>
                        <dl class="dl-horizontal">
                            <dt>Logradouro:</dt>
                            <dd>{{ $associated->user->address_street }}</dd>
                            <dt>Número:</dt>
                            <dd>{{ $associated->user->address_number}}</dd>
                            <dt>Complmento:</dt>
                            <dd>{{ $associated->user->address_complement}}</dd>
                            <dt>Bairo:</dt>
                            <dd>{{ $associated->user->address_neighborhood }}</dd>
                            <dt>CEP:</dt>
                            <dd>{{ formatString('cep', $associated->user->address_zipcode) }}</dd>
                            <dt>Cidade/Estado:</dt>
                            <dd>{{ $associated->user->address_city }}/{{$associated->user->address_state }}</dd>
                            <dt>Telefone:</dt>
                            <dd>{{ formatString('fone', $associated->user->phone, 10) }}</dd>
                            <dt>Celular:</dt>
                            <dd>{{ formatString('fone', $associated->user->cell, 11) }}</dd>
                        </dl>
                    </fieldset>
                        
                </div><!-- /.box-body -->

                {!! Form::open(['route' => ['associated.destroy', $associated->id], 'method' => 'DELETE', 'name' => 'form_del']) !!}
                <div class="box-footer text-right">
                    <a href="{{ route('associated.index') }}" class="btn btn-sm btn-default"><i class="fa fa-undo" aria-hidden="true"></i> Voltar</a>
                    <button type="submit" class="btn btn-sm btn-danger" title="Excluir registro" onclick="javascript: return confirm('Tem certeza que deseja excluir associado? Esta exclusão implicará na perda de todas as informações referentes a este associado.');">
                        <i class="fa fa-trash-o" aria-hidden="true"></i> Excluir
                    </button>
                </div>
                {!! Form::close() !!}

            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@stop