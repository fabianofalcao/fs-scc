@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Usuários</h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index')}}">Home</a></li>
        <li>Usuários</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                @include('admin.includes.alerts')
                <div class="box-header">
                    <a href="{{ route('user.create') }}" class="btn bg-olive btn-sm" title="Adicionar registro"><i class="fa fa-plus-square" aria-hidden="true"></i> Adicionar</a>
                    <div class="box-tools">
                        {!! Form::open(['route' => 'user.search', 'method' => 'POST']) !!}
                            @include('admin.includes.formsearch')
                        {!! Form::close() !!}
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                    @if(isset($dataForm['key_search']))
                        <div class="alert alert-info">
                            <p>
                                <a href="{{ route('user.index') }}" style="text-decoration: none"><i class="fa fa-refresh"></i>&nbsp;</a>
                                <b>Resultados para:</b> {{ $dataForm['key_search'] }}
                            </p>
                        </div>
                    @endif()

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            @if(isset($dataForm))
                                <th>Nome / Razão social</th>
                                <th>E-mail</th>
                                <th>Grupos</th>
                            @else
                                <th><a href="{{Order::url('name')}}">Nome / Razão social</a></th>
                                <th><a href="{{Order::url('email')}}">E-mail</a></th>
                                <th>Grupos de usuário</th>
                            @endif
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</th>
                                    <td>{{ $user->email }}</th>
                                    <td>
                                        @forelse($user->roles as $role)
                                        {{ $role->name }}
                                        @empty
                                        Nenhum
                                        @endforelse
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('user.show', $user->id) }}" class="btn bg-purple btn-xs" title="Detalhar registro"><i class="fa fa-info-circle" aria-hidden="true"></i> Detalhar</a>
                                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary btn-xs" title="Editar registro"><i class="fa fa-pencil-square" aria-hidden="true"></i> Editar</a>
                                    </td>
                                </tr>                                
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center">Nenhum usuário cadastrado!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="text-center">
                        @if(isset($dataForm))
                            {!! $users->appends($dataForm)->links()  !!}
                        @else
                            {!! $users->links()  !!}
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