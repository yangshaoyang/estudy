window.onload=function(){
	$("#up_onclick h1").click(function(){
		if(this.innerText=="<<"){
			this.innerHTML="&gt;&gt;";
			$("#up").fadeOut('slow');
		}
		else{
			this.innerHTML="&lt;&lt;";
			$("#up").fadeIn('slow');
		}
	});	
	$("#down_onclick h1").click(function(){
		if(this.innerText=="<<"){
			this.innerHTML="&gt;&gt;";
			$("#down").fadeOut('slow');
		}
		else{
			this.innerHTML="&lt;&lt;";
			$("#down").fadeIn('slow');
		}
	});	
	$("#top1").click(function(){
			if($("#top1").hasClass("hnow")){
				$("#top1").removeClass("hnow");
				$("#tt2").show();
				$("#tt1").hide();
				$("#title2").show();
				$("#title1").hide();
			}
			else{
				$("#top1").addClass("hnow");
				$("#top2").removeClass("hnow");
				$("#title1").show();
				$("#title2").hide();
				$("#tt1").show();
				$("#tt2").hide();

			}
	});
		$("#top2").click(function(){
			if($("#top2").hasClass("hnow")){
				$("#top2").removeClass("hnow");
				$("#title1").show();
				$("#title2").hide();
				$("#tt1").show();
				$("#tt2").hide();
			}
			else{
				$("#top2").addClass("hnow");
				$("#top1").removeClass("hnow");
				$("#title2").show();
				$("#title1").hide();
				$("#tt2").show();
				$("#tt1").hide();

			}
	});


}
  function testshow(id){
    	
		document.getElementById(id).style.display="block";
}
  function testhide(id){
    	
		document.getElementById(id).style.display="none";
}
