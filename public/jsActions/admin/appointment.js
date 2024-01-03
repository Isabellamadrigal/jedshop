$(document).ready(async function(){

    initializeTable("#appointmentTable", { 
        pageLength: 5,
        lengthMenu: [5, 10, 20],
        
    });
    
    await reloadAppointmentTable();

    $('#appointmentTable tbody').on('change', '.appointmentActionBtn', async function() {
        let resService = await getServicesList();
        let resParts = await getPartsList();
        let action = $(this).val();
        let id = $(this).data('id');
        let html ="",html2="";
        let formType="";
        if(action=="Reject Appointment"){
            html=`
            <input type="hidden" class='form-control vehicleInput' value="${id}" name="id" id="appoint-id" >
            <b>Reason for rejection</b>
            <div class="row">
                <div class="col">
                <textarea class="form-control" rows="4" name="remarks" placeholder="" required></textarea>
                </div>
            </div>
            `
            formType="reject";
   
        }else if(action=="Approve Appointment"){
            formType="approve";
            html=`
            <input type="hidden" class='form-control vehicleInput' value="${id}" name="id" id="appoint-id" >
            <b>Set a date schedule for client</b>
            <div class="row">
                <div class="col">
                <textarea class="form-control" rows="4" name="remarks" placeholder="" required></textarea>
                </div>
            </div>
            `
        }

     
        $('#formType-appointment').val(formType);
        $('.inputfields-form').html(html);
        $('#appointmentModal').modal('show');

        setTimeout(()=>{
            $(this).val('');
        },200);
    })

    

    $('.closeAppointmentModalBtn').click(function(){
        $('.inputfields-form').html("");
        $('#appointmentModal').modal('hide');
    })


    $('#appointment-form').submit(async function(event){
        event.preventDefault();
        let serializeForm = $(this).serialize();
        let formType = $('#formType-appointment').val();
        if(formType=="reject"){
            let rejectForm = await changeAppointmentStatus(serializeForm);
            if(rejectForm.result=="success"){
                showNotification(rejectForm.type,rejectForm.description,rejectForm.result);
                $('.inputfields-form').html("");
                $('#appointmentModal').modal('hide');
                await reloadAppointmentTable();
            }
        }else if(formType=="approve"){
            let approveForm = await changeAppointmentStatus(serializeForm);
            if(approveForm.result=="success"){
                showNotification(approveForm.type,approveForm.description,approveForm.result);
                $('.inputfields-form').html("");
                $('#appointmentModal').modal('hide');
                await reloadAppointmentTable();
            }
        }
       
    })

})


