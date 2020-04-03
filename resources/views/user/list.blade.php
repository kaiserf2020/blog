<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="/layer/layer/jquery.js"></script>
    <script src="/layer/layer/layer.js"></script>

</head>
<body>
    <table>
        <tr>
            <td>ID</td>
            <td>用户名</td>
            <td>密码</td>
            <td>操作</td>
        </tr>
        @foreach($user as $v)
        <tr>
            <td>{{$v->id}}</td>
            <td>{{$v->username}}</td>
            <td>{{$v->password}}</td>
            <td><a href="/user/edit/{{$v->id}}">修改</a><a href="javascript:;" onclick="del_member(this,{{$v->id}})">删除</a></td>
        </tr>
        @endforeach
    </table>
    <style>
        table,tr,td{
            border: black 1px solid;
        }
    </style>
    <script>
        //删除用户
        function del_member(obj,id) {
            layer.confirm('是否确认删除用户？', {
                btn: ['确认','取消'] //按钮
            }, function(){
                $.get('/user/del/'+id,function (data) {
                    //如果删除成功
                    if (data.status == 0) {
                        $(obj).parents('tr').remove();
                        layer.msg(data.message, {icon: 6});
                    }else{
                        layer.msg(data.message, {icon: 5});
                    }
                });

            });

        }
    </script>
</body>
</html>
