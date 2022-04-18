function draw2D() {
    // Recuperamos los resultados del algoritmo de Graham
    var response_data = JSON.parse( localStorage.getItem('response_data') );

    var canvas = document.getElementById('canvasDraw');
    var ctx = canvas.getContext('2d');

    ctx.clearRect(0, 0, 1000, 1000);

    var points = response_data['points'];
    var neighbor = response_data['neighbor'];
    var user_point = response_data['user_point'];
    var steps = localStorage.getItem('steps');
    steps = parseInt(steps);
    //var points_rect = response_data['points_rect'];

    console.log(steps);
    

    var trasladar = 7;
    var dez_x = 50;
    var dez_y = 70;


    var pointSize = 4; // Cambia el tamaño del punto
    ctx.fillStyle = "black"; // Color rojo
    
    /*for(i=0; i < points.length; i++) {
        points[i].y *= -1; 
        ctx.beginPath(); // Iniciar trazo
        ctx.arc( (points[i].x + dez_x ) * trasladar , (points[i].y + dez_y) * trasladar, pointSize, 0, Math.PI * 2, true); // Dibujar un punto usando la funcion arc
        ctx.fill(); // Terminar trazo
    }

    var pointSize = 5; // Cambia el tamaño del punto
    ctx.fillStyle = "red"; // Color rojo
    neighbor[0].y *= -1; 
    ctx.beginPath(); // Iniciar trazo
    ctx.arc( (neighbor[0].x + dez_x ) * trasladar , (neighbor[0].y + dez_y) * trasladar, pointSize, 0, Math.PI * 2, true); // Dibujar un punto usando la funcion arc
    ctx.fill(); // Terminar trazo

    var pointSize = 5; // Cambia el tamaño del punto
    ctx.fillStyle = "blue"; // Color rojo
    user_point[0].y *= -1; 
    ctx.beginPath(); // Iniciar trazo
    ctx.arc( (user_point[0].x + dez_x ) * trasladar , (user_point[0].y + dez_y) * trasladar, pointSize, 0, Math.PI * 2, true); // Dibujar un punto usando la funcion arc
    ctx.fill(); // Terminar trazo
    */

    var pointSize = 4; // Cambia el tamaño del punto
    ctx.fillStyle = "black"; // Color rojo

   
    
    for(i=0; i<steps-1; i++) {
        //ctx.fillStyle = "black"; // Color rojo
        console.log(steps);
        console.log(points.length);
        points[i].y *= -1; 
        ctx.beginPath(); // Iniciar trazo
        ctx.arc( (points[i].x + dez_x ) * trasladar , (points[i].y + dez_y) * trasladar, pointSize, 0, Math.PI * 2, true); // Dibujar un punto usando la funcion arc
        ctx.fill(); // Terminar trazo

        if(points[i].axis == 'y') {
            //console.log("SE pinta en y");
            ctx.strokeStyle = "red";
            ctx.beginPath();
            ctx.moveTo( (points[i].x + dez_x ) * trasladar, (10 + dez_y) * trasladar );
            ctx.lineTo( (points[i].x + dez_x ) * trasladar, (-100 + dez_y) * trasladar );
            ctx.stroke();
        } else {
            //console.log("SE pinta en X");

            ctx.strokeStyle = "red";
            ctx.beginPath();
            ctx.moveTo( (-50 + dez_x ) * trasladar, (points[i].y + dez_y) * trasladar );
            ctx.lineTo( (100 + dez_x ) * trasladar, (points[i].y + dez_y) * trasladar );
            ctx.stroke();
        }
        
    }

    

    if( steps == 0 ) {
        steps = 2;
        localStorage.setItem('steps', steps);
    } else {
        steps = steps + 1;
        localStorage.setItem('steps', steps);
    }
    
}
