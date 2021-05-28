<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category'
    ];

    /*
     | =================================================================
     | Relations
     | =================================================================
     */

     /**
      * Has many product
      */
    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    /*
     | =================================================================
     | Scope Model
     | =================================================================
     */

     /**
      * Search data with like condition
      * 
      * @param \Illuminate\Database\Eloquent\Builder $query
      * @param String|null $keyword
      */
     public function scopeSearch($query, String $keyword = null)
     {
         $keyword = "%{$keyword}%";

         return $query->where('category', 'like', $keyword);
     }
}
