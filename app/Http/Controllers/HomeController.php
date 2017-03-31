<?php

namespace App\Http\Controllers;

use App\Models\Postulante;
use Auth;
use DB;
use Illuminate\Http\Request;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resumen = Postulante::select('fecha_registro',DB::raw('count(*) as cantidad'))->Activos()->isNull()->groupBy('fecha_registro')->get();
        $pagantes = Postulante::select('fecha_registro',DB::raw('count(*) as cantidad'))->where('pago',1)->Activos()->isNull()->groupBy('fecha_registro')->get();


        switch (Auth::user()->role->nombre) {
            case 'root':
                return view('admin.index',compact('resumen','pagantes'));
                break;
            case 'Alumno':
                return view('index');
                break;

            default:
                return view('admin.index',compact('resumen','pagantes'));
                break;
        }
    }
}
