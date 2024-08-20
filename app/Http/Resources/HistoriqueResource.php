<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HistoriqueResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
   public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'action' => $this->action,
            'date_action' => $this->date_action,
            'utilisateur' => new UserResource($this->utilisateur),
            'document_id' => $this->document_id,
            'created_at' => $this->created_at,
        ];
    }
}
