<?php

namespace App\Http\Controllers;

use App\Models\Models\Category;
use App\Models\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::pluck('categoryname','id');
        $productsQuery = Product::query();

        if($request->filled('search')){
            $productsQuery->where('productname', 'like' , "%$request->search%")->orWhere('productdescription', 'like' , "%$request->search%");
        }
        $products = $productsQuery->orderBy('created_at', 'desc')->get();


        foreach ($products as $p){
           $p->category_name = $categories[$p->categoryid];
        }

        if($request->filled('price_from') || $request->filled('price_to') || $request->filled('categoryid') ){

            foreach ($products as $elementKey => $element) {

                if ($request->filled('price_from')){
                    if ($element->price < $request->price_from) {
                        unset($products[$elementKey]);
                    }
                }
                if ($request->filled('price_to')){
                    if ($element->price > $request->price_to) {
                        unset($products[$elementKey]);
                    }
                }
                if ($request->filled('categoryid')){
                    if ($element->categoryid != $request->categoryid) {
                        unset($products[$elementKey]);
                    }
                }
            }

            // dd($products);
        }



        //dd($request);

        return View('product.index',compact('categories'), compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('categoryname', 'id'); //формируем список категориий
        $product = new Product;
        return View('product.create', ['product'=>$product, 'categories'=>$categories ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'productname' =>'required|max:128',
            'productdescription'=>'required',
        ];
        $customMessages =[
            'productname.required'=>'Поле Название товара не может быть пустым!',
            'productname.max' => 'Поле не может быть больше 128 символов',
            'productdescription.required'=>'Поле Описание товара не может быть пустым!',
        ];
        $this->validate($request, $rules,$customMessages);

        $product = new Product;
        $product->productname=$request->productname;
        $product->productdescription=$request->productdescription;
        $product->price=$request->price;
        $product->categoryid=$request->categoryid;

        if(!$product->save()){
            $err=$product->getErrors();
            return redirect()->action('App\Http\Controllers\ProductController@create')->with('errors',$err)->withInput();
        }
        return redirect()->action('App\Http\Controllers\ProductController@index')->with('success', 'New product '. $product->productname.' has been added!');
       // return redirect()->action('App\Http\Controllers\ProductController@create')->with('message', 'New product '. $product->productname.' has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::pluck('categoryname', 'id'); //формируем список категориий
        //return view('product.edit',compact('product' , 'categories'));
        return View('product.edit', ['product'=>$product, 'categories'=>$categories ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'productname' => 'required|max:128',
            'productdescription' => 'required|max:256',
            'price',
            'categoryid',

        ]);
        $product->update($request->all());
        return redirect()->route('product.index')->with('success','Товар изменен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::findOrFail($id);
        $product->delete();
        return redirect('product')->with('completed', 'Товар удален');
    }
}
