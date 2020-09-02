<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Creamos una variable llamada categories y agregamos las categorias
        $categories = Category::all();
        return $categories;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //todas los datos que enviamos post
        //validar la data
        $request -> validate([
            'name'=> 'required|max:30|unique:categories,name'
        ]);
        //$category se crea nueva variable
        $category = new Category;
        $category -> name = $request->input('name');
        $category -> save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //actualizar una categoria en especifico
        $data = $request -> validate([
            'name' => 'required|max:30|unique:categories,name,'.$category->id
        ]);
        //al campo name le asigne el nombre que recibumos de la peticion
        $category -> name = $data['name'];
        $category->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category -> delete();
    }
}
