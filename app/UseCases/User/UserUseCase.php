<?php

namespace App\UseCases\User;

use App\Http\Requests\User\UserRequest;
use App\Models\User;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Collection;

class UserUseCase
{
    private UserRepository $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function all():Collection
    {
        return $this->userRepository->all();
    }
    public function find($id):User
    {
        return $this->userRepository->find($id);
    }
    public function create(UserRequest $data):User
    {
        return $this->userRepository->create( $data);
    }
    public function update($id,UserRequest $data):User
    {
        return $this->userRepository->update($id, $data);
    }
    public function delete($id): void
    {
         $this->userRepository->delete($id);
    }
}
