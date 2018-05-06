<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Permission;
use App\Role;
use App\Http\Requests\PermissionStoreUpdateFormRequest;

class PermissionController extends Controller
{
    private $permission;
    private $totalPage = 10;
    private $get;
    
    public function __construct(Request $request, Permission $permission)
    {
        $this->permission = $permission;
        $this->get = $request;        
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = $this->get->get('order', 'ASC');
        $by = $this->get->get('by', 'name');
        $permissions = $this->permission->with('roles')->orderBy($by, $order)->paginate($this->totalPage);
        return view('admin.permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionStoreUpdateFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = $this->permission->create($dataForm);
        if($insert)
            return redirect()->route('permission.index')->with('success', 'Cadastro realizado com sucesso!');
        else
            return redirect()->back()->with('error', 'Falha ao cadastrar');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = $this->permission->find($id);
        return view('admin.permission.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionStoreUpdateFormRequest $request, $id)
    {
        $permission = $this->permission->find($id);
        if(!$permission)
            return redirect()->back()->with('error', 'Falha ao editar!');
        $update = $permission->update($request->all());    
        if($update)
            return redirect()->route('permission.index')->with('success', 'Cadastro atualizado com sucesso!');
        else
            return redirect()->back()->with('error', 'Falha ao atualizar.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = $this->permission->find($id);
        if(!$permission)
            return redirect()->back()->with('error', 'Falha ao excluir.');
        if($permission->delete())
            return redirect()->route('permission.index')->with('success', 'Permissão excluída com sucesso!');
        else
            return redirect()->back()->with('error', 'Falha ao excluir.');
    }

    public function search(Request $request)
    {
        $dataForm = $request->except('_token');
        
        $permissions = $this->permission->search($request, $this->totalPage);
        
        return view('admin.permission.index', compact('permissions', 'dataForm'));
    }
}
