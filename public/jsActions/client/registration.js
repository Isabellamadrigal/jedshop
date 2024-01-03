$(document).ready(async function(){
    

    $('#image').change(function(event){
        var input = event.target;
        var imagePreview = $('#imagePreview');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
              
                imagePreview.attr('src', e.target.result);
                imagePreview.show();
            };

           
            reader.readAsDataURL(input.files[0]);
           
        }
    })
    
    $('#customer-registration-form').submit(async function(event){
        event.preventDefault();
        var formData = new FormData(this);
        console.log(formData);
        let testForm = await clientRegistration(formData);
        //console.log(testForm)
        if(testForm.result=="success"){
          let res= await showNotificationRedirect(testForm.type,testForm.description,testForm.result);
            if(res=="success"){
                window.location.href="/";
            }
        }else{
            showNotification(testForm.type,testForm.description,testForm.result);
        }
        
    })
})