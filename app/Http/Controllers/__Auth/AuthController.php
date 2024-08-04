<?php

namespace App\Http\Controllers\__Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $name = $user->nickname ?? '';


        return view('index', compact('name'));
    }
    public function private()
    {
        if (!auth()->check()) {
            return response()->json([
                'message' => 'You did not provide a valid token.',
            ]);
        }
    }
    public function scope()
    {
        return response('You have `read:messages` permission, and can therefore access this resource.');
    }


}
