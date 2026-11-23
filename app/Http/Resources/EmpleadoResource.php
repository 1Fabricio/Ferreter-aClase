<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmpleadoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'identidad'       => $this->identidad,
            'codigo_empleado' => $this->codigo_empleado,
            'nombre'          => $this->nombre,
            'apellido'        => $this->apellido,
            'nombre_completo' => $this->nombre . ' ' . $this->apellido,
            'cargo'           => $this->cargo,
            'salario'         => (float) $this->salario,
            'fecha_ingreso'   => $this->fecha_ingreso,
            'created_at'      => $this->created_at?->toDateTimeString(),
            'updated_at'      => $this->updated_at?->toDateTimeString(),
        ];
    }
}