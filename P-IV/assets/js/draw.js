
function drawLines(ctx, points) {
    var move = 0;
    var enlarge = 16;

    ctx.strokeStyle = "#000000";
    ctx.lineWidth = 1;

    for(i=0; i<points.length; i++){
        for(j=0; j<points[i].length; j++){
            ctx.beginPath();
            ctx.moveTo( (points[i][j][0].xValue + move) * enlarge, (points[i][j][0].yValue + move) * enlarge );
            ctx.lineTo( (points[i][j][1].xValue + move) * enlarge, (points[i][j][1].yValue + move) * enlarge );
            ctx.stroke();
        }
    }
}

function drawPoints(ctx, points) {
    var move = 0;
    var enlarge = 16;

    // Dibujamos todos los puntos
    var pointSize = 6; // Cambia el tamaño del punto
    for(i=0; i<points.length; i++){
        for(j=0; j<points[i].length; j++){
            for(k=0; k<points[i][j].length; k++){

                ctx.fillStyle = "#9E0B0B"; // Color
                ctx.beginPath(); // Iniciar trazo
                ctx.arc( (points[i][j][k].xValue + move) * enlarge , (points[i][j][k].yValue + move) * enlarge, pointSize, 0, Math.PI * 2, true); // Dibujar un punto usando la funcion arc
                ctx.fill(); // Terminar trazo

            }
        }
    }
}

function draw2D_1() {

    var response_data = JSON.parse( localStorage.getItem('response_data') );
    var canvas = document.getElementById('canvasDraw');
    var ctx = canvas.getContext('2d');
    var points = response_data['points_delaunay'];

    drawLines(ctx, points);
    drawPoints(ctx, points);

}

function draw_for_step(ctx, step, points) {
    var move = 0;
    var enlarge = 16;

    ctx.strokeStyle = "#000000";
    ctx.lineWidth = 1;

    for(i=0; i<step; i++){
        for(j=0; j<points[i].length; j++){
            ctx.beginPath();
            ctx.moveTo( (points[i][j][0].xValue + move) * enlarge, (points[i][j][0].yValue + move) * enlarge );
            ctx.lineTo( (points[i][j][1].xValue + move) * enlarge, (points[i][j][1].yValue + move) * enlarge );
            ctx.stroke();
        }
    }

    // Dibujamos todos los puntos
    var pointSize = 6; // Cambia el tamaño del punto
    for(i=0; i<points.length; i++){
        for(j=0; j<points[i].length; j++){
            for(k=0; k<points[i][j].length; k++){

                ctx.fillStyle = "#9E0B0B"; // Color
                ctx.beginPath(); // Iniciar trazo
                ctx.arc( (points[i][j][k].xValue + move) * enlarge , (points[i][j][k].yValue + move) * enlarge, pointSize, 0, Math.PI * 2, true); // Dibujar un punto usando la funcion arc
                ctx.fill(); // Terminar trazo

            }
        }
    }

    step++;
    localStorage.setItem('steps', step);
}

function draw2D() {

    var canvas = document.getElementById('canvasDraw');
    var response_data = JSON.parse( localStorage.getItem('response_data') );
    var points = response_data['points_delaunay'];
    var step = localStorage.getItem('steps');

    if (canvas.getContext) {
        var ctx = canvas.getContext('2d');
        ctx.clearRect(0, 0, 1000, 1000);

        if(step < points.length){
            ctx.clearRect(0, 0, 1000, 1000);
            draw_for_step(ctx, step, points);

        } else {
            ctx.clearRect(0, 0, 1000, 1000);
            draw2D_1();
        }

    }

}


function clear_points() {
    var canvas = document.getElementById('canvasDraw');
    localStorage.setItem('steps', 0);

    if (canvas.getContext) {
        var ctx = canvas.getContext('2d');
        ctx.clearRect(0, 0, 1000, 1000);
    }

    localStorage.setItem('selectedPoints', JSON.stringify( [] ) );
}
