/**
 * @module		Into Timeline
 * @copyright	Copyright (C) 2010 artetics.com
 * @copyright	Copyright (C) 2013 Miku Laitinen
 * @license	GPL
 */

var resizeTimerID = null;
function intoOnResize() {
    if (resizeTimerID == null) {
        resizeTimerID = window.setTimeout(function() {
            resizeTimerID = null;
            tl.layout();
        }, 500);
    }
} 

function into_timeline_init() {
    intoOnLoad();
    intoOnResize();
}

if(document.body){
    if(document.all){
        document.body.onload = into_timeline_init;
    } else {
        document.body.setAttribute("onload","into_timeline_init()");
    }
}