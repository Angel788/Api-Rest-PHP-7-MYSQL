const d=document;
export default function insert(contenido,lugar,options){
   const fragmento=d.createDocumentFragment();
   if(Array.from(contenido).length===0){
    const $enlaces=d.createElement(options.element);
    $enlaces.dataset.id=contenido.id;
    $enlaces.classList.add(options.class);
    $enlaces.innerHTML=`
        
                    <div class="section-img">
                        <img src="${contenido.rutaimagen}" alt="${contenido.nombre}">
                    </div>
                    <div class="section-text">
                        <h3>${contenido.Marca}</h3>
                        <h3>${contenido.nombre}</h3>
                        <p>Precion: <span>$${contenido.costo}</span></p>
                        <p>${contenido.descripcion}</p>
                        <a href="" data-id="${contenido.id} id="buy">Comprar</a>
                    </div>
        `;
    fragmento.appendChild($enlaces);
   }
   else{
     Array.from(contenido).forEach((ele)=>{
    const $enlaces=d.createElement(options.element);
    $enlaces.dataset.id=ele.id;
    if(options.element="a"){
        $enlaces.href=`producto.html?id=${ele.id}`;
    }
    $enlaces.classList.add(options.class);
    $enlaces.innerHTML=`
        
                    <div class="section-img">
                        <img src="${ele.rutaimagen}" alt="${ele.nombre}">
                    </div>
                    <div class="section-text">
                        <h3>${ele.Marca}</h3>
                        <h3>${ele.nombre}</h3>
                        <p>Precion: <span>$${ele.costo}</span></p>
                        <p>${ele.descripcion}</p>
                        <a href="carrito.html" data-id="${ele.id}" id="buy">Comprar</a>
                    </div>
        `;
    fragmento.appendChild($enlaces);
  })
   }
   
  d.querySelector(lugar).appendChild(fragmento);
}