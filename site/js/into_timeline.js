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

var tl;

/**
 * Requires the following variables:
 *  - componentPath
 *  - timeline object
 *  - settings object
 *  - interval_unit
 *  - brows (array of objects [id, interval_unit_name, interval_pixel])
 */
function intoOnLoad() {
    var jee = Timeline.GregorianDateLabeller.monthNames;
    Timeline.componentPath = componentPath;
    var eventSource = new Timeline.DefaultEventSource(0);

    if(timeline.scroll_start_date) {
        var startProj = Timeline.DateTime.parseIso8601DateTime(timeline.scroll_start_date);
    }

    if(timeline.scroll_end_date) {
        var endProj = Timeline.DateTime.parseIso8601DateTime(timeline.scroll_end_date);
    }

    eval('var theme = Timeline.' + timeline.theme + '.create();');
    theme.event.bubble.width = timeline.bubble_width;
    theme.event.bubble.height = timeline.bubble_height;
    theme.event.instant.icon = Timeline.componentPath + 'img/' + timeline.event_img;
    theme.event.instant.lineColor = timeline.event_line_color;
    theme.event.instant.impreciseColor = timeline.event_imprecise_color;
    theme.event.instant.impreciseOpacity = timeline.event_imprecise_opacity;
    theme.event.duration.color = timeline.event_duration_color;
    theme.event.duration.opacity = timeline.event_duration_opacity;
    theme.event.duration.impreciseColor = timeline.event_duration_imprecise_color;
    theme.event.duration.impreciseOpacity = timeline.event_duration_imprecise_opacity;

    if(settings.bubbletype) {
        Timeline.bubbletype = true;
    }

    if (settings.customJS) {
        eval(settings.customJS);
    }
    
    var d = Timeline.DateTime.parseGregorianDateTime(timeline.start_date);
    
    eval('var intervalUnit = Timeline.DateTime.' + interval_unit + ';');
    var bandSettings = {
        width:          timeline.width,
        intervalUnit:   intervalUnit,
        intervalPixels: timeline.interval_pixel,
        eventSource:    eventSource,
        date:           d,
        theme:          theme
    };
    
    if(brows.length > 0) {
        bandSettings.width = '70%';
    }
    
    var bandInfos = [Timeline.createBandInfo(bandSettings)];
    
    // Generate bands and push them to bandInfos array.
    for(var i = 0; i < brows.length; i++) {
        var brow = brows[i];
        
        var width = (30 / brows.length) + '%';
        eval('var browIntervalUnit = Timeline.DateTime.' + brow.interval_unit_name + ';');
        var bandInfo = Timeline.createBandInfo({
            width: width,
            intervalUnit: browIntervalUnit,
            intervalPixels: brow.interval_pixel
        });
        
        bandInfos.push(bandInfo);
        bandInfos[i+1].syncWith = 0;
        bandInfos[i+1].highlight = true;
    }

    eval('var direction = Timeline.' + timeline.direction + ';');
    tl = Timeline.create(document.getElementById(settings.container_id), bandInfos, direction);

    if (timeline.scroll_start_date !== 0) {
        tl.timeline_start = startProj;
    }

    if (timeline.scroll_end_date !== 0) {
        tl.timeline_stop = endProj;
    }

    tl.loadJSON('index.php?option=com_intotimeline&format=raw&task=jsontimeline&id=' + timeline.id, function(json, url) {
        eventSource.loadJSON(json, url);
    });
}
