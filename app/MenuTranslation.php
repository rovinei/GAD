<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuTranslation extends Model
{
    protected $table = "menu_translations";
    
    protected $fillable = [
        "menu_id",
        "language_id",
        "title",
        "content"
    ];
    
    public $timestamps = false;
    
    public function menu(){
        return $this->belongsTo("App\Menu",'menu_id');
    }
}
