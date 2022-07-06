<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title> Login </title>
        <link rel="icon" href="images/favicon.ico" />
        <link rel="stylesheet" href="{{ url('css/log_reg.css') }}"/>
    </head>
    <body>
        
        <div class="cont">
            <form method="POST" autocomplete='off'>
                @csrf
                <h2>Welcome</h2>
                <input type="text" name="username" class="dati" placeholder="username"/>
                <input type="password" name="password" class="dati" placeholder="password"/>
                <input type="submit" class="submit" value="signin">
                @if ($error=='not_exist')
                <p class='errore'> Credenziali non valide. </p>
                @endif
            </form>
            <p id='registrati'> se non hai un account, <a href="{{ url('register') }}"> registrati</a> </p>
        </div>
    </body>
</html>