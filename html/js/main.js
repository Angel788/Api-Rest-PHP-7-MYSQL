import hamburgerMenu from "./menu/menu.js";
import {ajax} from "./peticionajaxbd/ajax.js";
import insert from "./insertarcontenido/insert.js";
import url from "./obtenerUrl/url.js"
const d=document;

d.addEventListener('DOMContentLoaded',(e=event)=>{
  hamburgerMenu(".hamburger",".panel",".panel a");
  if(d.querySelector(".contenedor-productos")){
    ajax({
    url: "http://34.94.17.78/apitelefonos/crud/read.php",
    options: {},
    succes:(json)=>{
      insert(json, ".contenedor-productos",{
      element: "a",
      class: "productos"
  });
    },
    error: (err)=>{
      d.querySelector(".contenedor-productos").innerHTML=""+err;
    }
  })
  }
})

d.addEventListener('submit',(e=event)=>{
  if(e.target.matches("#login")){
    e.preventDefault();
    ajax({
      url: "http://34.94.17.78/apitelefonos/auth.php",
      options: {
        method: "POST",
        body: JSON.stringify({
          usuario: e.target.usuario.value,
          password: e.target.password.value
        }),
        headers:{
          "Content-type": "application/json; charset=UTF-8"
        }
      },
      succes:(json)=>{
        if(json.status==="error"){
          d.querySelector(".respuesta").innerHTML=`
          <h3>${json.status}</h3>
          <p>${json.result.error_msg}</p>
          `
        }
        else{
          localStorage.setItem('token', json.result.token);
          window.location.href="index.html";
        }
      },
      error: (err)=>{
        console.log(err);
         d.querySelector(".respuesta").innerHTML=""+err;
      }
    })
  }
  if(e.target.matches("#registro")){
    e.preventDefault();
    ajax({
      url: "http://34.94.17.78/apitelefonos/User/createUser.php",
      options: {
        method: "POST",
        body: JSON.stringify({
          usuario: e.target.usuario.value,
          password: e.target.password.value
        }),
        headers:{
          "Content-type": "application/json; charset=UTF-8"
        }
      },
      succes:(json)=>{
        if(json.status==="error"){
          d.querySelector(".respuesta").innerHTML=`
          <h3>${json.status}</h3>
          <p>${json.result.error_msg}</p>
          `;
        }
        else{
          d.querySelector(".respuesta").innerHTML=`
          <h3>Se registro el usuario con exito<h3>
          <p>Porfavor innicie secion en el siguinte link</p>
          <a href="login.html">Registro</a>
          `
        }
      },
      error: (err)=>{
        console.log(err);
         d.querySelector(".respuesta").innerHTML=""+err;
      }
    })
  }
});

d.addEventListener('click',(e=event)=>{
  if(e.target.matches("#buy")){
    e.preventDefault();
    if(window.localStorage.getItem('token') !== undefined && localStorage.getItem('token')){
      ajax({
      url: "http://34.94.17.78/apitelefonos/Carrito/insertItem.php",
      options: {
        method: "POST",
        body: JSON.stringify({
          token: localStorage.getItem('token'),
          id_atributo: e.target.dataset.id
        }),
        headers:{
          "Content-type": "application/json; charset=UTF-8"
        }
      },
      succes:(json)=>{
        console.log(json);
        if(json.status==="error"){
          d.querySelector(".respuesta").innerHTML=`
          <h3>${json.status}</h3>
          <p>${json.result.error_msg}</p>
          `;
        }
        else{
          d.querySelector(".respuesta").innerHTML=`
          <h3>Se registro el usuario con exito<h3>
          <p>Porfavor innicie secion en el siguinte link</p>
          <a href="login.html">Registro</a>
          `
        }
      },
      error: (err)=>{
        console.log(err);
         d.querySelector(".respuesta").innerHTML=""+err;
      }
    })
    }
    else{
      alert("No estas logeado");
    }
  }
  if(e.target.matches(".delete")){
    e.preventDefault();
    if(window.localStorage.getItem('token') !== undefined && localStorage.getItem('token')){
      ajax({
      url: "http://34.94.17.78/apitelefonos/Carrito/deleteItem.php",
      options: {
        method: "POST",
        body: JSON.stringify({
         id: e.target.dataset.id
        }),
        headers:{
          "Content-type": "application/json; charset=UTF-8"
        }
      },
      succes:(json)=>{
        console.log(json);
        if(json.status==="error"){
          d.querySelector(".respuesta").innerHTML=`
          <h3>${json.status}</h3>
          <p>${json.result.error_msg}</p>
          `;
        }
        else{
         window.location.reload();
        }
      },
      error: (err)=>{
        console.log(err);
         d.querySelector(".respuesta").innerHTML=""+err;
      }
    })
    }
    else{
      alert("No estas logeado");
    }
  }
})






