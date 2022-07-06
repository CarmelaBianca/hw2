<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title> Registrazione </title>
        <link rel="icon" href="images/favicon.ico" />
        <link rel="stylesheet" href="{{ url('css/log_reg.css') }}">
        <script src="{{ url('js/registrazione.js') }}" defer></script>
        <script type="text/javascript">
            const REGISTER_ROUTE = "{{url('register')}}";
        </script>
    </head>  
    <div class="cont">
        <form method='post' autocomplete='off'>
            @csrf <!-- aggiunge in automatico il campo hidden -->
            <h2>Welcome</h2>
            <input type="text" id='nome' name="nome" class="dati" placeholder="nome">
            <p id='errore_nome' class='hidden'> campo vuoto </p>
            <input type="text" id='cognome' name="cognome" class="dati" placeholder="cognome">
            <p id='errore_cognome' class='hidden'> campo vuoto </p>
            <input type="email" id='email' name="email" class="dati" placeholder="email">
            <p id='errore_email' class='hidden'> campo vuoto </p>
            <p id='errore_email_nonvalida' class='hidden'> e-mail non valida </p>
            <p id='errore_email_inuso' class='hidden'> e-mail già in uso </p>
            <input type="text" id='data_di_nascita' name="data_di_nascita" class="dati" placeholder="data di nascita (età min: 14 anni)" onfocus="(this.type='date')">
            <p id='errore_data' class='hidden'> età non valida </p>
            <input type="text" id='username' name="username" class="dati" placeholder="username">
            <p id='errore_user' class='hidden'> campo vuoto </p>
            <p id='errore_user_inuso' class='hidden'> username già in uso </p>
            <input type="password" id='password' name="password" class="dati" placeholder="password">
            <p id='errore_password' class='hidden'> la password deve contere: almeno un numero e una lettera, minimo 8 caratteri e massimo 50</p>
            <input type='submit' class='submit' value='signup' disabled>
        </form>    
    </div>
</html>