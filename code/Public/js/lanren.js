/* 代码整理：懒人之家 www.lanrenzhijia.com */
window.onload=function  () {
	var linksone=getClass("personal_left")[0].getElementsByTagName("a");
	var listsone=getClass("personal_table_right");
	tab(linksone,listsone);

	var links2=getClass("top")[0].getElementsByTagName("a");
	var lists2=getClass("userdiv");
	tab1(links2,lists2);

	var links3=getClass("top")[1].getElementsByTagName("a");
	var lists3=getClass("userdiv2");
	tab1(links3,lists3);


	// var links4=getClass("list4-title")[0].getElementsByTagName("a");
	// var lists4=getClass("list4-list");
	// tab(links4,lists4);


	var imgs=getClass("imgs")[0];
	var imgs1=getClass("imgs1");
	for (var i=0; i<4; i++) {
		imgs1[i].index=i;
		imgs1[i].onclick=function  () {
			animate(imgs,"height",0,20);
			for (var j=0; j<linksone.length; j++) {
				listsone[j].style.display="none";
			}
			listsone[(this.index)].style.display="block";
		}
	}
}
function tab (links,lists) {
for (var i=0; i<links.length; i++) {
    links[i].index=i;
    links[i].onclick=function  () {
	  for (var j=0; j<lists.length; j++) {
	    lists[j].style.display="none";
		links[j].style.background="";
		links[j].style.color="#000";
		links[j].parentNode.className="";
	  }
      lists[this.index].style.display="block";
		
	  this.style.color="#2f8abb";
	  this.parentNode.className="left_nav_now";
    }
  }
}

function tab1 (links,lists) {
for (var i=0; i<links.length; i++) {
    links[i].index=i;
    links[i].onclick=function  () {
	  for (var j=0; j<lists.length; j++) {
	    lists[j].style.display="none";
		links[j].style.background="";
		links[j].style.color="#000"
	  }
      lists[this.index].style.display="block";
		
	  this.style.color="#f2bb64";
    }
  }
}
/* 代码整理：懒人之家 www.lanrenzhijia.com */