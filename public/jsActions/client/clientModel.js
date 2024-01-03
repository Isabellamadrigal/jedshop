//submit with file
const clientRegistration = async(formData)=>{
    return new Promise((resolve,reject)=>{
        $.ajax({
            url: '/clientRegistration',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(res) {
               resolve(res)
            }
           
        });
    })
}



const reloadVehicleTable = async() => {
    return new Promise(async(resolve,reject)=>{
    
        const allVehicles = await getAllClientVehicle();
        const allVehiclesArr = createArrayForDataTable(allVehicles.data, [
            "actions",
            "vehicleType",
            "make",
            "model",    
            "variant",
            "year"
        ]);
        resolve(loadTable("#vehicleTable", allVehiclesArr));
    });
}


const reloadAppointmentTable = async() => {
    return new Promise(async(resolve,reject)=>{
        const allAppointments = await getWaitingAppoinments();
        const allAppointmentsArr = createArrayForDataTable(allAppointments.data, [
            'actions',
            'vehicle',
            'vehicleProblem',
            'services',
            'requestDate',
            'remarks',
            'requestStatus'
        ]);
        resolve(loadTable("#appointmentTable", allAppointmentsArr));
    });
}





const getAllClientVehicle=async()=>{
    return new Promise((resolve,reject)=>{
        $.get('/getAllClientVehicle',function(res){
            resolve(res);
        })  
    })
}

const getServicesList=async()=>{
    return new Promise((resolve,reject)=>{
        $.get('/getServicesList',function(res){
            resolve(res);
        })
    })
}

const addVehicle=async(serializeForm)=>{
    return new Promise((resolve,reject)=>{
        $.post('/addVehicle',
        serializeForm,function(res){
            resolve(res);
        })
    })
}

const  clearVehicleModal=()=>{
    $("#vehicle-id").val("");
    $("#vehicle-type").val("");
    $("#vehicle-make").val("");
    $("#vehicle-model").val("");
    $("#vehicle-variant").val("");
    $("#vehicle-year").val("");
    $("#vehicle-plateNo").val("");
    
}

const getVehicleInfo =async(id)=>{
    return new Promise((resolve,reject)=>{
        $.get('/getVehicleInfo',
        {id},function(res){
            resolve(res);
        })
    })
}

const editVehicle =async(serializeForm)=>{
    return new Promise((resolve,reject)=>{
        $.post('/editVehicle',
        serializeForm,function(res){
            resolve(res);
        })
    })
}


const changeVehicleStatus = async(id,status)=>{
    return new Promise((resolve,reject)=>{
        $.get('/changeVehicleStatus',
        {id,status},function(res){
            resolve(res);
        })
    })
}

const getWaitingAppoinments =async ()=>{
    return new Promise((resolve,reject)=>{
        $.get('/getWaitingAppoinments',function(res){
            resolve(res);
        })
    })
}

const requestAppointment=async(serializeForm)=>{
    return new Promise((resolve,reject)=>{
        $.post('/requestAppointment',
        serializeForm,function(res){
            resolve(res);
        })
    })
}

const changeAppointmentStatus = async(id,status)=>{
    return new Promise((resolve,reject)=>{
        $.get('/changeAppointmentStatus',
        {id,status},function(res){
            resolve(res);
        })
    })
}
const reloadOnServiceLogsTable = async() => {
    return new Promise(async(resolve,reject)=>{
        const allOnService = await getOnServiceLogs();
        const allOnServiceArr = createArrayForDataTable(allOnService.data, [
           
         
            'vehicle',
            'servicesAvail',
            'partsAvail',
            'dateStart',
            'dateEnded',
            'totalPrice',
            'serviceStatus',
            'paymentStatus'
        ]);
        resolve(loadTable("#onServiceLogstTable", allOnServiceArr));
    });
}

const getOnServiceLogs = async()=>{
    return new Promise((resolve,reject)=>{
        $.get('/getOnServiceLogs',
        function(res){
            resolve(res);
        })
    })
}