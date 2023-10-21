
<?php
$uid= $_GET['uid']; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>CashBack</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="./assets/css/styles.css">
  <script src="./assets/js/jquery.min.js"></script>
  <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />   

  <script defer >

    var uid1 ='<?php echo $uid; ?>'
   
  


   var jsonBody= JSON.stringify({
    "qrData": "https://www.sureassure.com/pa?uid="+uid1,
    "usrAdrs": "Agra, Uttar Pradesh, 282004, India",
    "usrCntry": "India(+91)",
    "usrState": "Uttar Pradesh",
    "usrZip": "282004",
    "usrlatitude": 27.1407174,
    "usrlongitude": 78.0309542,
    "verificationMode": "Web",
    "verificationType": 2
  })
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
        url: "https://www.sureassure.com/api/PA/Verify",
        dataType: "html",        
        success: function(data) {   

        //  alert(data)



        var obj = JSON.parse(data); 
        

        if(obj.responseCode=='200'){

          $("#total_div").show(); 
            var data=obj.data
            var prodSpecification=data.prodSpecification;



            $("#productImg").attr('src',data.productImg[0])
            $("#compLogo").attr('src',data.compLogo)
            $("#responseMessage").html(obj.responseMessage)
            $("#productNm").html(data.productNm)
            $("#productRating").html(data.productRating)
            $("#totalRating").html(data.totalRating)
  
            prodSpecification.forEach((item)=>{
            
              if(item.key==='Email'){
            $("#prodSpecification > tbody").append("<tr><th>"+item.key+"</th><td><a href='mailto:"+item.value+"'>"+item.value+"</a></td></tr>")
                
              }
              else if(item.key==='Website'){
                $("#prodSpecification > tbody").append("<tr><th>"+item.key+"</th><td><a href='"+item.value+"'>"+item.value+"</a></td></tr>")

              } 
              else if(item.key==='Mobile'){
                $("#prodSpecification > tbody").append("<tr><th>"+item.key+"</th><td><a href='tel:+"+item.value+"'>"+item.value+"</a></td></tr>")

              }
              else{
            $("#prodSpecification > tbody").append("<tr><th>"+item.key+"</th><td>"+item.value+"</td></tr>")

              }

            })


            $("#prodSpecificationKey1").html(obj.data.prodSpecification[0].key)
            $("#prodSpecificationValue1").html(obj.data.prodSpecification[0].value)





         if(obj.data.isTransfer==='1'){

              $("#claim").show();
              $("#form_div").show();
              $("#responseMessage").html(obj.responseMessage)
             // $("#loyaltyMsg").html(obj.data.loyaltyMsg)
              $("#seqNo").val(obj.data.seqNo)
              $("#verificationId").val(obj.data.verificationId)
              $("#genuineAudio").val(obj.data.genuineAudio)
              $("#cashBackForm").show();
          }else{
              $("#claim").hide();
              $("#form_div").show();
             // $("#loyaltyMsg").html(obj.data.loyaltyMsg)
              $("#responseMessage").html(obj.responseMessage)
              $("#cashBackForm").hide();

            }


         // $("#uid_hidden").val(uid1)
        }else{
            $("#error").show();

        }

        },
            error:function(error){
               alert("error"); 
                 return false;
               
            }      
        }); 




</script>


</head>
<body id='total_body' class=''>
<div id='loading' class="ring"  >Loading
  <span></span>
