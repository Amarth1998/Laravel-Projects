<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
class ProductController extends Controller
{

    //***************************create***************************/
    public function addproduct(Request $req)
    {
      
        // Create new Product instance
        $product = new Product;
        $product->name = $req->input('name');
        $product->price = $req->input('price');
        $product->description = $req->input('description');

        // Store the uploaded file and save the filepath
        if ($req->hasFile('file')) {
            $filePath = $req->file('file')->store('products', 'public'); // Save in 'public/products' folder
            $product->filepath = $filePath;
        }

        // Save the product to the database
        $product->save();

        // Return a success response with the saved product
        return response()->json([
            'message' => 'Product added successfully',
            'product' => $product,
        ], 201);
    }




// ************************************************************************list ************************************************
   function list(){
    return Product::all();
   }




   //****************************************************delete*****************************************************
   function delete($id){
    $product = Product::where('id',$id)->delete();
    if($product){
        return response()->json(['message'=>'product deleted successfully'],200);
    }
   else{
    return response()->json(['message'=>'product not found'],404);
   }
   }

   public function getSingleProduct($id)
   {
       // Find the product by its ID
       $product = Product::find($id);
   
       // Check if the product exists
       if (!$product) {
           return response()->json([
               'error' => 'Product not found'
           ], 404); // Return a 404 error if product not found
       }
   
       // Return the product if found
       return response()->json($product, 200);
   }
   



   //***********************************************search prodcut **************************************************************************

   function search($key){
 // Check if the key is not empty or null
 if (empty($key)) {
    return response()->json([
        'message' => 'Search key is required.',
        'status' => 400
    ], 400);
}
$products = Product::where('name', 'LIKE', "%$key%")->get();

// Search across multiple columns (name, description, etc.)
//$products = Product::where('name', 'LIKE', "%$key%") ->orWhere('description', 'LIKE', "%$key%")->get();

// Check if any products were found
if ($products->isEmpty()) {
    return response()->json([
        'message' => 'No products found matching your search criteria.',
        'status' => 404
    ], 404);
}

// Return the found products as a JSON response
return response()->json([
    'message' => 'Products found',
    'status' => 200,
    'data' => $products
], 200);
}

   
// ************************************ update*********************************

public function update(Request $req, $id)
{
    // Find the product by ID
    $product = Product::find($id);

    if (!$product) {
        return response()->json(['error' => 'Product not found'], 404);
    }

    // Update product properties
    $product->name = $req->input('name');
    $product->price = $req->input('price');
    $product->description = $req->input('description');

    // Check if a new file is uploaded
    if ($req->hasFile('file')) {
        // Delete the old file if it exists
        if ($product->filepath) {
            Storage::disk('public')->delete($product->filepath);
        }

        // Store the new file and save the filepath
        $filePath = $req->file('file')->store('products', 'public'); // Save in 'public/products' folder
        $product->filepath = $filePath;
    }
    // Save the updated product
    $product->save();
    // Return a success response with the updated product
    return response()->json([
        'message' => 'Product updated successfully',
        'product' => $product,
    ], 200);
}



      



}
