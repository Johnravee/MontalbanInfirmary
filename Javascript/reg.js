function checkPasswordMatch() {
  const pass = document.querySelector('#pass').value;
  const cpass = document.querySelector('#cpass').value;


  if(cpass.length > 0){
     if (pass === cpass) {
    document.getElementById('cpass').style.borderColor  = '#5cb85c ';
    document.querySelector('small').innerText = "Password matched!";
    document.querySelector('small').style.color  = '#5cb85c';
  } else {
    document.getElementById('cpass').style.borderColor  = '#d9534f ';
    document.querySelector('small').innerText = "Password not matched!";
    document.querySelector('small').style.color  = '#d9534f ';
  }
  }else{
     document.getElementById('cpass').style.borderColor  = null;
    document.querySelector('small').innerText = null;
    document.querySelector('small').style.color  = null;
  }
}


function showPass(i){
  const pass =  document.querySelector('#pass');
    if(pass.type === 'password'){
        i.classList.add("bi-eye-fill");
        i.classList.remove("bi-eye-slash-fill")
        document.querySelector('#cpass').type = 'text';
        document.querySelector('#pass').type = 'text';
    }else{
        i.classList.remove("bi-eye-fill");
        i.classList.add("bi-eye-slash-fill")
        document.querySelector('#cpass').type = 'password';
        document.querySelector('#pass').type = 'password';
    }
}


function logIn(){
  window.location.href = "../public/loginPage.php";
}