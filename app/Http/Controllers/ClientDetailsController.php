<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientDetails;
use App\Http\Resources\ClientDetailsResource;
use App\Http\Requests\ClientDetailsRequest;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\File;

class ClientDetailsController extends Controller
{
    use HttpResponses;
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientDetailsRequest $request)
    {
        $request->validated();
        if($request->picture != null){
            $image = $request->picture;
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $request->picture->move('profilepics/',$imageName);
        }else{
            $imageName = "profilepics/default.jpg";
        }

        $details = ClientDetails::create([
            'user_id' => $request->user_id,
            'address' => $request->address,
            'phone' => $request->phone,
            'picture' => 'profilepics/'.$imageName
        ]);
        return new ClientDetailsResource($details);
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
        $req = $request->except(['_method']);
        $details = ClientDetails::where('user_id',$id)->first();
        if($request->picture != null){
            $image = $request->picture;
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $request->picture->move('profilepics/',$imageName);
            File::delete($details->picture);
            $req['picture'] = 'profilepics/'.$imageName;
        }

        if($details){
            $details->update($req);
            return $this->success($details, "Updated successfully", 200);
        }else{
            if($request->picture != null){
                $image = $request->picture;
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $request->picture->move('profilepics/',$imageName);
            }else{
                $imageName = "profilepics/default.jpg";
            }
    
            $details = ClientDetails::create([
                'user_id' => $id,
                'address' => $request->address,
                'phone' => $request->phone,
                'picture' => 'profilepics/'.$imageName
            ]);

            return $this->success($details, "Updated successfully", 200);
        }
    }
}
