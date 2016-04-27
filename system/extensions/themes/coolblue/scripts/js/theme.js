$(document).ready(function() {

	var div = $('#hdr-menu');
	var start = $(div).offset().top;

	$.event.add(window, "scroll", function() {
		var p = $(window).scrollTop();
		$(div).css('position',((p)>start) ? 'fixed' : 'static');
		$(div).css('top',((p)>start) ? '0px' : '');
	});

});

function expandchatbox(){
	        xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState!==4){
                document.getElementById('overlay').style.display='block';
                document.getElementById('overlay').innerHTML='<img id="loadimg" src= "'+path+'/system/images/loading.gif"/>';
            }
            if (xmlhttp.readyState===4 && xmlhttp.status===200) {      
                document.getElementById('overlay').style.display='none';
					//alert(xmlhttp.responseText);
					
					var obj = JSON.parse(xmlhttp.responseText);
					
					
					var users = "";
					
					for(var i=0;i<obj.length;i++){
						users+= "&#9673; "+obj[i].user_fname+"<br>";
					}
					
					var br = document.createElement("br");
					
					var post_button = document.createElement("button");
					post_button.innerHTML = "Post";
					
					var clear_button = document.createElement("button");
					clear_button.innerHTML = "Clear";	
					
					var close_button = document.createElement("button");
					close_button.innerHTML = "Close";	
					
					close_button.onclick=function(){
						close_chat_box();
					};									
					
					var textarea = document.createElement('textarea');
					setAttributes(textarea,{"cols":"35","rows":"5","style":"margin-bottom:10px;margin-top:10px;"});
					
					var chat_header = document.getElementById('chat_header');
					var  chat_main_div = document.getElementById('chat_main_div');
					
					chat_header.setAttribute("id","users_online");
					
					var message_area = document.createElement("div");
					//message_area.appendChild(users_div);
					
					message_area.innerHTML=users;
					chat_main_div.appendChild(message_area);
					
					chat_header.innerHTML='Users Online<br>';
					chat_main_div.appendChild(textarea);
					chat_main_div.appendChild(br);
					chat_main_div.appendChild(post_button);
					chat_main_div.appendChild(clear_button);
					chat_main_div.appendChild(close_button);
            }
        };
                                     
         xmlhttp.open("GET",path+"/mvc/Welcome/usersonline",true);
         xmlhttp.send();	
}
function close_chat_box(){
	//alert("Hello");
	var  chat_main_div = document.getElementById('chat_main_div');
	chat_main_div.innerHTML = "Toolkit Chatbox  &#9679;";
	
	chat_main_div.onclick = function(){
		expandchatbox();
	};
}
