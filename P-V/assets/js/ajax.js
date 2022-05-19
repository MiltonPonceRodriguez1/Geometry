
$(document).ready(function() {
    $('#loginform').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: './model/Main.php',
            data: $(this).serialize()  + "&selectedPoints="+localStorage.getItem('selectedPoints'),
            success: function(response) {
                var response_data = JSON.parse(response);
                console.log(response_data);

                if (response_data.status == 'success') {
                    // Reiniciamos los puntos seleccionados por el usuario
                    // localStorage.setItem('selectedPoints', JSON.stringify( [] ) );

                    // Guardamos los resultados obtenidos
                    localStorage.setItem('response_data', JSON.stringify(response_data));

                    localStorage.setItem('steps', 0);
                    alert('Ejecución Finalizada Correctamente !!');
                }
                else
                {
                    alert(response_data.msg);
                }
            }
        });
    });
});