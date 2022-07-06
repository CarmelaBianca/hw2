fetch(ANNUNCI_ROUTE).then(searchResponse).then(searchJson);
fetch(N_ADS).then(searchResponse).then(OnJ);
function searchResponse(response){
    return response.json();
}
function searchJson(json)
{
    const div=document.querySelector('#annunci');
    div.innerHTML='';
    if(!json.response) {
        const p_user=document.querySelector('#benvenuto');
        p_user.textContent='';
        const no_ads=document.createElement('p');
        no_ads.textContent='Non hai inserito nessun annuncio';
        no_ads.classList.add('empty');
        div.appendChild(no_ads);
    }else{
        for (let i in json.response){
            const annuncio=json.response[i];
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
            
            //creo div per eliminare l'annuncio
            const div_3= document.createElement('div');
            div_3.classList.add('div3');
            div_secondario.appendChild(div_3);

            //creo img delete
            const img_delete=document.createElement('img');
            img_delete.src='images/delete.png';
            img_delete.classList.add('delete'); //la classe è preferiti perchè ha le stesse caratteristiche della stellina
            div_3.appendChild(img_delete);

            img_delete.addEventListener('click', delete_ad);
            
        }
    }
}
function delete_ad(event){
    img=event.currentTarget;
    const div_annunci=img.parentNode.parentNode;
    const id=div_annunci.querySelector('p').textContent;
    fetch(ANNUNCI_ROUTE+'/id/'+encodeURIComponent(id)).then(searchResponse).then(Onjson); 
}
function Onjson(json){
    if(json.ok) fetch(ANNUNCI_ROUTE).then(searchResponse).then(searchJson);
}
function OnJ(json){
    const n=document.querySelector('#n');
    n.textContent=json;
}
