<?php

namespace App\Http\Controllers\api\V1;
use App\Http\Controllers\Controller;
use App\Http\Resources\DocumentResource;
use App\Models\Documents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Node\Block\Document;

class DocumentController extends Controller
{
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $documents = Documents::all();
        return DocumentResource::collection($documents);
    }

    public function store(Request $request): DocumentResource
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'chemin_acces' => 'required|string|max:255',
            'date_creation' => 'required|date',
            'auteur_id' => 'required|integer|exists:users,id',
            'date_derniere_modification' => 'nullable|date',
            'dernier_utilisateur_id' => 'nullable|integer|exists:users,id',
            'historique_actions' => 'nullable|string',
        ]);

        $document = Documents::create($data);

        return new DocumentResource($document);
    }

    public function show($id)
    {
        $document = Documents::findOrFail($id);
        return new DocumentResource($document);
    }

    public function update(Request $request, $id): DocumentResource
    {
        $data = $request->validate([
            'nom' => 'sometimes|string|max:255',
              'chemin_acces' => 'sometimes|string|max:255',
            'date_creation' => 'sometimes|date',
             'auteur_id' => 'sometimes|integer|exists:users,id',
              'date_derniere_modification' => 'nullable|date',
            'dernier_utilisateur_id' => 'nullable|integer|exists:users,id',
            'historique_actions' => 'nullable|string',
        ]);

        $document = Documents::findOrFail($id);
        $document->update($data);

        return new DocumentResource($document);
    }

    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $document = Documents::findOrFail($id);

        Storage::disk('public')->delete($document->chemin_acces);

        $document->delete();

        return response()->json(['message' => 'Document supprimé avec succès']);
    }

    public function upload(Request $request): DocumentResource
    {
        $request->validate([
            'document' => 'required|file|mimes:pdf,doc,docx,txt|max:51200',
            'nom' => 'required|string|max:255',
            'client' => 'required|string|max:255',
            'projet' => 'required|string|max:255',
        ]);

         $file = $request->file('document');
        $client = $request->input('client');
           $projet = $request->input('projet');
        $chemin_acces = $file->storeAs("documents/{$client}/{$projet}", $file->getClientOriginalName(), 'public');

        $document = Documents::create([
            'nom' => $request->input('nom'),
            'chemin_acces' => $chemin_acces,
            'date_creation' => now(),
            'auteur_id' => Auth::id(),
            'date_derniere_modification' => now(),
            'dernier_utilisateur_id' => Auth::id(),
        ]);

        return new DocumentResource($document);
    }
    public function archiver($document_id): DocumentResource
    {
        $document = Documents::findOrFail($document_id);

        $document->est_archive = true;
        $document->save();

        return new DocumentResource($document);
    }

    public function desarchiver($document_id): DocumentResource
    {
        $document = Documents::findOrFail($document_id);

        $document->est_archive = false;
        $document->save();

        return new DocumentResource($document);
    }


}

