import hamburgerMenu from "./menu/menu.js";
import {ajax} from "./peticionajaxbd/ajax.js";
import insert from "./insertarcontenido/insert.js";
import url from "./obtenerUrl/url.js"
const d=document;

d.addEventListener('DOMContentLoaded', async (e=event)=>{
    const id=url("id");
    if(id===null || id==="0"){
        d.querySelector(".productos-main").innerHTML="<h1>Prodcutos</h1>"
    }
    else{
    ajax({
    url: `http://34.94.17.78/apitelefonos/crud/single_read.php?id=${id}`,
    options: {},
    succes:(json)=>{
      insert(json,".productos-main",{
        element: "div",
        class: "producto"
    });
    },
    error: (err)=>{
      d.querySelector(".contenedor-productos").innerHTML=""+err;
    }
  })
    }
  
})


