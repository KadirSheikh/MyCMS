/*$(document).ready(function(){
    //checkall
    $('#select_all').click(function(event){
       if(this.checked){
           $('.checkbox').each(function(){
              this.checked = true; 
           });
       } 
        else{
            $('.checkbox').each(function(){
              this.checked = false; 
           });
        }
    });
});*/


$(document).ready(function(){
 //ckeditor
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        });
    
    
/*  var div_box = "<div id='load-screen'><div id='loading'></div></div>";
    
    $("body").prepend(div_box);
    $('#load-screen').delay(700).fadeOut(600 , function(){
       $(this).remove();
    });*/
    
});

function loadUsersOnline() {


	$.get("includes/nav.php?onlineusers=result", function(data){

		$(".usersonline").text(data);


	});

}


setInterval(function(){

	loadUsersOnline();


},500);
