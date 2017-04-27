<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $table = 'categories';
    
    protected $fillable = [
            'title',
            'description',
            'parent_id',
            'created_by',
            'updated_by',
            'ordering',
            'image',
            'thumb_image',
            'status',
            'level'
        ];
    
    public function createdBy(){
        return $this->belongsTo('App\User', 'created_by');
    }
    
    public function updatedBy(){
        return $this->belongsTo('App\User', 'updated_by');
    }
    
    public function categoryTranslation(){
        return $this->hasMany('App\CategoryTranslation','category_id');
    }
    
    public function contents(){
        return $this->hasMany('App\Content');
    }
    
    public function translation($language=null){
        if ($language == null) {
           $language = App::getLocale();
        }
        return $this->hasMany('App\CategoryTranslation')->where('language_id', '=', $language);
    }
    
    public function parentCategory(){
        return $this->belongsTo('App\Category', 'parent_id')->where('status',1);
    }
    
    public function categories(){
        return $this->hasMany('App\Category','parent_id')->where('status',1);
    }
    
    protected $dates = ['deleted_at'];
}
