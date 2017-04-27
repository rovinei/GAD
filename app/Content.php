<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model
{
    use SoftDeletes;
    // 1. SPECIFY THE TABLE NAME FOR STORING DATA Of Content Model
    protected $table = 'contents';
    
    protected $fillable = [
        'title',
        'content',
        'created_by',
        'updated_by',
        'images',
        'status',
        'category_id',
        'thumb_images',
        'show_home_page'
    ];
    
    /*public function getCreatedAtAttribute()
    {
        return $this->attributes['created_at']->format('m/d/Y');
    }*/
    
    public function createdBy(){
        return $this->belongsTo('App\User', 'created_by');
    }
    
    public function updatedBy(){
        return $this->belongsTo('App\User', 'updated_by');
    }
    
    public function category(){
        return $this->belongsTo('App\Category', 'category_id');
    }
    
    public function contentTranslation(){
        return $this->hasMany('App\ContentTranslation', 'content_id');
    }
    
    public function translation($language=null){
        if ($language == null) {
           $language = App::getLocale();
        }
        return $this->hasMany('App\ContentTranslation')->where('language_id', '=', $language);
    }
    
    public function translationCount(){
        return $this->hasMany('App\ContentTranslation');
    }
    
    protected $dates = ['deleted_at'];
    
}
