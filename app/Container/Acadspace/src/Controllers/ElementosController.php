<?php

namespace App\Container\Acadspace\src\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Acadspace\src\Articulo;
use App\Container\Overall\Src\Facades\AjaxResponse;
use Yajra\DataTables\DataTables;


class ElementosController extends Controller
{

    /**
     * Funcion para mostrar la vista elementos o articulos
     * @param Request $request
     * @return \Illuminate\View\View | \App\Container\Overall\Src\Facades\AjaxResponse
     */

    public function index(Request $request)
    {

        if ($request->isMethod('GET')) {
                //Muestra vista elementos
                return view('acadspace.Inventario.formularioinventario');
            }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * funcion para cargar articulos ya registrados
     * @param Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse | \Yajra\DataTables\
     */

    public function data(Request $request)
    {
        //Recibe peticion Ajax

        if ($request->ajax() && $request->isMethod('GET')) {
            //Relaciona la tabla articulos con, categorias y prodecencias
            $articulos = Articulo::select('pk_id_articulo', 'codigo_articulo',
                'descripcion_articulo', 'fk_id_categoria','fk_id_procedencia','fk_id_hojavida')
            ->with(['categoria' => function ($query) {
                return $query->select('pk_id_categoria',
                    'nombre_categoria');
            }])
            ->with(['procedencia' => function ($query) {
                return $query->select('pk_id_procedencia',
                    'tipo_procedencia');
            }])
            ->get();//Trae todos los articulos
            return DataTables::of($articulos)
            ->addColumn('hojavida',function($articulos) {
                if ($articulos->fk_id_hojavida==NULL) {
                    return "<span class='label label-sm label-warning'>" . 'No corresponde' . "</span>";
                } else{
                    return "<span class='label label-sm label-default'>" . $articulos->fk_id_hojavida . "</span>";
                }
            })
                //Elimina columnas no necesarias
                ->rawColumns(['hojavida'])
                ->removeColumn('fk_id_categoria')
                ->removeColumn('fk_id_procedencia')
                ->removeColumn('fk_id_hojavida')
                ->removeColumn('updated_at')
                ->removeColumn('created_at')
                ->removeColumn('fecha_registro')
                ->addIndexColumn()
                ->make(true);//Retorna tabla creada
            /*$articulos = Articulo::select('pk_id_articulo', 'codigo_articulo',
                'descripcion_articulo', 'fk_id_categoria','fk_id_procedencia','fk_id_hojavida')
                ->with(['categoria' => function ($query) {
                    return $query->select('pk_id_categoria',
                        'nombre_categoria');
                }])
                ->with(['procedencia' => function ($query) {
                    return $query->select('pk_id_procedencia',
                        'tipo_procedencia');
                }])
                ->get();
                return DataTables::of($articulos)
                ->addColumn('hojavida',function($articulos) {
                    if ($articulos->fk_id_hojavida->NULL) {
                        return "<span class='label label-sm label-warning'>" . 'Indefinida' . "</span>";
                    } else{
                        return "<span class='label label-sm label-default'>" . 'fk_id_hojavida' . "</span>";
                    }
                })
                ->rawColumns(['hojavida'])
                ->removeColumn('fk_id_hojavida')
                ->removeColumn('fk_id_categoria')
                ->removeColumn('fk_id_procedencia')
                ->addIndexColumn()
                ->make(true);*/
            
        }
        //Envia notificacion de no recibir peticion ajax
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );


    }
    
}