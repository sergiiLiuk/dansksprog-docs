<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    // Table name
    protected $table = 'documents';

    // Primary Key
    public $primaryKey = 'id';

    // Timestamps
    public $timestamps = true;

    public function admin(){
        return $this->belongsTo('App\Admin');
    }

   public function user(){
        return $this->belongsTo('App\User');
    }   
}
