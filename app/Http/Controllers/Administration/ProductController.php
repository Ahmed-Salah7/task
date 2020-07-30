<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdministrationRequest;
use App\Http\Requests\ProductRequest;
use App\Models\Admin;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:product-list');
        $this->middleware('permission:product-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administration.pages.products.index');
    }


    public function products_index_ajax()
    {
        $products = Product::get();

        return DataTables::of($products)
            ->setRowId(function ($product) {
                return $product->id;
            })
            ->addColumn('action', function ($products) {
                return '
            <a href=' . route("admin.product.show", $products->id) . '><button class="btn btn-warning">Show</button></a>
            <a href=' . route("admin.product.edit", $products->id) . '><button class="btn btn-info">Edit</button></a>

            <a onclick="event.preventDefault(); document.getElementById(\'' . $products->id . '-button-logout\').submit();"  href="#"><button class="btn btn-danger">Delete</button></a>
            <form id="' . $products->id . '-button-logout" action=' . route("admin.product.destroy", $products->id) . ' method="post">
           <input type="hidden" name="_token" value= ' . csrf_token() . '>
                <input name="_method" type="hidden" value="delete">
            </form>
            ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administration.pages.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
//        dd($request->all());
        $product = new Product();

        $path = $request->file('image')->store('images');

        $product->image = $path;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->save();

        return redirect()->route('admin.product.edit', $product->id)->with('success', 'Product Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('administration.pages.products.show')->with([
            'product' => $product,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('administration.pages.products.edit')->with([
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        if ($request->image) {
            $path = $request->file('image')->store('images');
            $product->image = $path;
        }

        $product->title = $request->title;
        $product->description = $request->description;

        $product->update();
        return redirect()->route('admin.product.edit', $product->id)->with('success', 'Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index');
    }
}
