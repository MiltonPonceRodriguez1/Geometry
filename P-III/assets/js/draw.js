function draw2D() {
    
    var response_data = JSON.parse( localStorage.getItem('response_data') );
    var canvas = document.getElementById('canvasDraw');
    var ctx = canvas.getContext('2d');
    var points = response_data['points'];
    var neighbor = response_data['neighbor'];
    var user_point = response_data['user_point'];
    var steps = localStorage.getItem('steps');
    var trasladar = 10;
    var dez_x = 20;
    var dez_y = 50;
    var pointSize = 4; 
    steps = parseInt(steps);
    
    ctx.clearRect(0, 0, 1000, 1000);

    /* DRAW USER POINT */
    ctx.fillStyle = "blue"; 
    user_point[0].y *= -1; 

    ctx.beginPath(); 
    ctx.arc((user_point[0].x + dez_x ) * trasladar , (user_point[0].y + dez_y) * trasladar, pointSize, 0, Math.PI * 2, true); 
    ctx.fill(); 
    ctx.font="italic 10pt Times New Roman, Verdana";
    ctx.fillStyle = "black";
    ctx.fillText('user', (user_point[0].x +  dez_x + 2) * trasladar, (user_point[0].y +  dez_y) * trasladar, 250);

    ctx.fillStyle = "black";

    if (steps < points.length + 2) {
        for(i=0; i<steps-1; i++) {
            points[i].y *= -1;
            
            if( points[i].x == neighbor[0].x && points[i].y == (neighbor[0]. y)*-1) {
                ctx.fillStyle = "#F91010";
                pointSize = 4;  
            } else {
                ctx.fillStyle = "black";
                pointSize = 3;  
            }
            
            ctx.beginPath(); 
            ctx.arc( (points[i].x + dez_x ) * trasladar , (points[i].y + dez_y) * trasladar, pointSize, 0, Math.PI * 2, true); 
            ctx.fill(); 

            /* INICIO AQUI DIBUJO LAS LINEAS */
            if(points[i].axis == 'y') {
                ctx.strokeStyle = "red";
                ctx.beginPath();
                ctx.moveTo((points[i].x + dez_x ) * trasladar, (10 + dez_y) * trasladar);
                ctx.lineTo((points[i].x + dez_x ) * trasladar, (-100 + dez_y) * trasladar);
                ctx.stroke();
            } else {
                ctx.strokeStyle = "red";
                ctx.beginPath();
                ctx.moveTo((-50 + dez_x ) * trasladar, (points[i].y + dez_y) * trasladar);
                ctx.lineTo((100 + dez_x ) * trasladar, (points[i].y + dez_y) * trasladar);
                ctx.stroke();
            }

            /* FIN AQUI DIBUJO LAS LINEAS */
        }
    } else  {
        for(i=0; i < points.length; i++) {
            points[i].y *= -1; 
            ctx.beginPath(); 
            ctx.arc((points[i].x + dez_x ) * trasladar , (points[i].y + dez_y) * trasladar, pointSize, 0, Math.PI * 2, true); 
            ctx.fill(); 
        }

        /* DRAW BEST NEIGHBOR */
        pointSize = 4; 
        ctx.fillStyle = "red"; 
        neighbor[0].y *= -1; 

        ctx.beginPath(); 
        ctx.arc((neighbor[0].x + dez_x ) * trasladar , (neighbor[0].y + dez_y) * trasladar, pointSize, 0, Math.PI * 2, true); 
        ctx.fill(); 

        ctx.font="italic 10pt Times New Roman, Verdana";
        ctx.fillStyle = "black";
        ctx.fillText('best', (neighbor[0].x +  dez_x + 2) * trasladar, (neighbor[0].y +  dez_y) * trasladar, 250);
    }

    steps = steps + 1;
    localStorage.setItem('steps', steps);
}
