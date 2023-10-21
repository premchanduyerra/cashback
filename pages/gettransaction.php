 

<?php
 
 $uid_hidden= $_POST['uid_hidden'];
 $beneficiary_name= $_POST['beneficiary_name'];
 $upi_handle= $_POST['upi_handle'];
 $seqNo= $_POST['seqNo'];
 $mobileNo= $_POST['mobileNo'];
 $verificationId=$_POST['verificationId'];
  ?>
  
 
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>CashBack</title>
     <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />   
     <link rel="stylesheet" href="../assets/css/gettransation.css">
     <link rel="stylesheet"   href="../assets/css/tostify.css">
 
 <style>
.default_background{

 
background: rgb(2,0,36);
background: linear-gradient(120deg, rgba(2,0,36,1) 0%, rgba(201,235,184,1) 0%, rgba(44,206,240,1) 100%, rgba(37,146,198,1) 100%, rgba(32,44,134,1) 100%, rgba(9,18,127,1) 100%);
} 

#response_card{

  margin-top: 10%;
    width: 70%;
    display: flex;
    flex-direction: column;
    align-items: center;
    background: rgba(27, 27, 27, 0.27);
    border-radius: 16px;
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(5.5px);
    -webkit-backdrop-filter: blur(5.5px);
    -webkit-box-shadow: 10px 10px 18px -1px rgba(0,0,0,0.75);
    -moz-box-shadow: 10px 10px 18px -1px rgba(0,0,0,0.75);
    box-shadow: 10px 10px 18px -1px rgba(0,0,0,0.75);
}




</style>
 </head>
 
 <script>

     var uid_hidden1 ='<?php echo $uid_hidden; ?>'
     var beneficiary_name1 ='<?php echo $beneficiary_name; ?>'
     var upi_handle1 ='<?php echo $upi_handle; ?>'
     var seqNo1 ='<?php echo $seqNo; ?>'
     var mobileNo1 ='<?php echo $mobileNo; ?>'
     var verificationId1 ='<?php echo $verificationId; ?>'
  
 
var jsonBody= JSON.stringify({
    "beneficiary_name": beneficiary_name1, //Name Entered by User
    "upi_handle": upi_handle1, //UPI Address Entered by User
    "seqNo": parseInt(seqNo1), //Sequence No received in Previous API
    "mobileNo": mobileNo1, //Mobile No. Entered by User
    "verificationId": parseInt(verificationId1) //Verification ID received in Previous API
});
 
 $.ajax({
         type: "POST",  
         data:jsonBody,
         contentType: "application/json; charset=utf-8",
         dataType   : "json",
       beforeSend:function(){
              $("#loading").show();
       // alert("before............")
          },
          complete:function(){
             $("#loading").hide();
              //alert("after ............")
          },
         url: "https://www.sureassure.com/api/VajraTejaUPI/QuickTransferAsync",
         dataType: "html",        
         success: function(data) {   
 
       //  alert(data)
 
 
 
         var obj = JSON.parse(data); 
 
 
         if(obj.responseCode=='200'){
 
           $("#total_div").show();
           $("#responseMessage").show();
           $("#errorResponseMessage").hide();
           $("#responseMessage").html(obj.responseMessage)
           document.getElementById("audioPlayer").play();
         }else if(obj.responseCode=='400'){
            $("#total_div").show();
            $("#errorResponseMessage").show();
          // $("#responseMessage").hide();
           $("#errorResponseMessage").html(obj.responseMessage)
          
          }
         
         else{
           $("#error").show();
           $("#total_div").hide();
         }
         Toastify({
            text: obj.responseMessage,
            position: "center",
            duration: 10000,
            offset: {
              x: 50, // horizontal axis - can be a number or a string indicating unity. eg: '2em'
              y: 10 // vertical axis - can be a number or a string indicating unity. eg: '2em'
            },
            style: {
              background: "linear-gradient(to right, #00b09b, #96c93d)",
            }
          }).showToast();
          

         setTimeout(function() {
            window.location.href = "../../cashback/index.php?uid="+uid_hidden1; // Replace with the URL you want to redirect to
        }, 10000);
         
             },
             error:function(error){
 
               $("#error").show();
               $("#total_div").hide();
                  return false;
                
             }      
         }); 
 
 </script>
 
 
 <body class='default_background' >
 
 <audio controls id="audioPlayer" style='display:none'>
        <source src="../assets/audio/success_audio.mp3" id="success_audio" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>

 <div id='loading' class="ring"  >Loading <span></span> </div>
 <br>
 <div id='total_div' style='display:none'>
    <div style='display: flex; flex-direction: column; align-items: center;'>
            <div id='response_card' class="card" style="width:70%;display: flex; flex-direction: column; align-items: center;    margin-top: 10%; "> 
    
            <!-- <h5 id='' style='margin: 20px 30px;'>Tranfer Status</h5> -->
            
    
              <div   id='responseMessage' style='display:none;text-align: center; width: 80%; margin: 30px; color: rgb(255 255 255 );font-size: 40px;font-weight:bolder;'> 
           
              Transaction Successful, Page will be<br>
                redirected in 10 seconds
          
            </div> 
            <div   id='errorResponseMessage' style='display:none;text-align: center;width: 80%; margin: 30px; color: rgb(255 255 255 );font-size: 40px;font-weight:bolder;'>
        
            </div>
    
    

    </div>
 
                <div id='error' style='display:none'>
                
                <h1> Please  try again after some time</h1>
                
                </div>
 
 </div>
     <br>
 </body>
 <script type="text/javascript" src="../assets/js/toastify.js"></script>
 </html>