<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nomina extends Model
{
    protected $guard = 'web_seller';

    function seller(){
    	return $this->belongsTo('App\Seller', 'seller_id');
    }

    protected $fillable = [
        'pdf', 'xml', 'fecha', 'id_sellers'
    ];
	protected $dates = ['deleted_at'];
    
	
    protected $table = 'nominas';
}
