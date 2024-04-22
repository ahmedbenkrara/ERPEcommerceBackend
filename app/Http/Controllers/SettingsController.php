<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function show()
    {
        $settings = json_decode(file_get_contents(public_path('/settings.json'),true));
        return response()->json($settings);
    }

    public function update(Request $req){
        $settings = json_decode(file_get_contents(public_path('/settings.json'),true));
        $settings->social->linkedin = $req->social['linkedin'];
        $settings->social->facebook = $req->social['facebook'];
        $settings->social->twitter = $req->social['twitter'];
        $settings->social->instagram = $req->social['instagram'];
        $settings->map = $req->map;
        $settings->about->who = $req->about['who'];
        $settings->about->why = $req->about['why'];
        $settings->description = $req->description;
        $new = json_encode($settings,JSON_PRETTY_PRINT);
        file_put_contents(public_path('/settings.json'),$new);
        return response()->json('success');
    }
}