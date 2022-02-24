<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::paginate(5);
        $data['status'] = 200;
        $data['message'] = 'Success';
        $data['data'] =  $product;


        return response()->json($data, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_name'      => 'required|max:25|unique:products,product_name',
            'product_price'     => 'required|numeric|min:500|max:100000',
            'product_qty'  => 'required|numeric|min:1|max:100',
        ]);

        if ($validator->fails()) {
            $data = array(
                'status' => 422,
                'error' => 1,
                'message' =>  $validator->errors()
            );
            return response()->json($data, 422);
        }

        $product = Product::create($request->all());

        $data = array(
            'status' => 201,
            'error'  => 0,
            'message' => 'Product Created'
        );

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product)
    {
        $validator = Validator::make($request->all(), [
            'product_name'      => 'required|max:25|unique:products,product_name',
            'product_price'     => 'required|numeric|min:500|max:100000',
            'product_qty'  => 'required|numeric|min:1|max:100',
        ]);

        if ($validator->fails()) {
            $data = array(
                'status' => 422,
                'error' => 1,
                'message' =>  $validator->errors()
            );
            return response()->json($data, 422);
        }

        $product = Product::find($product);
        $product->update($request->all());


        $data = array(
            'status' => 202,
            'error'  => 0,
            'message' => 'Product Successfully Updated'
        );

        return response()->json($data, 202);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($product)
    {
        $product = Product::where('id', $product);
        $result = $product->delete();
        if ($result === 0) {
            $data = array(
            'status' => 422,
            'error'  => 1,
            'message' => 'Product can not be delete'
        );

            return response()->json($data, 422);
        }

        $data = array(
            'status' => 202,
            'error'  => 0,
            'message' => 'Product Successfully deleted'
        );

        return response()->json($data, 202);
    }
}
