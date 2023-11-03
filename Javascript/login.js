const EMAIL = document.querySelector("#email");
const PASS = document.querySelector('#pass');



document.querySelector('#login').addEventListener('click', ()=>{

    if(EMAIL.value === '' && PASS.value === ''){

        EMAIL.style.borderColor = '#d9534f';
        PASS.style.borderColor = '#d9534f'; 

        const modalMessage = new bootstrap.Modal(document.querySelector('#modalMessage'));
        modalMessage.show();
       setTimeout(()=>{
         EMAIL.style.borderColor = null;
        PASS.style.borderColor = null ; 
       },3000);
    }
    else if(EMAIL.value === ''){
        EMAIL.style.borderColor = '#d9534f';
       setTimeout(()=>{
         EMAIL.style.borderColor = null;
       },3000);
    }

    else if(PASS.value === ''){
        PASS.style.borderColor = '#d9534f';
       setTimeout(()=>{
         PASS.style.borderColor = null;
       },3000);
    }


})


function showPassword(){
  const pass = document.querySelector("#pass");
  const seePass = document.querySelector("#showPass");

  if(seePass.checked == true){
    pass.type = "text";
  } else {
    pass.type = "password";
  }
}