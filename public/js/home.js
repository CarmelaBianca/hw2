fetch(ADS_HOME).then(searchResponse).then(searchJson); 
fetch(N_ADS).then(searchResponse).then(OnJ);

function searchResponse(response){ 
    return response.json();
}

function searchJson(json)
{
    const div=document.querySelector('#annunci');
    div.innerHTML='';
    let len=json.length;
    if(len===0){
        const no_ads=document.createElement('p');
        no_ads.textContent='Nessun annuncio trovato';
        no_ads.classList.add('empty');
        div.appendChild(no_ads);
    }
    if (len>10) len=10;
    for (let i=0; i<len; i++){
        const annuncio=json[i];
        const id=annuncio.id;
        const user=annuncio.username;
        const nome=annuncio.nome;
        const descrizione=annuncio.descrizione;
        const prezzo=annuncio.prezzo;
        const img=annuncio.foto;
        
        const div_secondario= document.createElement('div');
        div_secondario.classList.add('secondario');
        div.appendChild(div_secondario);

        const id_p=document.createElement('p');
        id_p.textContent=id;
        id_p.classList.add('hidden');
        const h2_user= document.createElement('h2');
        h2_user.textContent = user;
        const h4_nome=document.createElement('h4');
        h4_nome.textContent = nome;
        const p_des=document.createElement('p');
        p_des.textContent = descrizione;
        const p_prezzo=document.createElement('p');
        p_prezzo.textContent = prezzo+'€';
        const img_foto=document.createElement('img');
        img_foto.src=img;

        div_secondario.appendChild(id_p);
        div_secondario.appendChild(h2_user);
        div_secondario.appendChild(h4_nome);
        div_secondario.appendChild(p_des);
        div_secondario.appendChild(img_foto);
        div_secondario.appendChild(p_prezzo);
        
        //creo div per bottone e preferiti
        const div_3= document.createElement('div');
        div_3.classList.add('div3');
        div_secondario.appendChild(div_3);

        //creo bottone compra
        const aggiungi=document.createElement('input');
        aggiungi.classList.add('aggiungi');
        aggiungi.type='submit';
        aggiungi.value='aggiungi al carrello';
        div_3.appendChild(aggiungi);
        aggiungi.addEventListener('click', add);

        //creo img preferiti
        const img_preferiti=document.createElement('img');
        img_preferiti.classList.add('preferiti');
        div_3.appendChild(img_preferiti);

        fetch(HOME_ROUTE+'/id/'+encodeURIComponent(id)+'/indice/'+encodeURIComponent(i)).then(searchResponse).then(OnJson_preferiti);     
    }

}
function add(event){
    event.preventDefault(); //lo posso togliere perchè non è submit
    const sub=event.currentTarget;
    div_annunci=sub.parentNode.parentNode;
    const id=div_annunci.querySelector('p').textContent;
    fetch(HOME_ROUTE+'/id/'+encodeURIComponent(id)).then(searchResponse).then(Onjson);  
    
}
function Onjson(json){
    if(json.ok) fetch(N_ADS).then(searchResponse).then(OnJ);
}
function OnJson_preferiti(json){
    const img_pref=document.querySelectorAll('.preferiti');
    if(json.preferito) img_pref[json.indice].src='images/preferiti_1.jpg';
    else img_pref[json.indice].src='images/preferiti_0.png';
    img_pref[json.indice].addEventListener('click', preferiti);
}

function preferiti(event){
    img=event.currentTarget;
    const div_annunci=img.parentNode.parentNode;
    const id=div_annunci.querySelector('p').textContent;
    const username=div_annunci.querySelector('h2').textContent;
    let action;
    if(img.src==='http://localhost/example-app/public/images/preferiti_0.png'){
        action='add';
        img.src='images/preferiti_1.jpg';
    }else{
        action='remove';
        img.src='images/preferiti_0.png';
    }
    fetch(HOME_ROUTE+'/id/'+encodeURIComponent(id)+'/action/'+encodeURIComponent(action)).then(searchResponse); 
}
function cerca(event){
    event.preventDefault(); //posso toglierlo perchè non è submit
    const articolo_cercato=document.querySelector('.search').value;
    fetch(HOME_ROUTE+"/articolo/"+encodeURIComponent(articolo_cercato)).then(searchResponse).then(searchJson); 
}
function OnJ(json){
    const n=document.querySelector('#n');
    n.textContent=json;
    window.scrollTo(0,0);
}
const submit=document.querySelector('#sub');
submit.addEventListener('click', cerca);
let indice;