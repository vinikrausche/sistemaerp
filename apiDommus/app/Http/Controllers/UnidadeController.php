<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unidade;

class UnidadeController extends Controller
{
    //lista todas as unidades
    public function index(){
            $unidades = Unidade::all();

            return response()->json($unidades);
    }

    //insere uma nova unidade
    public function store(Request $request){

        $res = 'Sucesso ao cadastrar uma nova unidade';

        //pegando os dados da requisição
        $nome = addslashes($request->nome);
        $bloco = addslashes($request->bloco);
        $status = addslashes($request->status);
        $valor = addslashes($request->valor);
        $id_empreendimento = addslashes($request->id_empreendimento);

        //verificando se os dados foram encaminhados
        if(!$nome || !$bloco || !$status || !$id_empreendimento){
            $res = 'Preencha todos os campos';
            return response()->json(json_encode($res));
        }

        //verificando se o valor de status está dentro dos padrões
        if($status !== 'disponivel' && $status !== 'vendida' && $status !== 'reservada'){
            $res = 'O valor de status só pode ser: disponivel, vendida ou reservada';
            return response()->json($res);
        }

        $unidade = new Unidade;
        $unidade->nome = $nome;
        $unidade->bloco = $bloco;
        $unidade->valor = $valor;
        $unidade->status = $status;
        $unidade->id_empreendimento = $id_empreendimento;

        //salvando
        $unidade->save();

        return response()->json($res);
    }

    //mostra uma unidade específica
    public function show($id){

        //procurando a unidade no banco
        $unidade = Unidade::find($id);

        //verificando se a unidade existe
        if(!$unidade)
            return response()->json('Unidade não encontrada');

        //enviando os dados
        return response()->json($unidade);
    }

    //atualiza os dados da unidade
    public function update(Request $request){

        //pegando os dados da requisição
        $nome = addslashes($request->nome);
        $bloco = addslashes($request->bloco);
        $valor = addslashes($request->valor);
        $status = addslashes($request->status);
        $id_empreendimento = addslashes($request->id_empreendimento);

        //pegando o id da unidade no corpo da requisição
        $id_unidade = addslashes($request->id);

        //verificando se os dados foram encaminhados
        if(!$nome || !$bloco || !$status || !$id_unidade || !$id_empreendimento){
            $res = 'Preencha todos os campos';
            return response()->json(json_encode($res));
        }

        //verificando se o valor de status está dentro dos padrões
        if($status !== 'disponivel' && $status !== 'vendida' && $status !== 'reservada'){
            $res = 'O valor de status só pode ser: disponivel, vendida ou reservada';
            return response()->json($res);
        }

        //procurando a unidade no banco
        $unidade = Unidade::find($id_unidade);

        //verificando se a unidade existe
        if(!$unidade)
            return response()->json('Unidade não encontrada');


        //atualizando os dados
        $unidade->nome = $nome;
        $unidade->bloco = $bloco;
        $unidade->valor = $valor;
        $unidade->status = $status;
        $unidade->id_empreendimento = $id_empreendimento;

        //salvando
        $unidade->save();

        //resposta de sucesso
        return response()->json('Unidade atualizada com sucesso!');

    }

    //exclusão da unidade
    public function delete($id){
        Unidade::find($id)->delete();
        return response()->json('Unidade excluida com sucesso!');
    }


    //calcula o total de vendas em dinheiro
    public function allSalesCash(){
       $unidades_vendidas = Unidade::all()->where('status', '==', 'vendida');
       $vendas = 0;

       foreach($unidades_vendidas as $vendida){
            $vendas += $vendida['valor'];
       }

       return response()->json($vendas);
    }

    //Número total de vendas
    public function allSales(){
        $unidades_vendidas = Unidade::all()->where('status', '==', 'vendida');

        $total_vendas = count($unidades_vendidas);

        return response()->json($total_vendas);
    }

    //Numero total de unidades reservadas
    public function allReserve(){
        $unidades_reservadas = Unidade::all()->where('status', '==','reservada');

        $total_reservadas = count($unidades_reservadas);

        return response()->json($total_reservadas);
    }

    public function allAvailable(){
        $unidades_disponiveis = Unidade::all()->where('status', '==','disponivel');

        $total_disponivel = count($unidades_disponiveis);

        return response()->json($total_disponivel);
    }


}
