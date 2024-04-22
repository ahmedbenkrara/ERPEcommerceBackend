<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Modele;
use App\Http\Resources\ModeleResource;
use App\Http\Requests\ModeleRequest;
use App\Traits\HttpResponses;

class ModeleController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ModeleResource::collection(Modele::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ModeleRequest $request)
    {
        $request->validated();
        $modele = Modele::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'package_id' => $request->package_id
        ]);
        return new ModeleResource($modele);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $modele = Modele::find($id);
        if($modele){
            return new ModeleResource($modele);
        }else{
            return $this->error(null, 'Module Not Found', 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $modele = Modele::find($id);
        if($modele){
            $modele->update($request->all());
            return $this->success(new ModeleResource($modele), "Updated successfully", 200);
        }else{
            return $this->error(null, "Module not found", 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $modele = Modele::find($id);
        if($modele != null){
            $modele->delete();
            return $this->success(null, 'Deleted successfully', 204);
        }else{
            return $this->error(null,'Module not found', 404);
        }
    }
}
