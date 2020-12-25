<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //


        $this->validate($request, [
            'userpic' => 'required_without:name',
            'name' => 'required_without:userpic'
        ]);

        $profile = Profile::all();
        if ($profile->isEmpty()) {


            $saveProfile = new Profile();
            if ($request->filled('name')) {
                $saveProfile->name = request()->name;
            }
            if (request()->hasFile('userpic')) {
                $saveProfile->imagePath = request()->file('userpic')->hashName();
                request()->file('userpic')->store('/public/userpics');
            }


            $saveProfile->save();
            return Profile::all()[0];
            //    return request()->file('userpic')->store('/public/userpics');


        } else {
            $profile = Profile::findOrFail(1);
            if ($request->filled('name')) {
                $profile->name = request()->name;
            }

            if (request()->hasFile('userpic')) {
                $profile->imagePath = request()->file('userpic')->hashName();
                request()->file('userpic')->store('/public/userpics');
            }
            $profile->save();
            return Profile::all()[0];
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
        return Profile::all()[0];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
