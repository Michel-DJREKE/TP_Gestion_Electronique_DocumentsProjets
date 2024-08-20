<?php

namespace App\UseCases\Document;
use App\Models\Documents;
use App\Repositories\Document\DocumentRepository;
use Illuminate\Support\Collection;

class DocumentUseCase
{
    private DocumentRepository $documentRepository;
    public function __construct(DocumentRepository $documentRepository)
    {
        $this->documentRepository = $documentRepository;
    }

    public function all():Collection
    {
       return $this->documentRepository->all();
    }
    public function find($id):Documents
    {
       return $this->documentRepository->find($id);
    }
    public function create( $data):Documents
    {
        return $this->documentRepository->create($data);
    }
    public function update($id,  $data):Documents
    {
        return $this->documentRepository->update($id,  $data);
    }
    public function delete($id): void
    {
         $this->documentRepository->delete($id);
    }

}
