<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = "users";

    protected $fillable = [
        'nome','email','cpf','data_nascimento','senha',
    ];

    public static function boot()
    {
        parent::boot();

        self::saving(function($model){
            $model->cpf = str_replace('.','',str_replace('-','',$model->cpf));
            $model->data_nascimento = implode('-',array_reverse(explode('/', $model->data_nascimento)));
            
            return $model;
        });

    }    
    
}
