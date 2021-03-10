<?php

namespace App\Http\Controllers\Api;

use App\API\ApiError;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// 1) Para criar um novo controller, inicialmente é necessário alterar o nome da classe abaixo, 
//referente a model.

use App\Models\User as Model; // 'App\Models\nome_classe'

// 2) Em seguida, é necessário definir um novo nome para o controller abaixo.

class PessoasController extends Controller { 

	// 3) Por fim, é necessário alterar a string abaixo para o nome do controller, no singular.

	public $nomeClasse = 'Pessoa'; 
	
	private $classe;

    public function __construct(Model $classe){
        $this->classe = $classe;
    }

    public function index(){
		$data = $this->classe->all();

    	return response()->json($data);
    }

    public function show($id){
        $data = $this->classe->find($id);

		if(!$data) return response()->json(ApiError::errorMessage($this->nomeClasse.' não encontrado(a)!', 4040), 404);

    	return response()->json($data);
    }

    public function store(Request $request){
		try {

			$data = $request->all();

			$this->classe->create($data);
            
			return response()->json(['msg' => $this->nomeClasse.' criado(a) com sucesso!'], 201);

		} catch (\Exception $e) {
			if(config('app.debug')) {
				return response()->json(ApiError::errorMessage($e->getMessage(), 1010), 500);
			}
			return response()->json(ApiError::errorMessage('Houve um erro ao realizar operação de salvar', 1010),  500);
		}
    }

    public function update(Request $request, $id){
		try {

			$data   = $request->all();
			$classe = $this->classe->find($id);
			$classe->update($data);

			return response()->json(['msg' => $this->nomeClasse.' atualizad(a) com sucesso!'], 201);

		} catch (\Exception $e) {
			if(config('app.debug')) {
				return response()->json(ApiError::errorMessage($e->getMessage(), 1011),  500);
			}
			return response()->json(ApiError::errorMessage('Houve um erro ao realizar operação de atualizar', 1011), 500);
		}
    }
    
    public function delete($id){
		try {
			$classe = $this->classe->find($id);

			$classe->delete();

			return response()->json(['msg' => $this->nomeClasse.' removido com sucesso!'], 200);

		}catch (\Exception $e) {
			if(config('app.debug')) {
				return response()->json(ApiError::errorMessage($e->getMessage(), 1012),  500);
			}
			return response()->json(ApiError::errorMessage('Houve um erro ao realizar operação de remover', 1012),  500);
		}
	}

}