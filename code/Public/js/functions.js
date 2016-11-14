/* 代码整理：懒人之家 www.lanrenzhijia.com */

function getClass (classname,obj) {
  var obj=obj||document
  var arr=[];
  if(obj.getElementsByClassName){
    return obj.getElementsByClassName(classname);
  }else{
    var all=obj.getElementsByTagName("*");
    for (var i=0; i<all.length; i++) {
		  if(checkClass(all[i].className,classname)){
		    arr.push(all[i]);
		  }
    }
	return arr;
  }
}
/* 代码整理：懒人之家 www.lanrenzhijia.com */
function checkClass (oldclass,newclass) {
 var arr=oldclass.split(" ");
 for (var i=0; i<arr.length; i++) {
	   if(arr[i]==newclass){
	     return true;
	   }
 }
 return false;
}



function getStyle (obj,attr) {
  if(window.getComputedStyle){
   return window.getComputedStyle(obj,null)[attr];
  }else{
    return obj.currentStyle[attr];
  }
}

function animate (obj,attr,end,speed) {
	var start=parseInt(getStyle(obj,attr));
	var change=start;
	var t=setInterval(function(){
	 if(end>start){
	  change+=speed;
	  if(change>=end){
	  clearInterval(t)
		  obj.style[attr]=end+"px";
	  }else{
		if(change>end){
		  change=end;
		}
	   obj.style[attr]=change+"px";
	  }
	 }else{
	    change-=speed;
	  if(change<=end){
	  clearInterval(t);
	  obj.style[attr]=end+"px";
	  }else{
		if(change<end){
		  change=end;
		}
		document.title=change;
	   obj.style[attr]=change+"px";
	  }
	 }
	},60)
}
