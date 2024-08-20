<?php

namespace App\Repositories\Projet;

use App\Http\Requests\Projet\ProjetRequest;
use App\Interfaces\Projet\ProjetInterface;
use App\Models\Projets;
use Illuminate\Support\Collection;

class ProjetRepository implements ProjetInterface
{


    public function all(): Collection
    {
        return Projets::all();
    }

    public function find($id): Projets
    {
        return Projets::all()->find($id);
    }

    public function create(ProjetRequest $request): Projets
    {
        $data = $request->validated();

        return Projets::create($data);
    }

    public function update($id, ProjetRequest $request): Projets
    {
        $projet = Projets::findOrFail($id);
        $projet->update($request->validated());
        return $projet;
    }


    public function delete($id)
    {
        $projet = Projets::all()->find($id);
        $projet->delete();
    }

    public function archiver($id)
    {
        $projet = Projets::all()->find($id);
        $projet->delete();
    }
}
