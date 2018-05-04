<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use App\Permission;
use App\Http\Requests\RoleStoreUpdateFormRequest;

class RoleController extends Controller
{
    private $role;
    
    public function __construct(Role $role)
    {
        $this->role = $role;
        
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->role->orderBy('name', 'ASC')->get();
        return view('admin.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleStoreUpdateFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = $this->role->create($dataForm);
        if($insert)
            return redirect()->route('role.index')->with('success', 'Cadastro realizado com sucesso!');
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
        $role = $this->role->find($id);
        
        if(!$role || $role->name == 'Administrador')        
            return redirect()->back()->with('error', 'Você não tem permissão para editar o grupo de usuários Administrador');;
        return view('admin.role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleStoreUpdateFormRequest $request, $id)
    {
        $role = $this->role->find($id);
        if(!$role || $role->name == 'Administrador')
            return redirect()->back()->with('error', 'Falha ao editar!');
        $update = $role->update($request->all());    
        if($update)
            return redirect()->route('role.index')->with('success', 'Cadastro atualizado com sucesso!');
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
        $role = $this->role->find($id);
        if(!$role || $role->name == 'Administrador')
            return redirect()->back()->with('error', 'Falha ao excluir!');
        if($role->delete())
            return redirect()->route('role.index')->with('success', 'Registro excluído com sucesso!');
        else
            return redirect()->back()->with('error', 'Erro ao excluir registro.');
    }

    public function permissions($id)
    {
        $role = $this->role->with('permissions')->find($id);
        $permissions = Permission::all();
        $permission_role = [];
        foreach($role->permissions as $permission){
            array_push($permission_role,$permission->id);
        }
        return view('admin.role.permission', compact('role', 'permissions', 'permission_role'));
    }

    public function permissionsStore(Request $request, $id)
    {
        $role = $this->role->find($id);
        $dataForm = $request->all();
        $permission = Permission::find($dataForm['permission_id']);
        if ($role->newPermission($permission))
            return redirect()->route('role.permission')->with('success', 'Registro incluído com sucesso!');
        else
            return redirect()->back()->with('error', 'Erro ao incluir registro.');
    }

    public function permissionsDestroy($id, $permission_id)
    {
        $role = $this->role->find($id);
        $permission = Permission::find($permission_id);
        if ($role->delPermission($permission))
            return redirect()->route('role.permission')->with('success', 'Registro excluído com sucesso!');
        else
            return redirect()->back()->with('error', 'Erro ao excluir registro.');
    }
}
