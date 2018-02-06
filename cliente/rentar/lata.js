$.ajax({
    url: "daraLata.php",
    type: "GET"
}).done(function(o) {
    if(o == "true"){
      $('.ui.basic.modal')
        .modal('setting', 'closable', false)
        .modal({
          onApprove : function() {
              location.href ="https://tianguismexico.mx/cliente/panel/";
            }
        })
        .modal('show')
      ;

    }
})
