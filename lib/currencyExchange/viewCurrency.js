 $(document).ready(function(){
  $("#btn").click(function(){
    var from = $("#from option:selected").val();
    var to = $("#to option:selected").val();
    var amount = $("#amount").val();
    $.ajax({
      url:"convert.php",
      method:"POST",
      data:{from:from ,to:to ,amount:amount ,},
      success:function(data){
           $('#value').html("amount is: "+data);
      }
    });
  });
});
