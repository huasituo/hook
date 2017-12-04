<?php 

class TestHook
{

    public function test1($data = array())
    {
        $data['b'] = '3';
        return $data;
    }
   

    public function test2($data = array())
    {
        $data['c'] = '4';
        return $data;
    }
}
