<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>地址管理</title>
    <meta content="app-id=984819816" name="apple-itunes-app" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link href="{{url('css/comm.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{url('css/address.css')}}">
    <link rel="stylesheet" href="{{url('css/sm.css')}}">
</head>
<body>

<!--触屏版内页头部-->
<div class="m-block-header" id="div-header">
    <strong id="m-title">地址管理</strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="/address/addressadd" class="m-index-icon">添加</a>
</div>
<div class="addr-wrapp">
    @foreach($addressinfo as $v)
    <div class="addr-list">
        <input type="hidden"  class="address_id" value="{{$v->address_id}}">
        <ul>
            <li class="clearfix">
                <span class="fl">{{$v->address_name}}</span>
                <span class="fr">{{$v->address_tel}}</span>
            </li>
            <li>
                <p>{{$v->address_area}}{{$v->address_detail}}</p>
            </li>
            <li class="a-set">
                @if($v->is_default == 1)
                <s class="z-set" style="margin-top: 6px;"></s>
                @else
                <s class="z-defalt" style="margin-top: 6px;"></s>
                @endif
                <span class="moren">设为默认</span>
                <div class="fr">
                    <span class="edit">编辑</span>
                    <span class="remove">删除</span>
                </div>
            </li>
        </ul>
    </div>
    @endforeach
    

</div>


<script src="{{url('js/zepto.js')}}" charset="utf-8"></script>
<script src="{{url('js/sm.js')}}"></script>
<script src="{{url('js/sm-extend.js')}}"></script>


<!-- 单选 -->
<script>


    // 删除地址
    $(document).on('click','span.remove', function () {
        // var buttons1 = [
        //     {
        //         text: '删除',
        //         bold: true,
        //         color: 'danger',
        //         onClick: function() {
        //             $.alert("您确定删除吗？");
        //         }
        //     }
        // ];
        // var buttons2 = [
        //     {
        //         text: '取消',
        //         bg: 'danger'
        //     }
        // ];
        // var groups = [buttons1, buttons2];
        // $.actions(groups);
        var address_id=$(this).parents('.addr-list').find('.address_id').val();
        //console.log(address_id)address_id=$(this).parents('.addr-list').find('.address_id').val();
        $.post(
            "/address/addressdel",
            {address_id:address_id,_token:'{{csrf_token()}}'},
            function(res){
                alert('删除地址成功');
                history.go(0);
            }
        )
        


    });
    $(document).on('click','.edit',function(){
        var address_id=$(this).parents('.addr-list').find('.address_id').val();
        location.href="/address/addressup/"+address_id;
    })


    $(document).on('click','.moren',function(){
        var address_id=$(this).parents('.addr-list').find('.address_id').val();
        //console.log(address_id);
        $.post(
            "/address/addressmoren",
            {address_id:address_id,_token:'{{csrf_token()}}'},
            function(res){
                alert('改变默认地址成功');
                history.go(0);
                //console.log(res)
            }
        )
    })
</script>
<script src="{{url('js/jquery-1.8.3.min.js')}}"></script>
<script>
    var $$=jQuery.noConflict();
    $$(document).ready(function(){
        // jquery相关代码
        $$('.addr-list .a-set s').toggle(
            function(){
                if($$(this).hasClass('z-set')){

                }else{
                    $$(this).removeClass('z-defalt').addClass('z-set');
                    $$(this).parents('.addr-list').siblings('.addr-list').find('s').removeClass('z-set').addClass('z-defalt');
                }
            },
            function(){
                if($$(this).hasClass('z-defalt')){
                    $$(this).removeClass('z-defalt').addClass('z-set');
                    $$(this).parents('.addr-list').siblings('.addr-list').find('s').removeClass('z-set').addClass('z-defalt');
                }

            }
        )

    });

</script>



</body>
</html>
