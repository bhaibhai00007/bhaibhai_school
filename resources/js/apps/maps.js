!function (e) {
    var t = function () {
        return"undefined" == typeof google ? void setTimeout(function () {
            t()
        }, 100) : void o()
    }, o = function () {
        var e = {lat: -26.7409366, lng: -53.5360018}, t = {lat: -26.722412, lng: -53.5316793}, o = new google.maps.Map(document.getElementById("gmap"), {center: e, zoom: 5});
        new google.maps.Marker({position: t, map: o, title: "Hey there, I live here! :)"})
    }, i = function () {
        var e = "M9,0C4.029,0,0,4.029,0,9s4.029,9,9,9s9-4.029,9-9S13.971,0,9,0z M9,15.93 c-3.83,0-6.93-3.1-6.93-6.93S5.17,2.07,9,2.07s6.93,3.1,6.93,6.93S12.83,15.93,9,15.93 M12.5,9c0,1.933-1.567,3.5-3.5,3.5S5.5,10.933,5.5,9S7.067,5.5,9,5.5 S12.5,7.067,12.5,9z", t = "m2,106h28l24,30h72l-44,-133h35l80,132h98c21,0 21,34 0,34l-98,0 -80,134h-35l43,-133h-71l-24,30h-28l15,-47";
        AmCharts.makeChart("ammap", {type: "map", dataProvider: {map: "worldLow", zoomLevel: 3.5, zoomLongitude: -55, zoomLatitude: 42, lines: [{id: "line1", arc: -.85, alpha: .3, latitudes: [48.8567, 43.8163, 34.3, 23], longitudes: [2.351, -79.4287, -118.15, -82]}, {id: "line2", alpha: 0, color: "#000000", latitudes: [48.8567, 43.8163, 34.3, 23], longitudes: [2.351, -79.4287, -118.15, -82]}], images: [{svgPath: e, title: "Paris", latitude: 48.8567, longitude: 2.351}, {svgPath: e, title: "Toronto", latitude: 43.8163, longitude: -79.4287}, {svgPath: e, title: "Los Angeles", latitude: 34.3, longitude: -118.15}, {svgPath: e, title: "Havana", latitude: 23, longitude: -82}, {svgPath: t, positionOnLine: 0, color: "#000000", alpha: .1, animateAlongLine: !0, lineId: "line2", flipDirection: !0, loop: !0, scale: .03, positionScale: 1.3}, {svgPath: t, positionOnLine: 0, color: "#585869", animateAlongLine: !0, lineId: "line1", flipDirection: !0, loop: !0, scale: .03, positionScale: 1.8}]}, areasSettings: {unlistedAreasColor: "#8dd9ef"}, imagesSettings: {color: "#585869", rollOverColor: "#585869", selectedColor: "#585869", pauseDuration: .2, animationDuration: 2.5, adjustAnimationSpeed: !0}, linesSettings: {color: "#585869", alpha: .4}, "export": {enabled: !0}})
    };
    e(document).ready(function () {
        t(), i()
    })
}(jQuery);