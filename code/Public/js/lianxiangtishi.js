window.onload=function(){
	var length=$("#inputul li").length;
	for(var i=0;i<length;i++){
		$("#inputul li")[i].onclick=function(){
			$("#text").val(this.innerText);
			$("#inputul").css("display","none");

		}
	}
	$("#text")[0].oninput=function(){
   

				$("#inputul").css("display","block");
				// var text=$("#text").val();
				// for(var i=0;i<length;i++){
				// 		var str=$("#inputul li")[i].innerText;
				// 		var num=$("#text").val().length;
		  //               var sstr=str.substring(num);

				// 		$("#span_left").val(text);
				// 			console.log(123);
				// 		$("#span_right").val(sstr);
			 //    }
	}

















}
