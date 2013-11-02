jQuery.fn.extend({ 
        disableSelection : function() { 
            this.each(function() { 
                this.onselectstart = function() { 
                    	return false;
                	}; 
                this.unselectable = "on"; 
                jQuery(this).css('-moz-user-select', 'none'); 
            }); 
        },
		enableSelection : function(){
			this.each(function() { 
				this.onselectstart = function() {  
                	return true;
            	}; 
                this.unselectable = "off"; 
                jQuery(this).css('-moz-user-select', 'all'); 
            }); 
		}
});

$(document).ready(function () {
	$(".ui-layout-west ul li").not(".nodrag").mousedown(function(e){
		$(document).disableSelection();
		var isMouseDown = false;
		var action;
		var appendbefore;
		actionMover = $("#actionMover").empty();
		action = $(this).clone();
		action.appendTo("#actionMover");
		isMouseDown = true;
		actionMover.css("z-index",-999);
		actionMover.offsetLeft = e.pageX;
		actionMover.offsetTop = e.pageY;
		$("body").mousemove(function(e){
				if(isMouseDown){
					actionMover = $("#actionMover");
					$(this).css("cursor","move");
					actionMover.animate({
						left:e.pageX+"px",
						top:e.pageY+"px"},
						0);
					actionMover.show();
					actionMover.css("z-index",999);
					//border-top highlight on elements in the center div.
					centerdiv = $(".ui-layout-center");
					centerdivchildren = centerdiv.children();
					
					//add border for drop position
					for(i=0; i<centerdivchildren.length;i++){
						if(i>0){
							$("#actionMover2").html($(centerdivchildren[i]).offset().top+" - "+e.pageY);
							if(e.pageY < $(centerdivchildren[i]).offset().top 
									&& e.pageY > $(centerdivchildren[i-1]).offset().top){
								appendbefore = $(centerdivchildren[i]);
								$(centerdivchildren[i]).css("border-top","2px solid #000");
							}else{
								$(centerdivchildren[i]).css("border-top","");
							}
						}
					}
				}
    		}
		).mouseup(function(e){
			if(isMouseDown){
				//check if the mouse is over the center div.
				centerdiv = $(".ui-layout-center");
				centerdivpos = centerdiv.position();
				if(e.pageX >= centerdivpos.left 
						&& e.pageY >= centerdivpos.top 
						&& e.pageX <= centerdivpos.left + centerdiv.width()
						&& e.pageY <= centerdivpos.top + centerdiv.height()){
					//append the new element
					if(centerdiv.children().length > 0 && appendbefore != null){
						action.insertBefore(appendbefore);
					}else{
						centerdiv.append(action);
					}
					action.html(action.attr("data-displayName"));
					
					actionMover.css({
						left:0,
						top:0	
					});
				}else{
					actionMover.fadeOut(200,function(){
						actionMover.css("z-index",-999);
						actionMover.css({
							left:0,
							top:0
						});
					});
				}
				//align the element between others.
			}
			//clear the border
			for(i=0; i<centerdivchildren.length;i++){
				$(centerdivchildren[i]).css("border-top","");
			}
			
			isMouseDown = false;
			$(document).enableSelection();
			$(this).css("cursor","auto");
			
			//check element drop position.
			//if over layout-center then add new row to layout center, append PHP code.
			//if not, then blink and disappear.
		});
	});
});

