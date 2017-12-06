<?php 

namespace Huasituo\Hook\Http\Controllers;

use Huasituo\Hook\Http\Controllers\Controller ;
use Illuminate\Http\Request;

use Hooks;

class TestController extends Controller
{

    public function index() 
    {
        $data = Hooks::call_hook('s_test_arr', ['a'=>1], true);
        return view('hook::test', ['data'=>$data]);
    }

}