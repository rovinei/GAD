<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentTranslation extends Model
{
    protected $table = 'content_translations';
    
    /*protected $primaryKey = ['content_id', 'language_id'];*/
    
    protected $fillable = [
        'content_id',
        'language_id',
        'title',
        'content',
        'images'
    ];
    
    public $timestamps = false;
    
    public function content(){
        return $this->belongsTo('App\Content', 'content_id');
    }
    
}
