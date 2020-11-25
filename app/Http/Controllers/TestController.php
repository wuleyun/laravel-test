<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Services\OSS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\MessageBag;

class TestController extends Controller
{

    /**
     * 文件上传
     * @param  Request $request [文件信息]
     * @return redirect         [文件列表页]
     */
    public function test(Request $request)
    {
        echo '这是测试的。。。。。';
    }

}
