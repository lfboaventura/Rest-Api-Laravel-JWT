<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'status', 'due', 'url', 'user_id'
    ];

    protected $hidden = [
        
    ];

    protected $dates = [
        'created_at', 'updated_at',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function arrayStatus($status = null){
        $opStatus = [
            'Paga'      => 'Paga',
            'Aberta'    => 'Aberta',
            'Atrasada'  => 'Atrasada',
        ];

        if (!$status){
            return $opStatus;
        }

        return $opStatus[$status];
    }

}
