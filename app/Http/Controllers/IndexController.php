<?php

namespace App\Http\Controllers;

use App\Models\Block;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        $blocks = Block::where('is_empty', true)->get();
        dd($blocks[6]->fridgeroom->location);
        return view('index');
    }
}
