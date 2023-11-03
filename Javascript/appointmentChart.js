document.addEventListener("DOMContentLoaded", () => {
const stats = document.querySelectorAll(".stat");

stats.forEach(stat => {

    if(stat.innerHTML === "Approved"){
        console.log(stat.innerHTML);
        stat.classList.remove("bg-danger");
        stat.classList.add("bg-success");
    }else if(stat.innerHTML === "Processing"){
        console.log(stat.innerHTML);
        stat.classList.remove("bg-danger");
        stat.classList.add("bg-primary");
    }else if(stat.innerHTML === "Expired"){
        console.log(stat.innerHTML);
        stat.classList.remove("bg-danger");
        stat.classList.add("bg-secondary");
    }
    
})

})