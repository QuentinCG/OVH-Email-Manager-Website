if(!document.ids) {
document.ids = new Array();
}
function t(i) {
return (document.getElementById) ? ((document.getElementById(i)) ? document.getElementById(i) : false) : ((document.all[i]) ? document.all[i] : false);
}
function processbar(ix,speed,n) {
/* ix = (string) div id; speed = (float) number; n = (int) to clear interval */
if(t(ix) && t(ix).getElementsByTagName("div").length > 1) {
o = t(ix).getElementsByTagName("div");
for(var i=0;i<o.length;i++) {
if(o[i].className == "process" || o[i].className.indexOf("process") != -1) {
ogg = o[i];
} else if(o[i].className == "text" || o[i].className.indexOf("text") != -1) {
pre = o[i];
}
}
w = (ogg.style.width.length > 1) ? parseFloat(ogg.style.width.replace("%","")) : 0;
w += speed;
if(w < 0) {
w = 0;
if(n != undefined && typeof(n) != "undefined") {
window.clearInterval(document.ids[n]);
}
}
if(w > 100) {
w = 100;
if(n != undefined && typeof(n) != "undefined") {
window.clearInterval(document.ids[n]);
}
}
if(pre.getElementsByTagName("span").length == 1) {
//pre.getElementsByTagName("span")[0].innerHTML = parseInt(w).toString() + "%";
//start fix ie7 innerHTML bug:
pre.getElementsByTagName("span")[0].innerHTML = "";
div = document.createElement("font");
div.innerHTML = parseInt(w).toString() + "%";
pre.getElementsByTagName("span")[0].appendChild(div);
//end fix ie7 innerHTML bug
}
ogg.style.width = w + "%";
}
}
