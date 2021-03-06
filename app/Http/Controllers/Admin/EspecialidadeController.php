<?php

namespace App\Http\Controllers\Admin;

use App\Models\Especialidade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class EspecialidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request = Request::create('/api/especialidade', 'GET');
        $especialidades = json_decode(Route::dispatch($request)->getContent());
        /// dd($especialidades);
        return view('admin.especialidade.index', compact('especialidades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request = Request::create('/api/especialidade', 'POST', $request->all());
        $especialidade = json_decode(Route::dispatch($request)->getContent());

        if ($especialidade) {
            return redirect()
                ->route('especialidade.index')
                ->with('success', 'Especialidade inserida com sucesso!');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Falha ao inserir');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $request = Request::create('/api/especialidade/'.$id, 'GET');
        $especialidade = json_decode(Route::dispatch($request)->getContent());

        return view('admin.especialidade.edit', compact('especialidade'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request = Request::create('/api/especialidade/'.$id, 'PUT', $request->all());
        $especialidade = json_decode(Route::dispatch($request)->getContent());
// dd($profissao);
        if ($especialidade) {
            return redirect()
                ->route('especialidade.index')
                ->with('success', 'Especialidade atualizada com sucesso!');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Falha ao atualizar');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $request = Request::create('/api/especialidade/'.$id, 'DELETE');
        $statusCode =  Route::dispatch($request)->getData();
 // dd($statusCode->destroy);
        if ($statusCode->destroy == true) { // No Content
            return redirect()
                ->route('especialidade.index')
                ->with('success', 'Especialidade apagada com sucesso!');
        } else {
            return redirect()
                ->back()
                ->with('error', $statusCode->msg);
        }
    }
}
