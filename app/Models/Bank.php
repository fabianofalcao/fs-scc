<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laraerp\Ordination\OrdinationTrait;

class Bank extends Model
{
    use OrdinationTrait;

    protected $fillable = ['number', 'name'];

    public function search($request, $totalPage = 5)
    {
        
        $keySearch = $request->key_search;
        return $this->where('name', 'LIKE', "%{$keySearch}%")
                    ->paginate($totalPage);
    }
}
