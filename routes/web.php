<?php
$this->group(['middleware' => ['auth'], 'namespace' => 'Admin', 'prefix' => 'admin'], function (){
    $this->get('/', 'AdminController@index')->name('admin.index');
    
    $this->any('person_types/search', 'Person_typeController@search')->name('person_types.search');
    $this->resource('person_types', 'Person_typeController');

    $this->any('marital_status/search', 'Marital_statusController@search')->name('marital_status.search');
    $this->resource('marital_status', 'Marital_statusController');

    $this->any('banks/search', 'BankController@search')->name('bank.search');
    $this->resource('bank', 'BankController');

    $this->any('user/search', 'UserController@search')->name('user.search');
    $this->resource('user', 'UserController');

    $this->any('company/search', 'UserCompany@search')->name('company.search');
    $this->resource('company', 'CompanyController');

});
   

$this->get('/', 'Site\SiteController@index')->name('site.index');

Auth::routes();


