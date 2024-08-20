<?php

namespace App\Http\Controllers\api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UtilisateurController extends Controller
{
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $users = User::all();
        return UserResource::collection($users);
    }





    public function store(UserRequest $request): UserResource
    {

        $user = new User();
        $user->nom_complet = $request->input('nom_complet');
        $user->email = $request->input('email');
        $user->mot_de_passe = Hash::make($request->input('mot_de_passe'));
        $user->save();
        return new UserResource($user);


       // $data = $request->validated();
       // $data['mot_de_passe'] = bcrypt($data['mot_de_passe']);
       // $user = User::create($data);

       // return new UserResource($user);
    }

    public function show($id): UserResource
    {
        $user = User::findOrFail($id);
        return new UserResource($user);
    }

    public function update(Request $request, $id): UserResource
    {
        $data = $request->validate([
            'nom_complete' => 'string',
            'email' => 'email|unique:users,email,' . $id,
            'mot_de_passe' => 'string|min:6',
        ]);

        if (isset($data['mot_de_passe'])) {
            $data['mot_de_passe'] = bcrypt($data['mot_de_passe']);
        }

        $user = User::findOrFail($id);
        $user->update($data);

        return new UserResource($user);
    }

    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'Utilisateur supprimé avec succès']);
    }

    public function activer(Request $request): UserResource
    {
        $request->validate([
            'utilisateur_id' => 'required|exists:utilisateurs,id',
        ]);

        $utilisateur = User::findOrFail($request->utilisateur_id);

        $utilisateur->est_actif = true;
        $utilisateur->save();

        return new UserResource($utilisateur);
    }


    public function desactiver(Request $request): UserResource
    {
        $request->validate([
            'utilisateur_id' => 'required|exists:utilisateurs,id',
        ]);

        $utilisateur = User::findOrFail($request->utilisateur_id);

        $utilisateur->est_actif = false;
        $utilisateur->save();

        return new UserResource($utilisateur);
    }


}
