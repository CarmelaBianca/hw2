fetch(CARRELLO_ROUTE).then(searchResponse).then(searchJson);
function searchResponse(response){
    return response.json();
}
function searchJson(json)
{
    const div=document.querySelector('#annunci');
    const div_totale = document.querySelector('#totale');
    div.innerHTML='';
    div_totale.innerHTML='';
    if(!json.response) {
        const no_ads=document.createElement('p');
        no_ads.textContent='Carrello vuoto';
        no_ads.classList.add('empty');
        div.appendChild(no_ads);
    }else{
        let totale=0;
        for (let i in json.response){
            const annuncio=json.response[i][0];
            const id=annuncio.id;
            const user=annuncio.username;
            const nome=annuncio.nome;
            const descrizione=annuncio.descrizione;
            const prezzo=annuncio.prezzo;
            const img=annuncio.foto;
            
            const div_secondario= document.createElement('div');
            div_secondario.classList.add('secondario');
            div.appendChild(div_secondario);

            const div_4= document.createElement('div');
            div_4.classList.add('div_4');

            const id_p=document.createElement('p');
            id_p.textContent=id;
            id_p.classList.add('hidden');
            const p_user= document.createElement('p');
            p_user.textContent = 'annuncio pubblicato da: @'+user;
            const h2_nome=document.createElement('h2');
            h2_nome.textContent = nome;
            const h6_des=document.createElement('h6');
            h6_des.textContent = descrizione;
            const p_prezzo=document.createElement('p');
            p_prezzo.textContent = prezzo+'€';
            p_prezzo.classList.add('prezzo');
            const img_foto=document.createElement('img');
            img_foto.src=img;
            
            div_secondario.appendChild(id_p);
            div_secondario.appendChild(img_foto);
            div_secondario.appendChild(div_4);
            div_4.appendChild(h2_nome);
            div_4.appendChild(h6_des);
            div_4.appendChild(p_user);
            div_secondario.appendChild(p_prezzo);
            
            //div per bottone rimuovi
            const div_3= document.createElement('div');
            div_3.classList.add('div3');
            div_secondario.appendChild(div_3);

            
            const rimuovi=document.createElement('input');
            rimuovi.classList.add('aggiungi');
            rimuovi.type='submit';
            rimuovi.value='rimuovi dal carrello';
            div_3.appendChild(rimuovi);
            rimuovi.addEventListener('click', remove);

            totale+=prezzo;
        }

        const h3_totale= document.createElement('h3');
        h3_totale.textContent = 'TOTALE';
        const p_totale= document.createElement('p');
        p_totale.textContent = totale+'€';
        p_totale.classList.add('prezzo_totale');
        div_totale.appendChild(h3_totale);
        div_totale.appendChild(p_totale);
        const acquista = document.createElement('input');
        acquista.classList.add('aggiungi');
        acquista.type='button';
        acquista.value='acquista';
        div_totale.appendChild(acquista);
        div_totale.addEventListener('click', acquista_articolo);
    }
}
function remove(event){
    const sub=event.currentTarget;
    div_annunci=sub.parentNode.parentNode;
    const id=div_annunci.querySelector('p').textContent;
    fetch(CARRELLO_ROUTE+'/id/'+id).then(searchResponse).then(Onjson);
    
}
function Onjson(json){
    if(json.ok)
        fetch(CARRELLO_ROUTE).then(searchResponse).then(searchJson);
}
function acquista_articolo(){
    fetch(ACQUISTA_ROUTE).then(searchResponse).then(OnJson);
}
function OnJson(json){
    const div=document.querySelector('#annunci');
    const div_totale = document.querySelector('#totale');
    div.innerHTML='';
    div_totale.innerHTML='';
    const acquisto=document.createElement('p');
    div.appendChild(acquisto);
    if(json.ok){
        acquisto.textContent='Acquisto avvenuto con successo';
        acquisto.classList.add('success');
    }else{
        acquisto.textContent='Acquisto fallito, siamo spiacenti';
        acquisto.classList.add('empty');
    }
}