<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div>
    <form method="POST" action="{{url('/adminvideoupload')}}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <div class="rows" style="margin-bottom: 10px">
            <input ng-model="vname" name="name" class="vname" type="text" placeholder="视频名称">
        </div>

        <div class="rows" style="margin-bottom: 10px">
            <input class="videofile" name="uploadvideo[]" type="file"  require />
        </div>

        <div class="rows" style="margin-bottom: 10px">
            <textarea ng-model="vtextarea"  placeholder="视频描述" ></textarea>

        </div>

        <div class="rows">

{{--            <button type="submit">确定上传</button>--}}
            <input type="submit" value="确定上传" />
        </div>

    </form>

</div>
</body>
</html>
