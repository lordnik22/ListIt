<?php

namespace ListIt;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class Company_Shoplocation extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;
    
    protected $table = 'company_shoplocation';

    protected $primaryKey = 'ID';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'CompanyID', 'ShoplocationID',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
    
    public $timestamps = false;
    
    public function company()
    {
        return $this->belongsTo('ListIt\Company', 'CompanyID');
    }
    
    public function shoplocation()
    {
        return $this->belongsTo('ListIt\Shoplocation', 'ShoplocationID');
    }
}
