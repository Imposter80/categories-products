<?php

namespace App\Http\Controllers;

use App\Models\Models\Product;
use App\Models\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) // показывает все
    {
        $categoriesQuery = Category::query();
        if($request->filled('search')){
            $categoriesQuery->where('categoryname', '==' , $request->search);
        }
        if($request->filled('price_from')){

        }
        if($request->filled('price_to')){

        }
        if($request->filled('count_from')){

        }
        if($request->filled('count_to')){

        }

        $products = Product::all();
        $categories = $categoriesQuery->orderBy('created_at', 'desc')->simplepaginate(10);

        return View('category.index', compact('categories'),compact('products') );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() // показать форму для заполнения категории и передать ее в метод store
    {
        $category = new Category;
        return View('category.create', ['category'=>$category,'page'=>'Новая категория']);
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
          'categoryname' =>'required|max:128',
            'categorydescription'=>'required',
        ];
        $customMessages =[
            'categoryname.required'=>'Поле Название категории не может быть пустым!',
            'categoryname.max' => 'Поле не может быть больше 128 символов',
            'categorydescription.required'=>'Поле Описание категории не может быть пустым!',
        ];
        $this->validate($request, $rules,$customMessages);

        $category = new Category;
        $category->categoryname=$request->categoryname;
        $category->categorydescription=$request->categorydescription;
        if(!$category->save()){
            $err=$category->getErrors();
            return redirect()->action('App\Http\Controllers\CategoryController@create')->with('errors',$err)->withInput();
        }
        return redirect()->action('App\Http\Controllers\CategoryController@create')->with('message', 'New category '. $category->categoryname.' has been added!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) // показать одну запись по id
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)  // показать одну запись по id для редактирования и передает в update
    {
        return view('category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'categoryname' => 'required|max:128',
            'categorydescription' => 'required|max:256',
        ]);
        $category->update($request->all());
        return redirect()->route('category.index')->with('success','Категирия изменена');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) //удалить по id
    {
        $category=Category::findOrFail($id);
        $category->delete();
        return redirect('category')->with('completed', 'Категория удалена');
    }
}

















