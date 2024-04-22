<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Package;
use App\Models\ModelImage;
use App\Models\Reviews;
use App\Models\Favorite;

class Modele extends Model
{
    use HasFactory;
    protected $table = 'modele';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'description', 'price', 'package_id'
    ];

    public function package(){
        return $this->belongsTo(Package::class);
    }

    public function images(){
        return $this->hasMany(ModelImage::class);
    }

    public function reviews(){
        return $this->hasMany(Reviews::class);
    }
}
