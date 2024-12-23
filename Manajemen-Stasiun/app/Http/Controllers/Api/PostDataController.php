<?php

namespace App\Http\Controllers\Api;
use App\Models\Rute;

use App\Models\Point;
use App\Models\Kereta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostDataResource;


    /**
     * index
     *
     * @return void
     */
class PostDataController extends Controller
{
    public function show ($post)
    {
        // gett all posts
        $kereta = Kereta::with('rute.points')->findOrFail($post); // Eager loading rute dan points
        $rutes = Rute::with('points')->get(); // Ambil semua rute dengan points
        //return collection of posts as a resource
    
        return new PostDataResource(true, 'List Data Point', $kereta, $rutes, 200);
    }
}
