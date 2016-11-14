        var a=document.getElementById('one').children;
        var b=document.getElementById('two').children;
        var c=document.getElementById('three').children;
        var al=a.length;
        var bl=b.length;
        var cl=c.length;
        for(var i=0;i<al;i++){
            a[i].onclick=function(){
                
                for(var j=0;j<al;j++){
                     a[j].style=" width:79px; height:34px; float:left;text-align:center; line-height:34px;  margin-bottom:10px;font:bold;";
                }
                this.style=" width:75px;height:30px;float:left;text-align:center; line-height:30px; border: 2px solid rgb(47,138,185); color:rgb(47,137,187); font:bold;  margin-bottom:10px;";
            }       
        }
         for(var i=0;i<bl;i++){
            b[i].onclick=function(){
                
                for(var j=0;j<bl;j++){
                     b[j].style=" width:79px; height:34px; float:left;text-align:center; line-height:34px;  margin-bottom:10px;font:bold;";
                }
                this.style=" width:75px;height:30px;float:left;text-align:center; line-height:30px; border: 2px solid rgb(47,138,185); color:rgb(47,137,187); font:bold;  margin-bottom:10px;";
            }       
        }
         for(var i=0;i<cl;i++){
            c[i].onclick=function(){
                for(var j=0;j<al;j++){
                     c[j].style=" width:79px; height:34px; float:left;text-align:center; line-height:34px;  margin-bottom:10px;font:bold;";
                }
                this.style=" width:75px;height:30px;float:left;text-align:center; line-height:30px; border: 2px solid rgb(47,138,185); color:rgb(47,137,187); font:bold;  margin-bottom:10px;";
            }       
        }