<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title> Miei annunci</title>
        <link rel="icon" href="images/favicon.ico" />
        <link rel="stylesheet" href="<?php echo e(url('css/home.css')); ?>"/>
        <link rel="stylesheet" href="<?php echo e(url('css/n.css')); ?>"/>
        <script src="<?php echo e(url('js/miei_annunci.js')); ?>" defer></script>
        <script type="text/javascript">
            const ANNUNCI_ROUTE = "<?php echo e(url('miei_annunci')); ?>";
            const N_ADS ="<?php echo e(url('num_ads_annunci')); ?>";
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
            <div class="menu"><a href="preferiti">Preferiti</a></div>
            <div class="menu"><a href="carrello">Carrello<img src="images/cart.png" class="icon"><p id="n"></p></a></div>
            <div class="menu"><a href="logout">Logout</a></div>
        </nav>
        <p id="benvenuto"> <?php echo e($user); ?>, ecco i tuoi annunci</p>
        <div id="annunci">
            
        </div>
        </body>
</html><?php /**PATH C:\xampp\htdocs\example-app\resources\views/annunci.blade.php ENDPATH**/ ?>