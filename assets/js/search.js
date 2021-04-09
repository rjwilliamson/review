let searchBtn = document.querySelector("#searchBtn");
 
   
     search.addEventListener('input',() => {
    
         let search = document.querySelector("#search");

		$.post('php/search.php',{search:$.trim(search.value)},(data) => {
        
        if(search.value !=""){
         	$('#search_results').html(data);
         }else{
         	$('#search_results').html("");
         }

		

		});
  


    });






