<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index(){

                
        $products = Product::where('status', '1')->limit(2)->get();
        return view('admin.comments.index' , compact('products'));
    }

    public function searchcomments(Request $request)
    {
        $search = $request->search;
        $products = Product::where(function ($query) use ($search) {
            $query->whereHas('comments', function ($subQuery) use ($search) {
                $subQuery->where('comment', 'like', "%$search%");
            })->orWhere('name', 'like', "%$search%")
            ->orWhereHas('user', function ($subQuery) use ($search) {
                $subQuery->where('name', 'like', "%$search%");
            });
        })->orWhere('user_id', 'like', "%$search%")->get();
        
    return view('admin.comments.index', compact('products', 'search'));
    }
}
