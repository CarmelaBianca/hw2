function checkNome(event) {
    const nome = event.currentTarget;
    let paragrafo;
    if (nome.id==='nome'){
        paragrafo = document.querySelector('#errore_nome');
        if (nome.value.length === 0) {
            paragrafo.classList.remove('hidden'); 
            disable_submit(0,true);
        }else {
        paragrafo.classList.add('hidden');
        disable_submit(0, false);
        }
    }else{
        paragrafo=document.querySelector('#errore_cognome');
        if (nome.value.length === 0) {
            paragrafo.classList.remove('hidden'); 
            disable_submit(1,true);
        }else {
        paragrafo.classList.add('hidden');
        disable_submit(1, false);
        }
    } 
     
}

function checkEmail(event) {
    const email =  event.currentTarget;
    let paragrafo={
        errore1 : document.querySelector('#errore_email'),
        errore2 : document.querySelector('#errore_email_nonvalida'),
        errore3 : document.querySelector('#errore_email_inuso')
    };
    for (let p in paragrafo){
        paragrafo[p].classList.add('hidden');
    }
    disable_submit(2, false);
    if(email.value.length===0){
        paragrafo['errore1'].classList.remove('hidden');
        disable_submit(2, true);
    }else{
        if(!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(String(email.value).toLowerCase())) {
            paragrafo['errore2'].classList.remove('hidden');
            disable_submit(2, true);
        } else 
            fetch(REGISTER_ROUTE+"/email/"+encodeURIComponent(String(email.value).toLowerCase())).then(OnResponse).then(jsonEmail);
        }
}

function OnResponse(response) {
    return response.json();
}

function jsonEmail(json) {
    const errore3 = document.querySelector('#errore_email_inuso');
    errore3.classList.add('hidden');
    disable_submit(2, false);
    if (json.exists===true) {
        errore3.classList.remove('hidden');
        disable_submit(2, true);
    }
}

function checkData(event) {
    const data = event.currentTarget;
    const data_inserita=data.value;
    const temp = new Date();
    const data_attuale={
        giorno:temp.getDate(),
        mese:temp.getMonth()+1,
        anno:temp.getFullYear()
    };
    const parts = data_inserita.split("-");;
    const confronto={
        a:data_attuale.anno-parts[0],
        m:parseInt(data_attuale.mese)-parts[1],
        g:parseInt(data_attuale.giorno)-parts[2]
    }
    let eta_valida=false;
    if (confronto['a']>14) eta_valida=true;
    if (confronto['a']<=13 || data_inserita.length===0 || parts[0]<1900) eta_valida=false;
    if (confronto['a']===14) {
        if(confronto['m']>0) eta_valida=true;
        else if(confronto['m']===0){
            if(confronto['g']>=0) eta_valida=true;
            else eta_valida=false;
        }else eta_valida=false;
    }
    if(data_inserita.length===0) eta_valida=false;

    paragrafo = document.querySelector('#errore_data');
    if (!eta_valida) {
        paragrafo.classList.remove('hidden'); 
        disable_submit(3, true);
    } else {
        paragrafo.classList.add('hidden');
        disable_submit(3, false);
    }
}

function checkUser(event) {
    const username =  event.currentTarget;
    const p = document.querySelector('#errore_user');
    const p1 = document.querySelector('#errore_user_inuso');
    p.classList.add('hidden');
    p1.classList.add('hidden');
    disable_submit(4, false);
    if(username.value.length===0){
        p.classList.remove('hidden');
        disable_submit(4, true);
    }  
    else
        fetch(REGISTER_ROUTE+"/username/"+encodeURIComponent(username.value)).then(OnResponse).then(jsonUsername);
}

function jsonUsername(json) {
    const p =  document.querySelector('#errore_user_inuso');
    p.classList.add('hidden');
    disable_submit(4, false);
    console.log(json.exists);
    if (json.exists===true) {
        p.classList.remove('hidden');
        disable_submit(4, true);
    }
}

function checkPassword(event) {
    const password = event.currentTarget;
    const p=document.querySelector('#errore_password');
    p.classList.add('hidden');
    disable_submit(5, false);
    if (password.value.length < 8 || password.value.length > 50 ){
        p.classList.remove('hidden');
        disable_submit(5, true);
    } 
    else 
        fetch(REGISTER_ROUTE+"/password/"+encodeURIComponent(password.value)).then(OnResponse).then(jsonPassword);
}
function jsonPassword(json) {
    const p =  document.querySelector('#errore_password');
    p.classList.add('hidden');
    disable_submit(5, false);
    if (json.ok===false) {
        p.classList.remove('hidden');
        disable_submit(5, true);
    }
}

function disable_submit(id_errore, valore_errore){
    sub=document.querySelector('.submit');
    count_errori=0;
    errori[id_errore]=valore_errore;
    for (let e of errori){
        if (e) count_errori=count_errori+1;
    }
    if(count_errori>0) {
        sub.disabled=true;}
    else if(!emptyFields()){
       sub.disabled=false; 
    } 
}

function emptyFields(){
    let fields = document.querySelectorAll('.dati');
    for(let f of fields){
        if (f.value==='') return true;
    }
    return false;
}

let errori=[];
document.querySelector('#nome').addEventListener('blur', checkNome);
document.querySelector('#cognome').addEventListener('blur', checkNome);
document.querySelector('#email').addEventListener('blur', checkEmail);
document.querySelector('#data_di_nascita').addEventListener('blur', checkData);
document.querySelector('#username').addEventListener('blur', checkUser);
document.querySelector('#password').addEventListener('blur', checkPassword);