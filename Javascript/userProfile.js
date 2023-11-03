const profileDetails = document.querySelector('#profileDetails');
const profilePic = document.querySelector('#profilePic');
const inputDetails = document.querySelectorAll('.inputDetail');


function updateInfo(){
    inputDetails.forEach(inputDetail => {
        inputDetail.removeAttribute('readonly');
    });
}




