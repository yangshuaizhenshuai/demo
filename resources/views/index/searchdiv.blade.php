 <ul>
                @foreach($data as $v)
                <li id="23901" >    
                    <a href="{{url('index/shopcontent/'.$v->goods_id)}}">
                    <span class="gList_l fl">        
                        <img src="{{url('/uploads')}}/{{$v->goods_img}}">    
                    </span>   
                    </a> 
                    <div class="gList_r">        
                        <h3 class="gray6">{{$v->goods_name}}</h3>        
                        <em class="gray9">价值：￥{{$v->self_price}}</em>        
                        <div class="gRate">            
                            <div class="Progress-bar">                
                                <p class="u-progress">
                                    <span style="width: 90.92307692307692%;" class="pgbar">
                                        <span class="pging"></span>
                                    </span>
                                </p>                
                                <ul class="Pro-bar-li">                    
                                    <li class="P-bar01"><em>591</em>已参与</li>                    
                                    <li class="P-bar02"><em>650</em>总需人次</li>                    
                                    <li class="P-bar03"><em>59</em>剩余</li>                
                                </ul>            
                            </div>            
                            <a codeid="13470136" class="cartadd" goods_id="{{$v->goods_id}}"><s></s></a>        
                        </div>    
                    </div>
                </li>
                @endforeach
</ul>