<?php
    namespace App\Interfaces\User;

    use App\Http\Requests\User\UserRequest;
    use App\Models\User;
    use Illuminate\Support\Collection;

    interface UserInterface
    {
    public function all():Collection;
    public function find($id):User;
    public function create(UserRequest $request):User;
    public function update($id, UserRequest $request):User;
    public function delete($id);
    }

