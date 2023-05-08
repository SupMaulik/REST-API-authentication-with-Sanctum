<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $product=Product::all();
        return $product->toArray();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        //

        
        $rules=["name"=>'required',
                   "price"=>'required'
          
          
                ];

                $validator=Validator::make($req->all(),$rules);

           if($validator->fails())
           {
               echo $validator->errors();

           }
           else
           {
              $product=new Product;
              $product->name=$req->name;
              $product->price=$req->price;
              $check=$product->save();

              if($check)
              {
                  return ["messsage"=>"Record inserted Successfully"];

              }
              else
              {
                return ["messsage"=>"Opertion failed"];
              }
           
          }

           
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req)
    {
        //
        

        $product=Product::find($req->id);
        
        
        if($product)
        {
          $product->name=$req->name;
          $product->price=$req->price;
          $check=$product->save();
         
              if($check)
              {
                return ["message"=>"Record Updated Successfully"];
              }
              else
              {
                return ["message"=>"Operation Failed"];
              }

        }
        else
        {
            return ["message"=>"Record not found"];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $req)
    {

        $result=Product::find($req->id);

        if($result)
        {
            $result->delete();
            return ["message"=>"Record deleated Successfully"];

        }
        else
        {
            return ["message"=>"Operation failed"];
        }
    }
}
