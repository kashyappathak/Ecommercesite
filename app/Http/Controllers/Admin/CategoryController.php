<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
       
            
        return view('admin.categories.index',compact('categories'));
    }
    public function create(){
        return view('admin.categories.create');
    }
    public function store(Request $request){

        Validator::make($request->all(),[
            'name'=>'required|string',
            'slug'=> 'required',
            'description' => 'required',
            'image'=> 'nullable|mimes:jpeg,jpg,png',
            'meta_title'=>'required|string',
            'meta_description'=>'required',
            'meta_keyword'=>'required',
            'navbar_status'=>'nullable',
            'status'=>'nullable'
        ])->validated();


        $data = $request->all();
        $category = new Category();
        $category->name = $data['name'];
        $category->slug =  Str::slug($data['slug']);
        $category->description = $data['description'];

        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/category/'), $filename);
            $category->image = 'uploads/category/' . $filename;
        }

        $category->meta_title = $data['meta_title'];
        $category->meta_description = $data['meta_description'];
        $category->meta_keyword= $data['meta_keyword'];
        $category->navbar_status = $request->navbar_status == true ? '1':'0';
        $category->status = $request->status == true ? '1':'0';
        $category->created_by = Auth::user()->id;
        if(Category::where('slug', $category->slug)->exists()){
            return redirect()->back()->with('success', 'Category Slug Exists');
        }
        $category->save();

       

        return redirect()->route('categories.index')->with('message','Category Added Successfully!!');
    }

    public function edit($id){
        $category = Category::findOrFail($id);

        return view('admin.categories.edit',compact('category'));

    }

    public function update(Request $request , $id){
        Validator::make($request->all(),[
            'name'=>'required|string',
            'slug'=> 'required',
            'description' => 'required',
            'image'=> 'nullable|mimes:jpeg,jpg,png',
            'meta_title'=>'required|string',
            'meta_description'=>'required',
            'meta_keyword'=>'required',
            'navbar_status'=>'nullable',
            'status'=>'nullable'
        ])->validated();

        $category = Category::findOrFail($id);
        $category->name  = $request->name;
        $category->slug  = $request->slug;
        $category->description  = $request->description;
       
        $previousImage = $category->image;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/category', $filename);

            if ($previousImage) {
                File::delete(public_path($previousImage));
            }
            $category->image = 'uploads/category/' .$filename;

        }
        else{
            $category->image = $previousImage;
        }

        $category->meta_title  = $request->meta_title;
        $category->meta_description  = $request->meta_description;
        $category->meta_keyword  = $request->meta_keyword;
        $category->navbar_status  = $request->navbar_status ==  true ? '1':'0';
        $category->status  = $request->status == true? '1':'0';
        // if(Category::where('slug', $category->slug)->exists()){
        //     return redirect()->back()->with('success', 'Category Slug Exists');
        // }
        $category->update();

        return redirect()->route('categories.index')->with('message', 'Category Updated SuccessFully');

    }

    public function destroy($id){
        $category = Category::find($id);
        $category->delete();

        return redirect()->route('categories.index')->with('message','Category Deleted Successfully');
    }
}