<?php
$this->group(['middleware' => ['auth'], 'namespace' => 'Admin', 'prefix' => 'admin'], function (){
    $this->get('/', 'AdminController@index')->name('admin.index');
    
    $this->any('person_types/search', 'Person_typeController@search')->name('person_types.search');
    $this->resource('person_types', 'Person_typeController');
});
   

$this->get('/', 'Site\SiteController@index')->name('site.index');

Auth::routes();


