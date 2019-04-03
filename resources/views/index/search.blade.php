

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" name="viewport" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <title>搜索</title>

    <link href="{{url('css/comm.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('css/goods.css')}}" rel="stylesheet" type="text/css" />
</head>
<body class="g-acc-bg m-site-box" fnav="2">
    <input name="hidSearchKey" type="hidden" id="hidSearchKey" value="黄金" />
    
<!--触屏版内页头部-->
<div class="m-block-header" id="div-header" style="display: block">
    <strong id="m-title">搜索</strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="/" class="m-index-icon"><i class="m-public-icon"></i></a>
</div>

    <div class="pro-s-box thin-bor-bottom search-box pos-fix-0" id="divSearch">    
        <div class="box">
            <div class="border">
                <div class="border-inner"></div>
            </div>
            <div class="input-box">
                <i class="s-icon"></i>
                <input type="text" placeholder="输入“汽车”试试" value="" id="txtSearch" maxlength="10" />
                <i class="c-icon" id="btnClearInput" style="display: none"></i>
            </div>
        </div>
        <a href="javascript:;" class="s-btn" id="btnSearch">搜索</a>
    </div>
    

    <!--搜索结果模块-->
    <div  id="loadingPicBlock">
        <!--搜索有结果时-->
        <div class="goodList" >
           
        </div>

        <!--搜索无结果时-->
        <div class="null-search-wrapper" id="divNoneData" style="display: none">
            <div class="null-search-inner">
                <i class="null-search-icon"></i>
                <p class="gray9">抱歉，没有您想要的商品！</p>
            </div>

            <div class="hot-recom">
                <div class="title thin-bor-top gray6">人气推荐</div>
                <div class="goods-wrap thin-bor-top">
                    <ul class="goods-list clearfix" id="ulRec"></ul>
                </div>
            </div>
        </div>

    </div>

    

<div class="footer clearfix" style="display:none;">
    <ul>
        <li class="f_home"><a href="/index" ><i></i>潮购</a></li>
                <li class="f_announced"><a href="/index/indexshop" class="hover"><i></i>全部商品</a></li>
                <li class="f_single"><a href="#" ><i></i>呵呵哒</a></li>
                <li class="f_car"><a id="btnCart" href="/index/indexshopcar" ><i></i>购物车</a></li>
                <li class="f_personal"><a href="/index/indexuser" ><i></i>我的潮购</a></li>
    </ul>
</div>

<script src="{{url('js/jquery-1.11.2.min.js')}}"></script>
<script>
    $(function(){
        $("#btnSearch").click(function(){
            var search=$('#txtSearch').val();
            if(search==''){
                    alert('请输入搜索内容');
                    return false;
            }  
            $.post(
                    "/index/searchdo",
                    {_token:'{{csrf_token()}}',search:search},
                    function(res){
                        $(".goodList").html(res);
                        //console.log(res)
                    }
            )       
        })
        //添加购物车
            $(document).on('click','.cartadd',function(){
                var _this=$(this);
                var goods_id=_this.attr('goods_id');
                //console.log(goods_id)
                $.post(
                    "/index/addcart",
                    {goods_id:goods_id,_token:'{{csrf_token()}}'},
                    function(res){
                        //console.log(res);
                        if(res==1){
                            alert("请先登陆!");
                            location.href="{{url('user/login')}}";
                        }else if(res==2){
                            alert('添加成功');
                            location.href="{{url('index/indexshopcar')}}";
                        }
                    }
                )
            })
    })
</script>
</body>
</html>
