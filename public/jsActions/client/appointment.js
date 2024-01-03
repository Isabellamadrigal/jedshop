$(document).ready(async function(){
    initializeTable("#appointmentTable", { 
        pageLength: 5,
        lengthMenu: [5, 10, 20]
    });
    //await reloadVehicleTable();

    await reloadAppointmentTable();
   
//  let tess = await getWaitingAppoinments();
//  console.log(tess)
    $('#appointmentModalBtn').click(async function(){
        let resService = await getServicesList();
        let resVehicle = await getAllClientVehicle();
        let shtml="" ,vhtml="";

        //load services on 1st table row
        shtml+=`<option value="" selected disabled>Select Option</option>`
        for(let data1 of resService){
            shtml+=`<option value="${data1.id}">${data1.serviceDesc}</option>`
        }
        //load select vehicle
        vhtml+=`<option value="" selected disabled>Select Option</option>`
        for(let data2 of resVehicle.data){
            vhtml+=`<option value="${data2.id}">${data2.make} ${data2.model} ${data2.variant}</option>`
        }
        //remove table row except for 1st row
        const $parentRow = $('.DelServices').closest('tr');
        if (!$parentRow.is(':first-child')) {
        $parentRow.remove();
        }


        $('#vehicle-list').html(vhtml);
        $('#service-service0').html(shtml);
        $('#appointmentModal').modal('show');
    })


    $('.closeAppointmentModalBtn').click(function(){
        $('#appointmentModal').modal('hide');
    })

    let index=1;

    
    $('#table tbody').on('click', '.DelServices', async function(){
        let id = $(this).data('id');
        $(this).closest('tr').remove();
    })


  

    $('.addServices').click(async function(){
  
        let html="";
        let res = await getServicesList();
      
        html+=`<tr>
            <td>
                <select class="form-control" name="serviceId[]" id="service-service${index}"'>`
                html+=`<option value="" selected disabled>Select Option</option>`
                
                for(let data of res){
                    html+=`<option value="${data.id}">${data.serviceDesc}</option>`
                }
        html+=`</select>
            </td>
            <td>
                <button type="button" class="btn btn-danger btn-sm DelServices" data-id='${index}'>Del</button>
            </td>
        </tr>`
        
        index++;

        $('#selectServiceTbody').append(html)
    })

   

    $('#appointmentTable tbody').on('change', '.appointmentActionBtn', async function() {
           
         const id = $(this).data('id');
         const action = $(this).val();
         if(action=="Del Appointment"){

            let delForm =  await changeAppointmentStatus(id,'canceled');
            if(delForm.result=="success"){
             showNotification(delForm.type,delForm.description,delForm.result); 
             await reloadAppointmentTable();
            }else{
             showNotification(delForm.type,delForm.description,delForm.result); 
            }
         }

  
         setTimeout(()=>{
             $(this).val('');
         },200);
     });

  

    $('#appointment-form').submit(async function(event){
        event.preventDefault();
        let serializeForm = $(this).serialize();
            let addForm = await requestAppointment(serializeForm);
                showNotification(addForm.type,addForm.description,addForm.result);
                $('#appointmentModal').modal('hide');
                clearVehicleModal();
                await reloadAppointmentTable();
    })
})

