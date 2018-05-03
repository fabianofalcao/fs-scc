<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Http\Requests\UserStoreUpdateFormRequest;

class UserController extends Controller
{
    private $user;
    private $role;
    private $totalPage = 10;
    private $get;

    public function __construct(Request $request, User $user, Role $role)
    {
        $this->user = $user;
        $this->get = $request;
        $this->role = $role;
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
        $users = $this->user->with('roles')->orderBy($by, $order)->paginate($this->totalPage);
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $sexos = ['' => 'Selecione o sexo', 'Feminino' => 'Feminino', 'Masculino' => 'Masculino'];
        $roles = $this->role->orderBy('name', 'ASC')->get();
        return view('admin.user.create', compact('sexos', 'user', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreUpdateFormRequest $request)
    {
        if($this->user->newUser($request))
            return redirect()->route('user.index')->with('success', 'Cadastro realizado com sucesso!');
        else
            return redirect()->back()->with('error', 'Falha ao cadastrar.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->user->with(['person_physical', 'person_type'])->find($id);
        if(!$user)
            return redirect()->back()->with('error', 'Falha ao detalhar');
        
        return view('admin.user.show', compact('user'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->user->with(['person_physical', 'person_type', 'roles'])->find($id);
        $sexos = ['' => 'Selecione o sexo', 'Feminino' => 'Feminino', 'Masculino' => 'Masculino'];
        $roles = $this->role->orderBy('name', 'ASC')->get();
        $role_user = [];
        foreach($user->roles as $role){
            array_push($role_user,$role->id);
        }
        if(!$user)        
            return redirect()->back();
        return view('admin.user.edit', compact('user', 'sexos', 'roles', 'role_user'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserStoreUpdateFormRequest $request, $id)
    {
        $user = $this->user->with(['person_physical', 'person_type'])->find($id);
        if(!$user)
            return redirect()->back();
        if($user->updateUser($request, $user->id))
            return redirect()->route('user.index')->with('success', 'Cadastro editado com sucesso!');
        else
            return redirect()->back()->with('error', 'Falha ao editar!')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->user->find($id);
        if(!$user)
            return redirect()->back()->with('error', 'Falha ao excluir.');
        if($user->delete())
            return redirect()->route('user.index')->with('success', 'Usuário excluído com sucesso!');
        else
            return redirect()->back()->with('error', 'Falha ao excluir.');
    }

    public function search(Request $request)
    {
        $dataForm = $request->except('_token');
        
        $users = $this->user->search($request, $this->totalPage);
        
        return view('admin.user.index', compact('users', 'dataForm'));
    }
}
