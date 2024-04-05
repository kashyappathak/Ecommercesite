<?php

namespace App\Http\Controllers\admin;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(){
        $brands = Brand::all();
        return view('admin.brands.index', compact('brands'));
    }

    public function create(){
        $category = Category::where('status','1')->get();
        return view('admin.brands.create', compact('category'));
    }

    public function store(Request $request){
        Validator::make($request->all(),[
            'category_id'=>
                'required|integer',
            
            'name'=>'required|string',
            'slug'=>'required|string',
            'description'=>'required|string'

        ])->validated();

        $data = $request->all();
        $brand = new Brand;
        $brand->category_id = $data['category_id'];
        $brand->name = $data['name'];
        $brand->slug = $data['slug'];
        $brand->description = $data['description'];
        $brand->navbar_status = $request->navbar_status == true ? '1':'0';
        $brand->status = $request->status == true ? '1':'0';
        if(Brand::where('slug', $brand->slug)->exists()){
            return redirect()->back()->with('success', 'Category Slug Exists');
        }
        $brand->save();
        


        return redirect()->route('brands.index')->with('message','Brands Added Successfully!!');

    }
    public function edit($id){
        $brand = Brand::find($id);
        $category = Category::where('status','1')->get();

        return view('admin.brands.edit',compact('brand','category'));
    }

    public function update(Request $request ,$id){
        $brand = Brand::findOrFail($id);
        Validator::make($request->all(),[
            'name'=>'required|string',
            'slug'=>'required|string',
            'description'=>'required|string'

        ])->validated();

        $data = $request->all();       
        $brand->name = $data['name'];
        $brand->slug = Str::slug($data['slug']);
        $brand->description = $data['description'];
        $brand->status = $request->status == true ? '1':'0';
        $brand->navbar_status = $request->navbar_status == true ? '1':'0';
        // if(Brand::where('slug', $brand->slug)->exists()){
        //     return redirect()->back()->with('success', 'Category Slug Exists');
        // }
        $brand->update();

        return redirect()->route('brands.index')->with('message','Brands Updated Successfully!!');

    }

    public function destroy($id){
        $brand = Brand::findOrFail($id);
        $brand->delete();

        return redirect()->route('brands.index')->with('message','Brands Deleted Successfully');
    
    }

}
