<?php
use App\Http\Controllers\api\v1\DocumentController;
use App\Http\Controllers\api\v1\HistoriqueController;
use App\Http\Controllers\api\v1\ProjetController;
use App\Http\Controllers\api\v1\UtilisateurController;
use App\Http\Controllers\api\v1\AuthController;
use Illuminate\Support\Facades\Route;

// Routes d'authentification
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/logout', [AuthController::class, 'logout']);

Route::post('/auth/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/auth/reset-password', [AuthController::class, 'resetPassword']);
Route::post('/auth/update-password', [AuthController::class, 'updatePassword'])->middleware('auth');

Route::get('/utilisateurs', [UtilisateurController::class, 'index']);
Route::post('/utilisateur', [UtilisateurController::class, 'store']);

Route::get('/utilisateurs/{user_id}', [UtilisateurController::class, 'show']);
Route::put('/utilisateur/{user_id}', [UtilisateurController::class, 'update']);
Route::delete('/utilisateur/{user_id}', [UtilisateurController::class, 'destroy']);
Route::patch('/utilisateurs/{user_id}/activer', [UtilisateurController::class, 'activer']);
Route::patch('/utilisateurs/{user_id}/desactiver', [UtilisateurController::class, 'desactiver']);

Route::post('/projets', [ProjetController::class, 'store'])->middleware('auth');
Route::get('/projets', [ProjetController::class, 'index']);
Route::get('/projets/{projet_id}', [ProjetController::class, 'show'])->where('projet_id', '[0-9]+');
Route::put('/projets/{projet_id}', [ProjetController::class, 'update'])->where('projet_id', '[0-9]+')->middleware('auth');
Route::patch('/projets/{projet_id}/archiver', [ProjetController::class, 'archiver'])->where('projet_id', '[0-9]+')->middleware('auth');
Route::patch('/projets/{projet_id}/desarchiver', [ProjetController::class, 'desarchiver'])->where('projet_id', '[0-9]+')->middleware('auth');
Route::delete('/projets/{projet_id}', [ProjetController::class, 'destroy'])->where('projet_id', '[0-9]+')->middleware('auth');

Route::post('/documents', [DocumentController::class, 'store'])->middleware('auth');
Route::get('/documents', [DocumentController::class, 'index']);
Route::post('documents/upload', [DocumentController::class, 'upload']);
Route::get('/documents/{document_id}', [DocumentController::class, 'show'])->where('document_id', '[0-9]+');
Route::put('/documents/{document_id}', [DocumentController::class, 'update'])->where('document_id', '[0-9]+')->middleware('auth');
Route::delete('/documents/{document_id}', [DocumentController::class, 'destroy'])->where('document_id', '[0-9]+')->middleware('auth');

Route::patch('/documents/{document_id}/archiver', [DocumentController::class, 'archiver'])->where('document_id', '[0-9]+')->middleware('auth');

Route::patch('/documents/{document_id}/desarchiver', [DocumentController::class, 'desarchiver'])->where('document_id', '[0-9]+')->middleware('auth');

Route::get('/historiques', [HistoriqueController::class, 'index']);
Route::post('/historiques', [HistoriqueController::class, 'store']);
Route::delete('/historiques/{historique_id}', [HistoriqueController::class, 'remove'])->where('historique_id', '[0-9]+')->middleware('auth');


































