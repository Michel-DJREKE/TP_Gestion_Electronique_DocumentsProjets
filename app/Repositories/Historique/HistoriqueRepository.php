<?php

namespace App\Repositories\Historique;

use App\Interfaces\Historique\HistoriqueInterface;
use App\Models\Historiques;

class HistoriqueRepository implements HistoriqueInterface

{
    public function storeHistorique($userId, $documentId, $action): Historiques
    {
        return Historiques::create([
            'user_id' => $userId,
            'document_id' => $documentId,
            'action' => $action,
            'action_date' => now(),
        ]);
    }

    public function getHistoriqueByDocument($documentId): Historiques
    {
        return Historiques::where('document_id', $documentId)->get();
    }

    public function removeHistorique(): void
    {
        $historique = Historiques::all();
        $historique->delete();
    }

}
