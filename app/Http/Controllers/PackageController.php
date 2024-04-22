<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Http\Resources\PackageResource;
use App\Http\Requests\PackageRequest;
use App\Traits\HttpResponses;

class PackageController extends Controller
{
    use HttpResponses;
    
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PackageResource::collection(Package::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PackageRequest $request)
    {
        $request->validated();
        $package = Package::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price
        ]);
        return new PackageResource($package);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $package = Package::find($id);
        if($package){
            return $this->success(new PackageResource($package));
        }else{
            return $this->error(null, 'Package Not Found', 404);
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
        $package = Package::find($id);
        if($package){
            $package->update($request->all());
            return $this->success(new PackageResource($package), "Updated successfully", 200);
        }else{
            return $this->error(null, "Package not found", 404);
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
        $package = Package::find($id);
        if($package != null){
            $package->delete();
            return $this->success(null, 'Deleted successfully', 204);
        }else{
            return $this->error(null,'Package not found', 404);
        }
    }
}
