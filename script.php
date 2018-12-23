 <script type="text/javascript">(function(){var t;(t=jQuery).bootstrapGrowl=function(s,e){var a,o,l;switch(e=t.extend({},t.bootstrapGrowl.default_options,e),(a=t("<div>")).attr("class","bootstrap-growl alert"),e.type&&a.addClass("alert-"+e.type),e.allow_dismiss&&(a.addClass("alert-dismissible"),a.append('<button  class="close" data-dismiss="alert" type="button"><span aria-hidden="true">&#215;</span><span class="sr-only">Close</span></button>')),a.append(s),e.top_offset&&(e.offset={from:"bottom",amount:e.top_offset}),l=e.offset.amount,t(".bootstrap-growl").each(function(){return l=Math.max(l,parseInt(t(this).css(e.offset.from))+t(this).outerHeight()+e.stackup_spacing)}),(o={position:"body"===e.ele?"fixed":"absolute",margin:0,"z-index":"9999",display:"none"})[e.offset.from]=l+"px",a.css(o),"auto"!==e.width&&a.css("width",e.width+"px"),t(e.ele).append(a),e.align){case"center":a.css({left:"50%","margin-left":"-"+a.outerWidth()/2+"px"});break;case"left":a.css("left","20px");break;default:a.css("right","20px")}return a.fadeIn(),e.delay>0&&a.delay(e.delay).fadeOut(function(){return t(this).alert("close")}),a},t.bootstrapGrowl.default_options={ele:"body",type:"info",offset:{from:"bottom",amount:20},align:"right",width:250,delay:4e3,allow_dismiss:!0,stackup_spacing:10}}).call(this);</script><script type="text/javascript">function tbinfo(mess){$.bootstrapGrowl('<i class="fa fa-spinner fa-spin"></i>  '+mess, {type: 'info',delay: 2000});}function tbsuccess(mess){$.bootstrapGrowl('<i class="fa fa-check"></i>  '+mess, {type: 'success',delay: 2000});}function tbdanger(mess){$.bootstrapGrowl('<i class="fa fa-times"></i>  '+mess, {type: 'danger',delay: 2000});}function tban(){$('.bootstrap-growl').remove();}</script>
    <div id="_lkn_" class="animated fadeInUp" style="position: fixed;display: block;margin-bottom: 0;left: 0;right:0;bottom: 0;height: 30px;width: 100%;background: #F44336;color: #ffffff;line-height: 30px;font-size: 100%;padding-left: 1rem;font-family: monospace;text-align: center;z-index: 999;display: none;"><b>CHÀ! Có vẻ không có kết nối</b></div>
    <script type="text/javascript">
      $(document).ready(function(){
        $('.content-wrapper').css('min-height',(window.innerHeight-171)+'px');
        $(window).on('resize',function(){
          $('.content-wrapper').css('min-height',(window.innerHeight-171)+'px');
        });
      });
    </script>
   <script type="text/javascript">/*
      var _z = setInterval(_x, 3000);
      function _x() {
        var _y = new XMLHttpRequest(),_=$('#_lkn_');
        var _f='<?php echo $ttth['HOST']; ?>/test-connect-internet.png';
        var r=3000;
        _y.open('HEAD',_f+'?subins='+r,false);
        try{
          _y.send();
          if(_y.status>=200&&_y.status<304){
            _.removeClass('fadeInUp');
            _.addClass('fadeOutDown');
            _.fadeOut(1000);
          }
          else{
            _.removeClass('fadeOutDown');
            _.addClass('fadeInUp');
            _.show();
          }
        }
        catch(e){
            _.removeClass('fadeOutDown');
            _.addClass('fadeInUp');
            _.show();
        }
      }*/
  </script>