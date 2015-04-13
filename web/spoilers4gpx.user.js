// ==UserScript==
// @name            Spoilers4gpx
// @namespace       http://www.geocaching.com
// @description     Retrieve spoilers for GPX files.
// @include         http://www.geocaching.com/geocache/*
// @include         http://www.geocaching.com/hide/report.aspx*
// @updateURL       http://spoilers4gpx.vaguelibre.net/spoilers4gpx.user.js
// @version         1.0.3
// ==/UserScript==

(function() {
    "use strict";

    function getURLParameter(name) {
        return decodeURI(
            (new RegExp(name + '=' + '(.+?)(&|$)').exec(location.search) || [, null])[1]
        );
    }

    var elm = document.getElementById('ctl00_ContentBody_GeoNav_adminTools');
    if (elm) {
        var newLink = document.createElement('a'),

            href = document.createAttribute('href');
        href.nodeValue = '#';
        newLink.setAttributeNode(href);

        var style = document.createAttribute('style');
        style.nodeValue = 'background-image: url("http://spoilers4gpx.vaguelibre.net/spoilers4gpx.png");';
        newLink.setAttributeNode(style);

        var newContent = document.createTextNode("Spoilers4Gpx");
        newLink.appendChild(newContent);

        var newAdminTool = document.createElement("li"),
            attr = document.createAttribute("id");
        attr.nodeValue = "Spoilers4Gpx";
        newAdminTool.setAttributeNode(attr);

        newAdminTool.appendChild(newLink);
        elm.appendChild(newAdminTool);

        document.getElementById("Spoilers4Gpx").addEventListener('click', function(e) {
            var findSpoilers = /<a href="(http:\/\/img(?:cdn)?\.geocaching\.com[^.]+\.(jpg|jpeg|png|gif))"[^>]+>([^<]+)<\/a>/g,
                item = '',
                list = '',
                edit_path = '',
                match;

            while (match = findSpoilers.exec(document.documentElement.innerHTML)) {
                item += '<!-- Spoiler4Gpx [' + match[3] + '](' + match[1] + ') -->' + "\n";
            }
            if (item === '') {
                alert('No spoilers found :-(');
                e.preventDefault();
                return false;
            }

            list = 'Here the code to copy paste at the end of the long description, don\'t forget to remove pictures in the list aren\'t a spoiler.' + "\n\n";
            list += '<!-- Spoiler4Gpx is a tool for include spoilers into GPX files. More info here : http://spoilers4gpx.vaguelibre.net -->' + "\n";
            list += item + "\n";
            list += 'Do you want to go to the edit page now?' + "\n";

            edit_path = 'http://www.geocaching.com' + elm.childNodes[3].childNodes[0].getAttribute("href") + '&s=spoilers4gpx#tbLongDesc';

            if (confirm(list)) {
                window.location = edit_path;
            }
            e.preventDefault();
            return false;
        });
    }

    if (window.location.pathname.substr(1) === 'hide/report.aspx' && getURLParameter('s') === 'spoilers4gpx') {
        var chkIsHtml = document.getElementById('chkIsHtml'),
            chkUnderstand = document.getElementById('ctl00_ContentBody_chkUnderstand'),
            chkDisclaimer = document.getElementById('ctl00_ContentBody_chkDisclaimer');

        if (chkIsHtml && !chkIsHtml.checked) {
            chkIsHtml.checked = true;
        }
        if (chkUnderstand && !chkUnderstand.checked) {
            chkUnderstand.checked = true;
        }
        if (chkDisclaimer && !chkDisclaimer.checked) {
            chkDisclaimer.checked = true;
        }
    }

}());