<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Associated;
use App\User;
use App\Role;
use App\Models\Dependent;
use App\Models\Marital_status;
use App\Models\Bank;
use App\Http\Requests\AssociatedStoreUpdateFormRequest;

class AssociatedController extends Controller
{
    private $associated;
    private $user;
    private $totalPage = 10;
    private $get;

    public function __construct(Request $request, Associated $associated, User $user)
    {
        $this->user = $user;
        $this->associated = $associated;
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
        $associateds = $this->associated->with(['user', 'person_physical'])->paginate($this->totalPage);
        //dd($associateds);
        return view('admin.associated.index', compact('associateds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sexos = ['' => 'Selecione o sexo', 'Feminino' => 'Feminino', 'Masculino' => 'Masculino'];
        $marital_statuses = Marital_status::pluck('description', 'id');
        $marital_statuses->prepend('Selecione o estado civil...', '');
        $statuses = ['' => 'Selecione o status...', 'Ativo' => 'Ativo', 'Inativo' => 'Inativo', 'Suspenso' => 'Suspenso', 'Outro' => 'Outro'];
        $banks = Bank::pluck('name', 'id');
        $banks->prepend('Selecione o banco...', '');
        $role = Role::where('name', '=', 'Associado')->get()->first();
        $types_account = ['' => 'Selecione o tipo de conta', 'Conta corrente' => 'Conta corrente', 'Poupança' => 'Poupança', 'Outro' => 'Outro'];
        
        return view('admin.associated.create', compact('sexos', 'marital_statuses', 'statuses', 'banks', 'types_account', 'role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssociatedStoreUpdateFormRequest $request, User $user)
    {
        if($this->associated->newAssociated($request, $user))
            return redirect()->route('associated.index')->with('success', 'Cadastro realizado com sucesso!');
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
        $associated = $this->associated->with(['user', 'person_physical','bank', 'marital_status'])->find($id);
        //dd($associated);
        if(!$associated)
            return redirect()->back();
        
        return view('admin.associated.show', compact('associated'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $associated = $this->associated->with(['user', 'person_physical'])->find($id);
        if(!$associated)
        return redirect()->back();
        $sexos = ['' => 'Selecione o sexo', 'Feminino' => 'Feminino', 'Masculino' => 'Masculino'];
        $marital_statuses = Marital_status::pluck('description', 'id');
        $marital_statuses->prepend('Selecione o estado civil...', '');
        $statuses = ['' => 'Selecione o status...', 'Ativo' => 'Ativo', 'Inativo' => 'Inativo', 'Suspenso' => 'Suspenso', 'Outro' => 'Outro'];
        $banks = Bank::pluck('name', 'id');
        $banks->prepend('Selecione o banco...', '');
        $types_account = ['' => 'Selecione o tipo de conta', 'Conta corrente' => 'Conta corrente', 'Poupança' => 'Poupança', 'Outro' => 'Outro'];
        return view('admin.associated.edit', compact('associated', 'statuses', 'sexos', 'marital_statuses', 'banks', 'types_account'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AssociatedStoreUpdateFormRequest $request, $id)
    {
        $associated = $this->associated->with(['person_physical', 'user'])->find($id);
        if($associated->updateAssociated($request, $id))
            return redirect()->route('associated.index')->with('success', 'Cadastro atualizado com sucesso!');
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
        //
    }


    public function search(Request $request)
    {
        $dataForm = $request->except('_token');
        
        $associateds = $this->associated->search($request, $this->totalPage);
        //dd($partners);
        return view('admin.associated.index', compact('associateds', 'dataForm'));
    }
}
