const account = document.querySelector('#account');
const navigation = document.querySelector('.navigation');

account.addEventListener('click', ()=>{
    navigation.classList.toggle("showNav");
})