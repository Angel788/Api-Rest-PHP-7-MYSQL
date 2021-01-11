export default function hamburgerMenu(btn,panel,menuLink){
    const d=document;
    d.addEventListener('click',(e=event)=>{
        if(e.target.matches(btn) || e.target.matches(` ${btn} *`)){
            d.querySelector(panel).classList.toggle("is-active")
        }
        if(e.target.matches(menuLink)){
            d.querySelector(panel).classList.remove("is-active")
        }
    })
}