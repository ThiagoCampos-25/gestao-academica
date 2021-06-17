<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AlunoService;

class AlunoController extends Controller
{
    /*
    |---------------------------------------------------------------------------------------------------------------------
    |   
    |---------------------------------------------------------------------------------------------------------------------
    */
    private $alunoService;

    /*
    |---------------------------------------------------------------------------------------------------------------------
    |   
    |---------------------------------------------------------------------------------------------------------------------
    */
    public function __construct(AlunoService $alunoService)
    {
        $this->alunoService = $alunoService;
    }

    /*
    |---------------------------------------------------------------------------------------------------------------------
    |   
    |---------------------------------------------------------------------------------------------------------------------
    */
    public function index(Request $request)
    {
        return view('secretaria.aluno.index', [
            'alunos' => $this->alunoService->consultar($request)
        ]);
    }

    /*
    |---------------------------------------------------------------------------------------------------------------------
    |   
    |---------------------------------------------------------------------------------------------------------------------
    */
    public function create()
    {
       return $this->alunoService->create();
    }

    /*
    |---------------------------------------------------------------------------------------------------------------------
    |   
    |---------------------------------------------------------------------------------------------------------------------
    */
    public function store(Request $request)
    {   
        return $this->alunoService->criar($request);
    }
    
    /*
    |---------------------------------------------------------------------------------------------------------------------
    |   
    |---------------------------------------------------------------------------------------------------------------------
    */
    public function show($id)
    {
        return $this->alunoService->show($id, 'secretaria.aluno.visualizar');
    }
    
    /*
    |---------------------------------------------------------------------------------------------------------------------
    |   
    |---------------------------------------------------------------------------------------------------------------------
    */
    public function edit($id)
    {
        return $this->alunoService->show($id, 'secretaria.aluno.editar');
    }

    /*
    |---------------------------------------------------------------------------------------------------------------------
    |   
    |---------------------------------------------------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        return $this->alunoService->editar($id, $request);
    }
    
    
    /*
    |---------------------------------------------------------------------------------------------------------------------
    |   
    |---------------------------------------------------------------------------------------------------------------------
    */
    public function destroy($id, Request $request)
    {
        if('delete-modal'=== $id){
            $id = (int)$request->delete_modal_id;
        }
        try {
            $this->alunoService->excluir($id);

        } catch(\Exception $e) {
            
            throw ValidationException::withMessages(['error'=>[$e->getMessage()]]);
        }
        return redirect()->route('aluno.index')->with('success', trans('validation.delete-success'));
    }


}
