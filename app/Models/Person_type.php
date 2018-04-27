<?php

namespace App\Models;
use Laraerp\Ordination\OrdinationTrait;

use Illuminate\Database\Eloquent\Model;

class Person_type extends Model
{
    use OrdinationTrait;

    public $timestamps = false;

    protected $fillable = ['description'];

    public function search($request, $totalPage = 5)
    {
        
        $keySearch = $request->key_search;
        return $this->where('description', 'LIKE', "%{$keySearch}%")
                    ->paginate($totalPage);
    }

}
