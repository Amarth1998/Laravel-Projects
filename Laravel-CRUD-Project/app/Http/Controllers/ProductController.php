<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // This method will show products page
    public function index() {
        $products = Product::orderBy('created_at','DESC')->get();
        return view('products.list',['products' => $products]);
    }


    // This method will show create product page
    public function create() {
        return view('products.create');
    }
    // 'products.create' refers to the Blade view file located in the resources/views/products/ directory with the filename create.blade.php.



    // This method will store a product in db
    public function store(Request $request) {
        // Validation rules
        $rules = [
            'name' => 'required|min:5',  // Product name must be at least 5 characters
            'sku' => 'required|min:3',   // SKU must be at least 3 characters
            'price' => 'required|numeric' // Price must be a valid number
        ];
    
        // Check if image is present and add image validation rule
        if ($request->image != "") {
            $rules['image'] = 'image';  // Image must be of valid file type
        }
    
        // Validate the request input against the rules
        $validator = Validator::make($request->all(), $rules);
    
        // If validation fails, redirect back to create form with errors and input
        if ($validator->fails()) {
            return redirect()->route('products.create')->withInput()->withErrors($validator);
        }
    
        // Insert product into the database
        $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();
    
        // If image is uploaded, handle the image upload process
        if ($request->image != "") {
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time().'.'.$ext;  // Generate unique image name
    
            // Move the image to the 'uploads/products' directory
            $image->move(public_path('uploads/products'), $imageName);
    
            // Save the image name in the product record
            $product->image = $imageName;
            $product->save();
        }
    
        // Redirect to the products index page with a success message
        return redirect()->route('products.index')->with('success', 'Product added successfully.');
    }
    




    // This method will show edit product page
    public function edit($id) {
        $product = Product::findOrFail($id);
        return view('products.edit',['product' => $product ]);
    }




    // This method will update a product
public function update($id, Request $request) {

    // Find the product by ID, or fail if not found
    $product = Product::findOrFail($id);

    // Validation rules
    $rules = [
        'name' => 'required|min:5',   // Product name should be at least 5 characters
        'sku' => 'required|min:3',    // SKU should be at least 3 characters
        'price' => 'required|numeric' // Price must be numeric
    ];

    // Add image validation rule if an image is provided
    if ($request->image != "") {
        $rules['image'] = 'image';  // Image should be of a valid type
    }

    // Validate the request input against the rules
    $validator = Validator::make($request->all(), $rules);

    // If validation fails, redirect back to the edit form with errors and input
    if ($validator->fails()) {
        return redirect()->route('products.edit', $product->id)
                         ->withInput()
                         ->withErrors($validator);
    }

    // Update the product fields
    $product->name = $request->name;
    $product->sku = $request->sku;
    $product->price = $request->price;
    $product->description = $request->description;
    $product->save();

    // If a new image is uploaded, handle the image update
    if ($request->image != "") {
        // Delete the old image from the filesystem
        File::delete(public_path('uploads/products/'.$product->image));

        // Save the new image
        $image = $request->image;
        $ext = $image->getClientOriginalExtension();
        $imageName = time().'.'.$ext; // Generate unique image name

        // Move the new image to the 'uploads/products' directory
        $image->move(public_path('uploads/products'), $imageName);

        // Update the product's image path in the database
        $product->image = $imageName;
        $product->save();
    }

    // Redirect to the products index page with a success message
    return redirect()->route('products.index')->with('success', 'Product updated successfully.');
}



    // This method will delete a product
    public function destroy($id) {
        $product = Product::findOrFail($id);

       // delete image
       File::delete(public_path('uploads/products/'.$product->image));

       // delete product from database
       $product->delete();

       return redirect()->route('products.index')->with('success','Product deleted successfully.');
    }
    
}
