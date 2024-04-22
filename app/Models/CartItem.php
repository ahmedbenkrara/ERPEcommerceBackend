<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cart;
use App\Models\Package;
use App\Models\Modele;

class CartItem extends Model
{
    use HasFactory;
    protected $table = 'cartitem';
    protected $primaryKey = 'id';
    protected $fillable = [
        'cart_id', 'modele_id', 'package_id', 'quantity', 'type'
    ];

    public function cart(){
        return $this->belongsTo(Cart::class);
    }

    public function package(){
        return $this->belongsTo(Package::class);
    }

    public function modele(){
        return $this->belongsTo(Modele::class);
    }
}
