<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    //
    protected $table = 'languages';
    
    public function createdBy(){
        return $this->belongsTo('App\User', 'created_by');
    }
    
    public function updatedBy(){
        return $this->belongsTo('App\User', 'created_by');
    }
}
