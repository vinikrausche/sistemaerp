<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Models\Unidade;

class Empreendimento extends Model
{
    protected $fillable = [
        'nome',
        'localizacao',
        'entrega_previsao',
    ];

    public $timestamps = false;


    public function unidades(){
        return $this->hasMany(Unidade::class,'id_empreendimento','id');
    }

}