</div>
<br> 
<br> 
<br> 
<br> 

 
  <div class="container" id='form_div' style='display:none'>
   <!-- 
    <div id='responseMessage' style='text-align: center; margin-bottom: 30px; color: #1893ac;font-size: 20px;'> </div>
    <div id='loyaltyMsg' style='text-align: center; margin-bottom: 30px; color: #257b00;font-size: 20px;'> </div> 
  -->
  <div class="container-text" id='' style='' >   
   
   <div id='total_div' style='display:none'>
      <div style='display: flex; flex-direction: column; align-items: center;'>
        <div class="card" style="width:70% "> 

        <h5 id='' style='margin: 20px 30px;'>PRODUCT AUTHENTICATION</h5>
          <br>

        <div id='responseMessage' style='text-align: center; margin-bottom: 30px; color: #1893ac;font-size: 20px;animation: blinker 1.5s linear infinite;'>

        </div>
        <!-- <div id='loyaltyMsg' style='text-align: center; margin-bottom: 30px; color: #257b00;font-size: 20px;'> </div> -->
        <div  id='claim' style='text-align: center; margin-bottom: 30px; color: red;font-size: 20px;  animation: blinker 1.5s linear infinite;'> 
          <a onclick='openCashBackForm();' style='cursor: pointer;'>  Click Here to Claim</a>
        </div>  


        <div id='images_div'>

          <img src="" id="productImg" class="card-img-top" alt="" style='width: 35%; margin: 20px;'>
          <img src="" id="compLogo" class="card-img-top" alt="" style='width: 20%; margin: 20px; right: 7%; position: absolute;'>

        </div>
       
      <div id='items_rating_div'>

          <h5 id='productNm' style='margin-top:10px;'></h5>
            
          <div style='display:flex;justify-content: space-around;'>
          <div class='ratings'>
          <i class="fa-regular fa-star"></i>&nbsp;
          <p id='productRating'></p>(<p id='totalRating'></p>)
          </div>
          <div class='ratings'>
          <i class="fa-regular fa-message"></i>&nbsp;<p>Feedback</p>
          </div>
          <div class='ratings'>
          <i class="fa-solid fa-share"></i>&nbsp;<p>Share</p>

          </div>
      
        </div>

      </div>
            <div class="card-body">
                <table class='table' id='prodSpecification'>

                <tbody>
                </tbody>
                </table>
            </div>

      </div>
 




   
   
  </div>
  
 
    
   

    </div>


    <div id='cashBackFormDiv' style='display:none'>

    <form action="./pages/gettransaction.php" method='post' id='cashBackForm' >
      <div style='display:flex;flex-direction:column;align-items: center;'>
      <h1 class='upi_transfer_text' style='background: aliceblue; border-radius: 35px; padding: 12px; width: 60%;font-size: 25px;'>UPI Transfer</h1>

      </div>
        
       <input type="hidden"   id='uid_hidden' name='uid_hidden' value='<?php echo $uid; ?>'>
       <input type="hidden"   id='genuineAudio' name='genuineAudio' value=''>
       <input type="hidden"   id='seqNo' name='seqNo' value=''>
       <input type="hidden"   id='verificationId' name='verificationId' value=''>

      <input type="text" placeholder="UPI Name" id='beneficiary_name' name='beneficiary_name' >
      <input type="text" placeholder="UPI Address(VPA)" id='upi_handle' name='upi_handle' >
      <input type="text" placeholder="Mobile No" id='mobileNo' name='mobileNo' maxlength='10'>
      <br><br>
      <button type="button" onclick='return submitForm()'>Submit</button>
      <br>

    </form> 


      </div>





</body>
<script>
 
 function submitForm(){

    if($("#beneficiary_name").val()==null || $("#beneficiary_name").val().trim()==""){
        alert('Please Enter Name ');
        $("#beneficiary_name").focus();
        return false;
    }
    if($("#upi_handle").val()==null || $("#upi_handle").val().trim()==""){
        alert('Please Enter UPI Address ');
        $("#upi_handle").focus();
        return false;
    }  

    // var emailRegEx= /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/; 
    // if(!emailRegEx.test($("#email").val())){
    //     alert('Please Enter valid Email ');
    //     $("#email").val('');
    //     $("#email").focus();
    //     return false;
    // }
    
     if($("#mobileNo").val()==null || $("#mobileNo").val().trim()==""){
        alert('Please Enter Mobile No ' );
        $("#mobileNo").focus();
        return false;
    }
    var mobileRegEx = /^[5-9][0-9]{9}$/;
    if(!mobileRegEx.test($("#mobileNo").val())){
        alert('Please Enter valid Mobile No ');
        $("#mobileNo").val('');
        $("#mobileNo").focus();
        return false;
    }
 
    $('#cashBackForm').submit();
    return true;
 }
  
function openCashBackForm(){
  $("#mobileNo").val('');
  $("#upi_handle").val('');
  $("#beneficiary_name").val('');

$("#cashBackFormDiv").show();
$("#total_div").hide();
$("#total_body").addClass("default_background")
$("#form_div").addClass("response_card")
}
 </script>
</html>
