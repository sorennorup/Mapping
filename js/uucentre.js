     // Markerer med farve UU centres dækning af kommuner
     
     var url = "http://uudanmark.dk/kommuner-kml-files/";
      
       function test(){
        alert("test")
        
       }
       
    function getAarhusSamsoe(mapId){
            var map = new google.maps.Map(document.getElementById(mapId));
            var src = url+"aarhus.kml";
            var src2 = url+'samsoe.kml';
            loadKmlLayer(src,map);
            loadKmlLayer(src2,map);
            }
 
    function getDenmark(mapId){
            var map = new google.maps.Map(document.getElementById(mapId));
            var src = 'url+kommunegraenser.kml';
            loadKmlLayer(src,map);
             }
             
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
            
   function kommuneDaekning(arr){
        
        this.url = "http://uudanmark.dk/kommuner-kml-files/";
         this.arr = arr;
         
         
         this.loadKmlLayer = function(src,map){
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
   
          //this.getKommune = function(mapId,this.arr){
                
                
                
                }    
        
   