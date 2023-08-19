<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class TesteController extends Controller
{
    //
    public function ajax_return(Request $request){
        $input = $request->all();
        var_dump($input);
        return json_encode([
            'status' => 'success',
            'teste' => 'teste',
            'redirect' => route('testehome'),
            "message" => "redirect to home ",
        ] );

    }
}
