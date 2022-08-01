<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empreendimento;

class EmpreendimentoController extends Controller
{
    //Lista todos os empreendimentos
    public function index(){
        $empreendimentos = Empreendimento::all();
        return response()->json($empreendimentos);
    }

    //Insere um novo empreendimento
    public function store(Request $request){
        $res = 'Sucesso ao cadastrar um novo empreendimento';

        $empreendimento = new Empreendimento;

        //pegando dados da requisição
        $nome = addslashes($request->nome);
        $localizacao = addslashes($request->localizacao);
        $prazo = addslashes($request->prazo);

        if(!$nome || !$localizacao || !$prazo){
            $res = 'Preencha todos os campos';
            return response()->json($res);
        }

        $empreendimento->nome = $nome;
        $empreendimento->localizacao = $localizacao;
        $empreendimento->entrega_previsao = $prazo;

        //salvando os dados via model
        $empreendimento->save();


        return response()->json($res);
    }

    //busca um empreendimento específico
    public function show($id){

        //busca o empreendimento no banco
        $empreendimento = Empreendimento::find($id);

        $empreendimento['unidades']  = $empreendimento->unidades;

        //verifica se o empreendimento existe
        if(!$empreendimento)
            return response()->json(json_encode('Empreendimento inexistente'));

        //envia os dados do empreendimento
        return response()->json($empreendimento);
    }

    //atualiza os dados de um empreendimento
    public function update(Request $request){

        //pegando dados da requisição
        $nome = addslashes($request->nome);
        $localizacao = addslashes($request->localizacao);
        $prazo = addslashes($request->prazo);
        $id = addslashes($request->id);

        //verificando se todos os dados foram enviados
        if(!$nome || !$localizacao || !$prazo || !$id){
            $res = 'Preencha todos os campos';
            return response()->json($res);
        }

        //buscando o empreendimento no banco
        $empreendimento = Empreendimento::find($id);

        //verificando se o empreendimento existe
        if(!$empreendimento)
            return response()->json('Empreendimento não encontrado');

        //atualizando os ddados
        $empreendimento->nome = $nome;
        $empreendimento->localizacao = $localizacao;
        $empreendimento->entrega_previsao = $prazo;

        //salvando
        $empreendimento->save();


        return response()->json(json_encode('Empreendimento atualizado com sucesso!'));


    }

    //deleta o empreendimento
    public function delete($id){

        //busca o empreendimento no banco
        Empreendimento::find($id)->delete();

        return response()->json('Empreendimento deletado com sucesso!');
    }

    public function listMyUnidades(Request $request){

        $search = addslashes($request->query('search'));

        $id = addslashes($request->id);

        if(!$id)
            return response()->json('Algum erro indesperado aconteceu');

        if($search){
            $unidades = Empreendimento::find($id)->unidades()->where('nome','like','%'.$search.'%')->get();
            return response()->json($unidades);
        }

         $empreendimento = Empreendimento::find($id);

        if(!$empreendimento){
            return response()->json('Empreendimento não encontrado');
        }


        return response()->json($empreendimento->unidades);
    }

}
