
var home_url = null; 
var dashDB = null;
var dashDB_Size =  (7 * 1024 * 1024); // 5 MB

var bMap = new Map();
var map, stateQuery,stateQueryTask,  zoneQuery,zoneQueryTask;


!function(){
	var web_db={};


	web_db.get_all_india_cp_data = function()
	{   
		debugger;
		try
	 	{
			$.ajax({
				url : home_url+'dashBoard/getBMapData',
				type : 'GET',
				contentType : 'application/json; charset=utf-8',
				dataType : 'json',
				data : {
					ID : 'IND',
				},
				success : function(dataD) 
				{
					localStorage.setItem("bmap_data", dojo.toJson(dataD));
					
					$.ajax({
						url : home_url+'dashBoard/getAllZone',
						type : 'GET',
						contentType : 'application/json; charset=utf-8',
						dataType : 'json',
						data : {
							ID : 'IND',
						},
						success : function(dataCP) 
						{
							localStorage.setItem("data_cp", dojo.toJson(dataCP));
							
							setTimeout(  function()
									{ 
										$( "a" ).removeClass( "noclick" );
										$( "#upload_text" ).show();
										$( "#upload_image" ).hide();
									
									} , 10);
						}
					});	
								
				}
			});
	 	    	
	 	}catch(err){alert(err);} 
	}	
	
	
 	
    /******
	require([
	 		"esri/map",
	 		"esri/tasks/query", 
	 		"esri/tasks/QueryTask",

	 		"dojo/domReady!" ],

	 			      
	 		function( Map,  Query, QueryTask  ) 
	   		{  
        	//stateQueryTask = new esri.tasks.QueryTask(stateArcUrl+"/0?Token="+stateArcKey, {outFields:["*"]});
        	stateQueryTask = new esri.tasks.QueryTask(stateArcUrl+"/0?Token="+stateArcKey);// 0->State 1->District
			stateQuery = new esri.tasks.Query();
			     	stateQuery.where = "1=1";
			     	stateQuery.returnGeometry = true;
			     	stateQuery.outFields = ["*"];
		    }
	);
	*/
	
	
	/**********************************************************/
	
	web_db.get_state_geometry = function(state_geometry_flag,  callback )
	{   
		if(state_geometry_flag)
		{
			stateQueryTask.execute(stateQuery, function(fset) 
			{   
				try
				{ 
					debugger;
					callback(0, 'all state geometry', dojo.toJson(fset.toJson())   );
	   
				}catch(err){alert(err);}
				
			});
		}
		else
		{
			callback(0, 'all state geometry',  localStorage.getItem("state_geometry")     ); 
            
		}
	}	
	
	/*******
	web_db.upload_geometry = function( )
	{
		var bool = false;
		dashDB = openDatabase('web_db', '1.0', 'Dash DB', dashDB_Size); 
		try
		{
			dashDB.transaction(function (tx) 
			{
				   tx.executeSql('CREATE TABLE IF NOT EXISTS DASH_GIS (id unique, geometry TEXT)'); 
				   tx.executeSql('DELETE FROM DASH_GIS');
	   
			});
			   
		}catch(err){alert(err);} 
		

		$.ajax({
			url : 'res/getWbDbData',
			type : 'GET',
			contentType : 'application/json; charset=utf-8',
			crossDomain:true,
			dataType : 'json', 

			data : 
			{
				selectedDate : Date.now()
			},
			success : function(dataD) 
			{
				if(dataD!=null)
				{   
					try
					{ 
						dashDB = openDatabase('web_db', '1.0', 'Dash DB', dashDB_Size); 
						dashDB.transaction(function (tx) 
						{
							var hData = dataD.all_india_cp;
							tx.executeSql('INSERT INTO DASH_GIS (id, geometry) VALUES (?,?)',[201,  dojo.toJson(dataD) ]);

							bool = true;
							   
						});
						
						
					}catch(err){alert(err);}
					
				}
			} 
		});	


		try
		{
			debugger;
			
			stateQueryTask.execute(stateQuery, function(fset) 
			{   
				try
				{ 

					dashDB = openDatabase('web_db', '1.0', 'Dash DB', dashDB_Size); 
					dashDB.transaction(function (tx) 
					{     
						   tx.executeSql('INSERT INTO DASH_GIS (id, geometry) VALUES (?,?)',[102, dojo.toJson(fset.toJson())]);
						   ******/
						       /*
						      var f_e_a_t_u_r_e = fset.toJson();
			                  for (var i = 0; i < f_e_a_t_u_r_e.features.length; i++) 
			                  {
			                        var feature = f_e_a_t_u_r_e.features[i].attributes;
			                        var stcode = new Number(feature.STCODE11);
			                        var stname = feature.STNAME;
			                        

			                        for(var t=5; t<f_e_a_t_u_r_e.features[i].geometry.rings[0].length-5; t++)
			                        {
			                            f_e_a_t_u_r_e.features[i].geometry.rings[0].splice(t, 1); 
			                        }
			                        for(var t=5; t<f_e_a_t_u_r_e.features[i].geometry.rings[0].length-5; t++)
			                        {
			                            f_e_a_t_u_r_e.features[i].geometry.rings[0].splice(t, 1); 
			                        }
			                        
			                  } */
			                 /******       
			                 setTimeout(function(){
								 if(bool)
								 { 
									 enableDashboard();
								 }
								 else
								 {
									 setTimeout(function(){
										 enableDashboard();
									 }, 1000); 
								 }
								 
							 }, 2000);
						   
					});
					
				}catch(err){alert(err);}
				
			}, showError );

		}catch(err){alert(err);}
	}*****/
	/*
	web_db.get_state_geometry_ = function(callback )
	{
		dashDB = openDatabase('web_db', '1.0', 'Dash DB', dashDB_Size); 
		dashDB.transaction(function (tx) 
		{ 
			try
			{
				tx.executeSql('SELECT * FROM DASH_GIS WHERE id=102', [], function (tx, results) 
				{ 
				      callback(results.rows.item(0).id, 'all state geometry', results.rows.item(0).geometry);
	
			    }, null); 
			}catch(err){alert(err);}
		});
	}	
	web_db.get_zone_geometry = function(callback )
	{
		dashDB = openDatabase('web_db', '1.0', 'Dash DB', dashDB_Size); 
		dashDB.transaction(function (tx) 
		{ 
			tx.executeSql('SELECT * FROM DASH_GIS WHERE id=101', [], function (tx, results) 
			{ 
			      results.rows.item(0).id;
			      
			      callback(results.rows.item(0).id, 'all zone geometry', results.rows.item(0).geometry);

		   }, null); 
		});
	}*/
	
	/**********************************************************/
	
	this.web_db = web_db;
}();


