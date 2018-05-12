@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Associados</h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index')}}">Home</a></li>
        <li>Associados</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                @include('admin.includes.alerts')
                <div class="box-header">
                    <a href="{{ route('associated.create') }}" class="btn bg-olive btn-sm" title="Adicionar registro"><i class="fa fa-plus-square" aria-hidden="true"></i> Adicionar</a>
                    <div class="box-tools">
                        {!! Form::open(['route' => 'associated.search', 'method' => 'POST']) !!}
                            @include('admin.includes.formsearch')
                        {!! Form::close() !!}
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                    @if(isset($dataForm['key_search']))
                        <div class="alert alert-info">
                            <p>
                                <a href="{{ route('associated.index') }}" style="text-decoration: none"><i class="fa fa-refresh"></i>&nbsp;</a>
                                <b>Resultados para:</b> {{ $dataForm['key_search'] }}
                            </p>
                        </div>
                    @endif()

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            @if(isset($dataForm))
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>CPF</th>
                            @else
                                <th><a href="{{Order::url('name')}}">Nome</a></th>
                                <th><a href="{{Order::url('email')}}">E-mail</a></th>
                                <th>CPF</th>
                            @endif
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($associateds as $associated)
                                <tr>
                                    <td>{{ $associated->user->name }}</td>
                                    <td>{{ $associated->user->email }}</td>
                                    <td>{{ formatString('cpf',$associated->person_physical->cpf)}}</td>
                                    
                                    <td class="text-center">
                                        <a href="{{ route('associated.show', $associated->id) }}" class="btn bg-purple btn-xs" title="Detalhar registro"><i class="fa fa-info-circle" aria-hidden="true"></i> Detalhar</a>
                                        <a href="{{ route('associated.dependets', $associated->id) }}" class="btn bg-purple btn-xs" title="Ver dependentes"><i class="fa fa-info-circle" aria-hidden="true"></i> Dependentes</a>
                                        <a href="{{ route('associated.edit', $associated->id) }}" class="btn btn-primary btn-xs" title="Editar registro"><i class="fa fa-pencil-square" aria-hidden="true"></i> Editar</a>
                                    </td>
                                </tr>                                
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Nenhum associado cadastrado!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="text-center">
                        @if(isset($dataForm))
                            {!! $associateds->appends($dataForm)->links()  !!}
                        @else
                            {!! $associateds->links()  !!}
                        @endif
                    </div>
                    
                </div><!-- /.box-body -->
                <div class="box-footer text-right">
                    <a href="{{ route('admin.index') }}" class="btn btn-default btn-sm" title="Voltar"><i class="fa fa-undo" aria-hidden="true"></i>  Voltar</a>
                </div>
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@stop