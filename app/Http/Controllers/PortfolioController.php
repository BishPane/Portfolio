<?php

namespace App\Http\Controllers;

use App\Http\Requests\PortfolioItemRequest;
use App\Http\Requests\UpdatePortfolioItemRequest;
use Intervention\Image\Facades\Image;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $portfolios = Portfolio::all();
        // Log::info("PFOLIOS:" .$portfolios);
        return Portfolio::all();
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
    public function store(PortfolioItemRequest $request)
    {
        //
        $item = new Portfolio();

        $item->img_path = request()->file('itempic')->hashName();
        request()->file('itempic')->store('/public/itempics');
        $item->name = request()->name;
        $item->description = request()->description;

        $item->save();
        return $item;
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function show(Portfolio $portfolio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function edit(Portfolio $portfolio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePortfolioItemRequest $request, Portfolio $portfolio)
    {

        $id = $request->id;
        $itempic = $request->itempic;
        //  return $itempic;
        $item = Portfolio::find($id);


        if ($request->hasFile('itempic')) {
            $item->img_path = request()->file('itempic')->hashName();
            request()->file('itempic')->store('/public/itempics');
        }


        $item->description = request()->description;
        $item->name = request()->name;
        $item->save();
        return $item;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portfolio $portfolio, Request $request)
    {
        //
        //return $request;
        return Portfolio::where('id', request()->id)->delete();
    }
}
