<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laraerp\Ordination\OrdinationTrait;

class Marital_status extends Model
{
    use OrdinationTrait;

    protected $fillable = ['description'];

    public function search($request, $totalPage = 5)
    {
        
        $keySearch = $request->key_search;
        return $this->where('description', 'LIKE', "%{$keySearch}%")
                    ->paginate($totalPage);
    }
}
