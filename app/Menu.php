<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;
    
    protected $table = 'menus';
    
    protected $fillable=[
        'title',
        'type',
        'parent_id',
        'position',
        'status',
        'internal_url',
        'external_url',
        'icon',
        'ordering',
        'level',
        'created_by',
        'updated_by',
        'content'
    ];
    
    protected $nullable = [
        'parent_id',
        'updated_by',
        'internal_url',
        'external_url',
        'icon'
    ];
    
    public function createdBy()
    {
        return $this->belongsTo('App\User', 'created_by');
    }
    
    public function updatedBy()
    {
        return $this->belongsTo('App\User', 'updated_by');
    }
    
    public function menuTranslation(){
        return $this->hasMany('App\MenuTranslation', 'menu_id');
    }
    
    public function translation($language=null){
        if ($language == null) {
           $language = App::getLocale();
        }
        return $this->hasMany('App\MenuTranslation')->where('language_id', '=', $language);
    }
    
    public function menu(){
        return $this->belongsTo('App\Menu', 'parent_id');
    }
    
    public function sidebar_menus(){
        return $this->hasMany('App\Menu','parent_id')
                    ->where('status',1)
                    ->where('position',0)
                    ->whereNull('deleted_at')
                    ->orderBy('ordering');
    }
    
    public function menus(){
        return $this->hasMany('App\Menu','parent_id')
                    ->where('status',1)
                    ->whereNull('deleted_at')
                    ->orderBy('ordering');
    }
    
    public function category(){
        return $this->belongsTo('App\Category','internal_url');
    }
    
    protected $dates = ['deleted_at'];
}
