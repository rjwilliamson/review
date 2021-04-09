let commentBtn = document.querySelector("#commentBtn");

commentBtn.addEventListener('click',()=>{
let commentBox = document.querySelector("#comment_box");
let url = document.querySelector("#url");

   

   if(commentBox.value !=""){


   $.post("php/comments.php",{commentBox:commentBox.value,url:url.value},(data)=>{
     
     commentBox.value="";
  
     $('#comment_results').html(data);


	      $.post("php/comment_count.php",{url:url.value},(comment_count)=>{
	     
	     
	     $('#comment_count').html(comment_count);
	     


	     });
      
     


     });


    


    }


     

});


  
