<?php
    namespace App\Interfaces\Historique;

use App\Models\Historiques;


interface HistoriqueInterface
{
    public function storeHistorique($userId, $documentId, $action):Historiques;
    public function getHistoriqueByDocument($documentId):Historiques;
    public function removeHistorique():void;
}
