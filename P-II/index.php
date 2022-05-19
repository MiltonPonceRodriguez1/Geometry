<!doctype html>
<html>
<head>
    <title>Rangos Ortogonales</title>
    <link rel="icon" type="image/x-icon" href="./assets/images/favicon.png">

    
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

    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">

</head>
<body>
    <figure class="text-center">
        <blockquote class="blockquote">
            <h1 class="mt-4">Tarea II - Geometría Computacional</h1>
        </blockquote>
        
        <div class="sub-text-h1">
            <figcaption class="blockquote-footer">
                <cite title="Source Title">Realizada por: </cite>Ponce Rodriguez Milton.
            </figcaption>
        </div>
    </figure>

    <div class="container botons mt-4">
        <div class="row justify-content-md-right">
            <form id="loginform" method="post" class="row justify-content-right">
                <div class="form-row row align-items-right">

                    <div class="col-md-4"></div>
                    
                    <div class="col-auto">
                        <input type="text" class="form-control mb-2" name="point_1" id="point_1" placeholder="Enter point 1 Rect: x, y">
                    </div>

                    <div class="col-auto">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" name="point_2" id="point_2" placeholder="Enter point 2 Rect: x, y">
                        </div>
                    </div>

                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-2" name="loginBtn" id="loginBtn">
                            <i class="fa-solid fa-play"></i>
                            EXECUTE
                        </button>
                    </div>

                    <div class="col-auto">
                    <button onclick="draw2D();" class="btn btn-light mb-2" type="button">
                            <i class="fa-solid fa-draw-polygon"></i>
                            DRAW
                        </button>
                    </div>
                    
                </div>
            </form>
        </div>
    </div>
    
    <div class="clearfix"></div>

    <div class="container justify-content-center">
            <div id="contenedor" class="justify-content-center">
                <canvas class="lienzo rounded mt-4" width="1000" height="540" id="canvasDraw"
                    style="">
                    Your browser doesn't support canvas!
                </canvas>
            </div>
    </div>

    

    <script src="assets/js/ajax.js"></script>
    <script src="assets/js/draw.js"></script>

</body>
</html>