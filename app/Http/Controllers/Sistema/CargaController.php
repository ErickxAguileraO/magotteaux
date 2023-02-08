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
use App\Models\Cliente;
use App\Models\Destino;
use App\Models\EmpresaTransporte;
use App\Models\Planta;
use App\Models\PuntoCarga;
use App\Models\TamanoBola;
use App\Models\TipoCarga;
use App\Services\File\Factories\HandleFileFactory;
use App\Services\File\Services\DeleteFileService;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;


class CargaController extends Controller
{

    private $handleFileFactory;
    private $deleteFileService;

    public function __construct(HandleFileFactory $handleFileFactory, DeleteFileService $deleteFileService)
    {
        $this->handleFileFactory = $handleFileFactory;
        $this->deleteFileService = $deleteFileService;
    }

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

        $tipo_cargas = TipoCarga::active()->get();
        $tamano_bolas = TamanoBola::active()->get();
        $plantas = Planta::active()->get();
        $clientes = Cliente::active()->get();
        $destinos = Destino::active()->where('des_cliente_id', old('cliente'))->get();
        $punto_cargas = PuntoCarga::active()->where('puc_planta_id', old('planta'))->get();
        $empresa = $empresas->firstWhere('emt_id', old('empresa'));
        $choferes = $empresa->choferes ?? [];
        $patentes = $empresa->patentes ?? [];

        return view('sistema.carga.crear', compact(
            'empresas',
            'choferes',
            'patentes',
            'tipo_cargas',
            'tamano_bolas',
            'plantas',
            'punto_cargas',
            'clientes',
            'destinos',
        ));
    }

    public function store(CreateCargaRequest $request)
    {
        try {
            $directorio = 'private/documentos/' . time() . '/';
            $foto_patente = $this->handleFileFactory->instance($request->file('foto_patente'));
            $foto_carga = $this->handleFileFactory->instance($request->file('foto_carga'));
            $certificado_calidad = $this->handleFileFactory->instance($request->file('certificado_calidad'));
            $guia_despacho = $this->handleFileFactory->instance($request->file('guia_despacho'));

            $carga = auth()->user()->cargas()->create([
                'car_fecha_carga' => $request->post('fecha_carga'),
                'car_fecha_salida' => $request->post('fecha_salida'),
                'car_empresa_id' => $request->post('empresa'),
                'car_planta_id' => $request->post('planta'),
                'car_tipo_id' => $request->post('tipo'),
                'car_tamano_bola_id' => $request->post('tamano_bola'),
                'car_patente_id' => $request->post('patente'),
                'car_chofer_id' => $request->post('chofer'),
                'car_cliente_id' => $request->post('cliente'),
                'car_destino_id' => $request->post('destino'),
                'car_punto_carga_id' => $request->post('punto_carga'),
                'car_token' => Str::random(40),
                'car_guia_despacho' => $directorio . $guia_despacho->getFullName(),
                'car_certificado_calidad' => $directorio . $certificado_calidad->getFullName(),
                'car_imagen_patente' => $directorio . $foto_patente->getFullName(),
                'car_imagen_carga' => $directorio . $foto_carga->getFullName(),
            ]);

            $foto_patente->upload($directorio);
            $foto_carga->upload($directorio);
            $certificado_calidad->upload($directorio);
            $guia_despacho->upload($directorio);

            return redirect()->route('chofer.index')->with(['message' => 'Se creo un nueva carga correctamente', 'type' => 'success']);
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->with(['message' => 'Ocurrio un error al intentar crear la carga', 'type' => 'error']);
        }
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

    public function detalleCarga($id)
    {
        $detalleCarga = Carga::findOrFail($id);
        return view('sistema.NotificacionCarga.detalle', compact('detalleCarga'));
    }

    public function sendEmail($id)
    {

        $horaActual = Carbon::now();
        $carga = Carga::findOrFail($id);
        //dd($horaActual,$carga);
        if ($carga->car_email_enviado == 0) {
            return 'Error de envio, el correo ya fue enviado';
        }
        if ($carga->car_fecha_salida < $horaActual) {
            return 'Error de envio, la fecha de salia es mejor a la actual, tiene que ser mayor o igual';
        }

        Mail::to($carga->usuario->usu_email)->send((new NotificacionCarga($carga)));
        return redirect()->route('cliente.index')->with(['message' => 'Se envió el correo exitosamente', 'type' => 'success']);
    }
}
