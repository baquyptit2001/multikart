<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cate = Brand::all();
        return response()->json($cate);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = new Brand;
        $item->name = $request->item['name'];
        $item->image = $request->item['image'];
        $item->status = $request->item['status'];
        $item->save();
        return $item;
        // $content = file_get_contents($request->item['url']);
        // file_put_contents(public_path($request->item['name']), $content);
        // return file_put_contents(public_path($request->item['name']), $content);
        // return json_decode(file_get_contents($request->item['url']));
        // return public_path($request->item['url']);
        // $item = new Brand;
        // $item->name = $request->item['name'];
        // $item->image = $request->item['file']; 
        // $item->save();
        // return $item;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Brand::find($id);
        if($item){
            $item->name = $request->item['name'];
            $item->image = $request->item['image'];
            $item->status = $request->item['status'];
            $item->save();
            return $item;
        }
        return "Item not found";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Brand::find($id);
        $item->delete();
    }
}
