<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Facades\Http;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }

    /**
     * Get the categories from Mercadona API.
     */
    public function getCategoryFromMercadona(){
        $response = Http::get('https://tienda.mercadona.es/api/categories/');
        $json = $response->json();

        foreach($json['results'] as $category){
            $categoryParent = Category::create([
                'mercadona_id' => $category['id'],
                'name' => $category['name'],
                'mercadona_parent_id' => null
            ]);
            foreach($category['categories'] as $subcategory){
                Category::create([
                    'mercadona_id' => $subcategory['id'],
                    'name' => $subcategory['name'],
                    'mercadona_parent_id' => $categoryParent->mercadona_id
                ]);
            }
        }


    }
}
