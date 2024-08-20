<?php

namespace App\UseCases\Projet;

use App\Models\Projets;
use App\Repositories\Projet\ProjetRepository;
use Illuminate\Support\Collection;

class ProjetUseCase
{
    private ProjetRepository $projetRepository;
    public function __construct(ProjetRepository $projetRepository)
    {
        $this->projetRepository = $projetRepository;
    }
         public function all():Collection
         {
            return $this->projetRepository->all();
         }
        public function find($id):Projets
        {
            return $this->projetRepository->find($id);
        }
            public function create( $data):Projets
        {
         return $this->projetRepository->create($data);
    }
        public function update($id,  $data):Projets
        {
            return $this->projetRepository->update($id, $data);
        }
        public function delete($id): void
        {
             $this->projetRepository->delete($id);
        }
         public function archiver($id): void
        {
          $this->projetRepository->archiver($id);
         }

}
