<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Marital_status;
use App\Http\Requests\Marital_statusStoreUpdateFormRequest;

class Marital_statusController extends Controller
{
    private $marital_status;
    private $totalPage = 10;
    private $get;

    public function __construct(Request $request, Marital_status $marital_status)
    {
        $this->marital_status = $marital_status;
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
        $by = $this->get->get('by', 'description');
        $marital_statuses = $this->marital_status->orderBy($by, $order)->paginate($this->totalPage);
        return view('admin.marital_status.index', compact('marital_statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.marital_status.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Marital_statusStoreUpdateFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = $this->marital_status->create($dataForm);
        if($insert)
            return redirect()->route('marital_status.index')->with('success', 'Cadastro realizado com sucesso!');
        else
            return redirect()->back()->with('error', 'Falha ao cadastrar');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $marital_status = $this->marital_status->find($id);
        if(!$marital_status)
            return redirect()->back()->with('error', 'Falha ao editar');
        return view('admin.marital_status.edit', compact('marital_status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Marital_statusStoreUpdateFormRequest $request, $id)
    {
        $marital_status = $this->marital_status->find($id);
        if(!$marital_status)
            return redirect()->back()->with('error', 'Falha ao editar');
        $update = $marital_status->update($request->all());    
        if($update)
            return redirect()->route('marital_status.index')->with('success', 'Cadastro atualizado com sucesso!');
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
        $marital_status = $this->marital_status->find($id);
        if(!$marital_status)
            return redirect()->back()->with('error', 'Falha ao excluir');
        if($marital_status->delete())
            return redirect()->route('marital_status.index')->with('success', 'Registro excluído com sucesso!');
        else
            return redirect()->back()->with('error', 'Erro ao excluir registro.');
    }

    public function search(Request $request)
    {
        $dataForm = $request->except('_token');

        $keySearch = $request->key_search;
        $order = $this->get->get('order', 'ASC');
        $by = $this->get->get('by', 'description');
        $marital_statuses = $this->marital_status
                    ->where('description', 'LIKE', "%{$keySearch}%")
                    ->orderBy($by, $order)
                    ->paginate($this->totalPage);


        return view('admin.marital_status.index', compact('marital_statuses', 'title', 'dataForm'));
    }
}
