
$(document).ready(function() {
    $('#loginform').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: './model/Main.php',
            data: $(this).serialize(),
            success: function(response) {
                var response_data = JSON.parse(response);
                console.log(response_data);

                if (response_data.success == "1") {
                    // Salvamos los resultados de Graham
                    localStorage.setItem('response_data', JSON.stringify( response_data ) );
                    localStorage.setItem('steps', 0);

                    alert('Ejecución Finalizada Correctamente !!');
                }
                else
                {
                    alert('Error to send request !!');
                }
            }
        });
    });
});