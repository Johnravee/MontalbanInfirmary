const date_time = document.querySelector("#date_time");
 const dateObj = new Date(); 

 //Check the day if weekends
function isWeekend(date) {
    return date === 0 || date === 6;
}

 //Check the time if 5pm or 9 am
function isAfter5PMAndBefore9AM(hours) {
    return (hours >= 17 || hours < 9);
}


 let  currentDateStr = dateObj.toISOString().slice(0, 16);
    date_time.min = currentDateStr;

date_time.addEventListener("change", function() {
   
    const selectedDate = new Date(this.value).getDay();
    const selectedHours = new Date(this.value).getHours();

 //check if the selectedDate is valid, also the selectedHours
   if (isWeekend(selectedDate) || isAfter5PMAndBefore9AM(selectedHours)) {
            const schedProb = new bootstrap.Modal(document.querySelector('#schedProb'));
            schedProb.show();
            dt.value = '';
        }
});


function getForm(){
          const contact = document.getElementById("contactInput").value
          const Email =  document.getElementById("emailInput").value
          const Concerns = document.getElementById("concerns").value
          const Consultant = document.getElementById("consultant").value 
          const DateTime = document.getElementById("date_time").value

    //Prevent null input fields 
    if (contact === '' || Email === '' || Concerns === '' || Consultant === '' || DateTime === '') {
        alert('Please fill in all the fields');
    } else{
          const showForm = new bootstrap.Modal(document.querySelector("#formShow"));
            showForm.show();
        //Generated reference number 
          let refNumber = '';
          const charSet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
          
          for(let i = 0 ; i <= 10 ; i++){
           refNumber += charSet.charAt(Math.floor(Math.random() * charSet.length))
          }
          

        //   Modal Inputs  
        const contactName = document.getElementById("contactName").value = contact;
        const contactEmail = document.getElementById("contactEmail").value = Email;
        const appointmentConcerns = document.getElementById("appointmentConcerns").value = Concerns;
        const appointmentConsultant = document.getElementById("appointmentConsultant").value = Consultant;
        const appointmentDateTime = document.getElementById("appointmentDateTime").value = DateTime; 
        const referenceNumber = document.getElementById("refNumber").value = refNumber;
        const paymentStat = document.getElementById("paymentStat").value = "Not Paid";
    }

         
          


           

          
         
          






        
}

