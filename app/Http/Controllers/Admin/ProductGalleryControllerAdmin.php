<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Http\Requests\Admin\ProductGalleryRequest;

use Yajra\DataTables\Facades\DataTables;

class ProductGalleryControllerAdmin extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = ProductGallery::with(["product"]);

            return Datatables::of($query)
                ->addColumn("action", function ($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">Aksi
                                </button>
                                <div class="dropdown-menu">
                                    <form action="' .
                        route("product-gallery.destroy", $item->id) .
                        '" method="POST">
                                        ' .
                        method_field("delete") .
                        csrf_field() .
                        '
                                        <button type="submit" class="dropdown-item text-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    ';
                })
                ->editColumn("photos", function ($item) {
                    return $item->photos
                        ? '<img src="' .
                                Storage::url($item->photos) .
                                '" style="max-height: 80px;"/>'
                        : "";
                })
                ->rawColumns(["action", "photos"])
                ->make();
        }
        return view("pages.admin.product-gallery.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();

        return view("pages.admin.product-gallery.create", [
            "products" => $products,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductGalleryRequest $request)
    {
        // dd($request->all());
        $data = $request->all();

        $data["photos"] = $request
            ->file("photos")
            ->store("assets/product", "public");

        // $photos = [];

        // foreach ($data["photos"] as $photo) {
        //     $fileName = uniqid() . "." . $photo->getClientOriginalExtension();
        //     $photo_path = $photo->storeAs(
        //         "assets/product",
        //         $fileName,
        //         "public"
        //     );

        //     array_push($photos, $photo_path);
        // }

        // $data["photos"] = $photos;

        ProductGallery::create($data);

        return redirect()->route("product-gallery.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = ProductGallery::findOrFail($id);
        $item->delete();

        return redirect()->route("product-gallery.index");
    }
}
