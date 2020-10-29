function redireccionar(obj) {
    var valorSeleccionado = obj.options[obj.selectedIndex].value; 
       if ( valorSeleccionado == 2 ) {
          document.location = './metodoPago.php';
         
       }
       if ( valorSeleccionado == 3 ) {
          document.location = './metodoPago2.php';
          
       }
    // etc..
    }

