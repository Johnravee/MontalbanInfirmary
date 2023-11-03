document.addEventListener("DOMContentLoaded", () => {
    const stats = document.querySelectorAll("#status");

    stats.forEach(stat =>{
        if(stat.innerText === 'Processing'){
        stat.classList.add("bg-primary");
        return;
    }
    
    if(stat.innerText === "Approved"){
        stat.classList.remove("bg-primary");
        stat.classList.add("bg-success");
        return;
         }

    if(stat.innerText === "Expired"){
        stat.classList.remove("bg-primary");
        stat.classList.add("bg-secondary");
        return
         }
         
    if(stat.innerText === "Cancelled"){
        stat.classList.remove("bg-primary");
        stat.classList.add("bg-danger");
        return
         }        
    })

});















