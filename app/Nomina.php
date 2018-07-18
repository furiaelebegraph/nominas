<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Laravel\Scout\Searchable;

class Nomina extends Model
{
    protected $guard = 'web_seller';

    use Searchable;

    public function searchableAs()
    {
        return 'fecha';
    }

    function seller(){
    	return $this->belongsTo(Seller::class, 'seller_id', 'id');
    }

    protected $fillable = [
        'pdf', 'xml', 'fecha', 'seller_id'
    ];
	protected $dates = ['deleted_at'];
    
	
    protected $table = 'nominas';
}
