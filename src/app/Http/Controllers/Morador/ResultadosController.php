<?php

namespace App\Http\Controllers\Morador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResultadosController extends Controller
{
    /**
     * Exibe os resultados das votações para o morador
     */
    public function index()
    {
        return view('morador.resultados.index');
    }
}
