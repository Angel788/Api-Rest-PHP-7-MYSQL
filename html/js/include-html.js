document.addEventListener('DOMContentLoaded',(e=event)=>{
    const includeHTML=(el,url)=>{
        const xhr= new XMLHttpRequest();
        xhr.addEventListener('readystatechange',(e=event)=>{
            if(xhr.readyState!==4)return;

            if(xhr.status>=200 && xhr.status<300){
                el.outerHTML=xhr.responseText;
            }else{
                let mesage=xhr.responseText || "Error al cargar el archivo";
                el.outerHTML=`<div><p>Error: ${xhr.response}, ${mesage}</p></div>`
            }
        })
        xhr.open("GET", url);
        xhr.setRequestHeader("Content-type", "text/html; charset=utf-8");
        xhr.send();
    }
    document.querySelectorAll("[data-include]").forEach(el=>includeHTML(el,el.getAttribute("data-include")));
});
