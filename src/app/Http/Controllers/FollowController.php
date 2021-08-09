<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Follow;

class FollowController extends Controller
{
    public function follow(Request $request)
    {
        $follows = new Follow;
        $follows->following_id = $request->following_id;
        $follows->followed_id = $request->followed_id;
        $follows->save();
    }
}
