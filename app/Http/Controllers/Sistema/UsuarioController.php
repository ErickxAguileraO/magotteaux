<?php

namespace App\Http\Controllers\Sistema;

use App\Exports\TamanoDeBolasExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\TamnoBola\UpdateTamanoBolaRequest;
use App\Http\Requests\Usuario\CreateUsuarioRequest;
use App\Http\Requests\Usuario\UpdateUsuarioRequest;
use App\Http\Resources\TamanoBolaResource;
use App\Mail\Usuario\CuentaCreada;
use App\Models\Cliente;
use App\Models\Planta;
use App\Models\TamanoBola;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{

    public function index()
    {
        return view('sistema.usuario.index');
    }

    // public function list()
    // {
    //     return TamanoBolaResource::collection(TamanoBola::all());
    // }

    public function create()
    {
        $clientes = Cliente::with(['destinos' => function ($query) {
            $query->active();
        }])->active()->get();

        $plantas = Planta::active()->get();
        $destinos = $clientes->firstWhere('cli_id', old('cliente'))->destinos ?? [];

        return view('sistema.usuario.crear', compact('clientes', 'plantas', 'destinos'));
    }

    public function store(CreateUsuarioRequest $request)
    {
        try {

            DB::beginTransaction();

            $rol = Role::findOrFail($request->post('tipo_usuario'));

            $usuario = User::create([
                'usu_nombre' => $request->post('nombre'),
                'usu_apellido' => $request->post('apellido'),
                'usu_identificacion' => $request->post('identificacion'),
                'usu_celular' => $request->post('celular'),
                'usu_email' => $request->post('email'),
                'usu_estado' => $request->post('estado'),
                'usu_password' => $request->post('contrasena'),
                'usu_planta_id' => $request->post('tipo_usuario') == User::TIPO_LOGISTICA ? $request->post('planta') : null,
                'usu_cliente_id' => $request->post('tipo_usuario') == User::TIPO_CLIENTE ? $request->post('cliente') : null,
                'usu_destino_id' => $request->post('tipo_usuario') == User::TIPO_CLIENTE ? $request->post('destino') : null,
            ]);

            $usuario->assignRole($rol->name);

            Mail::to($usuario->usu_email)->send((new CuentaCreada($usuario, $request->post('contrasena')))->afterCommit());

            DB::commit();

            return redirect()->route('usuario.index')->with(['message' => 'Se creo un nuevo usuario correctamente', 'type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with(['message' => 'Ocurrio un error al intentar crear el usuario', 'type' => 'error']);
        }
    }

    public function edit(int $id)
    {
        $usuario = User::findOrFail($id);
        $clientes = Cliente::with(['destinos' => function ($query) {
            $query->active();
        }])->active()->get();

        $plantas = Planta::active()->get();
        $destinos = $clientes->firstWhere('cli_id', old('cliente', $usuario->usu_cliente_id))->destinos ?? [];

        return view('sistema.usuario.editar', compact('clientes', 'plantas', 'usuario', 'destinos'));
    }

    public function update(UpdateUsuarioRequest $request, int $id)
    {
        try {

            DB::beginTransaction();
            
            $usuario = User::findOrFail($id);
            $rol = Role::findOrFail($request->post('tipo_usuario'));

            $usuario->update([
                'usu_nombre' => $request->post('nombre'),
                'usu_apellido' => $request->post('apellido'),
                'usu_identificacion' => $request->post('identificacion'),
                'usu_celular' => $request->post('celular'),
                'usu_email' => $request->post('email'),
                'usu_estado' => $request->post('estado'),
                'usu_planta_id' => $request->post('tipo_usuario') == User::TIPO_LOGISTICA ? $request->post('planta') : null,
                'usu_cliente_id' => $request->post('tipo_usuario') == User::TIPO_CLIENTE ? $request->post('cliente') : null,
                'usu_destino_id' => $request->post('tipo_usuario') == User::TIPO_CLIENTE ? $request->post('destino') : null,
            ]);

            if ($request->post('contrasena')) {
                $usuario->update(['usu_password' => $request->post('contrasena')]);
            }

            $usuario->syncRoles($rol->name);

            DB::commit();

            return redirect()->route('usuario.index')->with(['message' => 'Se edito el usuario correctamente', 'type' => 'success']);
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->with(['message' => 'Ocurrio un error al intentar editar el usuario', 'type' => 'error']);
        }
    }

    // public function delete(int $id)
    // {
    //     try {
    //         TamanoBola::findOrFail($id)->delete();

    //         return redirect()->route('tamano.bola.index')->with(['message' => 'Tamaño de bola eliminado correctamente', 'type' => 'success']);
    //     } catch (\Throwable $th) {

    //         return redirect()->back()->with(['message' => 'Ocurrio un error al intentar eliminar el tamaño de bola', 'type' => 'error']);
    //     }
    // }

    // public function downloadExcel()
    // {
    //     try {
    //         $tamanos = TamanoBola::all();

    //         return Excel::download(new TamanoDeBolasExport($tamanos), 'tamaños-de-bola.xlsx');
    //     } catch (\Throwable $th) {

    //         return redirect()->back()->with(['message' => 'Ocurrio un error al intentar descargar el excel', 'type' => 'error']);
    //     }
    // }
}
