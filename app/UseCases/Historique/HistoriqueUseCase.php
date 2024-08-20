<?php

namespace App\UseCases\Historique;

use App\Repositories\Historique\HistoriqueRepository;

class HistoriqueUseCase
{
    protected HistoriqueRepository $historiqueRepository;

    public function __construct(HistoriqueRepository $historiqueRepository)
    {
        $this->historiqueRepository = $historiqueRepository;
    }

    public function handle($userId, $documentId, $action)
    {
        return $this->historiqueRepository->storeHistorique($userId, $documentId, $action);
    }

    public function getHistoriqueByDocument($documentId)
    {
        return $this->historiqueRepository->getHistoriqueByDocument($documentId);
    }

    public function handleRemove($historiqueId)
    {
        return $this->historiqueRepository->removeHistorique($historiqueId);
    }
}

