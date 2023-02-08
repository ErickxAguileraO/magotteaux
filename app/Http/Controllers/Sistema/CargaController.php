<?php

namespace App\Http\Controllers\Sistema;

use App\Exports\Carga\CargaClienteExport;
use App\Exports\Carga\CargaLogisticaExport;
use App\Http\Controllers\Controller;

use App\Mail\DespachoCarga\NotificacionCarga;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Carga\CreateCargaRequest;
use App\Http\Resources\Carga\CargaClienteResource;
use App\Http\Resources\Carga\CargaLogisticaResource;
use App\Models\Carga;
use App\Models\EmpresaTransporte;
use Maatwebsite\Excel\Facades\Excel;


class CargaController extends Controller
{
    public function index()
    {
        return view('sistema.carga.index');
    }

    public function list()
    {
        $relations = ['empresaTransporte', 'patente', 'tipo', 'cliente'];

        if (auth()->user()->hasRole('Cliente')) {
            $cargas = Carga::with($relations)->forClient()->get();

            return CargaClienteResource::collection($cargas);
        }

        $relations = array_merge($relations, ['planta']);

        $cargas = Carga::with($relations)->orderBy('car_email_enviado')->get();

        return CargaLogisticaResource::collection($cargas);
    }

    public function create()
    {
        $empresas = EmpresaTransporte::with([
            'choferes' => function ($query) {
                $query->active();
            },
            'patentes' => function ($query) {
                $query->active();
            },
        ])->active()->get();

        $choferes = $empresas->firstWhere('emt_id', old('empresa'))->choferes ?? [];

        return view('sistema.carga.crear', compact('empresas', 'choferes'));
    }

    public function store(CreateCargaRequest $request)
    {
        // try {
        //     Chofer::create([
        //         'cho_nombre' => $request->post('nombre'),
        //         'cho_apellido' => $request->post('apellido'),
        //         'cho_identificacion' => $request->post('identificacion'),
        //         'cho_empresa_id' => $request->post('empresa'),
        //         'cho_estado' => $request->post('estado'),
        //     ]);

        //     return redirect()->route('chofer.index')->with(['message' => 'Se creo un nuevo chofer correctamente', 'type' => 'success']);
        // } catch (\Throwable $th) {
        //     return redirect()->back()->with(['message' => 'Ocurrio un error al intentar crear el chofer', 'type' => 'error']);
        // }
    }

    // public function edit(int $id)
    // {
    //     $chofer = Chofer::findOrFail($id);
    //     $empresas = EmpresaTransporte::active()->get();

    //     return view('sistema.chofer.editar', compact('chofer', 'empresas'));
    // }

    // public function update(UpdateChoferRequest $request, int $id)
    // {
    //     try {

    //         $chofer = Chofer::findOrFail($id);

    //         $chofer->update([
    //             'cho_nombre' => $request->post('nombre'),
    //             'cho_apellido' => $request->post('apellido'),
    //             'cho_identificacion' => $request->post('identificacion'),
    //             'cho_empresa_id' => $request->post('empresa'),
    //             'cho_estado' => $request->post('estado'),
    //         ]);

    //         return redirect()->route('chofer.index')->with(['message' => 'Se edito el chofer correctamente', 'type' => 'success']);
    //     } catch (\Throwable $th) {
    //         return redirect()->back()->with(['message' => 'Ocurrio un error al intentar editar el chofer', 'type' => 'error']);
    //     }
    // }

    public function delete(int $id)
    {
        try {
            Carga::findOrFail($id)->delete();

            return redirect()->route('carga.index')->with(['message' => 'Carga eliminada correctamente', 'type' => 'success']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['message' => 'Ocurrio un error al intentar eliminar el carga', 'type' => 'error']);
        }
    }

    public function downloadExcel()
    {
        try {

            $relations = ['empresaTransporte', 'patente', 'tipo', 'cliente'];

            if (auth()->user()->hasRole('Cliente')) {
                $cargas = Carga::with($relations)->forClient()->get();

                return Excel::download(new CargaClienteExport($cargas), 'cargas.xlsx');
            }

            $relations = array_merge($relations, ['usuario', 'planta']);
            $cargas = Carga::with($relations)->orderBy('car_email_enviado')->get();

            return Excel::download(new CargaLogisticaExport($cargas), 'cargas.xlsx');
        } catch (\Throwable $th) {

            return redirect()->back()->with(['message' => 'Ocurrio un error al intentar descargar el excel', 'type' => 'error']);
        }
    }

    public function detalleCarga ($id)
    {
        $detalleCarga = Carga::findOrFail($id);
        return view('sistema.NotificacionCarga.detalle', compact('detalleCarga'));
    }

    public function sendEmail ($id)
    {

        $horaActual = Carbon::now();
        $carga = Carga::findOrFail($id);
        //dd($horaActual,$carga);
        if ($carga->car_email_enviado == 0) {
            return 'Error de envio, el correo ya fue enviado';
        }
        if ($carga->car_fecha_salida <= $horaActual) {
            return 'Error de envio, la fecha de salia es mejor a la actual, tiene que ser mayor o igual';
        }
        Mail::to($carga->usuario->usu_email)->send((new NotificacionCarga($carga)));
        return redirect()->route('cliente.index')->with(['message' => 'Se envió el correo exitosamente', 'type' => 'success']);
    }
}
