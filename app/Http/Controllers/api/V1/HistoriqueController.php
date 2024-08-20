<?php

namespace App\Http\Controllers\api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Historique\HistoriqueRequest;
use App\Http\Resources\HistoriqueResource;
use App\Models\Historiques;

class HistoriqueController extends Controller
{
    public function store(HistoriqueRequest $request)
    {
        $historique = Historiques::create([
            'user_id' => $request->user_id,
            'document_id' => $request->document_id,
            'action' => $request->action,
        ]);
        return new HistoriqueResource($historique);
    }

    public function index($documentId): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $historiques = Historiques::where('document_id', $documentId)->get();
        return HistoriqueResource::collection($historiques);
    }

    public function remove(HistoriqueRequest $request): \Illuminate\Http\JsonResponse
    {
        $historique = Historiques::findOrFail($request->historique_id);
        $historique->delete();
        return response()->json(['message' => 'Historique supprimé avec succès 😊.']);
    }
}
