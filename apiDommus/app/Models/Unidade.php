<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    protected $fillable = [
        'nome_unidade',
        'bloco',
        'valor_unidade',
        'status_unidade',
    ];

    public $timestamps = false;


    public function empreendimento(){
        return $this->belongsTo(Empreendimento::class,'id_empreendimento','id');
    }
}
