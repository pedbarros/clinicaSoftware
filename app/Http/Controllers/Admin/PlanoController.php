<?php

namespace App\Http\Controllers\Admin;

use App\Models\Plano;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class PlanoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request = Request::create('/api/plano', 'GET');
        $planos = json_decode(Route::dispatch($request)->getContent());

        return view('admin.plano.index', compact('planos'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request = Request::create('/api/plano', 'POST', $request->all());
        $plano = json_decode(Route::dispatch($request)->getContent());
// dd($plano);
        if ($plano) {
            return redirect()
                ->route('plano.index')
                ->with('success', 'Plano inserida com sucesso!');
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
        $plano = $this->plano->find($id);
        return view('admin.plano.edit', compact('plano'));
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
        $request = Request::create('/api/plano/'.$id, 'PUT', $request->all());
        $plano = json_decode(Route::dispatch($request)->getContent());

        if ($plano) {
            return redirect()
                ->route('plano.index')
                ->with('success', 'Plano atualizada com sucesso!');
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
        $request = Request::create('/api/plano/'.$id, 'DELETE');
        $statusCode = json_decode(Route::dispatch($request)->getStatusCode());
        //dd($statusCode);
        if ($statusCode == 204) { // No Content
            return redirect()
                ->route('plano.index')
                ->with('success', 'Plano apagada com sucesso!');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Falha ao apagar');
        }
    }
}