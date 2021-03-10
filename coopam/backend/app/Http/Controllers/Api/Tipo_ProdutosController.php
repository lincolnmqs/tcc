<?php

namespace App\Http\Controllers\Api;

use App\API\ApiError;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// INÍCIO

// 1) Alterar o nome da classe abaixo, referente a model

use App\Models\Tipo_Produtos as Model; // 'App\Models\nome_classe'

// 2) Definir um novo nome para o controller abaixo

class Tipo_ProdutosController extends Controller { 

	// 3) Definir o nome e os relacionamentos "muito para muitos" da classe

	public $nomeClasse = 'Tipo Produtos'; 
	public $muitosParaMuitos = [];

    public function __construct(Model $classe){
		$this->classe = $classe;
	}

	// 4) Criar condições dentro da função abaixo de acordo com os métodos relacionados
	
	public function relacionamento($classe, $tabela){
		/*
		if($tabela == 'ingredientes')
			return $classe->ingredientes();
		*/
	}

	//
	//
	//
	//
	//
	//
	//
	//
	//
	//

	// FIM

	public function aplicarRelacionamento($class, $data, $metodo){
		if($this->muitosParaMuitos){
			$count = count($this->muitosParaMuitos);

			for($i=0; $i<$count; $i++){
				$dataAux = $data;

				unset($data['ids_' . $this->muitosParaMuitos[$i]]);

				$classe = $class;

				if($metodo == 'store')
					$classe = $this->classe->create($data);

				else if($metodo == 'update')
					$class->update($data);

				else if($metodo == 'delete')
					$class->delete();

				if($dataAux['ids_' . $this->muitosParaMuitos[$i]]['adicionar'])
					$this->relacionamento($classe, $this->muitosParaMuitos[$i])->attach($dataAux['ids_' . $this->muitosParaMuitos[$i]]['adicionar']);

				if($dataAux['ids_' . $this->muitosParaMuitos[$i]]['remover'])
					$this->relacionamento($classe, $this->muitosParaMuitos[$i])->detach($dataAux['ids_' . $this->muitosParaMuitos[$i]]['remover']);
			}
		}
	}

    public function index(){
        return response()->json($this->classe->all());
    }

    public function show($id){
        $classe = $this->classe->find($id);

        if(!$classe) return response()->json(ApiError::errorMessage($this->nomeClasse.' não encontrado(a)!', 4040), 404);

    	return response()->json($classe);
    }

    public function store(Request $request){
		try {
			$data = $request->all();

			if($this->muitosParaMuitos){
				$this->aplicarRelacionamento(null, $data, 'store');
			} else {	
				$this->classe->create($data);
			}

			return response()->json(['msg' => $this->nomeClasse.' criado(a) com sucesso!'], 201);

		} catch (\Exception $e) {
			if(config('app.debug')) {
				return response()->json(ApiError::errorMessage($e->getMessage(), 1011),  500);
			}
			return response()->json(ApiError::errorMessage('Houve um erro ao realizar operação de cadastrar', 1011), 500);
		}
    }

    public function update(Request $request, $id){
		try {
			$data   = $request->all();
			$classe = $this->classe->find($id);

			if($this->muitosParaMuitos){
				$this->aplicarRelacionamento($classe, $data, 'update');
			} else {
				$classe->update($data);
			}

			return response()->json(['msg' => $this->nomeClasse.' atualizad(a) com sucesso!'], 201);

		} catch (\Exception $e) {
			if(config('app.debug')) {
				return response()->json(ApiError::errorMessage($e->getMessage(), 1011),  500);
			}
			return response()->json(ApiError::errorMessage('Houve um erro ao realizar operação de atualizar', 1011), 500);
		}
    }
    
    public function delete(Request $request, $id){
		try {
			$data   = $request->all();
			$classe = $this->classe->find($id);

			if($this->muitosParaMuitos){
				$this->aplicarRelacionamento($classe, $data, 'delete');
			} else {	
				$classe->delete();
			}

			return response()->json(['msg' => $this->nomeClasse.' removido com sucesso!'], 200);

		}catch (\Exception $e) {
			if(config('app.debug')) {
				return response()->json(ApiError::errorMessage($e->getMessage(), 1012),  500);
			}
			return response()->json(ApiError::errorMessage('Houve um erro ao realizar operação de remover', 1012),  500);
		}
	}

}