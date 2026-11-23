<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductoResource extends JsonResource
{
    /**
     * Transforma el recurso en un array estructurado y seguro.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'nombre'         => $this->nombre,
            'descripcion'    => $this->descripcion ?? 'Sin descripción',
            // Formateo del precio en Lempiras para la interfaz de usuario
            'precio'         => (float) $this->precio,
            'precio_hnl'     => 'L. ' . number_format((float) $this->precio, 2),
            'disponibilidad' => $this->stock > 0 ? 'En Existencia' : 'Agotado',
            'stock_unidades' => (int) $this->stock,
            'fecha_registro' => $this->created_at?->format('d/m/Y h:i A'),
        ];
    }
}