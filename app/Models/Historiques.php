<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historiques extends Model
{
    use HasFactory;
    protected $table = 'historique';

    protected $fillable = ['user_id', 'document_id', 'action', 'action_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function document()
    {
        return $this->belongsTo(Documents::class);
    }
}
