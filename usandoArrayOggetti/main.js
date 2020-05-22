
function init(){
  getNameLastnameAddressPaganti()
}

$(document).ready(init);

function getNameLastnameAddressPaganti(){
  $.ajax({
  url: "server.php",
  method: "GET",
  success: function(data,stato) {
    console.log(data);
    var target = $("#target");
    for (var pagamento of data){
      target.append("<li>" + pagamento["status"]+ " " + pagamento["price"] + "</li>");
    }
  },
  error: function(richiesta,stato,errore){
    alert("Chiamata fallita!!!");
  }
});
}
