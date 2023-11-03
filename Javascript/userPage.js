const profile = document.querySelector("#profile");
const navigation = document.querySelector(".navigation");

profile.addEventListener('click', ()=>{
    navigation.classList.toggle("display");
})

document.addEventListener('click', (e)=>{
    if(e.target.id !== 'profile'){
        navigation.classList.remove("display");
    }
})


