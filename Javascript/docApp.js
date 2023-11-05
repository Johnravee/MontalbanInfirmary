document.addEventListener("DOMContentLoaded", ()=>{
    if(document.querySelector(".payment").innerHTML === "Paid"){
        document.querySelector(".payment").classList.remove("bg-danger");
        document.querySelector(".payment").classList.add("bg-success");
    }
})