function showError(rr) {  
	  //remove all graphics on the maps graphics layer  
	  alert(rr);
}


/*
function loadJSON(callback) {   

    var xobj = new XMLHttpRequest();
        xobj.overrideMimeType("application/json");
    xobj.open('GET', 'resources/res/js/map.json', true); // Replace 'my_data' with the path to your file
    xobj.onreadystatechange = function () {
          if (xobj.readyState == 4 && xobj.status == "200") {
            // Required use of an anonymous callback as .open will NOT return a value but simply returns undefined in asynchronous mode
            callback(xobj.responseText);
          }
    };
    xobj.send(null);  
 }
 


function readTextFile(file, callback) {
    var rawFile = new XMLHttpRequest();
    rawFile.overrideMimeType("application/json");
    rawFile.open("GET", file, true);
    rawFile.onreadystatechange = function() {
        if (rawFile.readyState === 4 && rawFile.status == "200") {
            callback(rawFile.responseText);
        }
    }
    rawFile.send(null);
}

//usage:
readTextFile("/Users/Documents/workspace/test.json", function(text){
    var data = JSON.parse(text);
    console.log(data);
});

function exportToJsonFile(jsonData, fname_) {
    let dataStr = JSON.stringify(jsonData);
    let dataUri = 'data:application/json;charset=utf-8,'+ encodeURIComponent(dataStr);
    
    let exportFileDefaultName = fname_; // 'D:\\datadata.json';
    
    let linkElement = document.createElement('a');
    linkElement.setAttribute('href', dataUri);
    linkElement.setAttribute('download', exportFileDefaultName);
    linkElement.click();
}
*/
