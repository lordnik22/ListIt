<?php

namespace ListIt;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class Receipt extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;
    
    protected $table = 'receipt';

    protected $primaryKey = 'ID';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Datum', 'UserID', 'CompanyShoplocationID',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    public $timestamps = false;
    
    /**
     * Get the comments for the blog post.
     */
    /*public function products()
    {
        return $this->belongsToMany('ListIt\Product', 'receipt_product', 'ReceiptID', 'ProductID');
    }*/
    public function receipt_products()
    {
        return $this->hasMany('ListIt\Receipt_Product', 'ReceiptID');
    }
    
    public function company_shoplocation()
    {
        return $this->belongsTo('ListIt\Company_Shoplocation', 'CompanyShoplocationID');
    }
    
}
