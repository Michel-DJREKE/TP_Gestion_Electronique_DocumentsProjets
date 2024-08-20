<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $date_derniere_modification
 */
class DocumentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id' => $this->id,
            'nom' => $this->nom,
            'chemin_acces' => url("/storage/{$this->chemin_acces}"),
            'est_archive' => $this->est_archive,
            'date_creation' => $this->date_creation,
            'auteur' => new UserResource($this->auteur),
            'date_derniere_modification' => $this->date_derniere_modification,
            'dernier_utilisateur' => new UserResource($this->dernierUtilisateur),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
