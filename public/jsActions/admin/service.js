
$('#toggleBtn').click(function () {
    
    $(this).text(function (i, text) {
        return text === "Hide Approve Appointment" ? "Show Approve Appointment" : "Hide Approve Appointment";
    });
});

$('#searchInput').on('keyup', function () {
    loadData(1, $(this).val());
});

loadInitialData();

function loadInitialData() {
    loadData(1);
}
async function loadData(page = 1, query = '') {

    // let data = await getApprovedAppointment(page,query);
    // displayData(data);
    // displayPagination(data);

    $.ajax({
        url: "/getApprovedAppointment",
        method: 'GET',
        data: { page: page, query: query },
        success: function (data) {
            displayData(data);
            displayPagination(data);
        },
        error: function (error) {
            console.log(error);
        }
    });
}

function displayData(data) {
    $('#dataContainer').empty();

    $.each(data.data, function (index, item) {
        var itemHtml = `
            <div class="card m-2 shadow" style="width: 18rem;">
                <div class="card-body">
                    <div class="row" style="height:100px;">
                        <div class="col">
                        <h5 class="card-title">Vehicle: ${item.make} ${item.model} ${item.variant}</h5>
                        <p class="card-text">Client: ${item.name}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col text-center">
                            <button type="button" class="btn btn-sm btn-success" onclick="setService('${item.id}')">Set Service</button>
                        </div>
                    </div>
                    

                    
                </div>
            </div>
        `;

        $('#dataContainer').append(itemHtml);
    });
}

function displayPagination(data) {
    $('#pagination').empty();

    var prevDisabled = data.prev_page_url ? '' : ' disabled';
    var nextDisabled = data.next_page_url ? '' : ' disabled';

    var paginationHtml = `
        <ul class="pagination">
            <li class="page-item${prevDisabled}">
                <a class="page-link" href="#"  onclick="loadData(${data.current_page - 1}, '${$('#searchInput').val()}')" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>

            </li>
    `;

    for (var i = 1; i <= data.last_page; i++) {
        var active = i === data.current_page ? ' active' : '';
        paginationHtml += `<li class="page-item${active}"><a class="page-link" href="#" onclick="loadData(${i}, '${$('#searchInput').val()}')">${i}</a></li>`;
    }

    paginationHtml += `
            <li class="page-item${nextDisabled}">
                <a class="page-link" href="#" onclick="loadData(${data.current_page + 1}, '${$('#searchInput').val()}')" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    `;

    $('#pagination').append(paginationHtml);
}


