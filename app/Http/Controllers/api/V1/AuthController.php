<?php

namespace App\Http\Controllers\api\V1;
use App\Http\Controllers\Controller;
use App\Http\Requests\Authentification\AuthRequest;
use App\Http\Requests\User\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    public function register(UserRequest $request): UserResource
    {
        $user = new User();
        $user->nom_complet = $request->input('nom_complet');
        $user->email = $request->input('email');
        $user->mot_de_passe = Hash::make($request->input('mot_de_passe'));
        $user->save();
        return new UserResource($user);

       // return response()->json(['message' => 'Inscription réussie'], Response::HTTP_CREATED);
    }

    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'mot_de_passe' => 'required|string',
        ]);

        if (!Auth::attempt([
            'email' => $credentials['email'],
            'mot_de_passe' => $credentials['mot_de_passe']
        ])) {
            throw ValidationException::withMessages([
                'email' => ['Les informations d\'identification fournies sont incorrectes😪.'],
            ]);
        }

        return response()->json(['message' => 'Connexion réussie']);
    }

    public function forgotPassword(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json(['message' => __($status)]);
        }

        return response()->json(['message' => __($status)], Response::HTTP_BAD_REQUEST);
    }

    public function resetPassword(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required|string',
            'mot_de_passe' => 'required|string|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'mot_de_passe', 'mot_de_passe_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'mot_de_passe' => Hash::make($request->mot_de_passe),
                ])->save();

                $user->setRememberToken(Str::random(60));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return response()->json(['message' => __($status)]);
        }

        return response()->json(['message' => __($status)], Response::HTTP_BAD_REQUEST);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'mot_de_passe_actuel' => 'required',
            'mot_de_passe' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->mot_de_passe_actuel, $user->mot_de_passe)) {
            return response()->json(['message' => 'Le mot de passe actuel est incorrect.'], Response::HTTP_BAD_REQUEST);
        }

        $user->update([
            'mot_de_passe' => $request->mot_de_passe,
        ]);

        return response()->json(['message' => 'Mot de passe mis à jour avec succès.']);
    }


    public function logout(): \Illuminate\Http\JsonResponse
    {
        Auth::logout();

        return response()->json(['message' => 'Déconnexion réussie']);
    }
}
