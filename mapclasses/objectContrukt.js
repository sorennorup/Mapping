     
  //uucenter object
  //Creates an object of a Googlemap pin
  //and displayes the fieldvalues from a Podio app in a infowindow
   var size;
   var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
   var pinColor = "336699";
   var answerd = true;

  var geocoder = new google.maps.Geocoder();

function uuCenter(arr = [], keys = []){
   
     
   this.answer = arr[3];
   

   this.centerName = arr[0]; // must not be changed

   this.lat = arr[1]; // must not be changed

   this.lng = arr[2]; // must not be changed

   this.propArrCreate = // set the fieldlabels and the fieldvalues in a twodimensional array
function(){   
   
   var propArr = []
 for(var k = 0;k<arr.length-3;k++ ){
   propArr.push([keys[k+3],arr[k+3]])
}
    
   return propArr
}

this.space= // set the postion of the centeraddress
   function(){
   var pos=new google.maps.LatLng(this.lat,this.lng);
   
    return pos;
}
    
this.returnContent = // creates all the content to be displayed in the infoWindow
function(){
     
      var propertyArr = this.propArrCreate();  //get the twodimentional array created by the proparrCreate function  
    
      var str="<div style='width:300px;height:auto;font-family:calibri;z-index:-1; font-size: 16px;'>" //some style to display in the infowindow
      
       str+="<b>Centernavn: "+ this.centerName+"</b><br/>" // The first field will allways be centername 
         for(var j = 0; j< propertyArr.length;j++){
            str+= "<b>" +propertyArr[j][0]+":</b>  "+ propertyArr[j][1]+"<br/>" // inserts the keystring and the valuestring in the content
   }
            +"</div>";                  
     
      return(str)
      
    }
                    
this.marker=  // display the pin on the map og sets all the content in the infowindow
function(map){
         if (this.answer == "Ja") {
            pinColor = "477e07" 
    }
         else {
            pinColor = "930a0a"
    }  
    
    var pinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|"+pinColor);
    
    var mark = new google.maps.Marker({
        icon: pinImage,
        position:this.space(),
        url:this.url, 
    })
         
    mark.setAnimation();
        
      var infoW = new google.maps.InfoWindow({
         maxWidth:800,       
         content: this.returnContent()       
       
});
   var infoW2 = new google.maps.InfoWindow({
        maxWidth:500,
        content: " <div style='width:auto;height:auto;font-family:calibri;z-index:-1; font-size: 18px;'>"+ this.centerName+"<p><i>Klik på ikonet nedenfor</i></p></div>"
           
      });
        google.maps.event.addListener(mark, "click", function() {
            
        infoW.open(map,mark);
        infoW2.close();
                    
    });
      
          
    
       google.maps.event.addListener(mark, "mouseover", function(){
         
        infoW2.open(map,mark);
         
         });
       
       google.maps.event.addListener(mark, "mouseout", function(){
         
         infoW2.close();
         
         });
     
        
      
        google.maps.event.addListener(mark,"click",function(){
   
           //window.location.href=this.url;
         
        });
     
      
    return mark
}
 
    
    


}

function createCenterObject(){     
     
       var centerObject=new Array();
       
 for (var i=0;i<centerInfo.length;i++) {       
                    
          centerObject[i]= new uuCenter(
                 centerInfo[i],
                 keyStr                
                 );
          
          
           }
          
      return centerObject;
      
     }

 function initialize(zoom,place,mapId)
{
 
  var center=new google.maps.LatLng(56.266427,10.292759);
 
  var mapProp = {
     center:center,
     zoomControl:false,  
     scaleControl:false,
     scrollwheel:false,
     keyboardShortcuts:false,
     disableDefaultUI: false,
     zoom:zoom,

  };  
     var map=new google.maps.Map(document.getElementById(mapId),mapProp);

     var styles = [
  { "featureType": "administrative", "elementType": "labels", "stylers": [ { "visibility": "simple" },  { "color": "" } ] },
  { "featureType": "road", "elementType": "labels", "stylers": [ { "visibility": "on" } ] },
  { "featureType": "portrait", "stylers": [ { "color": "#fffff" },{ "hue": "#00aaff" },  ] },
          { "featureType": "road", "stylers": [ { "visibility": "off" } ] },
          { "featureType": "poi", "stylers": [ { "visibility": "off" } ] },
          { "featureType": "poi", "stylers": [ { "visibility": "off" } ] },
          {"featureType":"transit","stylers":[{"visibility":"off"}]},
          { "featureType": "water","stylers": [ { "visibility": "on" },{color:"#ffffff"}] },
            
           
];
     
    
//styling the map
map.setOptions({zoomControl:true, scrollwheel: false ,navigationControl: false,
    mapTypeControl: true,
    scaleControl: true,
    draggable: true,
    zooom:true,
    styles: styles
    
    }  
    );
     
 
  var obj = createCenterObject();
  
 for(var i=0;i<centerInfo.length;i++){
          obj[i].marker(map).setMap(map);
           
            }         
  
              center.marker.setMap(map);  
}


 
 
    