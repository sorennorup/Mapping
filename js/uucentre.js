     // Markerer med farve UU centres dækning af kommuner
     
     var url = "http://uudanmark.dk/kommuner-kml-files/";
      
 
   
             
    function getKommune(mapId,arr){
            var map = new google.maps.Map(document.getElementById(mapId));
            for(var i = 0; i<arr.length;i++){              
                var src = url + arr[i]
                
                loadKmlLayer(src,map);
            }
            
            }
 
    function loadKmlLayer(src, map) {
            var kmlLayer = new google.maps.KmlLayer(src, {
            suppressInfoWindows: false,
            preserveViewport: false,
            map: map
            });
            google.maps.event.addListener(kmlLayer, 'click', function(event) {
                        
            var content = event.featureData.infoWindowHtml;
            var testimonial = document.getElementById('capture');
            testimonial.innerHTML = content;
            });
            }
        
   