function showSubmenu(objToShow){
	var $obj = $(objToShow);
	var $newobj;
	if($obj.hasClass("visible")){
		$obj.removeClass("visible");
		$("#"+$obj.attr("id")+"_new").remove();
	}else{
		$("#"+$(".visible").attr("id")+"_new").remove();
		$(".visible").removeClass("visible"); //remove all others
		var $prev = $obj.prev();
		//console.log($prev.offset().top+$prev.innerHeight());
		$obj.css({
			"top":($prev.offset().top+$prev.outerHeight()+5)+"px",
			"left":($prev.offset().left+5)+"px",
		});
		//have to copy it because of the div it's in
		$newobj = $obj.clone(true);
		$newobj.attr("id",$newobj.attr("id")+"_new");
		$("body").append($newobj);
		//TODO: add mouse out listener when hovering over another menu item
		//TODO: add mouse click listener when mouse is outside of ul
		$obj.addClass("visible");
		$newobj.show(100);
	}
	$(window).click(function(event){
		var $elem = $("#"+$(".visible").attr("id")+"_new");
		var pos = $elem.position();
		if(pos !== null && (event.clientX > (pos.left+$elem.width()) 
			|| event.clientX < pos.left
			|| event.clientY > pos.top+$elem.height())){
			$elem.remove();
			$(".visible").removeClass("visible");	
		}
	});
}

function showHelpScreen(){
	//use lightbox and another page.
	$("#help").show();
}
