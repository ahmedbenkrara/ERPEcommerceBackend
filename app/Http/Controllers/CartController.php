<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Http\Resources\CartResource;
use App\Http\Requests\CartRequest;
use App\Traits\HttpResponses;

class CartController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CartResource::collection(
            Cart::all()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CartRequest $request)
    {
        $request->validated();
        $cart = Cart::create([
            'user_id' => $request->user_id
        ]);
        return new CartResource($cart);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cart = Cart::find($id);
        if($cart){
            return $this->success(new CartResource($cart));
        }else{
            return $this->error(null, 'Cart Not Found', 404);
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
        $cart = Cart::find($id);
        if($cart){
            $cart->delete();
            return $this->success(null, 'Deleted successfully', 204);
        }else{
            return $this->error(null,'Cart not found', 404);
        }
    }
}
