<?php

namespace App\Http\Controllers\Sistema;

use App\Exports\Carga\CargaClienteExport;
use App\Exports\Carga\CargaLogisticaExport;
use App\Http\Controllers\Controller;

use App\Mail\DespachoCarga\NotificacionCarga;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Carga\CreateCargaRequest;
use App\Http\Requests\Carga\UpdateCargaRequest;
use App\Http\Resources\Carga\CargaClienteResource;
use App\Http\Resources\Carga\CargaLogisticaResource;
use App\Models\Carga;
use App\Models\Chofer;
use App\Models\Cliente;
use App\Models\Destino;
use App\Models\EmpresaTransporte;
use App\Models\Patente;
use App\Models\Planta;
use App\Models\PuntoCarga;
use App\Models\TamanoBola;
use App\Models\TipoCarga;
use App\Models\User;
use App\Services\CargaService;
use App\Services\File\Factories\HandleFileFactory;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;


class CargaController extends Controller
{

    private $handleFileFactory;
    private $cargaService;

    public function __construct(HandleFileFactory $handleFileFactory, CargaService $cargaService)
    {
        $this->handleFileFactory = $handleFileFactory;
        $this->cargaService = $cargaService;
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
        $empresas = EmpresaTransporte::active()->get();
        $tipo_cargas = TipoCarga::active()->get();
        $tamano_bolas = TamanoBola::active()->get();
        $plantas = Planta::active()->where('pla_id', auth()->user()->usu_planta_id)->get();
        $clientes = Cliente::active()->get();
        $destinos = Destino::active()->where('des_cliente_id', old('cliente'))->get();
        $punto_cargas = PuntoCarga::active()->where('puc_planta_id', old('planta'))->get();
        $choferes = Chofer::active()->where('cho_empresa_id', old('empresa'))->get();
        $patentes = Patente::active()->where('pat_empresa_id', old('empresa'))->get();

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

            $carga = auth()->user()->cargas()->create([
                'car_fecha_carga' => $request->post('fecha_carga'),
                'car_fecha_salida' => $request->post('fecha_salida'),
                'car_empresa_id' => $request->post('empresa'),
                'car_planta_id' => $request->post('planta'),
                'car_tipo_id' => $request->post('tipo_carga'),
                'car_tamano_bola_id' => $request->post('tamano_bola'),
                'car_patente_id' => $request->post('patente'),
                'car_chofer_id' => $request->post('chofer'),
                'car_cliente_id' => $request->post('cliente'),
                'car_destino_id' => $request->post('destino'),
                'car_punto_carga_id' => $request->post('punto_carga'),
                'car_numero_guia_despacho' => $request->post('numero_guia_despacho'),
                'car_token' => Str::random(40)
            ]);

            $this->cargaService->storeFiles($carga, $request);

            return redirect()->route('carga.index')->with(['message' => 'Se creo un nueva carga correctamente', 'type' => 'success']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['message' => 'Ocurrio un error al intentar crear la carga', 'type' => 'error']);
        }
    }

    public function edit(int $id)
    {
        $carga = Carga::findOrFail($id);
        $empresas = EmpresaTransporte::active()->get();
        $tipo_cargas = TipoCarga::active()->get();
        $tamano_bolas = TamanoBola::active()->get();
        $plantas = Planta::active()->where('pla_id', auth()->user()->usu_planta_id)->get();
        $clientes = Cliente::active()->get();
        $destinos = Destino::active()->where('des_cliente_id', old('cliente', $carga->car_cliente_id))->get();
        $punto_cargas = PuntoCarga::active()->where('puc_planta_id', old('planta', $carga->car_planta_id))->get();
        $choferes = Chofer::active()->where('cho_empresa_id', old('empresa', $carga->car_empresa_id))->get();
        $patentes = Patente::active()->where('pat_empresa_id', old('empresa', $carga->car_empresa_id))->get();

        return view('sistema.carga.editar', compact(
            'carga',
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

    public function update(UpdateCargaRequest $request, int $id)
    {
        try {

            $carga = auth()->user()->cargas()->findOrFail($id);

            $carga->update([
                'car_fecha_carga' => $request->post('fecha_carga'),
                'car_fecha_salida' => $request->post('fecha_salida'),
                'car_empresa_id' => $request->post('empresa'),
                'car_planta_id' => $request->post('planta'),
                'car_tipo_id' => $request->post('tipo_carga'),
                'car_tamano_bola_id' => $request->post('tamano_bola'),
                'car_patente_id' => $request->post('patente'),
                'car_chofer_id' => $request->post('chofer'),
                'car_cliente_id' => $request->post('cliente'),
                'car_destino_id' => $request->post('destino'),
                'car_punto_carga_id' => $request->post('punto_carga'),
                'car_numero_guia_despacho' => $request->post('numero_guia_despacho'),
            ]);

            $this->cargaService->updateFiles($carga, $request);

            return redirect()->route('carga.index')->with(['message' => 'Se edito la carga correctamente', 'type' => 'success']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['message' => 'Ocurrio un error al intentar editar la carga', 'type' => 'error']);
        }
    }

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

    public function detalleCargaCorreo($id, $token)
    {
        $detalleCarga = Carga::where('car_token', $token)->findOrFail($id);

        return view('sistema.NotificacionCarga.detalle', compact('detalleCarga'));
    }

    public function sendEmail($id)
    {
        $horaActual = Carbon::now();
        $carga = Carga::findOrFail($id);
        $usuarioCliente = User::role('Cliente')->get();
        $usuarioLogistica = User::role('Logistica')->get();
        $correoLogistica = [];
        $correoClientes = [];

        foreach ($usuarioCliente as $clientes) {
            if ($clientes['usu_destino_id'] == $carga->car_destino_id) {
                $correoClientes[] = $clientes['usu_email'];
            }
        }

        foreach ($usuarioLogistica as $logistica) {
            if ($logistica['usu_planta_id'] == $carga->car_planta_id) {
                $correoLogistica[] = $logistica['usu_email'];
            }
        }

        if ($carga->car_email_enviado == 1) {
            return redirect()->route('carga.index')->with(['message' => 'No se puede enviar el correo más de una vez', 'type' => 'error']);
        }
        if ($carga->car_fecha_salida > $horaActual) {
            return redirect()->route('carga.index')->with(['message' => 'La fecha de salia es mayor a la actual, la fecha actual tiene que ser mayor o igual a la de salida', 'type' => 'error']);
        }
        $carga->update([
            'car_email_enviado' => 1,
        ]);


        Mail::to($correoClientes)->bcc($correoLogistica)->send((new NotificacionCarga($carga)));
        return redirect()->route('carga.index')->with(['message' => 'Se envió el correo exitosamente', 'type' => 'success']);
    }

    public function show($id)
    {
        $carga = Carga::findOrFail($id);

        return view('sistema.carga.detalle', compact('carga'));
    }
}
