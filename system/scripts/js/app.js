var url = location.href;
var url_arr = url.split("/");
var BASE_PATH='http://'+location.hostname+"/"+url_arr[3]+"/";
var path = BASE_PATH;


if (window.XMLHttpRequest) {
       // code for IE7+, Firefox, Chrome, Opera, Safari
       var xmlhttp=new XMLHttpRequest();
        else { // code for IE6, IE5
       var xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}