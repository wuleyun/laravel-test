<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Services\OSS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\MessageBag;

class FileController extends Controller
{

    /**
     * 文件上传
     * @param  Request $request [文件信息]
     * @return redirect         [文件列表页]
     */
    public function adminvideoupload(Request $request)
    {
    	$result = ["result" => true, "errorinfo" => "", "data" => []];
        if ($request->hasFile('uploadvideo')) {

            $t= ['rm','rmvb','mp4', 'mov','mtv', 'dat', 'wmv', 'avi', '3gp', 'amv', 'dmv', 'flv'];
            $s= 600*1024*1024;
            $files = $request->file('uploadvideo');
            $name=$request->input('name')?$request->input('name'):'';
            $not_allow=[];
            try {
                foreach ($files as $fileitem){
                    $oname=$fileitem->getClientOriginalName();
                    if(!in_array($fileitem->getClientOriginalExtension(), $t) || $fileitem->getSize() > $s){
                        $not_allow[]=$oname;
                        continue;
                    }

                    if ($fileitem->isValid()) {
                        $path = $fileitem->storeAs('uploads/videos',$oname);

                        $filepath = base_path() . Storage::url('app/' . $path);

                        if(env('APP_DEBUG')){
                            $url=env('APP_URL').'/';
                            Storage::disk('local')->put($path, file_get_contents($fileitem->getRealPath()));
                        }else {
                            OSS::publicupload('bangwai' ,$path, $filepath);
                            $url='https://img.banghaiwai.com/';
                        }
                        // $imgpath = OSS::getUrl($path);
                        Video::insertGetId([
                                'name'=>$name,
                                'url' => $url . $path
                        ]);
                        //Delete from local
                        if(!env('APP_DEBUG')){
                            Storage::delete($path);
                        }
                    }
                }

            } catch (\Illuminate\Database\QueryException $e) {
                Log::info("Request URL:" . $request->url());
                Log::error($e->getMessage());
                abort(500);
            } catch (Exception $e) {
                Log::info("Request URL:" . $request->url());
                Log::error($e->getMessage());
                abort(500);
            }

        } else {
            $error = new MessageBag(['title'=>'提示','message'=>'请选择文件']);
            return back()->withInput()->with(compact('error'));
        }
    	if(!empty($not_allow)){
    		$error = new MessageBag(['title'=>'提示','message'=>'请选择文件']);
    		return back()->withInput()->with(compact('error'));
    	}
    	return '成功';
    }

}
