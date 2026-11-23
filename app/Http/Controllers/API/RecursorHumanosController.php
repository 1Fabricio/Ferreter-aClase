<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmpleadoResource;
use App\Models\Empleado;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RecursorHumanosController extends Controller
{
    public function index(): JsonResponse
    {
        $empleados = Empleado::orderBy('id', 'desc')->paginate(10);

        return response()->json([
            'status' => 'success',
            'data'   => EmpleadoResource::collection($empleados),
            'pagination' => [
                'total'        => $empleados->total(),
                'per_page'     => $empleados->perPage(),
                'current_page' => $empleados->currentPage(),
                'last_page'    => $empleados->lastPage(),
            ],
        ], 200);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate(Empleado::reglas());

        $empleado = Empleado::create($data);

        return response()->json([
            'status'  => 'success',
            'message' => 'Empleado registrado correctamente',
            'data'    => new EmpleadoResource($empleado),
        ], 201);
    }

    public function show(string $id): JsonResponse
    {
        $empleado = Empleado::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data'   => new EmpleadoResource($empleado),
        ], 200);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $empleado = Empleado::findOrFail($id);

        $data = $request->validate(Empleado::reglas($empleado->id));

        $empleado->update($data);

        return response()->json([
            'status'  => 'success',
            'message' => 'Empleado actualizado correctamente',
            'data'    => new EmpleadoResource($empleado),
        ], 200);
    }

    public function destroy(string $id): JsonResponse
    {
        Empleado::findOrFail($id)->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Empleado eliminado correctamente',
        ], 200);
    }
}