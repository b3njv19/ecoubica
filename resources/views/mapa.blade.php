@extends('layouts.app')
@push('stylesheet')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />
<style>
    #map {
        height: 400px;
    }
</style>

@endpush
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Mapa de focos</h1>
  <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group me-2">
        <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
        <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
      </div>
      <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1">
        <svg class="bi">
            <use xlink:href="#calendar3" />
        </svg>
        This week
      </button>
  </div>
</div>

<div class="container">

  <div class="row">


    <h2>Section title</h2>
    <div class="mt-3">
      <div id="map" class="shadow"></div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/heatmap.js/2.0.2/heatmap.min.js"></script>
<script>
  // Genera puntos aleatorios en la comuna de Maipú
  function generateRandomPoints() {
      var points = [];

      // Límites aproximados de la comuna de Maipú
      var minLat = -33.550;
      var maxLat = -33.460;
      var minLng = -70.830;
      var maxLng = -70.670;

      // Genera 100 puntos aleatorios
      for (var i = 0; i < 10000; i++) {
          var lat = Math.random() * (maxLat - minLat) + minLat;
          var lng = Math.random() * (maxLng - minLng) + minLng;
          points.push({ lat: lat, lng: lng });
      }

      return points;
  }

  // Crea el mapa centrado en Maipú
  var map = L.map('map').setView([-33.505, -70.765], 13);

  // Carga el mapa base
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
      maxZoom: 18,
  }).addTo(map);

  // Crea un objeto Heatmap.js
  var heatmap = new HeatmapOverlay({
      radius: 20,
      maxOpacity: 0.8,
      scaleRadius: true,
      latField: 'lat',
      lngField: 'lng',
      valueField: 1,
      gradient: {
          0.4: 'blue',
          0.6: 'lime',
          0.8: 'yellow',
          1.0: 'red'
      }
  });

  // Genera puntos aleatorios en Maipú
  var randomPoints = generateRandomPoints();

  // Agrega los puntos al mapa de calor
  heatmap.setData({ data: randomPoints });

  // Agrega el mapa de calor al mapa principal
  map.addLayer(heatmap);
</script>
@endsection
