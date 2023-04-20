<?php

namespace App\Http\Controllers\Sistema;

use App\Exports\NotificacionExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Notificacion\CreateNotificacionRequest;
use App\Http\Requests\Notificacion\UpdateNotificacionRequest;
use App\Http\Resources\NotificacionResource;
use App\Models\Cliente;
use App\Models\Frecuencia;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class NotificacionController extends Controller
{
    public function index()
    {
        return view('sistema.notificaciones.index');
    }

    public function list()
    {
        return NotificacionResource::collection(Frecuencia::all());
    }

    public function create()
    {
        $clientes = Cliente::all();
        $frecuencias = Frecuencia::all();
        return view('sistema.notificaciones.crear', compact('frecuencias','clientes'));
    }

    public function store(CreateNotificacionRequest $request)
    {
        try {
            $frecuencia = new Frecuencia();
            $frecuencia->fre_cliente_id = ucwords(strtolower($request->empresa));
            $frecuencia->fre_frecuencia = $request->frecuencia;
            $frecuencia->save();
            return redirect()->route('notificacion.index')->with(['message' => 'Se creo una frecuencia de notificación', 'type' => 'success']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['message' => 'Ocurrio un error al intentar crear una frecuencia', 'type' => 'error']);
        }
    }

    public function edit($id)
    {
        $frecuencias = Frecuencia::findOrFail($id);
        $clientes = Cliente::all();
        return view('sistema.notificaciones.editar', compact('frecuencias','clientes'));
    }

    public function update(UpdateNotificacionRequest $request, int $id)
    {
        try {
            $frecuencia = Frecuencia::findOrFail($id);
            $frecuencia->fre_cliente_id = ucwords(strtolower($request->empresa));
            $frecuencia->fre_frecuencia = $request->frecuencia;
            $frecuencia->save();
            return redirect()->route('notificacion.index')->with(['message' => 'Se editó la frecuencia de notificación', 'type' => 'success']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['message' => 'Ocurrio un error al intentar editar la frecuencia', 'type' => 'error']);
        }
    }

    public function delete(int $id)
    {
        try {
            $frecuencia = Frecuencia::findOrFail($id);
            $frecuencia ->delete();
            return redirect()->route('notificacion.index')->with(['message' => 'Notificación eliminada correctamente', 'type' => 'success']);
        } catch (\Throwable $th) {

            return redirect()->back()->with(['message' => 'Ocurrio un error al intentar eliminar la notificación', 'type' => 'error']);
        }
    }

    public function downloadExcel()
    {
        try {
            $frecuencia = Frecuencia::all();

            return Excel::download(new NotificacionExport($frecuencia), 'Notificaciones de frecuencia de correos.xlsx');
        } catch (\Throwable $th) {

            return redirect()->back()->with(['message' => 'Ocurrio un error al intentar descargar el excel', 'type' => 'error']);
        }
    }

}
