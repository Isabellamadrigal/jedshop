const getServicesList=async()=>{
    return new Promise((resolve,reject)=>{
        $.get('/getServicesList',function(res){
            resolve(res);
        })
    })
}

const getPartsList=async()=>{
    return new Promise((resolve,reject)=>{
        $.get('/getPartsList',function(res){
            resolve(res);
        })
    })
}

const reloadAppointmentTable = async() => {
    return new Promise(async(resolve,reject)=>{
        const allAppointments = await getWaitingAppoinments();
        const allAppointmentsArr = createArrayForDataTable(allAppointments.data, [
            'actions',
            'name',
            'vehicle',
            'vehicleProblem',
            'services',
            'requestDate',
           
            'requestStatus'
        ]);
        resolve(loadTable("#appointmentTable", allAppointmentsArr));
    });
}


const reloadServicesTable = async() => {
    return new Promise(async(resolve,reject)=>{
        const dataList = await getServices();
        const arr = createArrayForDataTable(dataList.data, [
            'actions',
            'imgPath',
            'serviceDesc',
            'price',
            'visible'
        ]);
        resolve(loadTable("#servicesTable", arr));
    });
}


const reloadPartsTable = async() => {
    return new Promise(async(resolve,reject)=>{
        const dataList = await getParts();
        const arr = createArrayForDataTable(dataList.data, [
            'actions',
            'imgPath',
            'itemDesc',
            'category',
            'price',
            'visible'
        ]);
        resolve(loadTable("#PartsTable", arr));
    });
}






const reloadOnServiceTable = async() => {
    return new Promise(async(resolve,reject)=>{
        const allOnService = await getOnServiceList();
        const allOnServiceArr = createArrayForDataTable(allOnService.data, [
            'actions',
            'name',
            'vehicle',
            'servicesAvail',
            'partsAvail',
            'dateStart',
            'dateEnded',
            'totalPrice',
            'serviceStatus',
            'paymentStatus'
        ]);
        resolve(loadTable("#onServicetTable", allOnServiceArr));
    });
}

const reloadOnServiceLogsTable = async() => {
    return new Promise(async(resolve,reject)=>{
        const allOnService = await getOnServiceLogs();
        const allOnServiceArr = createArrayForDataTable(allOnService.data, [
           
            'name',
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



const getServiceInformation = async (id)=>{
    return new Promise((resolve,reject)=>{
        $.get('/getServiceInformation',{id},function(res){
            resolve(res);
        })
    })
}

const getPartsInformation = async (id)=>{
    return new Promise((resolve,reject)=>{
        $.get('/getPartsInformation',{id},function(res){
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

const changeAppointmentStatus = async(serializeForm)=>{
    return new Promise((resolve,reject)=>{
        $.post('/changeAppointmentStatus',
        serializeForm,function(res){
            resolve(res);
        })
    })
}



const getApprovedAppointmentInfo=async(id)=>{
    return new Promise((resolve,reject)=>{
        $.get('/getApprovedAppointmentInfo',{id},function(res){
            resolve(res);
        })
    })
}


const setServiceSubmit=async (serializeForm)=>{
    return new Promise((resolve,reject)=>{
        $.post('/setServiceSubmit',
        serializeForm,function(res){
            resolve(res);
        })
    })
}


const getOnServiceList =async ()=>{
    return new Promise((resolve,reject)=>{
        $.get('/getOnServiceList',function(res){
            resolve(res);
        })
    })
}

const changeOnServiceStatus =async (id,status)=>{
    return new Promise((resolve,reject)=>{
        $.get('/changeOnServiceStatus',
        {id,status},function(res){
            resolve(res);
        })
    })
}


const getOnServiceInfo =async(id)=>{
    return new Promise((resolve,reject)=>{
        $.get('/getOnServiceInfo',
        {id},function(res){
            resolve(res);
        })
    })
}

const getOnServiceLogs = async()=>{
    return new Promise((resolve,reject)=>{
        $.get('/getOnServiceLogs',
        function(res){
            resolve(res);
        })
    })
}

const getServices=async()=>{
    return new Promise((resolve,reject)=>{
        $.get('/getServices',function(res){
            resolve(res);
        })
    })
}

const getParts=async()=>{
    return new Promise((resolve,reject)=>{
        $.get('/getParts',function(res){
            resolve(res);
        })
    })
}




const changeServicesStatus = async (id,status)=>{
    return new Promise((resolve,reject)=>{
        $.get('/changeServicesStatus',
        {id,status},function(res){
            resolve(res);
        })
    })
}

const changePartsStatus = async (id,status)=>{
    return new Promise((resolve,reject)=>{
        $.get('/changePartsStatus',
        {id,status},function(res){
            resolve(res);
        })
    })
}

// const editServiceInfo =async(serializeForm)=>{
//     return new Promise((resolve,reject)=>{
//         $.post('/editServiceInfo',
//         serializeForm,function(res){
//             resolve(res);
//         })
//     })
// }


// const editPartInfo =async(serializeForm)=>{
//     return new Promise((resolve,reject)=>{
//         $.post('/editPartInfo',
//         serializeForm,function(res){
//             resolve(res);
//         })
//     })
// }


const editServiceInfo = async(formData)=>{
    return new Promise((resolve,reject)=>{
        $.ajax({
            url: '/editServiceInfo',
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


const editPartInfo = async(formData)=>{
    return new Promise((resolve,reject)=>{
        $.ajax({
            url: '/editPartInfo',
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


const addParts = async(formData)=>{
    return new Promise((resolve,reject)=>{
        $.ajax({
            url: '/addParts',
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


const addServices = async(formData)=>{
    return new Promise((resolve,reject)=>{
        $.ajax({
            url: '/addServices',
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

const getSalesDWMY =async(date)=>{
    return new Promise((resolve,reject)=>{
        $.get('/getSalesDWMY',
        {date},function(res){
            resolve(res);
        })
    })
}