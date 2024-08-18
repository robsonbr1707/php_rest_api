<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Example;
use App\Validation\ExampleValidate;

class ExampleController extends Controller
{
    public function index()
    {
        return $this->response->json([
            'message' => 'Listagem de exemplos',
            'datas'   => Example::all()
        ], 200);
    }

    public function show(int $id)
    {
        $exemple = Example::findOrFail($id);
        return $this->response->json([
            'message' => "Listando exemplo - ". $exemple['title'],
            'datas'   => $exemple
        ], 200);
    }

    public function store()
    {
        $fields = $this->request->body();
        $datas = ExampleValidate::validate($fields);
        
        Example::create($datas);

        return $this->response->json([
            'message' => 'Exemplo criado com sucesso!',
            'data'    => $datas
        ], 200);
    }

    public function update(int $id)
    {
        $fields = $this->request->body();
        $datas = ExampleValidate::validate($fields);
        
        Example::update($id, $datas);

        return $this->response->json([
            'message' => 'Exemplo atualizado com sucesso!',
            'data'    => $datas
        ], 200);
    }

    public function delete(int $id)
    {
        Example::delete($id);

        return $this->response->json([
            'message' => 'Exemplo excluído com sucesso!',
        ], 200);
    }
}