<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Models\Partner;

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
    public function store(Request $request, User $user)
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
