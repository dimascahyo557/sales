<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /*
     | =================================================================
     | Relations
     | =================================================================
     */

    /**
     * Belongs to category
     */
     public function category()
     {
         return $this->belongsTo('App\Models\Category');
     }

    /*
     | =================================================================
     | Getter
     | =================================================================
     */

     /**
      * Get Price
      * 
      * @param Int $price
      * @return String
      */
     public function getPriceAttribute($price)
     {
         return "Rp " . number_format($price, 2, ',', '.');
     }

     /**
      * Get SKU
      * 
      * @param String $price
      * @return String
      */
     public function getSkuAttribute($sku)
     {
         return strtoupper($sku);
     }

     /**
      * Get Status
      * 
      * @param Boolean $price
      * @return String
      */
     public function getStatusAttribute($status)
     {
         return $status ? 'Active' : 'Inactive';
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
 
          return $query->where('name', 'like', $keyword)
                    ->orWhere('price', 'like', $keyword)
                    ->orWhere('sku', 'like', $keyword);
      }
}
