<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Documents extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable =
        [
            'nom',
            'chemin',
            'date_creation',
            'auteur',
            'date_derniere_modification',
            'dernier_utilisateur_modification',
            'historique_actions'
    ];



    public function projet():BelongsTo
    {
        return $this->BelongsTo(Projets::class);
    }
    public function dernierUtilisateurModification():BelongsTo
    {
        return $this->BelongsTo(User::class, 'dernier_utilisateur_modification');
    }
    public function historiques():BelongsToMany
    {
        return $this->BelongsToMany(User::class, 'historique')
            ->withPivot('action', 'action_date')
            ->withTimestamps();
    }

}