async function setService(id){
        let resService = await getServicesList();
        let resParts = await getPartsList();
        let appointmentInfo =await getApprovedAppointmentInfo(id);
    console.log(appointmentInfo)
        let html ="",html2="";
        let formType="";

            formType="onservicesform";
            $('#modal-size').removeClass('modal-md');
            $('#modal-size').addClass('modal-xl');

            html+=`
                            <div class="row">
                                <div class="col-3 ">
                                    <label>Client Name</label>
                                    <div class="row">
                                        <div class="col">
                                            <input type="hidden" id="appoint-id" name="appointId">
                                            <input type="hidden" id="client-id" name="clientId"> 
                                            <input type="hidden" id="vehicle-id" name="vehicleId">
                                            <input type="text" id="client-name" disabled>
                                        </div>
                                    </div>
                                    <label>Vehicle</label>
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" id="client-vehicle" disabled>
                                        </div>
                                    </div>
                                    <label>Vehicle Issue</label>
                                    <div class="row">
                                        <div class="col">
                                            <textarea class="form-control" rows="4" id="vehicle-issue" placeholder="" disabled></textarea>
                                        </div>
                                    </div>
                                    <label>Requested Service</label>
                                    <div class="row">
                                        <div class="col">
                                            <textarea class="form-control" rows="4" id="service-request" placeholder="" disabled></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                        <label for="">Service Select</label>
                                        <table id="serviceTable" class="table">
                                            <thead>
                                                <Tr>
                                                    <th>Services</th>
                                                    <th>Action</th>
                                                </Tr>
                                            </thead>
                                            <tbody id="selectServiceTbody">
                                                <tr>
                                                    <td>
                                                    <input type="hidden" name="serviceCost[]" class="serviceCost" id="serviceCost0">
                                                     <select class="form-control form-control-sm serviceSelectBtn" name="serviceId[]" id="service-service0" data-id="0">`
                                                     html+=`<option value="" selected disabled>Select Option</option>`
                                                     for(let data of resService){
                                                         html+=`<option value="${data.id}">${data.serviceDesc} | ${formatter.format(data.price)}</option>`
                                                     }
                                                     html+=`</select>
                                                    </td>
                                                    <td>
                                                     <button type="button" class="addServices bg-primary rounded" data-id='0'>Add</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                       
                                        </div>
                                        <div class="col">
                                        <label for="">Parts Select</label>
                                        <table id="partsTable" class="table">
                                            <thead>
                                                <Tr>
                                                    <th>Parts</th>
                                                    <th>Action</th>
                                                </Tr>
                                            </thead>
                                            <tbody id="selectPartsTbody">
                                                <tr>
                                                    <td>
                                                     <input type="hidden" name="partCost[]" class="partCost" id="partCost0">
                                                     <select class="form-control form-control-sm partsSelectBtn"  name="partsId[]" id="vehicle-parts0" data-id="0">`
                                                     html+=`<option value="" selected disabled>Select Option</option>`
                                                     for(let data2 of resParts){
                                                         html+=`<option value="${data2.id}">${data2.itemDesc} | ${formatter.format(data2.price)}</option>`
                                                     }
                                                    html+=`</select>
                                                    </td>
                                                    <td>
                                                     <button type="button" class=" bg-primary rounded addParts" data-id='0'>Add</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        
                                        </div>
                                    </div>
                                    <div class="row">
                                            <div class="col">
                                                     <div class="card">
                                                        <div class="card-body">
                                                            <input id="serviceCharge" type="hidden" name="serviceCharge">
                                                            <input id="partsCharge" type="hidden" name="partsCharge">
                                                            <input id="totalPrice" type="hidden" name="totalPrice">
                                                            <h5>Total Price: <span id="total-pricetag"></span></h5>
                                                        </div>
                                                     </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
            `

        $('#formType-appointment').val(formType);
        $('.inputfields-form').html(html);
        $('#appointmentModal').modal('show');
        $('#client-name').val(appointmentInfo.data[0].name);
        $('#client-vehicle').val(appointmentInfo.data[0].vehicle);
        $('#vehicle-issue').val(appointmentInfo.data[0].vehicleProblem);
        $('#service-request').val(appointmentInfo.data[0].serviceRequest);
        
        $('#client-id').val(appointmentInfo.data[0].clientId);
        $('#vehicle-id').val(appointmentInfo.data[0].vehicleId);
        $('#appoint-id').val(id);

        const serviceCost=()=>{
            var sum = 0;
            let serviceCost = $('input[name="serviceCost[]"]').map(function(){ 
                return this.value; 
            }).get();
            for(let i=0;i<serviceCost.length;i++){
                if(serviceCost[i]!=""){
                    sum = sum+parseFloat(serviceCost[i])
                }   
            }
            $('#serviceCharge').val(sum);
           // $(".serviceCharge").html(formatter.format(sum));    
        }
        
        const partsCost=()=>{
            var sum = 0;
            
            let partCost = $('input[name="partCost[]"]').map(function(){ 
                return this.value; 
            }).get();

            for(let i=0;i<partCost.length;i++){
                if(partCost[i]!=""){
                    sum = sum+parseFloat(partCost[i])
                }   
            }
            $("#partsCharge").val(sum);    
        }
        


        const totalCost=()=>{
            let sum=0
            let serviceCost = $('input[name="serviceCost[]"]').map(function(){ 
                return this.value; 
            }).get();
        
            let partCost = $('input[name="partCost[]"]').map(function(){ 
                return this.value; 
            }).get();
            for(let i=0;i<serviceCost.length;i++){
                if(serviceCost[i]!=""){
                    sum = sum+parseFloat(serviceCost[i])
                }   
            }
            for(let i=0;i<partCost.length;i++){
                if(partCost[i]!=""){
                    sum = sum+parseFloat(partCost[i])
                }   
            }
            $("#totalPrice").val(sum);
            $("#total-pricetag").html(formatter.format(sum));    
        }

        
        $('#partsTable tbody').on('change','.partsSelectBtn', async function(){
            let id = $(this).val();
            let dataId= $(this).data('id');
            let res = await getPartsInformation(id);
        
            $(`#partCost${dataId}`).val(res[0].price)
          //  partsCost();
            totalCost();
            partsCost()
        })


        $('#serviceTable tbody').on('change','.serviceSelectBtn', async function(){
            let id = $(this).val();
            let dataId= $(this).data('id');
            let res = await getServiceInformation(id);
      
            $(`#serviceCost${dataId}`).val(res[0].price)
         //   serviceCost();
            totalCost();
            serviceCost();
        })


        //append service select select events nested
        let indexS =1;      let indexP =1;
        $('.addServices').click(async function(){
            let html="";
            let res = await getServicesList();
          
            html+=`<tr>
                <td>
                    <input type="hidden" name="serviceCost[]" class="serviceCost" id="serviceCost${indexS}">
                    <select class="form-control serviceSelectBtn" name="serviceId[]" id="service-service${indexS}" data-id="${indexS}" required>`
                    html+=`<option value="" selected disabled>Select Option</option>`
                    
                    for(let data of res){
                        html+=`<option value="${data.id}">${data.serviceDesc} | ${formatter.format(data.price)}</option>`
                    }
            html+=`</select>
                </td>
                <td>
                    <button type="button" class="bg-danger DelServices" data-id='${indexS}'>Del</button>
                </td>
            </tr>`
            
            indexS++;
    
            $('#selectServiceTbody').append(html)

            
        })
        
        //delete service table row
        $('#serviceTable tbody').on('click', '.DelServices', async function(){
        let id = $(this).data('id');

        $(this).closest('tr').remove();
        totalCost();
        serviceCost();
        })


        

        //append parts select select events nested
        $('.addParts').click(async function(){
           
            let html="";
            let res = await getPartsList();
          
            html+=`<tr>
                <td>
                    <input type="hidden" name="partCost[]" class="partCost" id="partCost${indexP}">
                    <select class="form-control partsSelectBtn" name="partsId[]" id="vehicle-parts${indexP}" data-id="${indexP}" required>`
                    html+=`<option value="" selected disabled>Select Option</option>`
                    
                    for(let data of res){
                        html+=`<option value="${data.id}">${data.itemDesc} | ${formatter.format(data.price)}</option>`
                    }
            html+=`</select>
                </td>
                <td>
                    <button type="button" class="bg-danger DelParts" data-id='${indexP}'>Del</button>
                </td>
            </tr>`
            
            indexP++;
    
            $('#selectPartsTbody').append(html)
        })
        
        //delete part table row
        $('#partsTable tbody').on('click', '.DelParts', async function(){
        let id = $(this).data('id');
    
        $(this).closest('tr').remove();

        totalCost();
        partsCost()
    })       

}


