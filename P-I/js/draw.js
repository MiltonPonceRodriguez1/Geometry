var points = null;

$(document).ready(function() {
    $('#drawform').submit(function(e) {
        e.preventDefault();

        // Recuperamos los resultados del algoritmo de Graham
        var response_data = JSON.parse( localStorage.getItem('response_data') );
        // Recuperamos el numero del paso que sigue
        var steps = localStorage.getItem('steps');

        // Dibujamos el paso correspondiente
        drawConvexHull(response_data, steps);

    });
});

function drawConvexHull(response_data, steps) {
    steps = parseInt(steps);

    var canvas = document.getElementById('canvasDraw');
    var ctx = canvas.getContext('2d');

    ctx.clearRect(0, 0, 1000, 1000);

    var points = response_data['points'];
    var final_points = response_data['finalPoints'];

    var i;
    var trasladar = 20 ;
    var dez_x = 15;
    var dez_y = 8;

    var o;
    var m;
    var f;
    var draw_letters = true;


    if( steps == 0 ) {
        o = final_points[0];
        m = final_points[1];
        f = final_points[2];
    } else if( steps > final_points.length-1 ) {
        draw_letters = false;
        o = final_points[final_points.length-3];
        m = final_points[final_points.length-2];
        f = final_points[final_points.length-1];
    } else {
        if( steps == final_points.length-1 ){
            o = final_points[steps-1];
            m = final_points[steps];
            f = final_points[0];
        } else {
            // Se cambian los puntos
            o = final_points[steps-1];
            m = final_points[steps];
            f = final_points[steps+1];
        }
    }

    if(draw_letters) {
        ctx.font="13pt Verdana";
        ctx.fillStyle = "black";
        ctx.fillText("o", (o.x + dez_x  - 1) * trasladar , (o.y + dez_y) * trasladar );

        ctx.font="13pt Verdana";
        ctx.fillStyle = "black";
        ctx.fillText("f", (f.x + dez_x - 1) * trasladar , (f.y + dez_y) * trasladar ); 

        ctx.font="13pt Verdana";
        ctx.fillStyle = "black";
        ctx.fillText("m",(m.x + dez_x - 1) * trasladar , (m.y + dez_y) * trasladar );
    }

    // dibujar las lineas de la convex que ya pasaron
    ctx.lineWidth = 4;
    ctx.strokeStyle = "#37DA23";
    for(i=0; i<steps-1; i++) {

        if(i == final_points.length-1) {
            ctx.beginPath();
            ctx.moveTo( (final_points[i].x + dez_x) * trasladar, (final_points[i].y + dez_y) * trasladar );
            ctx.lineTo( (final_points[0].x + dez_x) * trasladar, (final_points[0].y + dez_y) * trasladar );
            ctx.stroke();
        } else {
            ctx.beginPath();
            ctx.moveTo( (final_points[i].x + dez_x) * trasladar, (final_points[i].y + dez_y) * trasladar );
            ctx.lineTo( (final_points[i+1].x + dez_x) * trasladar, (final_points[i+1].y + dez_y) * trasladar );
            ctx.stroke();
        }

    }

    ctx.lineWidth = 4;
    if( steps > final_points.length-1 ){
        ctx.strokeStyle = "#37DA23";
    } else {
        ctx.strokeStyle = "#1C5DF9";
    }

    ctx.beginPath();
    ctx.moveTo( (o.x + dez_x ) * trasladar, (o.y + dez_y) * trasladar );
    ctx.lineTo( (m.x + dez_x ) * trasladar, (m.y + dez_y) * trasladar );
    ctx.stroke();

    if( steps > final_points.length-1 ){
        ctx.strokeStyle = "#37DA23";
    } else {
        ctx.strokeStyle = "red";
    }

    ctx.beginPath();
    ctx.moveTo( (m.x + dez_x ) * trasladar, (m.y + dez_y) * trasladar );
    ctx.lineTo( (f.x + dez_x ) * trasladar, (f.y + dez_y) * trasladar );
    ctx.stroke();

    var pointSize = 4; // Cambia el tamaño del punto
    ctx.fillStyle = "black"; // Color rojo

    for(i=0; i<points.length; i++) {
        points[i].id = i + 1;
    }

    console.log(points);
    
    for(i=0; i<points.length; i++) {
        ctx.beginPath(); // Iniciar trazo
        ctx.arc( (points[i].x + dez_x ) * trasladar , (points[i].y + dez_y) * trasladar, pointSize, 0, Math.PI * 2, true); // Dibujar un punto usando la funcion arc
        ctx.fill(); // Terminar trazo

        ctx.font="13pt Verdana";
        ctx.fillStyle = "black";
        ctx.fillText(points[i].id , (points[i].x + dez_x) * trasladar , (points[i].y + dez_y+1) * trasladar );
    }



    if( steps == 0 ) {
        steps = 2;
        localStorage.setItem('steps', steps);
    } else {
        steps = steps + 1;
        localStorage.setItem('steps', steps);
    }

}
