<?php

namespace ListIt;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class Shoplocation extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;
    
    protected $table = 'shoplocation';

    protected $primaryKey = 'ID';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'RegionID', 'StreetID', 'StreetNr',
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
    
    public function region()
    {
        return $this->belongsTo('ListIt\Region', 'RegionID');
    }
    
    public function street()
    {
        return $this->belongsTo('ListIt\Street', 'StreetID');
    }
    
    
}
