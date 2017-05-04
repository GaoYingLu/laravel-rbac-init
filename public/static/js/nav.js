$(function() {
                $(".nav li").hover(
                        function() {
                            $(this).find("ul").show();
                        },
                        function() {
                            $(this).find("ul").hide();
                        }
                );
//              $(".nav li a").on("click",function(){
//              	$(this).addClass("active").siblings().removeClass();
//              })
                
            });