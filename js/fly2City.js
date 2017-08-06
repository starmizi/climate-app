var iconStyle = new ol.style.Style({
  image: new ol.style.Icon(({
    anchor: [0.5, 46],
    anchorXUnits: 'fraction',
    anchorYUnits: 'pixels',
    src: 'img/marker_umbrella.png'
  }))
});
iconFeature.setStyle(iconStyle);
var vectorSource = new ol.source.Vector({
  features: [iconFeature]
});
var vectorLayer = new ol.layer.Vector({
  source: vectorSource
});
var osm = new ol.layer.Tile({
      preload: 4,
      source: new ol.source.OSM()
});
var view = new ol.View({
  center: cityLoc,
  zoom: 7
});
var map = new ol.Map({
  target: 'map',
  layers: [osm, vectorLayer],
  loadTilesWhileAnimating: true,
  view: view
});
function onClick(id, callback) {
  document.getElementById(id).addEventListener('click', callback);
}
function flyTo(location, done) {
  var duration = 2000;
  var zoom = view.getZoom();
  var parts = 2;
  var called = false;
  function callback(complete) {
    --parts;
    if (called) {
      return;
    }
    if (parts === 0 || !complete) {
      called = true;
      done(complete);
    }
  }
  view.animate({
    center: location,
    duration: duration
  }, callback);
  view.animate({
    zoom: zoom - 1,
    duration: duration / 2
  }, {
    zoom: zoom,
    duration: duration / 2
  }, callback);
}
onClick('cityName', function() {
  flyTo(cityLoc, function() {});
});