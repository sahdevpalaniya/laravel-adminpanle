<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use DataTables;
use Session;

class CategoryController extends Controller
{
   public function index()
   {
      $data = [];
      $data['page_title'] = 'Category List';
      return view('admin.category.index', $data);
   }
   public function datatable(Request $request)
   {
      $category = Category::all();
      return datatables()->of($category)
         ->addColumn('action', function ($category) {
            $html = '<a href="' . route('edit', $category->id) . '" class="btn btn-light btn-edit"><i class="fa fa-pencil h4"></i></a> ';
            $html.='<a class="btn btn-dark btn-delete btnDelete" data-url="' . route('destroy') . '" data-id="' . $category->id . '" title="Delete"><i class="fa fa-trash"></i></a>';
            return $html;
         })
         ->editColumn('created_at',function($category){
            return isset($category->created_at) ? date('d/m/Y',strtotime($category->created_at)) : '-';
         })->toJson();
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

      Session::flash('success', ' Category ' . $action . ' successfully.');
      return redirect()->route('category_list');
   }

   public function destroy(Request $request) 
   {
      if ($request->ajax()) {
         $category = Category::where('id', $request->id)->first();
         if ($category) {
            $category->delete();
            $return=true;
         }
      }

      return response()->json($return);
   }
}
