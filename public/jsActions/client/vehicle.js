$(document).ready(async function(){
    initializeTable("#vehicleTable", { 
        pageLength: 5,
        lengthMenu: [5, 10, 20]
    });
    await reloadVehicleTable();

//    let test = await getAllClientVehicle();
// console.log(test)
    $('#vehicleModalBtn').click(function(){
        $('#vehicleModal').modal('show');
    })
    $('.closeVehicleModalBtn').click(function(){
        clearVehicleModal();
        $('#vehicleModal').modal('hide');
    })


    //

    $('#vehicleTable tbody').on('change', '.vehicleActionBtn', async function() {
        
        // let select_choice = ['Edit Branch','Open Branch','Close Branch','Disable Branch'];
 
         
         const id = $(this).data('id');
         const action = $(this).val();
         if(action=="Edit Vehicle"){
        
             const vehicleDetails = await getVehicleInfo(id);
             $("#vehicleModal").modal('show');
             $("#vehicle-id").val(vehicleDetails[0].id);
             $("#vehicle-type").val(vehicleDetails[0].vehicleType);
             $("#vehicle-make").val(vehicleDetails[0].make);
             $("#vehicle-model").val(vehicleDetails[0].model);
             $("#vehicle-variant").val(vehicleDetails[0].variant);
             $("#vehicle-year").val(vehicleDetails[0].year);
             $("#vehicle-plateNo").val(vehicleDetails[0].plateNo);

         }else if(action=="Delete Vehicle"){
           let delForm =  await changeVehicleStatus(id,'hidden');
           if(delForm.result=="success"){
            showNotification(delForm.type,delForm.description,delForm.result); 
            await reloadVehicleTable();
           }else{
            showNotification(delForm.type,delForm.description,delForm.result); 
           }
           
         }
  
         setTimeout(()=>{
             $(this).val('');
         },200);
     });



    $('#vehicle-form').submit(async function(event){
        event.preventDefault();
        let serializeForm = $(this).serialize();
      
        
        //edit form
        if($('#vehicle-id').val()){
            let editForm = await editVehicle(serializeForm);
            if(editForm.result=="success"){
                showNotification(editForm.type,editForm.description,editForm.result);
                $('#vehicleModal').modal('hide');
                clearVehicleModal();
                await reloadVehicleTable();
            }else{
                showNotification(editForm.type,editForm.description,editForm.result); 
            }
        }
        else{
        //add form
            let addForm = await addVehicle(serializeForm);
            if(addForm.result=="success"){
                showNotification(addForm.type,addForm.description,addForm.result);
                $('#vehicleModal').modal('hide');
                clearVehicleModal();
                await reloadVehicleTable();
            }else{
                showNotification(addForm.type,addForm.description,addForm.result); 
            }
        }
       
    })
})

