function change_insert_mode() {
var val = document.getElementById('ishare-insert-mode').value;

if (val == 'shortcode') {
document.getElementById('ishare-auto-info').style.display = 'none';
document.getElementById('ishare-shortcode-info').style.display = 'block';
}
else {
document.getElementById('ishare-auto-info').style.display = 'block';
document.getElementById('ishare-shortcode-info').style.display = 'none';
}

}


var code='';

function getCode()
{
var frame = document.getElementById('ishare-frame');
frame.contentWindow.postMessage('getCode', '*');
}

function receiveMessage(event)
{
//  if (event.origin !== "http://share.itraffic.su" && event.origin !== "https://share.itraffic.su") return;
  document.getElementById('ishare-code').value = event.data;
  document.getElementById('ishare-form').submit();
}
window.addEventListener("message", receiveMessage, false);
