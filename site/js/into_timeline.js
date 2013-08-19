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

var initialized = false;
window.onload = into_timeline_init;
/*if(window.document.body !== null) {
 if(window.document.all){
 window.document.body.onload = into_timeline_init;
 } else {
 window.document.body.setAttribute("onload","into_timeline_init()");
 }
 } else {
 // IE crap fix
 window.document.onload = into_timeline_init;
 }*/

var tl;

/* For a given date, get the ISO week number
 *
 * Based on information at:
 *
 *    http://www.merlyn.demon.co.uk/weekcalc.htm#WNR
 *
 * Algorithm is to find nearest thursday, it's year
 * is the year of the week number. Then get weeks
 * between that date and the first day of that year.
 *
 * Note that dates in one year can be weeks of previous
 * or next year, overlap is up to 3 days.
 *
 * e.g. 2014/12/29 is Monday in week  1 of 2015
 *      2012/1/1   is Sunday in week 52 of 2011
 */
function getWeekNumber(d) {
    // Copy date so don't modify original
    d = new Date(d);
    d.setHours(0, 0, 0);
    // Set to nearest Thursday: current date + 4 - current day number
    // Make Sunday's day number 7
    d.setDate(d.getDate() + 4 - (d.getDay() || 7));
    // Get first day of year
    var yearStart = new Date(d.getFullYear(), 0, 1);
    // Calculate full weeks to nearest Thursday
    var weekNo = Math.ceil((((d - yearStart) / 86400000) + 1) / 7)
    // Return week number
    return weekNo;
}

/**
 * Requires the following variables:
 *  - componentPath
 *  - timeline object
 *  - settings object
 *  - interval_unit
 *  - brows (array of objects [id, interval_unit_name, interval_pixel])
 */
function intoOnLoad() {


    // Change the date format of week interval in the band.
    // TODO: Make the date format configurable.
    Timeline.GregorianDateLabeller.prototype.labelInterval = function(A, C) {
        var B = Timeline.GregorianDateLabeller.labelIntervalFunctions[this._locale];
        if (!B) {
            B = Timeline.GregorianDateLabeller.prototype.defaultLabelInterval;
        }
        var dateObj = B.call(this, A, C);

        if(C === Timeline.DateTime.WEEK) {
            // Add week number
            var week = getWeekNumber(A);
            var weekCaption = Timeline.GregorianDateLabeller
                    .getIntervalName(Timeline.DateTime.WEEK, this._locale);
            dateObj.text = dateObj.text + "<br />" + weekCaption + " "+week;
        }
        
        return dateObj;
    };

    // Change the date format in bubble.
    // TODO: Make the date format configurable.
    Timeline.GregorianDateLabeller.prototype.labelPrecise = function(date) {
        date = SimileAjax.DateTime.removeTimeZoneOffset(date, this._timeZone);
        return date.toLocaleDateString(); // + ' ' + date.toLocaleTimeString();
    };

    Timeline.componentPath = componentPath;
    var eventSource = new Timeline.DefaultEventSource(0);

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
    theme.firstDayOfWeek = 1; // Yes, it's hard-coded to monday.

    if (settings.bubbletype) {
        Timeline.bubbletype = true;
    }

    if (settings.customJS) {
        eval(settings.customJS);
    }

    eval('var intervalUnit = Timeline.DateTime.' + interval_unit + ';');
    var bandSettings = {
        width: timeline.width,
        intervalUnit: intervalUnit,
        intervalPixels: timeline.interval_pixel,
        eventSource: eventSource,
        theme: theme
    };

    if (timeline.start_date) {
        bandSettings.date = Timeline.DateTime.parseGregorianDateTime(timeline.start_date);
    }

    if (brows.length > 0) {
        bandSettings.width = '80%';
    }

    var bandInfos = [Timeline.createBandInfo(bandSettings)];

    // Generate bands and push them to bandInfos array.
    for (var i = 0; i < brows.length; i++) {
        var brow = brows[i];

        var width = (20 / brows.length) + '%';
        eval('var browIntervalUnit = Timeline.DateTime.' + brow.interval_unit_name + ';');
        var bandInfo = Timeline.createBandInfo({
            width: width,
            intervalUnit: browIntervalUnit,
            intervalPixels: brow.interval_pixel,
            eventSource: eventSource,
            overview: true
        });

        bandInfos.push(bandInfo);
        bandInfos[i + 1].syncWith = 0;
        bandInfos[i + 1].highlight = true;
    }

    eval('var direction = Timeline.' + timeline.direction + ';');
    tl = Timeline.create(document.getElementById(settings.container_id), bandInfos, direction);

    if (timeline.scroll_start_date) {
        tl.timeline_start = Timeline.DateTime.parseIso8601DateTime(timeline.scroll_start_date);
    }

    if (timeline.scroll_end_date) {
        tl.timeline_stop = Timeline.DateTime.parseIso8601DateTime(timeline.scroll_end_date);
    }

    tl.loadJSON('index.php?option=com_intotimeline&format=raw&task=jsontimeline&id=' + timeline.id, function(json, url) {
        eventSource.loadJSON(json, url);
    });
}
