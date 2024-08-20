<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Projets extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable =
        [
            'libelle',
            'client',
            'date_debut',
            'date_fin',
            'est_archive'
        ];

   
    public function documents():HasMany
    {
        return $this->HasMany(Documents::class);
    }
}
