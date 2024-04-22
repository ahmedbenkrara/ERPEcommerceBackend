<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ClientDetails extends Model
{
    use HasFactory;
    protected $table = 'clientdetails';
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'user_id', 'phone', 'address', 'picture'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
