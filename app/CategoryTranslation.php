<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    protected $table = 'category_translations';
    
    protected $fillable = [
        'title',
        'description',
        'category_id',
        'language_id'
    ];
    
    public $timestamps = false;
    
    public function category(){
        return $this->belongsTo('App\Category','category_id');
    }
}
