 </div>
   
    <script src="js/jquery.js"></script>

     <script>
     
	 // script to check all checkboxes
	 
	 $(document).ready(function(){
		 
		$('#selectAllBoxes').click(function(event){
			
			if(this.checked){
			
			    $('.checkBoxes').each(function(){
					
					this.checked = true;
					
				});
			
				
			}else{
				 $('.checkBoxes').each(function(){
					
					this.checked = false;
					
				});
				
				
			}
			
		});
		 
		 
		 
		 
		 
		 //loader script
		 
		 var div_box = "<div id='load-screen'><div id='loading'></div></div>";
		 
		 $("body").prepend(div_box);
		 
		 $('#load-screen').delay(500).fadeOut(600, function(){
	               
					$(this).remove();						  
											  
			});
		 
		 
		 //instant user_online script Ajax
		 
		 function loadUsersOnline(){
			 
			 $.get("functions.php?onlineusers=result", function(data){
				 
				 
				 $(".usersonline").text(data);
				 
			 });
			 
		 }
		 
		 setInterval(function(){
			 
			 loadUsersOnline();
			 
			 //calling the function loadUsersOnline() every 500 seconds
		 },500);
		 
		 
		 
		 
	 });
     
     
     
     </script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
