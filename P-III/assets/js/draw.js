function allPointsRight(response_data) {
    var points = response_data['points'];

    var userPoint = response_data['user_point'][0];
    var neighbor = response_data['neighbor'][0];
    var i;

    for(i=0; i<points.length; i++)
        points[i].y = points[i].y * -1;

    userPoint.x = parseInt(userPoint.x);
    userPoint.y = parseInt(userPoint.y);

    neighbor.x = parseInt(neighbor.x);
    neighbor.y = parseInt(neighbor.y);


    userPoint.y = userPoint.y * -1;
    neighbor.y = neighbor.y * -1;

    var min=points[0].y;
    for(i=1; i<points.length; i++){
        if( points[i].y < min ) {
            min = points[i].y;
        }
    }

    if(min<0)
        min = min * -1;

    min += 10;

    userPoint.y = userPoint.y + min;
    neighbor.y = neighbor.y + min;

    for(i=0; i<points.length; i++)
        points[i].y = points[i].y + min;

}

function draw2D() {

    var response_data = JSON.parse( localStorage.getItem('response_data') );
    var canvas = document.getElementById('canvasDraw');
    var ctx = canvas.getContext('2d');
    var points = response_data['points'];
    var neighbor = response_data['neighbor'];
    var user_point = response_data['user_point'];
    var steps = localStorage.getItem('steps');
    var trasladar = 8;
    var dez_x = 0;
    var dez_y = 0;
    var pointSize = 4;
    steps = parseInt(steps);


    /* DRAW USER POINT */
    ctx.fillStyle = "blue";

    ctx.beginPath();
    ctx.arc((user_point[0].x + dez_x ) * trasladar , (user_point[0].y + dez_y) * trasladar, pointSize, 0, Math.PI * 2, true);
    ctx.fill();

    ctx.font="italic 10pt Times New Roman, Verdana";
    ctx.fillStyle = "black";
    ctx.fillText('user', (user_point[0].x +  dez_x + 2) * trasladar, (user_point[0].y +  dez_y) * trasladar, 250);

    ctx.fillStyle = "black";

    if (steps < points.length + 2) {
        ctx.clearRect(0, 0, 1000, 1000);

        var matrix = [];
        for(i=0; i<100; i++) {
            var arrayTemp = [];
            for(j=0; j<100; j++) {
                arrayTemp.push(0);
            }
            matrix.push(arrayTemp);
        }

        for(i=0; i<steps-1; i++) {

            if( points[i].x == neighbor[0].x && points[i].y == (neighbor[0]. y)) {
                ctx.fillStyle = "#F91010";
                pointSize = 4;
            } else {
                ctx.fillStyle = "black";
                pointSize = 3;
            }

            ctx.beginPath();
            ctx.arc( (points[i].x + dez_x ) * trasladar , (points[i].y + dez_y) * trasladar, pointSize, 0, Math.PI * 2, true);
            ctx.fill();

            var lim_min = 0;
            var lim_max = 99;

            /* INICIO AQUI DIBUJO LAS LINEAS */
            if(points[i].axis == 'y') {

                // Se buscan los limites de donde a donde se va a dibujar la linea en Y
                for(j=points[i].y; j>=0; j--) {
                    if(matrix[points[i].x][j] == 1){
                        lim_min = j-1;
                        break;
                    }
                }
                for(j=points[i].y; j<100; j++) {
                    if(matrix[points[i].x][j] == 1){
                        lim_max = j-1;
                        break;
                    }
                }
                for(j=lim_min; j<=lim_max; j++) {
                    matrix[points[i].x][j] = 1;
                }

                ctx.strokeStyle = "red";
                ctx.beginPath();
                ctx.moveTo((points[i].x + dez_x ) * trasladar, (lim_min+1 + dez_y) * trasladar);
                ctx.lineTo((points[i].x + dez_x ) * trasladar, (lim_max+1 + dez_y) * trasladar);
                ctx.stroke();
            } else {

                // Se buscan los limites de donde a donde se va a dibujar la linea en X
                for(j=points[i].x; j>=0; j--) {
                    if(matrix[j][points[i].y] == 1){
                        lim_min = j-1;
                        break;
                    }
                }
                for(j=points[i].x; j<100; j++) {
                    if(matrix[j][points[i].y] == 1){
                        lim_max = j-1;
                        break;
                    }
                }
                for(j=lim_min; j<=lim_max; j++) {
                    matrix[j][points[i].y] = 1;
                }

                ctx.strokeStyle = "red";
                ctx.beginPath();
                ctx.moveTo((lim_min+1 + dez_x ) * trasladar, (points[i].y + dez_y) * trasladar);
                ctx.lineTo((lim_max+1 + dez_x ) * trasladar, (points[i].y + dez_y) * trasladar);
                ctx.stroke();
            }

            /* FIN AQUI DIBUJO LAS LINEAS */
        }
    }

    steps = steps + 1;
    localStorage.setItem('steps', steps);
}
