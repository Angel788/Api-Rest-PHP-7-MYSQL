const $form=document.getElementById("form");
const asynFeth=async($element)=>{
    try{
       const res= await fetch("crud/create.php",{
           method: "POST",
           headers: {
               "Content-type": "application/json; charset=utf-8"
           },
           body: JSON.stringify({
               marca:$element.marca,
               name:$element.name,
               noserie:$element.noserie,
               costo:$element.costo,
               descripcion:$element.descripcion,
               imagen:$element.imagen
           })
       });
       const json=await res.json();
       if(!res.ok) throw {status:res.status,statusText:  res.statusText};
    }
    catch(err){
        let mesage=`Error ${err.status}, ${res.statusText}`;
        document.getElementById('eror').innerHTML=`<h2>${mesage}</h2>`;
    }
}
document.addEventListener('submit',(e=event)=>{
    if(e.target===$form){
        asynFeth(e.target);
    }
})
document.addEventListener('change')