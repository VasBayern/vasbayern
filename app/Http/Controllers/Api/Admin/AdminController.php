<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function getSlug(Request $request) {
        $slug = Str::slug($request->name, '-');
        return response()->json([ 'slug' => $slug ]);
    }

}
