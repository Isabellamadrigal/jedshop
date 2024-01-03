

$(document).ready(async function(){
    const checkLoginLoadStatus = async() =>{
      let html="";
      if($('#userType').val()=="client"){
        html=`<br>
        <div class="row">
          <div class="col">
          <a href="/clientRegistration"> Register</a>
          </div>
        </div>
        `
      }
      $('#registrationHyperLink').html(html);
    }
    
    await checkLoginLoadStatus()


    // $('#userType').change(function() {
    //   if($(this).val()=="client"){
    //     $('#yourUsername').attr('type', 'email');
    //   }else if($(this).val()=="admin"){
    //     $('#yourUsername').attr('type', 'pass');
    //   }
    // });

    $('#userType').change(function(){
     let html="";
      if($(this).val()=='client'){
        html=`<br>
        <div class="row">
          <div class="col">
          <a href="/clientRegistration">Registration</a>
          </div>
        `
        $('#yourUsername').attr('type', 'email');
       }else if($(this).val()=="admin"){
            $('#yourUsername').attr('type', 'text');
        }
       $('#registrationHyperLink').html(html);
    })

    $('#login-form').submit(async function(event){
        event.preventDefault();
        let serializeInput = $(this).serialize();
        $.post('/loginAccount',serializeInput,async function(res){
            console.log(res)
            if(res!=""){
                    if(res[0].role =="client"){
                        window.location.href="/clientDashboard";
                    }else if(res[0].role =="admin"){
                      window.location.href="/adminDashboard";
                    }
                
            }else{
                showNotification('Login Failed','This user is not exist','error');
            }
        })
    })

   
  })