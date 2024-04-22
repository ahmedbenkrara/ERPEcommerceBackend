<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Http\Resources\CartItemResource;
use App\Http\Requests\CartItemRequest;
use App\Traits\HttpResponses;

class CartItemController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CartItemResource::collection(
            CartItem::all()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CartItemRequest $request)
    {
        $request->validated();
        $find = CartItem::where([['modele_id',$request->modele_id], ['package_id',$request->package_id], ['cart_id',$request->cart_id]])->first();
        if($find){
            $find->update([
                'quantity' => $find->quantity+1
            ]);
            return new CartItemResource($find);
        }
        $item = CartItem::create([
            'cart_id' => $request->cart_id,
            'modele_id' => $request->modele_id,
            'package_id' => $request->package_id,
            'quantity' => $request->quantity, 
            'type' => $request->type
        ]);
        return new CartItemResource($item);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = CartItem::find($id);
        if($item){
            return $this->success(new CartItemResource($item));
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
        $item = CartItem::find($id);
        if($item){
            $item->update($request->all());
            return $this->success(new CartItemResource($item), "Updated successfully", 200);
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
        $item = CartItem::find($id);
        if($item != null){
            $item->delete();
            return $this->success(null, 'Deleted successfully', 204);
        }else{
            return $this->error(null,'Item not found', 404);
        }
    }

    public function deleteByCartId($id){
        CartItem::where('cart_id', $id)->delete();
        return $this->success(null, 'Deleted successfully', 204);
    }
}
