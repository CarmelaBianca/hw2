<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title> Crea annuncio</title>
        <link rel="icon" href="images/favicon.ico" />
        <link rel="stylesheet" href="{{ url('css/crea.css') }}"/>
        <script src="{{ url('js/crea.js') }}" defer></script>
        <script type="text/javascript">
            const CREA_ROUTE = "{{url('crea')}}";
            const N_ADS ="{{url('num_ads_crea')}}";
        </script>
    </head>
    <body>
        <img src="images/main.jpg" id="main_img">
        <div id="menu_mobile">
            <div></div><div></div><div></div>
        </div>
        <nav>
            <div class="menu"><a href="home">Home</a></div>
            <div class="menu"><a href="annunci">I miei annunci</a></div>
            <div class="menu"><a href="preferiti">Preferiti</a></div>
            <div class="menu"><a href="carrello">Carrello<img src="images/cart.png" class="icon"><p id="n"></p></a></div>
            <div class="menu"><a href="logout">Logout</a></div>
        </nav>
        <div class="cont">
            <form> 
                <h1>Inserisci annuncio</h1>
                <input type="text" id="nome" name='nome' class="dati" placeholder="nome"/>
                <input type="text" id='descrizione' name='descrizione' class="dati" placeholder="descrizione"/>
                <input type="text" id='prezzo' name='prezzo' class="dati" placeholder="prezzo"/>
                <img src="images/default.jpg" name="immagine" id="immagine"  class="dati"/>
            
                <select name="scelta" id="select">
                    <option name="carica" value="carica"> carica da file</option>
                    <option name="cerca" value="cerca"> cerca </option>
                </select>
                <div class="input_hidden">
                    <input type="file" class="hidden" id="file" name='foto' accept="image/*"/>
                    <input type="text" class="hidden" id="articolo" name='campo' placeholder="cerca un articolo"/>
                    <input type="submit" class="hidden" id='cerca' value='cerca'/>
                <div>
                <div id="result">
                </div>
                <input type="submit" id='pubblica' value='pubblica'/>
            </form>
        </div>
    </body>
</html>