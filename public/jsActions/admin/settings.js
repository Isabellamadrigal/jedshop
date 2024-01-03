$(document).ready(async function(){
    initializeTable("#servicesTable", { 
       pageLength: 5,
       lengthMenu: [5, 10, 20],
    
   });

   initializeTable("#PartsTable", { 
    pageLength: 5,
    lengthMenu: [5, 10, 20],

    });

    await reloadPartsTable()
    await reloadServicesTable()

    $('#servicesTable tbody').on('change','.servicesActionBtn',async function(){
            let id = $(this).data('id');
            let actions = $(this).val();
            let formType=""; 
            let html="";

            if(actions=="Edit"){
                formType="Services";
                let resData = await getServiceInformation(id);
                
                console.log(resData)
               html = html = htmlFormSettings(resData,'Edit','Services')
                $('#formType').val(formType);
                $('.inputfields-form').html(html);
                $('#settingsModal').modal("show");

            }else if(actions=="Show"){
                let show= await changeServicesStatus(id,'visible');
                if(show.result=="success"){
                    showNotification(show.type,show.description,show.result);
                    await reloadServicesTable()
                }
            }
            else if(actions=="Hide"){
                let hidden= await changeServicesStatus(id,'hidden');
                if(hidden.result=="success"){
                    showNotification(hidden.type,hidden.description,hidden.result);
                    await reloadServicesTable()
                }
            }

        setTimeout(()=>{
            $(this).val('');
        },200);
    })

    $('.closeSettingsModalBtn').click(function(){
     
        $('#settingsModal').modal('hide');
        $('.inputfields-form').html("");
    })
    
    $('#PartsTable tbody').on('change','.partsActionBtn',async function(){
        let id = $(this).data('id');
        let actions = $(this).val();
        let formType=""; 
        let html="";

        if(actions=="Edit"){
            formType="Parts";
            
            let resData = await getPartsInformation(id);
            html = htmlFormSettings(resData,'Edit','Parts')
            $('#formType').val(formType);
            $('.inputfields-form').html(html);
            $('#settingsModal').modal("show");

        }else if(actions=="Show"){
           let show= await changePartsStatus(id,'visible');
           if(show.result=="success"){
            showNotification(show.type,show.description,show.result);
            await reloadPartsTable()
            }
        }

        else if(actions=="Hide"){
           let hidden= await changePartsStatus(id,'hidden');
           if(hidden.result=="success"){
            showNotification(hidden.type,hidden.description,hidden.result);
            await reloadPartsTable()
        }
        }

        setTimeout(()=>{
            $(this).val('');
        },200);
    })

    $('.addServiceBtn').click(async function(){
        let html = htmlFormSettings('','Add','Services');
        //console.log(html)
        let formType="Services";    
        $('#formType').val(formType);
        $('.inputfields-form').html(html);
        $('#settingsModal').modal("show");
    })

    $('.addPartsBtn').click(async function(){
        let html = htmlFormSettings('','Add','Parts');
        //console.log(html)
        let formType="Parts";    
        $('#formType').val(formType);
        $('.inputfields-form').html(html);
        $('#settingsModal').modal("show");
    })


    $('#settings-form').submit(async function(event){
        event.preventDefault();
        var formData = new FormData(this); 
        let formType= $('#formType').val();
        let id=$('#id').val();
       
        if(id){
            if(formType=="Services"){
                let resEditService = await editServiceInfo(formData);
                if(resEditService.result=="success"){
                    showNotification(resEditService.type,resEditService.description,resEditService.result);
                    await reloadServicesTable()
                    $('#settingsModal').modal("hide");
                }
            }
            if(formType=="Parts"){
                let resEditParts = await editPartInfo(formData);
                if(resEditParts.result=="success"){
                    showNotification(resEditParts.type,resEditParts.description,resEditParts.result);
                    await reloadPartsTable()
                    $('#settingsModal').modal("hide");
                }
            }
        }
        else{
            if(formType=="Services"){
                let resAddService = await addServices(formData);
                if(resAddService.result=="success"){
                    showNotification(resAddService.type,resAddService.description,resAddService.result);
                    await reloadServicesTable()
                    $('#settingsModal').modal("hide");
                }
            }
            if(formType=="Parts"){
                let resAddParts = await addParts(formData);
                if(resAddParts){
                    if(resAddParts.result=="success"){
                        showNotification(resAddParts.type,resAddParts.description,resAddParts.result);
                        await reloadPartsTable()
                        $('#settingsModal').modal("hide");
                    }
                }
            }
        }

    })



    //forms 
    const htmlFormSettings=(data, formType,formCat)=>{
        let html="";
        if(formType=="Edit" && formCat=='Services'){
            html+=`
            <input type="hidden" value="${data[0].id}" id="id" name="id" >
         
            <div class="row">
                <div class="col-12">
                    <label>Image</label>
                    <input type="file" value="" name="imgPath" class="form-control" required>
                </div>
                <div class="col-12">
                    <label>Item Desc</label>
                    <input type="text" value="${data[0].serviceDesc}" name="serviceDesc" class="form-control" required>
                </div>
                <div class="col-12">
                <label>Price</label>
                    <input type="number" value="${data[0].price}" name="price" class="form-control" required>
                </div>
            </div>
            `
        }

        else if(formType=="Add" && formCat=='Services'){
            html+=`
            <input type="hidden" value="" id="id" name="id"  >
    
            <div class="row">
                <div class="col-12">
                    <label>Image</label>
                    <input type="file" value="" name="imgPath" class="form-control" required>
                </div>
                <div class="col-12">
                    <label>Item Desc</label>
                    <input type="text" value="" name="serviceDesc" class="form-control" required>
                </div>
                <div class="col-12">
                <label>Price</label>
                    <input type="number" value="" name="price" class="form-control" required>
                </div>
            </div>
            `
        }

        if(formType=="Edit" && formCat=='Parts'){
            html+=`
            <input type="hidden" value="${data[0].id}" id="id" name="id">
   
            <div class="row">
                <div class="col-12">
                    <label>Image</label>
                    <input type="file" value="" name="imgPath" class="form-control" required>
                </div>
                <div class="col-12">
                    <label>Item Desc</label>
                    <input type="text" value="${data[0].itemDesc}" name="itemDesc" class="form-control" required>
                </div>
                <div class="col-12">
                    <label>Category</label>
                    <input type="text" value="${data[0].category}" name="category" class="form-control" required>
                </div>
            
                <div class="col-12">
                <label>Price</label>
                    <input type="number" value="${data[0].price}" name="price" class="form-control" required>
                </div>
            </div>
            `
        }

        else if(formType=="Add" && formCat=='Parts'){
            html+=`
            <input type="hidden" value="" name="id" id="id" >
       
            <div class="row">
                <div class="col-12">
                    <label>Image</label>
                    <input type="file" value="" name="imgPath" class="form-control" required>
                </div>
                <div class="col-12">
                    <label>Item Desc</label>
                    <input type="text" value="" name="itemDesc" class="form-control" required>
                </div>
            
                <div class="col-12">
                    <label>Category</label>
                    <input type="text" value="" name="category" class="form-control" required>
                </div>
                <div class="col-12">
                <label>Price</label>
                    <input type="number" value="" name="price" class="form-control" required>
                </div>
            </div>
            `
        }
        
    
        return html;
    }

})