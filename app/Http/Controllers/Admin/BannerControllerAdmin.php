<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\Admin\BannerRequest;

use Yajra\DataTables\Facades\DataTables;

class BannerControllerAdmin extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Banner::all();

            return Datatables::of($query)
                ->addColumn("action", function ($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">Aksi
                                </button>
                                <div class="dropdown-menu">
                                    <form action="' .
                        route("banner.destroy", $item->id) .
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
                ->editColumn("foto_banner", function ($item) {
                    return $item->foto_banner
                        ? '<img src="' .
                                Storage::url($item->foto_banner) .
                                '" style="max-height: 80px;"/>'
                        : "";
                })
                ->rawColumns(["action", "foto_banner"])
                ->make();
        }
        return view("pages.admin.banner.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banners = Banner::all();

        return view("pages.admin.banner.create", [
            "banners" => $banners,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BannerRequest $request)
    {
        // dd($request->all());
        $data = $request->all();

        $data["foto_banner"] = $request
            ->file("foto_banner")
            ->store("assets/banner", "public");

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

        Banner::create($data);

        return redirect()->route("banner.index");
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
    public function update(Request $request, $id)
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
        $item = Banner::findOrFail($id);
        $item->delete();

        return redirect()->route("banner.index");
    }
}
