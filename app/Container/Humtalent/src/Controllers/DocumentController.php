<?php
/**
 * Created by PhpStorm.
 * User: Yeison Gomez
 * Date: 28/06/2017
 * Time: 2:04 PM
 */

namespace App\Container\Humtalent\src\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Users\Src\Interfaces\UserInterface;
use App\Container\Humtalent\src\DocumentacionPersona;
use App\Container\Humtalent\src\StatusOfDocument;
use App\Container\Humtalent\src\Persona;
use Yajra\DataTables\DataTables;
use App\Container\Overall\Src\Facades\AjaxResponse;
use Barryvdh\Snappy\Facades\SnappyPdf;


class DocumentController extends Controller
{

    protected $userRepository;

    protected $tipo;  //variable para almacenar el tipo de radicación (EPS o caja de compensación)

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function consultaDocsRadicados (Request $request, $id, $tipoRad)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            if($tipoRad == 'Caja')
            {
                $tipoRad = 'Caja de compensación';
            }
            $empleados = Persona::where('PK_PRSN_Cedula', $id)->get();  //se realiza la consulta del empleado correspondiente
            if (count($empleados) > 0)
            {
                $documentos = DocumentacionPersona::where('DCMTP_Tipo_Documento', $tipoRad)->get();     //se realiza la consulta de los documentos requeridos que esten registrados
                $docs = []; //array para almacenar con indices numericos los documentos consultados
                foreach ($documentos as $documento)
                {
                    $docs = $docs + [ $documento->PK_DCMTP_Id_Documento => $documento->DCMTP_Nombre_Documento];//se realiza la conversion del array con clave a array con indices numéricos
                }
                $selects = StatusOfDocument::where('FK_TBL_Persona_Cedula', $id)
                    ->whereIn('EDCMT_Proceso_Documentacion',
                            [
                                "Documentación incompleta " . $tipoRad,
                                "Documentación completa " . $tipoRad,
                                "Afiliado " . $tipoRad
                            ])
                    ->get(['FK_Personal_Documento']);

                $seleccion = [];    //array para almacenar con indices numericos los documentos consultados
                foreach ($selects as $select)
                {
                    $seleccion = array_merge($seleccion, [$select->FK_Personal_Documento]); //se realiza la conversion del array con clave a array con indices numéricos
                }
                $cantidadDocumentos = count($documentos);
                $cantidadRadicados = count($seleccion);
                $estado = StatusOfDocument::where('FK_TBL_Persona_Cedula', $id)
                    ->whereIn('EDCMT_Proceso_Documentacion',
                            [
                                "Documentación incompleta " . $tipoRad,
                                "Documentación completa " . $tipoRad,
                                "Afiliado " . $tipoRad
                            ])
                    ->get(['EDCMT_Proceso_Documentacion'])->first();
                if (count($estado) > 0)
                {
                    $estado = $estado->EDCMT_Proceso_Documentacion;
                }
                else
                {
                    $estado = 'No Afiliado ' . $tipoRad;
                }

                return view('humtalent.documentacion.radicarDocumentos',
                    compact('empleados', 'docs', 'seleccion', 'cantidadDocumentos',
                            'cantidadRadicados', 'estado', 'tipoRad'));     //y se muestran todas las consultas en el formuario de radicacion
            }
        }
        else
        {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }

    }

    public function listarDocsRad (Request $request)    //funcion que se encarga de listar los documentos registrados y que debern ser entregados por los empleados
    {
        if ($request->ajax() && $request->isMethod('POST'))
        {
            $id = $request['PK_PRSN_Cedula'];       //se recibe como parametro el numero de cedula del empleado a quien se le van a radicar los documentos
            $tipoRad = $request['tipoRadicacion'];
            $empleados = Persona::where('PK_PRSN_Cedula', $id)->get();      //se realiza la consulta del empleado correspondiente
            if (count($empleados) > 0)
            {
                $documentos = DocumentacionPersona::where('DCMTP_Tipo_Documento', $tipoRad)->get();     //se realiza la consulta de los documentos requeridos que esten registrados
                $docs = [];     //array para almacenar con indices numericos los documentos consultados
                foreach ($documentos as $documento)
                {
                    $docs = $docs + [$documento->PK_DCMTP_Id_Documento => $documento->DCMTP_Nombre_Documento];//se realiza la conversion del array con clave a array con indices numéricos
                }
                $selects = StatusOfDocument::where('FK_TBL_Persona_Cedula', $id)
                    ->whereIn('EDCMT_Proceso_Documentacion',
                            [
                                "Documentación incompleta " . $tipoRad,
                                "Documentación completa " . $tipoRad,
                                "Afiliado " . $tipoRad
                            ])
                    ->get(['FK_Personal_Documento']); //se realiza la consulta a la tabla estado documentación para saber que documentos ya han sido radicados por el empleado
                $seleccion = [];//array para almacenar con indices numericos los documentos consultados
                foreach ($selects as $select)
                {
                    $seleccion = array_merge($seleccion, [$select->FK_Personal_Documento]); //se realiza la conversion del array con clave a array con indices numéricos
                }
                $cantidadDocumentos = count($documentos);   //DocumentacionPersona::where('DCMTP_Tipo_Documento',$tipoRad)->count();
                $cantidadRadicados = count($seleccion);
                $estado = StatusOfDocument::where('FK_TBL_Persona_Cedula', $id)
                    ->whereIn('EDCMT_Proceso_Documentacion',
                            [
                                "Documentación incompleta " . $tipoRad,
                                "Documentación completa " . $tipoRad,
                                "Afiliado " . $tipoRad
                            ])
                    ->get(['EDCMT_Proceso_Documentacion'])->first();
                if (count($estado) > 0)
                {
                    $estado = $estado->EDCMT_Proceso_Documentacion;
                }
                else
                {
                    $estado = 'No Afiliado ' . $tipoRad;
                }
                return view('humtalent.documentacion.radicarDocumentos',
                    [
                        'empleados' => $empleados, 'docs' => $docs, 'seleccion' => $seleccion,
                        'cantidadDocumentos' => $cantidadDocumentos, 'cantidadRadicados' => $cantidadRadicados,
                        'estado' => $estado, 'tipoRad' => $tipoRad,
                    ]);
            }
            else
            {
               return "Empleado no registrado";
            }
        }
        else
        {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

    public function ajaxBuscarEmpleado (Request $request)
    {
        if($request->ajax() && $request->isMethod('GET'))
        {
            return view('humtalent.empleado.ajaxBuscarEmpleado');
        }
        else
        {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

    public function radicarDocumentos (Request $request)    //funcion que almacena las radicación de los documentos
    {
        if($request->ajax() && $request->isMethod('POST'))
        {
            $documento = explode(';', $request['FK_Personal_Documento']);   //se toman los documentos a radicar.
            $this->tipo = $request['tipoRadicacion'];
            $tipoRad = $this->tipo;
            $radicados = StatusOfDocument::with([
                'DocumentacionPersonas' => function ($query)
                {
                    $query->where('DCMTP_Tipo_Documento', $this->tipo);
                }
            ])->where('FK_TBL_Persona_Cedula', $request['FK_TBL_Persona_Cedula'])->get();    //se realiza una consulta de los documentos ya radicados para el empleado
            $docsRad = [];
            foreach ($radicados as $radicado)
            {
                if ($radicado['DocumentacionPersonas'] != null)
                {
                    $docsRad = array_merge($docsRad, [$radicado['DocumentacionPersonas']['PK_DCMTP_Id_Documento']]); //se realiza la conversion  a array de una sola dimensión.
                }
            }
            $cantidadDocumentos = DocumentacionPersona::where('DCMTP_Tipo_Documento', $tipoRad)->count();
            $cantidadRadicados = count($documento)-1;
            if ($cantidadRadicados < $cantidadDocumentos)
            {
                $estado = "Documentación incompleta " . $tipoRad;
            }
            else
            {
                $estado = "Documentación completa " . $tipoRad;
            }
            if (!empty($docsRad))   //en caso de que ya hayan radicado algunos documentos con anterioridad
            {
                for ($j = 0; $j < count($documento)-1; $j++)    //se recorren los documentos a radicar
                {
                    $contador = 0;
                    for ($k = 0; $k < count($docsRad); $k++)
                    {
                        if ($documento[$j] != $docsRad[$k]) //se comparan los documentos a radicar con los ya radicados
                        {
                            $contador = $contador + 1;
                        }
                    }
                    if ($contador == count($docsRad))   //si la variable contador es igual al tamaño del vector que contiene los documentos ya radicados quiere decir que hay un documento nuevo
                    {
                        StatusOfDocument::create([ //por ende se crea un nuevo registro en la  tabla estadodocumentacion relacionando el documento con el epmpleado
                            'EDCMT_Fecha' => $request['EDCMT_Fecha'],
                            'EDCMT_Proceso_Documentacion' => $estado,
                            'FK_TBL_Persona_Cedula' => $request['FK_TBL_Persona_Cedula'],
                            'FK_Personal_Documento' => $documento[$j]
                        ]);
                    }
                    else
                    {
                        $procesoActual = StatusOfDocument::where('FK_TBL_Persona_Cedula', $request['FK_TBL_Persona_Cedula'])
                            ->where('FK_Personal_Documento', $documento[$j])
                            ->get(['EDCMT_Proceso_Documentacion'])
                            ->first();
                        if ($procesoActual != $estado)
                        {
                            StatusOfDocument::where('FK_TBL_Persona_Cedula', $request['FK_TBL_Persona_Cedula'])
                                ->where('FK_Personal_Documento', $documento[$j])
                                ->update(['EDCMT_Proceso_Documentacion' => $estado]);
                        }
                    }
                }
                    /*  una vez se hayan registrado los documentos nuevos del empelado que no esten radicados
                    *   se recorre los documentos radicados
                    */
                for ($j = 0; $j < count($docsRad); $j++)
                {
                    $contador = 0;
                    for ($k = 0; $k < count($documento)-1; $k++) //se recorre los documentos enviados a radicar
                    {
                        if ($documento[$k] != $docsRad[$j])     //se realiza la comparacion con la finalidad de ver si habia un documento radicado y que el funcionario ahopra desea eliminar
                        {
                            $contador = $contador + 1;
                        }
                    }
                    if ($contador == count($documento)-1)   //cuando la variable contador sea igual al tamaño del vector que contiene los documentos enviados a radicar
                    {
                        StatusOfDocument::where('FK_TBL_Persona_Cedula', $request['FK_TBL_Persona_Cedula'])     //quiere decir que se ha deseleccionado uno de los documentos ya radicados
                            ->where('FK_Personal_Documento', $docsRad[$j])
                            ->delete();//por ende se realiza la respectiva eliminación
                    }
                }
            }
            else        //en caso de que no se hayan radicado algunos documentos con anterioridad para el empleado
            {
                for ($i = 0; $i < count($documento)-1; $i++)
                {
                    StatusOfDocument::create([ //se realiza un registro completo de los documentos enviados para radicar
                        'EDCMT_Fecha' => $request['EDCMT_Fecha'],
                        'EDCMT_Proceso_Documentacion' => $estado,
                        'FK_TBL_Persona_Cedula' => $request['FK_TBL_Persona_Cedula'],
                        'FK_Personal_Documento' => $documento[$i]
                    ]);
                }
            }
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Documentos radicados correctamente.'
            );
        }
        else
        {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

    public function afiliarEmpleado (Request $request)
    {
        if($request->ajax() && $request->isMethod('POST')) {
            StatusOfDocument::where('FK_TBL_Persona_Cedula', $request['FK_TBL_Persona_Cedula'])
                ->where('EDCMT_Proceso_Documentacion',
                        "Documentación completa " . $request['tipoRadicacion'])
                ->update(['EDCMT_Proceso_Documentacion' => $request['EDCMT_Proceso_Documentacion'],
                    'updated_at' => $request['EDCMT_Fecha']
                ]);
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Empleado afiliado correctamente.'
            );
        }
        else
        {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

    public function reiniciarRadicacion (Request $request)
    {
        if($request->ajax() && $request->isMethod('POST'))
        {
            StatusOfDocument::where('FK_TBL_Persona_Cedula', $request['FK_TBL_Persona_Cedula'])
                ->where('EDCMT_Proceso_Documentacion', $request['EDCMT_Proceso_Documentacion'])
                ->delete();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Se reinicio correctamente.'
            );
        }
        else
        {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

    public function consultaRadicados (Request $request, $id){
        $radicados=StatusOfDocument::with('DocumentacionPersonas')
            ->where('FK_TBL_Persona_Cedula',$id)
            ->get(['EDCMT_Fecha','FK_Personal_Documento']);
        if ($request->ajax())
        {
            return DataTables::of($radicados)
                ->addIndexColumn()
                ->make(true);
        }
        else
        {
            return response()->json([
                'message' => 'Incorrect request',
                'code' => 412
            ], 412);
        }

    }
    public function tablaRadicados(Request $request, $id)
    {
        if($request->ajax() && $request->isMethod('GET')) {
            $empleado = Persona::where('PK_PRSN_Cedula', $id)->get(['PK_PRSN_Cedula', 'PRSN_Nombres', 'PRSN_Apellidos', 'PRSN_Telefono', 'PRSN_Correo'])->first();
            $estadoEPS = StatusOfDocument::where('FK_TBL_Persona_Cedula', $id)
                ->where('EDCMT_Proceso_Documentacion', 'Afiliado EPS')
                ->get(['EDCMT_Proceso_Documentacion', 'updated_at'])->first();

            $estadoCaja = StatusOfDocument::where('FK_TBL_Persona_Cedula', $id)
                ->where('EDCMT_Proceso_Documentacion', 'Afiliado Caja de compensación')
                ->get(['EDCMT_Proceso_Documentacion', 'updated_at'])->first();

            if (count($estadoEPS) > 0)
            {
                $fechaEPS = $estadoEPS->updated_at->format('d-m-Y');
                $procesoEPS = $estadoEPS->EDCMT_Proceso_Documentacion;
            }
            else
            {
                $fechaEPS = null;
                $procesoEPS = "No afiliado";
            }
            if (count($estadoCaja) > 0)
            {
                $fechaCaja = $estadoCaja->updated_at->format('d-m-Y');
                $procesoCaja = $estadoCaja->EDCMT_Proceso_Documentacion;
            }
            else
            {
                $fechaCaja = null;
                $procesoCaja = "No afiliado";
            }
            return view('humtalent.documentacion.listaDocumentosRadicados',
                compact('empleado', 'id', 'procesoEPS', 'fechaEPS', 'procesoCaja', 'fechaCaja')
            );
        }
        else
        {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
     }
     /**
      * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
      */
    public function index()//muestra todos los documentos que esten registrados
    {
        return view('humtalent.documentacion.listaDocumentos');
    }

    public function indexAjax (Request $request)//muestra todos los documentos que esten registrados
    {
        if($request->ajax() && $request->isMethod('GET'))
        {
            return view('humtalent.documentacion.ajaxListaDocumentos');
        }
        else
        {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create (Request $request)//preseta el formulario para registrar un documento
    {
        if($request->ajax() && $request->isMethod('GET'))
        {
            return view('humtalent.documentacion.registroDocumento');
        }
        else
        {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //almacena un documento enviado desde el formulario del la funcion create
    {
        if($request->ajax() && $request->isMethod('POST'))
        {
            DocumentacionPersona::create([
                'DCMTP_Nombre_Documento' => $request['DCMTP_Nombre_Documento'],
                'DCMTP_Tipo_Documento' => $request['DCMTP_Tipo_Documento'],
            ]);
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos almacenados correctamente.'
            );
        }
        else
        {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    /**
     * Display the specified resource.
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)     //presenta el formulario para editar un documento deseado
    {
        if($request->ajax() && $request->isMethod('GET'))
        {
            $documento = DocumentacionPersona::find($id);
            return view('humtalent.documentacion.editarDocumento',
                [
                    'documento' => $documento,
                ]);
        }
        else
        {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update (Request $request)//se realiza la actulización de datos de los documentos
    {
        if($request->ajax() && $request->isMethod('POST'))
        {
            $documento= DocumentacionPersona::find($request['PK_DCMTP_Id_Documento']);
            $documento->fill($request->all());
            $documento->save();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos modificados correctamente.'
            );
        }
        else
        {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy (Request $request,$id)  //se elimina el registro de un documento
    {
        if($request->ajax() && $request->isMethod('DELETE'))
        {
            StatusOfDocument::where('FK_Personal_Documento',$id)->delete();
            DocumentacionPersona::destroy($id);
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos eliminados correctamente.'
            );
        }
        else
        {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

    public function reporteRadicacionEmpleados ($id)
    {
        $date = date("d/m/Y");
        $time = date("h:i A");
        $empleado = Persona::where('PK_PRSN_Cedula',$id)
                ->get(['PK_PRSN_Cedula', 'PRSN_Nombres', 'PRSN_Apellidos', 'PRSN_Area',
                   'PRSN_Correo', 'PRSN_Rol', 'PRSN_Eps', 'PRSN_Caja_Compensacion'])
                ->first();
        $radicados = StatusOfDocument::where('FK_TBL_Persona_Cedula', $id)
                ->get(['FK_Personal_Documento']);
        $primariaEPS = DocumentacionPersona::where('DCMTP_Tipo_Documento','EPS')
                ->get(['PK_DCMTP_Id_Documento']);
        $primariaCaja = DocumentacionPersona::where('DCMTP_Tipo_Documento','Caja de compensación')
                ->get(['PK_DCMTP_Id_Documento']);
        $noEPS = DocumentacionPersona::where('DCMTP_Tipo_Documento','EPS')
                ->whereNotIn('PK_DCMTP_Id_Documento',$radicados)
                ->get(['DCMTP_Nombre_Documento']);
        $radicadosEPS = StatusOfDocument::with(['DocumentacionPersonas' => function($query )
        {
            $query -> where('DCMTP_Tipo_Documento', 'EPS')->get(['DCMTP_Nombre_Documento']);
        }])
                ->where('FK_TBL_Persona_Cedula', $id)->whereIn('FK_Personal_Documento', $primariaEPS)
                ->get();
        $radicadosCaja = StatusOfDocument::with(['DocumentacionPersonas' => function($query )
        {
            $query -> where('DCMTP_Tipo_Documento', 'Caja de compensación')->get(['DCMTP_Nombre_Documento']);
        }])
                ->where('FK_TBL_Persona_Cedula', $id)->whereIn('FK_Personal_Documento', $primariaCaja)
                ->get();
        $PendientesCaja = DocumentacionPersona::where('DCMTP_Tipo_Documento', 'Caja de compensación')
                ->whereNotIn('PK_DCMTP_Id_Documento', $radicados)
                ->get(['DCMTP_Nombre_Documento']);
        return view('humtalent.reportes.ReporteRadicacionEmpleados',
            compact('empleado','date', 'time', 'cont', 'noEPS',
                    'PendientesCaja', 'radicadosEPS', 'radicadosCaja')
        );
    }
    public function DownloadReporteRadicacionEmpleados ($id)
    {
        $date = date("d/m/Y");
        $time = date("h:i A");
        $empleado = Persona::where('PK_PRSN_Cedula',$id)
                ->get([ 'PK_PRSN_Cedula', 'PRSN_Nombres', 'PRSN_Apellidos', 'PRSN_Area',
                    'PRSN_Correo', 'PRSN_Rol', 'PRSN_Eps', 'PRSN_Caja_Compensacion'])->first();
        $radicados = StatusOfDocument::where('FK_TBL_Persona_Cedula', $id)
                ->get(['FK_Personal_Documento']);
        $primariaEPS = DocumentacionPersona::where('DCMTP_Tipo_Documento', 'EPS')
                ->get(['PK_DCMTP_Id_Documento']);
        $primariaCaja = DocumentacionPersona::where('DCMTP_Tipo_Documento', 'Caja de compensación')
                ->get(['PK_DCMTP_Id_Documento']);
        $noEPS = DocumentacionPersona::where('DCMTP_Tipo_Documento', 'EPS')
                ->whereNotIn('PK_DCMTP_Id_Documento', $radicados)
                ->get(['DCMTP_Nombre_Documento']);
        $radicadosEPS = StatusOfDocument::with(['DocumentacionPersonas' => function($query )
        {
            $query -> where('DCMTP_Tipo_Documento', 'EPS')->get(['DCMTP_Nombre_Documento']);
        }])
                ->where('FK_TBL_Persona_Cedula', $id)->whereIn('FK_Personal_Documento', $primariaEPS)
                ->get();
        $radicadosCaja = StatusOfDocument::with(['DocumentacionPersonas' => function($query )
        {
            $query -> where('DCMTP_Tipo_Documento','Caja de compensación')
                ->get(['DCMTP_Nombre_Documento']);
        }])
                ->where('FK_TBL_Persona_Cedula', $id)->whereIn('FK_Personal_Documento', $primariaCaja)
                ->get();
        $PendientesCaja = DocumentacionPersona::where('DCMTP_Tipo_Documento', 'Caja de compensación')
                ->whereNotIn('PK_DCMTP_Id_Documento', $radicados)
                ->get(['DCMTP_Nombre_Documento']);
        return SnappyPdf::loadView('humtalent.reportes.ReporteRadicacionEmpleados',
            compact('empleado', 'date', 'time', 'cont', 'noEPS', 'PendientesCaja',
                    'radicadosEPS', 'radicadosCaja'))->download('ReporteRadicacion.pdf');
    }

    public function reporteConsolidadoEmpleados(){
        $cont = 1;
        $date = date("d/m/Y");
        $time = date("h:i A");
        $empleados = Persona::all();
        foreach ($empleados as $empleado)
        {
            $estadoCaja = StatusOfDocument::where('FK_TBL_Persona_Cedula', $empleado->PK_PRSN_Cedula)
                                     ->whereIn('EDCMT_Proceso_Documentacion',
                                         [
                                            "Documentación incompleta Caja de compensación",
                                            "Documentación completa Caja de compensación",
                                            "Afiliado Caja de compensación"
                                         ])->get(['EDCMT_Proceso_Documentacion'])->first();
            if (count($estadoCaja) > 0)
            {
                $empleado->offsetSet('estadoCaja', $estadoCaja['EDCMT_Proceso_Documentacion']);
            }
            else
            {
                $empleado->offsetSet('estadoCaja', "Sin documentación");
            }

            $estadoEPS = StatusOfDocument::where('FK_TBL_Persona_Cedula', $empleado->PK_PRSN_Cedula)
                ->whereIn('EDCMT_Proceso_Documentacion',
                    [
                        "Documentación incompleta EPS",
                        "Documentación completa EPS",
                        "Afiliado EPS"
                    ])->get(['EDCMT_Proceso_Documentacion'])->first();
            if(count($estadoEPS) > 0)
            {
                $empleado->offsetSet('estadoEPS', $estadoEPS['EDCMT_Proceso_Documentacion']);
            }
            else
            {
                $empleado->offsetSet('estadoEPS',"Sin documentación");
            }
        }
        return view('humtalent.reportes.ReporteConsolidadoEmpleados',
            compact('empleados','date','time','cont'));

    }
    public function DownloadReporteConsolidadoEmpleados(){
        $cont = 1;
        $date = date("d/m/Y");
        $time = date("h:i A");
        $empleados = Persona::all();
        foreach ($empleados as $empleado)
        {
            $estadoCaja = StatusOfDocument::where('FK_TBL_Persona_Cedula', $empleado->PK_PRSN_Cedula)
                ->whereIn('EDCMT_Proceso_Documentacion',
                    [
                        "Documentación incompleta Caja de compensación",
                        "Documentación completa Caja de compensación",
                        "Afiliado Caja de compensación"
                    ])->get(['EDCMT_Proceso_Documentacion'])->first();
            if (count($estadoCaja) > 0)
            {
                $empleado->offsetSet('estadoCaja', $estadoCaja['EDCMT_Proceso_Documentacion']);
            }
            else
            {
                $empleado->offsetSet('estadoCaja', "Sin documentación");
            }

            $estadoEPS = StatusOfDocument::where('FK_TBL_Persona_Cedula', $empleado->PK_PRSN_Cedula)
                ->whereIn('EDCMT_Proceso_Documentacion',
                    [
                        "Documentación incompleta EPS",
                        "Documentación completa EPS",
                        "Afiliado EPS"
                    ])->get(['EDCMT_Proceso_Documentacion'])->first();
            if(count($estadoEPS) > 0)
            {
                $empleado->offsetSet('estadoEPS', $estadoEPS['EDCMT_Proceso_Documentacion']);
            }
            else
            {
                $empleado->offsetSet('estadoEPS',"Sin documentación");
            }
        }
        return SnappyPdf::loadView('humtalent.reportes.ReporteConsolidadoEmpleados',
            compact('empleados','date','time','cont'))->download('ReporteConsolidado.pdf');
    }
}