<?php

namespace App\Http\Controllers\Sistema;

use App\Exports\ChoferesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Chofer\CreateChoferRequest;
use App\Http\Requests\Chofer\UpdateChoferRequest;
use App\Http\Resources\ChoferResource;
use App\Mail\Usuario\CuentaCreada;
use App\Models\Chofer;
use App\Models\Cliente;
use App\Models\EmpresaTransporte;
use App\Models\Planta;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class ChoferController extends Controller
{

    public function index()
    {
        return view('sistema.chofer.index');
    }

    public function list()
    {
        $choferes = Chofer::with('empresaTransporte')->get();

        return ChoferResource::collection($choferes);
    }

    public function create()
    {
        $empresas = EmpresaTransporte::active()->get();

        return view('sistema.chofer.crear', compact('empresas'));
    }

    public function store(CreateChoferRequest $request)
    {
        try {
            Chofer::create([
                'cho_nombre' => $request->post('nombre'),
                'cho_apellido' => $request->post('apellido'),
                'cho_identificacion' => $request->post('identificacion'),
                'cho_empresa_id' => $request->post('empresa'),
                'cho_estado' => $request->post('estado'),
            ]);

            return redirect()->route('chofer.index')->with(['message' => 'Se creo un nuevo chofer correctamente', 'type' => 'success']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['message' => 'Ocurrio un error al intentar crear el chofer', 'type' => 'error']);
        }
    }

    public function edit(int $id)
    {
        $chofer = Chofer::findOrFail($id);
        $empresas = EmpresaTransporte::active()->get();

        return view('sistema.chofer.editar', compact('chofer', 'empresas'));
    }

    public function update(UpdateChoferRequest $request, int $id)
    {
        try {

            $chofer = Chofer::findOrFail($id);

            $chofer->update([
                'cho_nombre' => $request->post('nombre'),
                'cho_apellido' => $request->post('apellido'),
                'cho_identificacion' => $request->post('identificacion'),
                'cho_empresa_id' => $request->post('empresa'),
                'cho_estado' => $request->post('estado'),
            ]);

            return redirect()->route('chofer.index')->with(['message' => 'Se edito el chofer correctamente', 'type' => 'success']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['message' => 'Ocurrio un error al intentar editar el chofer', 'type' => 'error']);
        }
    }

    public function delete(int $id)
    {
        try {
            $chofer = Chofer::withExists('cargas')->findOrFail($id);

            if($chofer->cargas_exists) return redirect()->route('chofer.index')->with(['message' => 'No puedes eliminar un chofer ya asociado a una carga.', 'type' => 'success']);

            $chofer->delete();

            return redirect()->route('chofer.index')->with(['message' => 'Chofer eliminado correctamente', 'type' => 'success']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['message' => 'Ocurrio un error al intentar eliminar el chofer', 'type' => 'error']);
        }
    }

    public function downloadExcel()
    {
        try {
            $choferes = Chofer::with('empresaTransporte')->get();

            return Excel::download(new ChoferesExport($choferes), 'choferes.xlsx');
        } catch (\Throwable $th) {

            return redirect()->back()->with(['message' => 'Ocurrio un error al intentar descargar el excel', 'type' => 'error']);
        }
    }
}
