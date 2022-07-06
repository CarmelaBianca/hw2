<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title> Carrello </title>
        <link rel="icon" href="images/favicon.ico" />
        <link rel="stylesheet" href="<?php echo e(url('css/carrello.css')); ?>"/>
        <script src="<?php echo e(url('js/carrello.js')); ?>" defer></script>
        <script type="text/javascript">
            const CARRELLO_ROUTE = "<?php echo e(url('mio_carrello')); ?>";
            const ACQUISTA_ROUTE = "<?php echo e(url('acquista')); ?>";
        </script>
    </head>
    <body>
        <img src="images/main.jpg" id="main_img">
        <div id="menu_mobile">
            <div></div><div></div><div></div>
        </div>
        <nav>
            <div class="menu"><a href="home">Home</a></div>
            <div class="menu"><a href="crea">Crea annuncio</a></div>
            <div class="menu"><a href="annunci">I miei annunci</a></div>
            <div class="menu"><a href="preferiti">Preferiti</a></div>
            <div class="menu"><a href="logout">Logout</a></div>
        </nav>
    <div id="annunci">
        
    </div>
    <div id="totale">
        
    </div>
    </body>
</html><?php /**PATH C:\xampp\htdocs\example-app\resources\views/carrello.blade.php ENDPATH**/ ?>