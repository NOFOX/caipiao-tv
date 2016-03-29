function makeRequest(url) {
http_request = false;
if (window.XMLHttpRequest) {
http_request = new XMLHttpRequest();
if (http_request.overrideMimeType){
http_request.overrideMimeType('text/xml');
} 
} else if (window.ActiveXObject) {
try{
http_request = new ActiveXObject("Msxml2.XMLHTTP"); 
} catch (e) {
try {
http_request = new ActiveXObject("Microsoft.XMLHTTP");
} catch (e) {
}
}
} 
if (!http_request) {
alert("您的浏览器不支持当前操作，请使用 IE 5.0 以上版本!");
return false;
}