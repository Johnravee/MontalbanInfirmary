document.addEventListener("DOMContentLoaded", () => {
const stats = document.querySelectorAll(".stat");
const payment_stats = document.querySelectorAll(".payment_stat");


stats.forEach(stat => {
   stat.innerHTML === "Approved" ? (
    stat.classList.remove("bg-danger"),
    stat.classList.add("bg-success")
    ) : stat.innerHTML === "Processing" ? (
        stat.classList.remove("bg-danger"),
        stat.classList.add("bg-primary")
    ) : stat.innerHTML === "Expired" && (
         stat.classList.remove("bg-danger"),
         stat.classList.add("bg-secondary")
    );
    
})


payment_stats.forEach(payment_stat =>{
    const paid =  payment_stat.innerHTML === "Paid" && true;

    paid ? (
        payment_stat.classList.remove("bg-danger"),
        payment_stat.classList.add("bg-success")
    ) : (
        payment_stat.classList.add("bg-danger"),
        payment_stat.classList.remove("bg-success")
    );
})



})