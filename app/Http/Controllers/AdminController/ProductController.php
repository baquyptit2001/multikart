<?php

namespace App\Http\Controllers\AdminController;

use App\Models\Size;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductSize;
use App\Models\ProductColor;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item = Product::with(['category', 'brand', 'colors', 'sizes', 'images'])->get();
        return response()->json($item);
    }

    public function init()
    {
        $category = Category::where('parent_id', '>', 0)->get();
        $brand = Brand::all();
        $size = ProductSize::all();
        $color = ProductColor::all();
        return response()->json([$category, $brand, $size, $color]);
    }

    public function proById($id)
    {
        $product = Product::where('id',$id)->with(['category', 'brand', 'colors', 'sizes', 'images'])->get();
        return response()->json($product, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product;
        $product->name = $request->item['name'];
        $product->image = $request->item['image'];
        $product->description = $request->item['description'];
        $product->slug = $request->item['slug'];
        $product->category_id = $request->item['category_id'];
        $product->brand_id = $request->item['brand_id'];
        $product->price = $request->item['price'];
        $product->sale_price = ($request->item['sale_price'] == '') ? 0 : $request->item['sale_price'];
        $product->status = $request->item['status'];
        if ($product->save()) {
            foreach ($request->item['size_id'] as $value) {
                $size = new Size;
                $size->product_id = $product->id;
                $size->size_id = $value;
                $size->save();
            }
            foreach ($request->item['color_id'] as $value) {
                $color = new Color;
                $color->product_id = $product->id;
                $color->color = $value;
                $color->save();
            }
            $detailImg = explode(' ', $request->item['imageDetail']);
            foreach ($detailImg as $value) {
                $img = new ProductImage;
                $img->image = $value;
                $img->product_id = $product->id;
                $img->save();
            }
        }
        return response()->json($product);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->name = $request->item['name'];
        $product->image = $request->item['image'];
        $product->brand_id = $request->item['brand_id'];
        $product->category_id = $request->item['category_id'];
        $product->sale_price = ($request->item['sale_price'] == '') ? 0 : $request->item['sale_price'];
        $product->slug = $request->item['slug'];
        $product->description = $request->item['description'];
        $product->status = $request->item['status'];
        if ($product->save()) {
            while (Size::where('product_id', $id)->first() != null) {
                $del = Size::where('product_id', $id)->first();
                $del->delete();
            }
            foreach ($request->item['size_id'] as $value) {
                $size = new Size;
                $size->product_id = $product->id;
                $size->size_id = $value;
                $size->save();
            }
            while (Color::where('product_id', $id)->first() != null) {
                $del = Color::where('product_id', $id)->first();
                $del->delete();
            }
            foreach ($request->item['color_id'] as $value) {
                $color = new Color;
                $color->product_id = $product->id;
                $color->color = $value;
                $color->save();
            }
            $detailImg = explode(' ', $request->item['imageDetail']);
            while (ProductImage::where('product_id', $id)->first() != null) {
                $del = ProductImage::where('product_id', $id)->first();
                $del->delete();
            }
            foreach ($detailImg as $value) {
                $img = new ProductImage;
                $img->image = $value;
                $img->product_id = $product->id;
                $img->save();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Product::find($id);
        while (Size::where('product_id', $id)->first() != null) {
            $del = Size::where('product_id', $id)->first();
            $del->delete();
        }
        while (Color::where('product_id', $id)->first() != null) {
            $del = Color::where('product_id', $id)->first();
            $del->delete();
        }
        while (ProductImage::where('product_id', $id)->first() != null) {
            $del = ProductImage::where('product_id', $id)->first();
            $del->delete();
        }
        $item->delete();
        return "Delete Success !!";
    }
}
