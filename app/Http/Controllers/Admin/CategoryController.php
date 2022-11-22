<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Validator;

class CategoryController extends Controller
{
   public function index()
   {
      $data = [];
      $data['page_title'] = 'Category List';
      return view('admin.category.index', $data);
   }

   public function create()
   {
      $data = [];
      $data['page_title'] = 'Add Category';
      return view('admin.category.create', $data);
   }

   public function edit($id)
   {
      $data = [];
      $data['page_title'] = 'Edit Category';
      $data['category'] = Category::find($id);
      return view('admin.category.create', $data);
   }

   public function store(Request $request)
   {
      $request->validate([
         'category_name' => 'required',
         'category_price' => 'required|integer',
         'category_quantity' => 'required|integer',
      ]);

      if ($request->has('id')) {
         $category                = Category::where('id', $request->id)->first();
         $category->updated_at    = date('Y-m-d H:i:s');
         $action              = 'updated';
      } else {
         $category                = new Category();
         $category->created_at    = date('Y-m-d H:i:s');
         $action              = 'added';
      }
      $category->category_name = $request['category_name'];
      $category->category_price = $request['category_price'];
      $category->category_quantity = $request['category_quantity'];
      $category->status = $request['status'];
      $category->save();
      return redirect()->route('category_list');
   }
}
