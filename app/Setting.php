<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'settings';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_name',
        'company_name_kh',
        'company_name_ch',
        'company_logo', 
        'copyright', 
        'copyright_kh',
        'copyright_ch',
        'company_information_kh',
        'company_information',
        'company_information_ch',
        'meta_title',
        'meta_content',
        'meta_description',
        'meta_keyword',
        'status'
    ];
    
    public function createdBy()
    {
        return $this->belongsTo('App\User', 'created_by');
    }
    
    public function updatedBy()
    {
        return $this->belongsTo('App\User', 'updated_by');
    }
    
    public function translationCompanyName($language=null){
        if ($language == null) {
           $language = App::getLocale();
        }
        if($language=='kh'){
            return $this->getAttribute('company_name_kh');
        }elseif($language=='ch'){
            return $this->getAttribute('company_name_ch');
        }else{
            return $this->getAttribute('company_name');
        }
    }
    
    public function translationCopyright($language=null){
        if ($language == null) {
           $language = App::getLocale();
        }
        if($language=='kh'){
            return $this->getAttribute('copyright_kh');
        }elseif($language=='ch'){
            return $this->getAttribute('copyright_ch');
        }else{
            return $this->getAttribute('copyright');
        }
    }
    
    public function translationCompanyInformation($language=null){
        if ($language == null) {
           $language = App::getLocale();
        }
        if($language=='kh'){
            return $this->getAttribute('company_information_kh');
        }elseif($language=='ch'){
            return $this->getAttribute('company_information_ch');
        }else{
            return $this->getAttribute('company_information');
        }
    }
}
