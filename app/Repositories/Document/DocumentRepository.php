<?php

namespace App\Repositories\Document;

use App\Http\Requests\Document\DocumentRequest;
use App\Interfaces\Document\DocumentInterface;
use App\Models\Documents;
use Illuminate\Support\Collection;

class DocumentRepository implements DocumentInterface
{


    public function all(): Collection
    {
        return Documents::all();
    }

    public function find($id): Documents
    {
        return Documents::all()->find($id);
    }

    public function create(DocumentRequest $request): Documents
    {
        $data = $request->validated();

        return Documents::create($data);
    }

    public function update($id, DocumentRequest $request): Documents
    {
        $document = Documents::findOrFail($id);
        $document->update($request->validated());
        return $document;
    }

    public function delete($id)
    {
        $document = Documents::all()->find($id);
        $document->delete();
    }
}
