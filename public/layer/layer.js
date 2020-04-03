layer.confirm('是否确认删除用户？', {
    btn: ['确认','取消'] //按钮
}, function(){
    layer.msg('用户已删除', {icon: 1});
}, function(){
    layer.msg('取消删除操作', {
        time: 20000, //20s后自动关闭
        btn: ['明白了', '知道了']
    });
});
