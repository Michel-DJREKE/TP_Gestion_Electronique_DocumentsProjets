<?php
    namespace App\Interfaces\Document;
    use App\Http\Requests\Document\DocumentRequest;
    use App\Models\Documents;
    use Illuminate\Support\Collection;

    interface DocumentInterface
{
    public function all():Collection;
    public function find($id):Documents;
    public function create(DocumentRequest $request):Documents;
    public function update($id, DocumentRequest $request):Documents;
    public function delete($id);
}
