	
	<script type="text/javascript" charset="utf-8">
		 var map, places, iw;
	  var markers = [];
	  var autocomplete;
	  
	  function initialize() {
		var myLatlng = new google.maps.LatLng(<?php echo $point[0] ?>,<?php echo $point[1] ?>);
		var myOptions = {
		  zoom: 16,
		  center: myLatlng,
		  mapTypeId: google.maps.MapTypeId.ROADMAP
		}

		
		map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
		places = new google.maps.places.PlacesService(map);
		google.maps.event.addListener(map, 'tilesloaded', tilesLoaded);
		autocomplete = new google.maps.places.Autocomplete(document.getElementById('autocomplete'));
		google.maps.event.addListener(autocomplete, 'place_changed', function() {
		  showSelectedPlace();
		});
		new google.maps.Marker({
			position: myLatlng,
			map: map,
			title: '<?php echo $info->store_name ?>',
			animation: google.maps.Animation.DROP
		});
		// google.maps.event.addListener(markers[i], 'click', getDetails(results[i], i));
		
	  }
	  
	  function tilesLoaded() {
		
	  //  google.maps.event.clearListeners(map, 'tilesloaded');
	  //  google.maps.event.addListener(map, 'zoom_changed', search);
	  //  google.maps.event.addListener(map, 'dragend', search);
	  //  search();
	  }
	  
	  function showSelectedPlace() {
		clearResults();
		clearMarkers();
		var place = autocomplete.getPlace();
		map.panTo(place.geometry.location);
		markers[0] = new google.maps.Marker({
		  position: place.geometry.location,
		  map: map
		});
		  console.log(markers[0]);
		iw = new google.maps.InfoWindow({
		  content: getIWContent(place)
		});
		iw.open(map, markers[0]);
	  }
	  
	  function search() {
		var type;
		for (var i = 0; i < document.controls.type.length; i++) {
		  if (document.controls.type[i].checked) {
			type = document.controls.type[i].value;
			
		  }
		}
		
		autocomplete.setBounds(map.getBounds());
		
		var search = {
		  bounds: map.getBounds()
		};
		
		if (type != 'establishment') {
		  search.types = [ type ];
		}
		
		places.search(search, function(results, status) {
		  if (status == google.maps.places.PlacesServiceStatus.OK) {
			clearResults();
			clearMarkers();
		   for (var i = 0; i < results.length; i++) {
			  markers[i] = new google.maps.Marker({
				position: results[i].geometry.location,
				animation: google.maps.Animation.DROP
			  });
			  google.maps.event.addListener(markers[i], 'click', getDetails(results[i], i));
			  setTimeout(dropMarker(i), i * 100);
			  addResult(results[i], i);
			} 
		  }
		})
	  }
	  
	  function clearMarkers() {
		for (var i = 0; i < markers.length; i++) {
		  if (markers[i]) {
			markers[i].setMap(null);
			markers[i] == null;

		  }
		}
	  }
	  
	  function dropMarker(i) {
		return function() {
		  markers[i].setMap(map);
		}
	  }
	  
	  function addResult(result, i) {
		var results = document.getElementById("results");
		var tr = document.createElement('tr');
		tr.style.backgroundColor = (i% 2 == 0 ? '#F0F0F0' : '#FFFFFF');
		tr.onclick = function() {
		  google.maps.event.trigger(markers[i], 'click');
		};
		
		var iconTd = document.createElement('td');
		var nameTd = document.createElement('td');
		var icon = document.createElement('img');
		icon.src = result.icon;
		icon.setAttribute("class", "placeIcon");
		var name = document.createTextNode(result.name);
		iconTd.appendChild(icon);
		nameTd.appendChild(name);
		tr.appendChild(iconTd);
		tr.appendChild(nameTd);
		results.appendChild(tr);
	  }
	  
	  function clearResults() {
		var results = document.getElementById("results");
		while (results.childNodes[0]) {
		  results.removeChild(results.childNodes[0]);
		}
	  }
	  
	  function getDetails(result, i) {
		return function() {
		  places.getDetails({
			  reference: result.reference
		  }, showInfoWindow(i));
		}
	  }
	  
	  function showInfoWindow(i) {
		return function(place, status) {
		  if (iw) {
			iw.close();
			iw = null;
		  }
		  
		  if (status == google.maps.places.PlacesServiceStatus.OK) {
			iw = new google.maps.InfoWindow({
			  content: getIWContent(place)
			});
			iw.open(map, markers[i]);        
		  }
		}
	  }
	  
	  function getIWContent(place) {
	  
		var content = "";
		content += '<table><tr><td>';
		content += '<img class="placeIcon" src="' + place.icon + '"/></td>';
		content += '<td><b><a href="' + place.url + '">' + place.name + '</a></b>';
		content += '</td></tr></table>';
		return content;
	  }
	</script>
