$(document).ready(async function(){
    initializeTable("#onServiceLogstTable", { 
       pageLength: 5,
       lengthMenu: [5, 10, 20],
       dom: 'Bfrtip',
       buttons: [
         'excelHtml5' // Enable Excel export button
       ]
   });
   await reloadOnServiceLogsTable();
})