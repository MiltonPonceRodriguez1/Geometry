<!doctype html>
<html>
<head>
    <title>Envolvente Convexa</title>
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
            <h1 class="mt-4">Tarea 1 - Geometría Computacional</h1>
        </blockquote>
        
        <div class="sub-text-h1">
            <figcaption class="blockquote-footer">
                <cite title="Source Title">Realizada por: </cite>Ponce Rodriguez Milton.
            </figcaption>
        </div>
    </figure>

    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-2 col-sep">
                <form id="loginform" method="post">
                    <button type="submit" class="btn btn-alert alert-primary border border-primary button-event-1" name="loginBtn" id="loginBtn">
                        <i class="fa-solid fa-play"></i>
                        EXECUTE
                    </button>
                    <!--<input type="submit" class="btn btn-alert alert-info border border-primary button-event-1" name="loginBtn" id="loginBtn" value="Execute" />-->
                </form>
            </div>

            <div class="col-md-2">
                <form id="drawform" method="post">
                    <button type="submit" class="btn btn-alert alert-info border border-primary button-event-2" name="loginBtn" id="loginBtn">
                    <i class="fa-solid fa-draw-polygon"></i>
                        DRAW
                    </button>
                    <!--<input type="submit" class="btn btn-alert alert-info border border-primary button-event-2" name="event" id="drawBtn" value="Draw" />-->
                </form>
            </div>
        </div>
    </div>

    <div class="container justify-content-center">
            <div id="contenedor" class="justify-content-center">
                <canvas class="lienzo rounded mt-4" width="1000" height="550" id="canvasDraw"
                    style=""
                >
                    Your browser doesn't support canvas!
                </canvas>
            </div>
    </div>

    

    <script src="js/ajax.js"></script>
    <script src="js/draw.js"></script>

</body>
</html>