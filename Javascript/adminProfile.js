function editProfile(){
    document.getElementById("surname").readOnly = false;
    document.getElementById("firstname").readOnly = false;
    document.getElementById("middlename").readOnly = false;
    document.getElementById("email").readOnly = false;
    document.getElementById("contact").readOnly = false;
    document.getElementById("citizenship").readOnly = false;
    document.getElementById("place").readOnly = false;
    document.getElementById("munipal_bara").readOnly = false;
  
}

function cancelEdit(){
    document.getElementById("surname").readOnly = true;
    document.getElementById("firstname").readOnly = true;
    document.getElementById("middlename").readOnly = true;
    document.getElementById("email").readOnly = true;
    document.getElementById("contact").readOnly = true;
    document.getElementById("citizenship").readOnly = true;
    document.getElementById("place").readOnly = true;
    document.getElementById("munipal_bara").readOnly = true;
}

function updateProfile(){
    setTimeout(()=>{
        console.log("Hello")
         },2000)
}