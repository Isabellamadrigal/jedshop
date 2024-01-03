$(document).ready(async function(){
  let vehicleCount = await getAllClientVehicle();
  let availedCount = await getOnServiceLogs();

  $('#vehicle-count').text(vehicleCount.data.length);
  $('#service-count').text(availedCount.data.length);
  console.log(vehicleCount)
  const loadCarouselData=async()=>{
        let res = await getServicesList();
        console.log(res)
            for(var i = 0; i < res.length; i++){
              var isActive = i === 0 ? 'active' : '';
  
              $('#carouselInner').append(`
                <div class="carousel-item ${isActive}">
                  <img src="img/services/${res[i].imgPath}" class="d-block w-100 " alt="${res[i].serviceDesc} ">
                  <hr>
                  <div class="square bg-primary text-whitet text-center p-1 rounded">
                   <h6>${res[i].serviceDesc}</h6>
                   <hr>
                   <h6>${formatter.format(res[i].price)}</h6>
                   </div>
                   
                </div>
              `);
            }
    }
    
    await loadCarouselData();

    async function getNoticeRemarks(){
       let res = await getWaitingAppoinments();
       let html ="";

      for(let rows of res.data){
        html+=`
        <div class="card">
            <div class="card-body p-1  rounded">
               From: Admin -> ${rows.remarks}            
            </div>
        </div>
        `
      }
      console.log(html)
      $('.announcements').html(html);
        
    }
  await getNoticeRemarks()
})