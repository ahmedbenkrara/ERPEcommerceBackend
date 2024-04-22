<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem;
use App\Http\Resources\OrderItemResource;
use App\Http\Requests\OrderItemRequest;
use App\Traits\HttpResponses;

class OrderItemController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return OrderItemResource::collection(
            OrderItem::all()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderItemRequest $request)
    {
        $request->validated();
        $item = OrderItem::create([
            'order_id' => $request->order_id,
            'modele_id' => $request->modele_id,
            'package_id' => $request->package_id,
            'quantity' => $request->quantity, 
            'type' => $request->type
        ]);
        return new OrderItemResource($item);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = OrderItem::find($id);
        if($item){
            return $this->success(new OrderItemResource($item));
        }else{
            return $this->error(null, 'Item Not Found', 404);
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
        $item = OrderItem::find($id);
        if($item){
            $item->update($request->all());
            return $this->success(new OrderItemResource($item), "Updated successfully", 200);
        }else{
            return $this->error(null, "Item not found", 404);
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
        $item = OrderItem::find($id);
        if($item != null){
            $item->delete();
            return $this->success(null, 'Deleted successfully', 204);
        }else{
            return $this->error(null,'Item not found', 404);
        }
    }
}
