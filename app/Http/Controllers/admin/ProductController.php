<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product;

class ProductController extends Controller
{
    public function create()
    {
        
        return view('administrator/ProductManager/add-product');
    }

    public function index()
    {
        $data = product::all();
        return view('administrator/ProductManager/products',array('data'=>$data));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product'     => 'required|unique:products',
            'rgPrice'     => 'numeric',
            'slPrice'     => 'required|numeric',
            'prodImg'     => 'required|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
            'type'        => 'required',
            'status'      => 'required',
        ]);

        //$path = $request->file('prodImg')->store('public/uploads');
        if (product::exists()) {
            $prvid = product::latest()->first()->id;
        } else {
            $prvid = 0;
        }
        $prvid += 1;
        $imageName = 'products-'.$prvid . '.' . $request->prodImg->extension();
        $path = $request->prodImg->storeAs('public/products', $imageName);


        $data = new product();
        $data['product']     = $request->product;
        $data['rgPrice']     = $request->rgPrice;
        $data['slPrice']     = $request->slPrice;
        $data['halfPrice']   = $request->hPrice;
        $data['customize']   = $request->customize;
        $data['description'] = $request->description;
        $data['category']    = $request->category;
        $data['prodImg']     = $imageName ;
        $data['type']        = $request->type;
        $data['tags']        = $request->tags;
        $data['status']      = $request->status;
        $data->save();
        return redirect('/admin/products');
    }

    public function destroy($id)
    {
        echo $id;
        
    }

    public function edit($id)
    {
        $data = product::where('id',$id)->first();
        return view('administrator/ProductManager/edit-product')->with(array('product_data'=>$data));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'product'     => 'required',
            'rgPrice'     => 'numeric',
            'slPrice'     => 'required|numeric',
            'prodImg'     => 'image|mimes:jpeg,png,jpg,svg,webp|max:2048',
            'type'        => 'required',
            'status'      => 'required',
        ]);

        //$path = $request->file('prodImg')->store('public/uploads');
        $prvid = $request->pId;
        if($request->prodImg !=''):
            $imageName = 'products-'.$prvid . '.' . $request->prodImg->extension();
            $path = $request->prodImg->storeAs('public/products', $imageName);
        endif;



        $data = product::find($request->pId);
        $data['product']     = $request->product;
        $data['rgPrice']     = $request->rgPrice;
        $data['slPrice']     = $request->slPrice;
        $data['halfPrice']   = $request->hPrice;
        $data['customize']   = $request->customize;
        $data['description'] = $request->description;
        $data['category'] = $request->category;
        if($request->prodImg !=''):
            $data['prodImg']     = $imageName ;
        endif;
        $data['type']        = $request->type;
        $data['tags']        = $request->tags;
        $data['status']      = $request->status;
        $data->save();
        return redirect('/admin/products');
    }
}
