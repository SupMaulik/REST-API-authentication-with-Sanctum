<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Product;

class ProductController extends Controller
{
     public function insert(Request $req)
     {
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


     public function update(Request $req)
     {

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

     public function display()
     {
        return Product::all();
     }

     public function delete(Request $req)
     {
        $result=Product::find($req->id);

        if($result)
        {
            $result->delete();
          return ["message"=>"Record Deleted Successfully"];
        }
        else
        {
          return ["message"=>"Record not found"];
        }


     }

     public function search(Request $req)
     {
          $product= Product::where('name','like','%'.$req->name.'%')->get();

          if($product)
          {
              
            return $product->toArray();
          }
          else
          {
            return ["message"=>"Record not found"];
          }

     }
}
