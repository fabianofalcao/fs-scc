@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Estados civis</h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index')}}">Home</a></li>
        <li>Estados civis</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                @include('admin.includes.alerts')
                <div class="box-header">
                    <a href="{{ route('marital_status.create') }}" class="btn bg-olive btn-xm" title="Adicionar registro"><i class="fa fa-plus-square" aria-hidden="true"></i> Adicionar</a>
                    <div class="box-tools">
                        {!! Form::open(['route' => 'marital_status.search', 'method' => 'POST']) !!}
                            @include('admin.includes.formsearch')
                        {!! Form::close() !!}
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                    @if(isset($dataForm['key_search']))
                        <div class="alert alert-info">
                            <p>
                                <a href="{{ route('marital_status.index') }}" style="text-decoration: none"><i class="fa fa-refresh"></i>&nbsp;</a>
                                <b>Resultados para:</b> {{ $dataForm['key_search'] }}
                            </p>
                        </div>
                    @endif()

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th><a href="{{Order::url('description')}}">Descrição</a></th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($marital_statuses as $marital_status)
                                <tr>
                                    <td>{{ $marital_status->description }}</th>
                                    <td class="text-center">
                                        {!! Form::open(['route' => ['marital_status.destroy', $marital_status->id], 'method' => 'DELETE']) !!}
                                            <a href="{{ route('marital_status.edit', $marital_status->id) }}" class="btn btn-primary btn-xs" title="Editar registro"><i class="fa fa-pencil-square" aria-hidden="true"></i> Editar</a>
                                            <button type="submit" class="btn btn-danger btn-xs" title="Excluir registro" onclick="javascript: return confirm('Tem certeza que deseja excluir registro?.');">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i> Excluir
                                            </button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>                                
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center">Nenhum estado civil cadastrado!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="text-center">
                        @if(isset($dataForm))
                            {!! $marital_statuses->appends($dataForm)->links()  !!}
                        @else
                            {!! $marital_statuses->links()  !!}
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