const dir = window.location.origin;
let formatter=new Intl.NumberFormat('en-US',{ style: 'currency' , currency:'php' }) 
const generateReferenceCode=(length)=>{
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    let result = '';
    for (let i = 0; i < length; i++) {
      const randomIndex = Math.floor(Math.random() * characters.length);
      result += characters.charAt(randomIndex);
    }
    return result;
}


const showNotification = (type, description, result) => {
Swal.fire({
    title: type,
    text: description,
    icon: result, // success, error, warning, info, question
    timer: 1000, // Set the timer to 2000 milliseconds (2 seconds)
    showConfirmButton: false // Hide the "OK" button
    });
}

const showNotificationRedirect = async(type, description, icon) => {
    return new Promise((resolve,reject)=>{
        Swal.fire({
            title: type,
            text: description,
            icon: icon, // success, error, warning, info, question
            timer: 2000, // Set the timer to 2000 milliseconds (2 seconds)
            showConfirmButton: false // Hide the "OK" button
            }).then((result)=>{
                resolve('success');
            })
    })
}

const alertDivs =(message,color)=>{
    var html="";
    return html=`<div class="text-center alert ${color}" role="alert">${message}</div>`
}

// const showNotificationWithConfirmation = (type, description, result) => {
//     Swal.fire({
//         title: type,
//         text: description,
//         icon: result, // success, error, warning, info, question // Set the timer to 2000 milliseconds (2 seconds)
//         showConfirmButton: true // Hide the "OK" button
//         });
// }

const validateAll = (...vals) =>{
    try{
        vals.forEach((val)=>{
            if(!$(val)[0].checkValidity()){
                throw new Error();
            }
        });
        return true;
    }
    catch(e){
        return false;
    }
}
const validateOne = (...vals) =>{
    vals.forEach((val)=>{
        if($(val)[0].checkValidity()){
            return true;
        }
    });
    return false;
}

const refreshList = (id, data, actualValue, displayValue, init) => {
    $(id).html("").append(init);
    data.forEach(val=>{
        $(id).append(`
            <option value='${val[displayValue]}' data-reg='${val[actualValue]}' >${val[displayValue]}</option>
        `);
    });
}

const initializeTable = (table, config) => {
    return($(table).DataTable(config));
}


const createArrayForDataTable = (data, fields) => {
    const arr = new Array;
    data.map(function(item) {
        const entry = new Array();
        fields.forEach((field)=>{
            entry.push(item[field]);
        });
        arr.push(entry);
    });
    return arr;
}

const selectTable = (table) => $(table).DataTable();

const loadTable = async (table, data) =>{
    return new Promise((resolve,reject)=>{
        const tbl = $(table).DataTable();
        tbl.clear();
        tbl.rows.add(data);
        tbl.draw();
        resolve(true);
    });
  }
  const appendTable = async (table, data) =>{
      return new Promise((resolve,reject)=>{
          const tbl = $(table).DataTable();
          tbl.rows.add(data);
          tbl.draw();
          resolve(true);
      });
    }
  const clearTable = async (table) =>{
      return new Promise((resolve,reject)=>{
          const tbl = $(table).DataTable();
          tbl.clear();
          tbl.draw();
          resolve(true);
      });
    }

const setLocalStorage = (variable, value) => {
    localStorage.setItem(variable, value);
};

const getLocalStorage = (variable) => {
    return(localStorage.getItem(variable));
}

const setSessionStorage = (variable, value) => {
    sessionStorage.setItem(variable, value);
};

const getSessionStorage = (variable) => {
    return(sessionStorage.getItem(variable));
}

const createProgressNotification = async (result, message) => {
    return new Promise((resolve,reject)=>{
        const notify = $.notify(`<i class="fa fa-bell"></i><strong>${result}</strong> ${message}`, {
            type: 'theme',
            allow_dismiss: false,
            progress:0
            // delay: 2000,
            // showProgressbar: true,
            // timer: 300
        });
        resolve(notify);
    });


    
}

const updateProgressNotification = (notify, counter, total) => {
    const progress = (counter/total)*100;

    notify.update('message', `<strong>Currently processing</strong> ${counter} of ${total}`);
    notify.update('type', 'primary');
    notify.update('progress', progress);

}

const refreshProgressBar = (count, total) => {
    const current = (count/total)*100;
    $("#progressStatus").html(`Processing ${count} of ${total}`);
    $("#uploadProgress").css("width", `${current}%`).prop("aria-valuenow", current);
}

const animateRandomNumbers = (id, targetNumber, decimalPlaces, duration) => {
    const interval = 10; // Update every 10 milliseconds for smooth animation
    const totalFrames = duration / interval;
    let currentFrame = 0;
  
    function getRandomNumber(min, max) {
      return Math.random() * (max - min) + min;
    }
  
    function updateNumber() {
      currentFrame++;
  
      if (currentFrame <= totalFrames) {
        const randomValue = getRandomNumber(0, targetNumber);
        $(id).html(randomValue.toFixed(decimalPlaces));
        setTimeout(updateNumber, interval);
      } else {
        $(id).html(targetNumber.toFixed(decimalPlaces));
      }
    }
  
    updateNumber();
  }

  const addFormattedNumbers = (numbers) => {
    let total = 0;

    for (const number of numbers) {
        if (typeof number === 'string') {
            // If the number is formatted (with commas), remove commas and convert to a number
            const unformattedNumber = parseFloat(number.replace(/,/g, ''));
            total += unformattedNumber;
        } else if (typeof number === 'number') {
            // If the number is already in numeric format, add it directly
            total += number;
        }
    }

    // Format the result with commas
    const formattedTotal = total.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');

    return formattedTotal;
}

function arrayContainsValue(array, key, value) {
    return array.some(item => item[key] === value);
}

const chartGraph = (elementTag) => {

    const data = {
        labels: [],
        datasets: [
          {
            label: 'AUTO CARE SALES',
            data: [],
            fill:true,
            backgroundColor: 'rgba(5,109,182, 0.2)', // Fill color
            borderColor: 'rgba(5,109,182, 1)', // Border color
            borderWidth: 2, // Border width
          },
        ],
      };
    
   
      const options = {
        scale: {
          ticks: { beginAtZero: true, max: 100 }, // Customize the scale
        },
      };
    
      const ctx = document.getElementById(elementTag).getContext('2d');
    
      return new Chart(ctx, {
        type: 'bar',
        data: data,
        options: options,
      });
}


