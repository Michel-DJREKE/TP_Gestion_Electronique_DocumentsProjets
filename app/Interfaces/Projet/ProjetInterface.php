<?php
    namespace App\Interfaces\Projet;

use App\Http\Requests\Projet\ProjetRequest;
use App\Models\Projets;
use Illuminate\Support\Collection;

interface ProjetInterface
{
    public function all():Collection;
    public function find($id):Projets;
    public function create(ProjetRequest $request):Projets;
    public function update($id, ProjetRequest $request):Projets;
    public function delete($id);
    public function archiver($id);
}
