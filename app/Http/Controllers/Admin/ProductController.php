<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\ProductForm;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        $brands = Brand::all();

        return view('admin.products.index', compact('products','brands'));
    }

    public function create(){
        $brand = Brand::all();
        $category = Category::all();
        return view('admin.products.create',compact('brand','category'));
    }

    public function store(ProductForm $request){
        $data = $request->validated();
        $category = Category::findOrFail($data['category_id']);
        if (Product::where('slug', Str::slug($data['slug']))->exists()) {
            return redirect()->back()->with('success', 'Product Slug Exists');
        }
        $product = $category->products()->create([
            'category_id' => $data['category_id'],
            'name' => $data['name'],
            'slug' => Str::slug($data['slug']),
            'brand' => $data['brand'],
            'small_description' => $data['small_description'],
            'description' => $data['description'],
            'orignal_price' => $data['orignal_price'],
            'selling_price' => $data['selling_price'],
            'quantity' => $data['quantity'],
            'trending' => $request->trending == true ? '1':'0',
            'status' => $request->status == true ? '1':'0',
            'meta_title' => $data['meta_title'],
            'meta_description' => $data['meta_description'],
            'meta_keyword' => $data['meta_keyword']
            
        ]);

        if($request->hasFile('image')){
            $uploadPath = 'uploads/products/';
            $i=1;
            foreach($request->file('image') as $img){
                $filename = time().$i++. '.'  .$img->getClientOriginalExtension();
                $img->move($uploadPath, $filename);
                $finalimage = $uploadPath.$filename;

                $product->productImages()->create([
                    'product_id'=> $product->id,
                    'image'=> $finalimage
                ]);
            }

            return redirect()->route('products.index')->with('message','Product Added Successfully!!');
            
        }
    }

    public function edit($id){
        $product = Product::find($id);
        $category = Category::where('status','1')->get();
        $brand = Brand::all();
        return view('admin.products.edit',compact('product','category','brand'));
    }

    public function update(ProductForm $request , $id){
        $data = $request->validated();
        $product = Category::findOrFail($data['category_id'])->products()->where('id',$id)->first();
        if($product){
            
            $product->update([
                'category_id' => $data['category_id'],
                'name' => $data['name'],
                'slug' => Str::slug($data['slug']),
                'brand' => $data['brand'],
                'small_description' => $data['small_description'],
                'description' => $data['description'],
                'orignal_price' => $data['orignal_price'],
                'selling_price' => $data['selling_price'],
                'quantity' => $data['quantity'],
                'trending' => $request->trending == true ? '1':'0',
                'status' => $request->status == true ? '1':'0',
                'meta_title' => $data['meta_title'],
                'meta_description' => $data['meta_description'],
                'meta_keyword' => $data['meta_keyword']
                
            ]);

            if($request->hasFile('image')){
                $uploadPath = 'uploads/products/';
                $i= 1;
                foreach($request->file('image') as $img){
                    $filename = time().$i++. '.' .$img->getClientOriginalExtension();
                    $img->move($uploadPath, $filename);
                    $finalimage = $uploadPath.$filename;

                    $product->productImages()->create([
                        'product_id'=>  $product->id,
                        'image' =>  $finalimage,
             
                    ]);
                }
                
            }
            
            return redirect()->route('products.index')->with('message','Product Updated Successfully!');
        }else{
            return redirect()->route('products.index')->with('message','No such Product ID Found');
        }
    }

    public function destroyImage(int $id){
        $productImage = ProductImage::findOrFail($id);
        if(File::exists($productImage->image)){
            File::delete($productImage->image);
        }
        $productImage->delete();

        return redirect()->back()->with('message', 'Product Images Deleted Successfully!!');

    }

    public function destroy($id){
        $product = Product::find($id);

        if($product->productImages()){
            foreach($product->productImages() as $image){
                if(File::exists($image->image)){
                    File::delete($image->image);
                }
            }
        }

        $product->delete();
        return redirect()->route('products.index')->with('message', 'Product Deleted Successfully');
    }
}
