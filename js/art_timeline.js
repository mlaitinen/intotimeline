var resizeTimerID = null;
function artOnResize() {
	if (resizeTimerID == null) {
		resizeTimerID = window.setTimeout(function() {
			resizeTimerID = null;
			tl.layout();
		}, 500);
	}
} 

function art_timeline_init() {
	artOnLoad();artOnResize();
}
if(document.body){
	if(document.all){
		document.body.onload = art_timeline_init;
	} else {
		document.body.setAttribute("onload","art_timeline_init()");
	}
}