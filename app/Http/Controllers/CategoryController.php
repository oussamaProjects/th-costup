<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return Inertia::render('Components/Categories/Index', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $category = new Category;
        $check_name = Category::where('name', 'like', $request->input('name'))->first();

        if ($check_name !== null) {
            return Redirect::route('settings')->with('flash.failures.form.store.categories', 'Le nom de la categorie  "' . $category->name . '" exist deja !');
        }

        $category->name = $request->input('name');
        $category->description = $request->input('description') ?? " -- ";
        $category->parent_id = $request->input('parent_id') ?? 0;
        $category->save();

        return Redirect::route('settings')->with('flash.success.form.store.categories', 'La catégorie  "' . $category->name . '" a été enregistrée !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return $category;
    }


     /**
     * getCategoryServices
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getCategoryServices(Category $category)
    {
        return $category->services()->get();
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
            'name' => 'required',
        ]);

        $check_name = Category::where('name', 'like', $request->input('name'))->first();

        $category->description = $request->input('description') ?? " -- ";
        $category->parent_id = $request->input('parent_id') ?? 0;
        if ($check_name !== null) {
            $category->save();
            return Redirect::route('settings')->with('flash.failures.form.update.categories', 'La categorie "' . $category->name . '" exist deja !');
        }

        $category->name = $request->input('name');
        $category->save();

        return Redirect::route('settings')->with('flash.success.form.update.categories', 'La catégorie "' . $category->name . '" a été bien modifié !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return Redirect::route('settings')->with('flash.success.list.categories', 'La catégorie ' . $category->name . ' a été supprimer !');
    }
}
