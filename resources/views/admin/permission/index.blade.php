@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Permissões</h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index')}}">Home</a></li>
        <li>Permissões</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                @include('admin.includes.alerts')
                <div class="box-header">
                    <a href="{{ route('permission.create') }}" class="btn bg-olive btn-sm" title="Adicionar registro"><i class="fa fa-plus-square" aria-hidden="true"></i> Adicionar</a>
                    <div class="box-tools">
                        {!! Form::open(['route' => 'permission.search', 'method' => 'POST']) !!}
                            @include('admin.includes.formsearch')
                        {!! Form::close() !!}
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                    @if(isset($dataForm['key_search']))
                        <div class="alert alert-info">
                            <p>
                                <a href="{{ route('permission.index') }}" style="text-decoration: none"><i class="fa fa-refresh"></i>&nbsp;</a>
                                <b>Resultados para:</b> {{ $dataForm['key_search'] }}
                            </p>
                        </div>
                    @endif()

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            @if(isset($dataForm))
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Grupos de usuário</th>
                            @else
                                <th><a href="{{Order::url('name')}}">Nome</a></th>
                                <th><a href="{{Order::url('description')}}">Descrição</a></th>
                                <th>Grupos de usuário</th>
                            @endif
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->name }}</th>
                                    <td>{{ $permission->description }}</th>
                                    <td>
                                        @forelse($permission->roles as $role)
                                        {{ $role->name }} <br/>
                                        @empty
                                        Nenhum
                                        @endforelse
                                    </td>
                                    <td class="text-center">
                                        {!! Form::open(['route' => ['permission.destroy', $permission->id], 'method' => 'DELETE', 'name' => 'form_del']) !!}
                                        <a href="{{ route('permission.edit', $permission->id) }}" class="btn btn-primary btn-xs" title="Editar registro"><i class="fa fa-pencil-square" aria-hidden="true"></i> Editar</a>
                                        <button type="submit" class="btn btn-xs btn-danger" title="Excluir registro" onclick="javascript: return confirm('Tem certeza que deseja excluir permissão?');">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i> Excluir
                                        </button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>                                
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center">Nenhuma permissão cadastrada!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="text-center">
                        @if(isset($dataForm))
                            {!! $permissions->appends($dataForm)->links()  !!}
                        @else
                            {!! $permissions->links()  !!}
                        @endif
                    </div>
                    
                </div><!-- /.box-body -->
                <div class="box-footer text-right">
                    <a href="{{ route('permission.index') }}" class="btn btn-default btn-sm" title="Voltar"><i class="fa fa-undo" aria-hidden="true"></i>  Voltar</a>
                </div>
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@stop