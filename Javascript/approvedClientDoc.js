const paymentStat = document.querySelector(".paymentStat");
const stat = document.querySelector(".stat");

document.addEventListener("DOMContentLoaded", ()=>{
    if(paymentStat.innerHTML === "Paid"){
        paymentStat.classList.remove("bg-danger");
        paymentStat.classList.add("bg-success");
        stat.classList.add("bg-success");
    }
})