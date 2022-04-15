function draw2D() {
    // Recuperamos los resultados del algoritmo de Graham
    var response_data = JSON.parse( localStorage.getItem('response_data') );

    var canvas = document.getElementById('canvasDraw');
    var ctx = canvas.getContext('2d');

    ctx.clearRect(0, 0, 1000, 1000);

    var points = response_data['points'];
    var points_rect = response_data['points_rect'];
    

    var trasladar = 20 ;
    var dez_x = 0;
    var dez_y = 28;
    

    var points = response_data['points'];
    console.log(points[0].x, points[0].y);

    var pointSize = 4; // Cambia el tamaño del punto
    ctx.fillStyle = "black"; // Color rojo
    
    for(i=0; i<points.length; i++) {
        points[i].y *= -1; 
        ctx.beginPath(); // Iniciar trazo
        ctx.arc( (points[i].x + dez_x ) * trasladar , (points[i].y + dez_y) * trasladar, pointSize, 0, Math.PI * 2, true); // Dibujar un punto usando la funcion arc
        ctx.fill(); // Terminar trazo
    }

    var pointSize = 4.2; // Cambia el tamaño del punto
    ctx.fillStyle = "#1832F9"; // Color rojo

    for(i=0; i<points_rect.length; i++) {
        points_rect[i].y *= -1;
        ctx.beginPath(); // Iniciar trazo
        ctx.arc( (points_rect[i].x + dez_x ) * trasladar , (points_rect[i].y + dez_y) * trasladar, pointSize, 0, Math.PI * 2, true); // Dibujar un punto usando la funcion arc
        ctx.fill(); // Terminar trazo
    }

    // dibujar las lineas de la convex que ya pasaron

    var rect_p1 = response_data['rect_p1'];
    var rect_p2 = response_data['rect_p2'];

    rect_p1.y *= -1;
    rect_p2.y *= -1;

    ctx.lineWidth = 4;
    ctx.strokeStyle = "red";

    ctx.beginPath();
    ctx.moveTo((rect_p1.x + dez_x ) * trasladar, (rect_p1.y + dez_y) * trasladar);
    ctx.lineTo((rect_p2.x + dez_x ) * trasladar, (rect_p1.y + dez_y) * trasladar);
    ctx.stroke();

    ctx.beginPath();
    ctx.moveTo((rect_p1.x + dez_x ) * trasladar, (rect_p1.y + dez_y) * trasladar);
    ctx.lineTo((rect_p1.x+ dez_x ) * trasladar, (rect_p2.y + dez_y) * trasladar);
    ctx.stroke();
    
    ctx.beginPath();
    ctx.moveTo((rect_p1.x+ dez_x ) * trasladar, (rect_p2.y + dez_y) * trasladar);
    ctx.lineTo((rect_p2.x+ dez_x ) * trasladar, (rect_p2.y + dez_y) * trasladar);
    ctx.stroke();

    ctx.beginPath();
    ctx.moveTo((rect_p2.x+ dez_x ) * trasladar, (rect_p2.y + dez_y) * trasladar);
    ctx.lineTo((rect_p2.x + dez_x ) * trasladar, (rect_p1.y + dez_y) * trasladar);
    ctx.stroke();

    
}
