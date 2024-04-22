<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FavoriteRequest;
use App\Models\Favorite;
use App\Traits\HttpResponses;
use App\Http\Resources\FavoriteResource;

class FavoriteController extends Controller
{
    use HttpResponses;

    public function store(FavoriteRequest $request){
        $request->validated();
        $favorite = Favorite::create([
            'type' => $request->type,
            'modele_id' => $request->modele_id,
            'package_id' => $request->package_id,
            'user_id' => $request->user_id,
        ]);

        return new FavoriteResource($favorite);
    }

    public function destroy($id){
        $favorite = Favorite::find($id);
        if($favorite != null){
            $favorite->delete();
            return $this->success(null, 'Deleted successfully', 204);
        }else{
            return $this->error(null,'Favorite not found', 404);
        }
    }
}
