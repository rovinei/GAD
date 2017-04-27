<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SliderTranslation extends Model
{
    protected $table = "slider_translations";
    
    protected $fillable = [
        "slider_id",
        "language_id",
        "title",
        'description'
    ];
    
    public $timestamps = false;
    
    public function slider(){
        return $this->belongsTo("App\Slider",'slider_id');
    }
}
