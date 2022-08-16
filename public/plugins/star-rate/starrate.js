$(document).ready(function(){

$("input[type='radio']").click(function(){
var sim = $("input[type='radio']:checked").val();
$('#myratings').val(sim);
//alert(sim);
if (sim<3) { 
    $('.myratings').css('color','red'); 
    $(".myratings").text(sim); }
else{ 
        $('.myratings').css('color','green'); 
        $(".myratings").text(sim); 
    } 
}); 
    
    
});