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
    public function store(Request $request, User $user)
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
