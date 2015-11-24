    function padLeft(value) {
     if (value<10) value = "0"+value;
     return value; 
    }
    
    function ShowTime () {
    var today = new Date();    
    var day = padLeft(today.getDate());
    var month = padLeft(today.getMonth()+1);
    var year = today.getFullYear();
    var hour = padLeft(today.getHours());   
    var minute = padLeft(today.getMinutes());    
    var second = padLeft(today.getSeconds());    
    document.getElementById("timer").innerHTML = 
     day+"/"+month+"/"+year+" | "+hour+":"+minute+":"+second;
    setTimeout("ShowTime()",1000);
 }

