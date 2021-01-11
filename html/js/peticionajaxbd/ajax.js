//url,options
 export async function ajax(json){
    let {url,options,succes,error}=json
    try{
        console.log(options);
        let res=await fetch(url,options);
        let json= await res.json();
        console.log(json);
        if(!res.ok){
            throw new Error("Algo ocurrio Error: "+res.status);
        }
        succes (json);
        
    }
    catch(err){
        error(err);
    }
}