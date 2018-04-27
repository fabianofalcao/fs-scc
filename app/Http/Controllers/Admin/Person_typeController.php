<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Person_type;

class Person_typeController extends Controller
{
    private $person_type;
    private $totalPage = 10;
    private $get;

    public function __construct(Request $request, Person_type $person_type)
    {
        $this->person_type = $person_type;
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
        $person_types = $this->person_type->orderBy($by, $order)->paginate($this->totalPage);
        return view('admin.person_type.index', compact('person_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.person_type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataForm = $request->all();
        $insert = $this->person_type->create($dataForm);
        if($insert)
            return redirect()->route('person_types.index')->with('success', 'Cadastro realizado com sucesso!');
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
        $person_type = $this->person_type->find($id);
        if(!$person_type)
            return redirect()->back()->with('error', 'Falha ao editar');
        return view('admin.person_type.edit', compact('person_type'));       
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
        $person_type = $this->person_type->find($id);
        if(!$person_type)
            return redirect()->back()->with('error', 'Falha ao editar');
        $update = $person_type->update($request->all());    
        if($update)
            return redirect()->route('person_types.index')->with('success', 'Cadastro atualizado com sucesso!');
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
        $person_type = $this->person_type->find($id);
        if(!$person_type)
            return redirect()->back()->with('error', 'Falha ao excluir');
        if($person_type->delete())
            return redirect()->route('person_types.index')->with('success', 'Registro excluído com sucesso!');
        else
            return redirect()->back()->with('error', 'Erro ao excluir registro.');
    }

    public function search(Request $request)
    {
        $dataForm = $request->except('_token');

        //$person_types = $this->person_type->search($request, $this->totalPage);

        $keySearch = $request->key_search;
        $order = $this->get->get('order', 'ASC');
        $by = $this->get->get('by', 'description');
        $person_types = $this->person_type
                    ->where('description', 'LIKE', "%{$keySearch}%")
                    ->orderBy($by, $order)
                    ->paginate($this->totalPage);


        return view('admin.person_type.index', compact('person_types', 'title', 'dataForm'));
    }
}
