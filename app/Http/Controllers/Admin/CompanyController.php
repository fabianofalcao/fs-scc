<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Http\Requests\CompanyStoreUpdateFormRequest;

class CompanyController extends Controller
{
    private $company;
    private $totalPage = 10;
    private $get;

    public function __construct(Request $request, Company $company)
    {
        $this->company = $company;
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
        $companies = $this->company->orderBy($by, $order)->paginate($this->totalPage);
        return view('admin.company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.company.create', compact('company'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyStoreUpdateFormRequest $request)
    {
        if($this->company->newCompany($request))
            return redirect()->route('company.index')->with('success', 'Cadastro realizado com sucesso!');
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
        $company = $this->company->find($id);
        if(!$company)
            return redirect()->back()->with('error', 'Falha ao detalhar');
        
        return view('admin.company.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = $this->company->find($id);
        $sexos = ['' => 'Selecione o sexo', 'Feminino' => 'Feminino', 'Masculino' => 'Masculino'];
        if(!$company)        
            return redirect()->back();
        return view('admin.company.edit', compact('company', 'sexos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyStoreUpdateFormRequest $request, $id)
    {
        $company = $this->company->find($id);
        if(!$company)
            return redirect()->back();
        if($company->updateCompany($request))
            return redirect()->route('company.index')->with('success', 'Cadastro editado com sucesso!');
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
        $company = $this->company->find($id);
        if(!$company)
            return redirect()->back()->with('error', 'Falha ao excluir.');
        if($company->delete())
            return redirect()->route('company.index')->with('success', 'Usuário excluído com sucesso!');
        else
            return redirect()->back()->with('error', 'Falha ao excluir.');
    }

    public function search(Request $request)
    {
        $dataForm = $request->except('_token');
        
        $companies = $this->company->search($request, $this->totalPage);
        
        return view('admin.company.index', compact('companies', 'dataForm'));
    }
}
