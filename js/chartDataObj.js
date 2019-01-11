google.charts.load('current', {packages: ['corechart']});
google.charts.setOnLoadCallback(drawCh);



function drawCh(){
   var centerobj = [];
   var divs = 'chartdiv';
   var v = document.getElementById('chart_div');
     for(var i = 0 ; i < chartData.length; i++){
         var elm = divs+i;
         v.innerHTML += '<div id = "'+elm+'"></div>';
         centerobj[i] = new chartDataobj(chartData[i].title,chartData[i].count_array,elm);
         centerobj[i].drawCh();
            
        }
 
}

function chartDataobj(title, chrdata = [],chart_div){
    
    this.title = title;
    this.chrdata = chrdata;
    this.chart_div = chart_div;
    this.drawCh = function() {
     
     var data = new google.visualization.DataTable();
     data.addColumn('string', 'Choice');
     data.addColumn('number', 'Answers');
      
      // Instantiate and draw our chart, passing in some options.
     var tableData= [];
     var chart = new google.visualization.PieChart(document.getElementById(this.chart_div));
     var options = {'title':this.title,
                    'pieSliceText': 'percentage',
                    'width':800,
                    'height':550,
                    'is3D':false,
                     colors: ['#4f81bd', '#9bbb59', '#c0504d', '#f79646', '#d19392','#4198af'],
                     sliceVisibilityThreshold :0
                     
                     };
                   
     var ans = this.chrdata;
     //console.log(ans);
            for(var j = 0; j < ans.length; j++){
                var a = ans[j].answer_count.answer;
                var c = ans[j].answer_count.count;
                var prop = [a,c];
                tableData.push(prop);

            }
                data.addRows(tableData);
                chart.draw(data, options);  
                
    };
    
    
}