<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Modele;
use App\Models\Package;
use App\Models\User;

class Favorite extends Model
{
    use HasFactory;
    protected $table = 'favorite';
    protected $primaryKey = 'id';
    protected $fillable = [
        'type', 'user_id', 'modele_id', 'package_id'
    ];

    public function modele(){
        return $this->belongsTo(Modele::class);
    }

    public function package(){
        return $this->belongsTo(Package::class);
    }
}