$(document).ready(async function(){
    initializeTable("#onServicetTable", { 
        pageLength: 5,
        lengthMenu: [5, 10, 20]
    })

    await reloadOnServiceTable()
    $('.closeAppointmentModalBtn').click(function(){
     
        $('#appointmentModal').modal('hide');
        $('.inputfields-form').html("");
    })
    
  
    
    $('#appointment-form').submit(async function(event){
        event.preventDefault();
        let formType =  $('#formType-appointment').val();
        let serializeForm = $(this).serialize();
      
        if(formType=="payment"){
            let totalPrice = $('#total-price').val();
            let cash  =$('#cash').val();
            let id = $('#onServiceId').val();
            if(parseFloat(totalPrice)<=parseFloat(cash) && cash !=""){
                let finishAction =await changeOnServiceStatus(id,'paid')
                if(finishAction.result=="success"){
                    showNotification(finishAction.type,finishAction.description,finishAction.result);
                    $('.inputfields-form').html("");
                    $('#appointmentModal').modal('hide');
                    await reloadOnServiceTable();
        
                }else{
                    showNotification(addForm.type,addForm.description,addForm.result);
                }
            }
            else{
                showNotification('Payment','Insufficient Payment','error');
            }
        }else if(formType=="onservicesform"){
            let addForm =await setServiceSubmit(serializeForm);
            if(addForm.result=="success"){
                showNotification(addForm.type,addForm.description,addForm.result);
                $('.inputfields-form').html("");
                $('#appointmentModal').modal('hide');
                loadInitialData();
                await reloadOnServiceTable()
    
            }else{
                showNotification(addForm.type,addForm.description,addForm.result);
            }
        }
        
    })

    $('#onServicetTable tbody').on('change','.onServiceActionBtn',async function(){
        let id = $(this).data('id');
        let actions = $(this).val();
        let html ="";
        if(actions=="start task"){
        let startAction =await changeOnServiceStatus(id,'ongoing')
            if(startAction.result=="success"){
                showNotification(startAction.type,startAction.description,startAction.result);

                await reloadOnServiceTable()
            }
        }else if(actions == "del task"){

        }else if(actions =="finish task"){
            let finishAction =await changeOnServiceStatus(id,'finished')
            if(finishAction.result=="success"){
                showNotification(finishAction.type,finishAction.description,finishAction.result);

                await reloadOnServiceTable()
            }
            
        }else if(actions=="payment"){
            let onServiceInfo = await getOnServiceInfo(id);
            console.log(onServiceInfo)
            html=`
            <div class="row">
                <div class="col text-center">
                    <h4>Payment</h4>   
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col-12">
                           <input type="hidden" value="${onServiceInfo[0].id}" id="onServiceId">
                           Client: <b>${onServiceInfo[0].name}</b>
                        </div>
                        <div class="col-12">
                           Vehicle <b>${onServiceInfo[0].make} ${onServiceInfo[0].model} ${onServiceInfo[0].variant} ${onServiceInfo[0].year}</b>
                        </div>
                        <div class="col-12">
                           Total Price : <b>${formatter.format(onServiceInfo[0].totalPrice)}</b>
                           <input type="hidden" id="total-price" value="${onServiceInfo[0].totalPrice}">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <input type="number" class="form-control" id="cash">
                        </div>
                    </div>  
                    <br>
                    <div class="row">
                        <div class="col">
                            Change: <b><span id="change">0</span></b>
                        </div>
                    </div>
                </div>
            </div>
            `
            $('#formType-appointment').val("payment");
            $('#modal-size').removeClass('modal-md');
            $('#modal-size').addClass('modal-lg');
            $('.inputfields-form').html(html);
            $('#appointmentModal').modal('show');
        } 

        $('#cash').on('input', function(){
            let cash = $(this).val();
            let totalPrice = $('#total-price').val();
            let diff =0;
            if(cash<=-1){
                $(this).val(0);
            }
            diff =cash -totalPrice;
            if(parseFloat(diff)>=0){
                $('#change').text(formatter.format(diff));
            }
           
        })

        setTimeout(()=>{
            $(this).val('');
        },200);
    })


   
})


