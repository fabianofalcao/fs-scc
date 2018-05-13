<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Http\Requests\BankStoreUpdateFormRequest;

class BankController extends Controller
{
    private $bank;
    private $totalPage = 10;
    private $get;

    public function __construct(Request $request, Bank $bank)
    {
        $this->bank = $bank;
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
        $banks = $this->bank->orderBy($by, $order)->paginate($this->totalPage);
        return view('admin.bank.index', compact('banks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.bank.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BankStoreUpdateFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = $this->bank->create($dataForm);
        if($insert)
            return redirect()->route('bank.index')->with('success', 'Cadastro realizado com sucesso!');
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
        $bank = $this->bank->find($id);
        if(!$bank)
            return redirect()->back()->with('error', 'Falha ao editar');
        return view('admin.bank.edit', compact('bank'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BankStoreUpdateFormRequest $request, $id)
    {
        $bank = $this->bank->find($id);
        if(!$bank)
            return redirect()->back()->with('error', 'Falha ao editar');
        $update = $bank->update($request->all());    
        if($update)
            return redirect()->route('bank.index')->with('success', 'Cadastro atualizado com sucesso!');
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
        $bank = $this->bank->find($id);
        if(!$bank)
            return redirect()->back()->with('error', 'Falha ao excluir');
        if($bank->delete())
            return redirect()->route('bank.index')->with('success', 'Registro excluído com sucesso!');
        else
            return redirect()->back()->with('error', 'Erro ao excluir registro.');
    }

    public function search(Request $request)
    {
        $dataForm = $request->except('_token');

        $keySearch = $request->key_search;
        $order = $this->get->get('order', 'ASC');
        $by = $this->get->get('by', 'name');
        $banks = $this->bank
                    ->where('name', 'LIKE', "%{$keySearch}%")
                    ->orderBy($by, $order)
                    ->paginate($this->totalPage);

        return view('admin.bank.index', compact('banks', 'title', 'dataForm'));
    }
}
