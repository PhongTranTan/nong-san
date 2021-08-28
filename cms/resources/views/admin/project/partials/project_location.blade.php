<div class="pac-card" id="pac-card">
  <div>
    <div id="title">
      Project Location
    </div>
    <div id="type-selector" class="pac-controls">
      <input type="radio" id="changetype-address" checked="checked">
      <label for="changetype-address">Address</label>
    </div>
  </div>
  <div id="pac-container">
    <input id="pac-input" type="text" placeholder="Enter a location" name="location" value="{{ !empty($project->location)  ? $project->location : old('location') }}">
    <input type="hidden" name="lat" id="lat-location" value="{{ !empty($project->lat)  ? $project->lat : old('lat') }}">
    <input type="hidden" name="lng" id="lng-location" value="{{ !empty($project->lng)  ? $project->lng : old('lng') }}">
    <input type="hidden" name="map_shape" id="map-shape" value="{{ !empty($project->map_shape)  ? $project->map_shape : old('map_shape') }}">
  </div>
</div>
<button type="button" class="btn btn-danger" id="delete-all-button" style="margin: 20px 0">Delete Shapes</button>
<div id="map"></div>
<div id="infowindow-content">
  <img src="" width="16" height="16" id="place-icon">
  <span id="place-name"  class="title"></span><br>
  <span id="place-address"></span>
</div>

<style>
	#map {
  height: 60vh;
}
/* Optional: Makes the sample page fill the window. */
html, body {
  height: 100%;
  margin: 0;
  padding: 0;
}
#description {
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
}

#infowindow-content .title {
  font-weight: bold;
}

#infowindow-content {
  display: none;
}

#map #infowindow-content {
  display: inline;
}

.pac-card {
  margin: 10px 10px 0 0;
  border-radius: 2px 0 0 2px;
  box-sizing: border-box;
  -moz-box-sizing: border-box;
  outline: none;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
  background-color: #fff;
  font-family: Roboto;
}

#pac-container {
  padding-bottom: 12px;
  margin-right: 12px;
}

.pac-controls {
  display: inline-block;
  padding: 5px 11px;
}

.pac-controls label {
  font-family: Roboto;
  font-size: 13px;
  font-weight: 300;
}

#pac-input {
  background-color: #fff;
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
  margin-left: 12px;
  padding: 0 11px 0 13px;
  text-overflow: ellipsis;
  width: 400px;
}

#pac-input:focus {
  border-color: #4d90fe;
}

#title {
  color: #fff;
  background-color: #4d90fe;
  font-size: 25px;
  font-weight: 500;
  padding: 6px 12px;
}
</style>