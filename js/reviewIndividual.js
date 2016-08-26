
$('.group1').start(function(cur){
        console.log(cur);
         $('#info').text(cur);
});

$(document).ready(function(){


  $(".delete").click(function(){
    if (!confirm("Do you really want to delete?")){
      return false;
    } else {
    	return true;
    }
  });




});

