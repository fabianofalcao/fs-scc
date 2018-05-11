<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Models\Partner;
use App\Http\Requests\PartnerStoreUpdateFormRequest;

class PartnerController extends Controller
{
    private $partner;
    private $totalPage = 10;
    private $get;

    public function __construct(Request $request, Partner $partner, User $user)
    {
        $this->user = $user;
        $this->get = $request;
        $this->partner = $partner;
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
        $partners = $this->user->where('person_type_id', '=', 2)->with(['partner', 'person_legal'])->orderBy($by, $order)->paginate($this->totalPage);
        //dd($partners[0]->person_legal->cnpj);
        return view('admin.partner.index', compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = ['' => 'Selecione o status', 'Ativo' => 'Ativo', 'Inativo' => 'Inativo', 'Suspenso' => 'Suspenso', 'Outro' => 'Outro'];
        $role = Role::where('name', '=', 'Parceiro')->get()->first();
        return view('admin.partner.create', compact('statuses', 'role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PartnerStoreUpdateFormRequest $request, User $user)
    {
        if($this->partner->newPartner($request, $user))
            return redirect()->route('partner.index')->with('success', 'Cadastro realizado com sucesso!');
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
        $partner = $this->partner->with(['user', 'person_legal'])->find($id);
        if(!$partner)
            return redirect()->back();
        
        return view('admin.partner.show', compact('partner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $partner = $this->partner->with(['user', 'person_legal'])->find($id);
        if(!$partner)
            return redirect()->back();
        $statuses = ['' => 'Selecione o status', 'Ativo' => 'Ativo', 'Inativo' => 'Inativo', 'Suspenso' => 'Suspenso', 'Outro' => 'Outro'];
        return view('admin.partner.edit', compact('partner', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PartnerStoreUpdateFormRequest $request, $id)
    {
        $partner = $this->partner->with(['person_legal', 'user'])->find($id);
        if($partner->updPartner($request, $id))
            return redirect()->route('partner.index')->with('success', 'Cadastro atualizado com sucesso!');
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
        $partner = $this->partner->find($id);
        if(!$partner)
            return redirect()->back()->with('error', 'Falha ao excluir.');
        if($partner->delete())
            return redirect()->route('partner.index')->with('success', 'Parceiro excluído com sucesso!');
        else
            return redirect()->back()->with('error', 'Falha ao excluir.');
    }

    public function search(Request $request)
    {
        $dataForm = $request->except('_token');
        
        $partners = $this->partner->search($request, $this->totalPage);
        //dd($partners);
        return view('admin.partner.search', compact('partners', 'dataForm'));
    }
}
