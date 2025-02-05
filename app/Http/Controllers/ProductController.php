<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
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
    public function store(StoreProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }

    public function getProductFromMercadona(){
        $categories = Category::whereNotNull('mercadona_parent_id')->limit(1)->get();
    
        foreach($categories as $category){
            $url = "https://tienda.mercadona.es/api/categories/".$category->mercadona_id;
            $response = Http::get($url);
// Verificar si la solicitud fue exitosa
if ($response->successful()) {
    // Obtener los datos de la respuesta en formato JSON
    //var_dump($response->json());
    $data = $response->json();
    foreach($data['categories'] as $subcategory){
        var_dump('entro a llistat de categories');
    // Verificar si existen productos en la categoría
    if (isset($subcategory['products']) && is_array($subcategory['products'])) {
        var_dump('entro a llistat de productes');

        foreach ($subcategory['products'] as $productData) {
            // Crear o actualizar el producto en la base de datos
            Product::updateOrCreate(
                ['mercadona_id' => $productData['id']],
                [
                    'name' => $productData['display_name'],
                    'slug' => $productData['slug'],
                    'price' => $productData['price_instructions']['unit_price'],
                    'category_id' => $category->id,
                    'tax_percentage' => $productData['price_instructions']['tax_percentage'],
                    'bulk_price' => $productData['price_instructions']['bulk_price'] ?? null,
                    'unit_size' => $productData['price_instructions']['unit_size'],
                    'published' => $productData['published'],
                    'thumbnail' => $productData['thumbnail'],
                    'unit_price' => $productData['price_instructions']['unit_price'],
                    'size_format' => $productData['price_instructions']['size_format'],
                    'previous_unit_price' => $productData['price_instructions']['previous_unit_price'] ?? null,
                    'category_id' => $category->id,
                    // Agregar otros campos según la estructura de tu tabla 'products'
                ]
            );
        }
    }
}
} else {
    // Manejar el caso en que la solicitud no fue exitosa
    // Puedes registrar un error o tomar alguna acción adicional
    Log::error("Error al obtener la categoría con ID: " . $category->mercadona_id);
}

        }
    }
}
