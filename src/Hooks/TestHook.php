<?php 

class TestHook
{

    public function test1($data = [])
    {
        $data['b'] = '数组钩子1内容，正常';
        return $data;
    }
   
    public function test2($data = [])
    {
        $data['c'] = '数组钩子2内容，正常';
        return $data;
    }

    public function test3($html = '')
    {
        //echo 'html钩子1输出内容,正常<br />';
        $html .= '1';
        return $html;
    }

    public function test4($html = '') 
    {
        //echo 'html钩子2输出内容,正常<br />';
        $html .='2';
        return $html;
    }
}
