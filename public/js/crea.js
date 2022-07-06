fetch(N_ADS).then(OnResponse).then(OnJ_2);
function Cerca(event){
    event.preventDefault();
    const articolo=document.querySelector('#articolo').value;
    fetch(CREA_ROUTE+'/articolo/'+encodeURIComponent(articolo)).then(OnResponse).then(OnJson); //FETCH A CURL
    
}
function OnResponse(response){
    return  response.json();
}
function OnJson(json){
    const results = json.hits;
    const div_articolo = document.querySelector('#result');
    div_articolo.innerHTML = '';
    for (let r of results){
        const img = document.createElement('img');
        img.src = r.previewURL;
        div_articolo.appendChild(img);
        img.addEventListener('click', scelta_immagine);
    }
}
function scelta_immagine(event){
    const img=event.currentTarget;
    const immagine_form=document.querySelector('#immagine');
    immagine_form.src=img.src;

    const div_articolo = document.querySelector('#result');
    div_articolo.innerHTML = '';
    immagine_form.classList.remove('hidden');
}

function option(event){
    const opzione = event.currentTarget;
    const file = document.querySelector('#file');
    const articolo = document.querySelector('#articolo');
    const cerca = document.querySelector('#cerca');

    const div_articolo = document.querySelector('#result'); //metto il contenitore vuoto (nel caso in cui prima ha cercato immagini)
    div_articolo.innerHTML = '';

    file.classList.add('hidden');
    articolo.classList.add('hidden');
    cerca.classList.add('hidden');

    if (opzione.value==='carica') file.classList.remove('hidden');
    else {
        articolo.classList.remove('hidden');
        cerca.classList.remove('hidden');
    }
}
function carica_immagine(){
    let file_name=[];
    let len;
    const file=document.querySelector('#file').value;
    const immagine_form=document.querySelector('#immagine');
    file_name=file.split("\\");
    len=file_name.length;
    immagine_form.src='images/'+file_name[len-1];
}
function pubblica(event){
    event.preventDefault();

    const nome = document.querySelector('#nome').value;
    const descrizione = document.querySelector('#descrizione').value;
    const prezzo = document.querySelector('#prezzo').value;
    const img = document.querySelector('#immagine').src;
    
    let url=img;
    let n=(img.split('/').length -1);
    for (let i=0; i<n; i++)
        url=url.replace("/","----");

    if(nome!==''&&descrizione!==''&& prezzo!==''&& img!=='') {
        fetch(CREA_ROUTE+'/nome/'+encodeURIComponent(nome)+'/descrizione/'+encodeURIComponent(descrizione)+'/prezzo/'+
        encodeURIComponent(prezzo)+'/foto/'+encodeURIComponent(url)).then(OnResponse).then(OnJ);

    }
    
}
function OnJ(json){
    const div_crea = document.querySelector('.cont'); 
    const p = document.createElement("p");
    if (json.ok) {
        div_crea.innerHTML = '';
        p.textContent="Annuncio inserito, guardalo su: i miei annunci";
    }
    else{
        p.textContent="inserimento annuncio fallito, riprova";
        p.classList.add("failed");
    }
    div_crea.appendChild(p);
    p.classList.add("success");
}
function OnJ_2(json){
    const n=document.querySelector('#n');
    n.textContent=json;
}
const button = document.querySelector('#cerca');
const select=document.querySelector('select');
const button2 = document.querySelector('#pubblica');
const file= document.querySelector('#file')

button.addEventListener('click', Cerca);
select.addEventListener('click', option);
file.addEventListener('input', carica_immagine);
button2.addEventListener('click', pubblica);