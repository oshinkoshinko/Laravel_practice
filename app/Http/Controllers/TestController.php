<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Test;

class TestController extends Controller
{
    //
    public function index()
    {

        $values = Test::all();

        // dd($values); //変数の中身を確認できる
        //tests.testのviewファイルへ飛ぶ
        return view('tests.test', compact('values'));
    }
}
