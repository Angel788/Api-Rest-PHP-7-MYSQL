const d=document;
import {ajax} from "./peticionajaxbd/ajax.js";
d.addEventListener('DOMContentLoaded',(e=event)=>{
    let $fragmento=d.createDocumentFragment();
    let $trheader=document.createElement('tr');
    $trheader.innerHTML=`
        <th>ID</th>
        <th>Producto</th>
        <th>Precio</th>
        <th>Imagen</th>       
    `;
    $fragmento.appendChild($trheader);
    ajax({
        url:"http://34.94.17.78/apitelefonos/Carrito/verItems.php",
        options: {
        method: "POST",
        body: JSON.stringify({
          token: localStorage.getItem('token'),
        })
        },
        succes:(json)=>{
            console.log(json);
            console.log(json.Id);
            if(Array.from(json).length===0){
                let $tr=document.createElement('tr');
                $tr.innerHTML=`
                <td>${json.Id}<button class="delete">Eliminar</button></td>
                <td>${json.nombre}</td>
                <td>${json.cosoto}</td>
                <td><img src="${json.rutaimagen}" alt=""></td>       
                `;
                $fragmento.appendChild($tr);
            }
            else{
                Array.from(json).forEach(e => {
                let $tr=document.createElement('tr');
                $tr.innerHTML=`
                <td>${e.Id}<button class="delete" data-id="${e.Id}">Eliminar</button></td>
                <td>${e.nombre}</td>
                <td>${e.costo}</td>
                <td><img src="${e.rutaimagen}" alt=""></td>       
                `;
                $fragmento.appendChild($tr);
            });
            }
             d.querySelector(".productos-comprados").appendChild($fragmento);
        },
        error: (err)=>{
        console.log(err);
         d.querySelector(".respuesta").innerHTML=""+err;
      }
    })
})