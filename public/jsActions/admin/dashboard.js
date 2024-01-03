$(document).ready(async function(){
    let chart =chartGraph('totalSales');
    let count = await getOnServiceLogs();
    let appointmentCount = await getWaitingAppoinments();
    $('#finished-task').text(count.data.length);
    $('#appointment-count').text(appointmentCount.data.length);
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

    


    const convertChartObjArray =async(date)=>{
        let res=await getSalesDWMY(date);
        let arrayOfObjects = [];

        for (let i =0;i<res.data.length;i++){
            arrayOfObjects.push({label:res.data[i].dateSale, value: res.data[i].totalSale});    
        }
        return arrayOfObjects;
    } 

    const initializeGraphChart=async(chart,date)=>{
        let parsedData = await convertChartObjArray(date);
        var labels = parsedData.map(function(item) {
           return item.label;
         });
         var values = parsedData.map(function(item) {
           return item.value;
         });
         chart.data.labels = labels;
         chart.data.datasets[0].data = values;
         chart.update();
    }

    
    initializeGraphChart(chart,'Yr:%Y-M:%m-D:%d');
    
    $('#chartTimelineSelect').change(async function(){
      
      let choice = $(this).val();
      if(choice=='day'){
          initializeGraphChart(chart,'Yr:%Y-M:%m-D:%d');
      }
      else if(choice=='week'){
          initializeGraphChart(chart,'Yr:%Y-W:%v');
      }
      else if(choice == 'month'){
          initializeGraphChart(chart,'Yr:%Y-M:%m');
      }
      else if(choice == 'year'){
          initializeGraphChart(chart,'Yr:%Y');
      }
    })
})