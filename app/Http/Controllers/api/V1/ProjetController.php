<?php

namespace App\Http\Controllers\api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Projet\ProjetRequest;
use App\Http\Resources\ProjetResource;
use App\Models\Projets;

class ProjetController extends Controller
{
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $projets = Projets::all();
        return ProjetResource::collection($projets);
    }

    public function store(ProjetRequest $request): ProjetResource
    {
        $data = $request->validated();
        $project = Projets::create($data);

        return new ProjetResource($project);
    }

    public function show($id): ProjetResource
    {
        $projet = Projets::findOrFail($id);
        return new ProjetResource($projet);
    }

    public function update(Request $request, $id): ProjetResource
    {
        $data = $request->validate([
            'libelle' => 'string',
            'client' => 'string',
            'date_debut' => 'date',
            'date_fin' => 'date',
        ]);

        $projet = Projets::findOrFail($id);
        $projet->update($data);

        return new ProjetResource($projet);
    }

    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $projet = Projets::findOrFail($id);
        $projet->delete();

        return response()->json(['message' => 'Projet supprimé avec succès']);
    }


    public function archiver($id): ProjetResource
    {
        $projet = Projets::findOrFail($id);
        $projet->update(['archivé' => true]);

        return new ProjetResource($projet);
    }


    public function desarchiver($projet_id): ProjetResource
    {
        $projet = Projets::findOrFail($projet_id);

        $projet->est_archive = false;
        $projet->save();

        return new ProjetResource($projet);
    }



}

