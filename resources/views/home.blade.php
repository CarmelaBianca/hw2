<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title> Home </title>
        <link rel="icon" href="images/favicon.ico" />
        <link rel="stylesheet" href="{{ url('css/home.css') }}"/>
        <script src="{{ url('js/home.js') }}" defer></script>
        <script type="text/javascript">
            const HOME_ROUTE = "{{url('home')}}";
            const ADS_HOME ="{{url('ads')}}";
            const N_ADS ="{{url('num_ads_home')}}";
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
            <div class="menu"><a href="carrello">Carrello<img src="images/cart.png" class="icon"><p id="n"></p></a></div>
            <div class="menu"><a href="logout">Logout</a></div>
        </nav>
        <p id="benvenuto"> Benvenutə {{ $user }}<p>
        <input type=text class="search" placeholder="cerca annunci">
        <input type="submit" id='sub' value='cerca'/>
    <div id="annunci">
        
    </div>
    </body>
</html>