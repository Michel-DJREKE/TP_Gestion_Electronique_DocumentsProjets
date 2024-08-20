<?php

namespace App\Repositories\User;

use App\Http\Requests\User\UserRequest;
use App\Interfaces\User\UserInterface;
use App\Models\User;
use Illuminate\Support\Collection;

class UserRepository implements UserInterface
{


    public function all(): Collection
    {
        return User::all();
    }

    public function find($id): User
    {
        return User::all()->find($id);
    }

    public function create(UserRequest $request): User
    {
        $data = $request->validated();

        $data['mot_de_passe'] = bcrypt($request['mot_de_passe']);

        return User::create($data);
    }

    public function update($id, UserRequest $request): User
    {
        $user = User::all()->find($id);
        $user->update($request->validated());
        return $user;
    }

    public function delete($id)
    {
        $user = User::all()->find($id);
        $user->delete();
    }
}
