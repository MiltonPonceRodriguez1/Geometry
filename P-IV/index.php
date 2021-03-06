<!doctype html>
<html>
<head>
    <title>The Best Neighbor</title>
    <!-- <link rel="icon" type="image/x-icon" href="./assets/images/favicon.png"> -->


    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>

    <!-- Boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
    crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- ------------- -->

    <!-- Remote Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Stint+Ultra+Condensed&display=swap" rel="stylesheet">

    <script src="https://kit.fontawesome.com/55dd5b67a6.js" crossorigin="anonymous"></script>
    <script src="assets/js/ajax.js"></script>
    <script src="assets/js/draw.js"></script>

    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">

</head>
<body>
    <figure class="text-center">
        <blockquote class="blockquote">
            <h1 class="mt-4">Tarea IV - Geometría Computacional</h1>
        </blockquote>

        <div class="sub-text-h1">
            <figcaption class="blockquote-footer">
                <cite title="Source Title">Realizada por: </cite>Ponce Rodriguez Milton.
            </figcaption>
        </div>
    </figure>

    <div class="container botons mt-4">
        <div class="row">
            <form id="loginform" method="post">
                <div class="form-row row d-flex justify-content-center">
                    <div class="col-md-2"></div>


                    <!-- <div class="col-auto">
                        <input type="text" class="form-control mb-2" name="point_1" id="point_1" placeholder="Enter Point Neighbor: x, y">
                    </div> -->

                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-2" name="loginBtn" id="loginBtn">
                            <i clss="fa-solid fa-play"></i>
                            EXECUTE
                        </button>
                    </div>

                    <div class="col-auto">
                    <button onclick="draw2D();" class="btn btn-light mb-2" type="button">
                            <i class="fa-solid fa-draw-polygon"></i>
                            DRAW
                        </button>
                    </div>

                    <div class="col-auto">
                    <button onclick="clear_points();" class="btn btn-light mb-2" type="button">
                            <i class="fa-solid fa-draw-polygon"></i>
                            CLEAR
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="container justify-content-center">
            <div id="contenedor" class="justify-content-center">
                <canvas class="lienzo rounded mt-4" width="800" height="540" id="canvasDraw"
                    style="">
                    Your browser doesn't support canvas!
                </canvas>
            </div>
    </div>

    <script>
        var canvas = document.getElementById("canvasDraw");

        if (canvas && canvas.getContext) {

            var ctx = canvas.getContext("2d");

            if (ctx) {
                catch_click(ctx);
            }
        }

        function catch_click() {
            canvas.addEventListener("mousedown", function(evt) {

                var ClientRect = canvas.getBoundingClientRect();

                var selec_points = localStorage.getItem('selectedPoints');
                selec_points = JSON.parse(selec_points);
                console.log(selec_points);

                var x = evt.clientX - ClientRect.left;
                var y = evt.clientY - ClientRect.top;

                if(selec_points.length == 0) {
                    var array = [];
                    array.push([Math.round( (x-(x%16)) /16), Math.round( (y-(y%16)) /16)]);
                    localStorage.setItem('selectedPoints', JSON.stringify( array ));
                } else {
                    selec_points.push([Math.round( (x-(x%16)) /16), Math.round( (y-(y%16)) /16)]);
                    localStorage.setItem('selectedPoints', JSON.stringify( selec_points ));
                }

                draw_selected_points();

            }, false);
        }

        function draw_selected_points() {
            var selec_points = localStorage.getItem('selectedPoints');
            selec_points = JSON.parse(selec_points);

            if(selec_points.length > 0) {

                var canvas = document.getElementById("canvasDraw");

                if (canvas && canvas.getContext) {

                    var ctx = canvas.getContext("2d");

                    var trasladar = 0;
                    var agrandar = 16;
                    var pointSize = 6;
                    // ctx.clearRect(0, 0, 1000, 1000);
                    ctx.fillStyle = "#9E0B0B"; // Color

                    for(i=0; i<selec_points.length; i++){
                        // console.log(selec_points[i][0]);
                        ctx.beginPath(); // Iniciar trazo
                        ctx.arc( (selec_points[i][0] + trasladar) * agrandar , (selec_points[i][1] + trasladar) * agrandar, pointSize, 0, Math.PI * 2, true); // Dibujar un punto usando la funcion arc
                        ctx.fill(); // Terminar trazo
                    }

                }

            }
        }
    </script>

</body>
</html>