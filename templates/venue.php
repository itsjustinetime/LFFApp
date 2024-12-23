<div class="placesholder venueexpand {venue_type}" id="{venuetag}">
	<div class="placecontainer " id="{venuetag}">
		
		<img class="placeimage" imgsrc="{venueimagesmall}"></img>
		
        <div class="venuerec" style="display:{venuerecshow}"><i class="fa-regular fa-star"></i></a></div>
		<div class="placename white">{venuename}</div>	
	</div>

</div>
	<div class="venuemodal" id="fs{venuetag}">
		<div id="fsclose" onClick="destroyFullscreen()">
			<div class="closebutton"><i class="fa-regular fa-circle-xmark fa-2xl"></i></div>
			<div class="venueimage"><img class="fsvenueimage" imgsrc="{venueimage}"></img></div>
			<div class="venuecolltext">
				<div class="fsvenuetitle">{venuename}</div>
				<div class="fstit" style="display:{venuerecshow}"><i class="fa-regular fa-star"></i>LFF recommended</div>
					<div class="fsinfotext white">{venuedescription}</div> 
						{OFFER}
					<div class="venuesociallinks">
					<a class="slink" href="{venuefacebook}" name="vfb" style="display:none;" id="vfacebook{venuetag}"><i class="fa-brands fa-facebook"></i></a>
					<a class="slink" href="{venueinstagram}" name="vig" style="display:none;" id="vinstagram{venuetag}"><i class="fa-brands fa-instagram"></i></a>
					<a class="slink" href="{venuewebsite}" name="vweb" style="display:none;" id="vwebsite{venuetag}"><i class="fa-solid fa-link"></i></a>
					</div>

				
			</div>
		</div>
						<div class="mapbutton" id="map{venuetag}">
						<a class="mapbutton_a" onClick="mapTranslate(this.id)" id="maplink{venuetag}" href='https://maps.google.com/?q={venuecoords}'>
							<div class="fsaddress white">{venueaddress}<i class="fsdot fa-solid fa-location-dot white"></i></div>
						</a>
				</div>
	</div>
