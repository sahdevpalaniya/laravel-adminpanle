<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
// use DataTables;
use File;
use Session;
use Yajra\DataTables\DataTables;
use PDF;

class CategoryController extends Controller
{
   public function index()
   {
      $data = [];
      $data['page_title'] = 'Category List';
      $data['back_page_title'] = 'Dashboard';
      $data['back_page_route'] = 'admin-dashboard';
      return view('admin.category.index', $data);
   }
   public function datatable(Request $request)
   {
      // $category = Category::all();
      return DataTables::eloquent($partner)
         ->addColumn('action', function ($category) {
            $html = '<a href="' . route('edit', $category->id) . '" class="btn btn-light btn-edit"><i class="fa fa-pencil h4"></i></a> ';
            $html .= '<a class="btn btn-dark btn-delete btnDelete" data-url="' . route('destroy') . '" data-id="' . $category->id . '" title="Delete"><i class="fa fa-trash"></i></a>';
            return $html;
         })
         ->editColumn('created_at', function ($category) {
            return isset($category->created_at) ? date('d/m/Y', strtotime($category->created_at)) : '-';
         })->toJson();
   }

   public function create()
   {
      $data = [];
      $data['page_title'] = 'Add Category';
      $data['back_page_title'] = 'Category List';
      $data['back_page_route'] = 'category_list';
      return view('admin.category.create', $data);
   }

   public function edit($id)
   {
      $data = [];
      $data['page_title'] = 'Edit Category';
      $data['back_page_title'] = 'Category List';
      $data['back_page_route'] = 'category_list';
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

      if ($image = $request->image) {
         if ($category->category_image != '') {
            $categoryImage = public_path('uploads/CategoryImage' . $category->category_image);
            if (File::exists($categoryImage)) {
               unlink($categoryImage);
            }
         }
      }
      $categoryImage = uniqid() . "." . $image->getClientOriginalExtension();
      $path = 'uploads/CategoryImage/';
      $upload_image = $image->move($path, $categoryImage);
      if ($upload_image) {
         $category->category_image = $categoryImage;
      }

      $category->category_name = $request['category_name'];
      $category->category_price = $request['category_price'];
      $category->category_quantity = $request['category_quantity'];
      $category->status = $request['status'];
      $category->save();

      Session::flash('alert-message', ' Category ' . $action . ' successfully.');
      Session::flash('alert-class', 'success');
      return redirect()->route('category_list');
   }

   public function destroy(Request $request)
   {
      if ($request->ajax()) {
         $category = Category::where('id', $request->id)->first();
         if ($category) {
            $category->delete();
            $return = true;
         }
      }
      return response()->json($return);
   }

   public function createPDF()
   {
      $data = [
         'title' => 'Category List',
         'date' => date('m/d/Y'),
         'categorys' => Category::all(),
      ];
      $pdf = PDF::loadView('categoryPDF', $data);

      return $pdf->download('Category List.pdf');
   }
}
