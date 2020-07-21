    var name_1 ='All India Status (Category-wise)', name_2='', name_3='', name_4='';
    var home_path = '';
    var zone_id=0, zone_name='';
    var state_id=0, state_name='';
	var event_STEP = 0;
	var event_TYPE  = 0;
	var centerAt = [81.748, 23.500];

	
	var station_id_map  = new Array();
	var popup_header    = "Zone";
    
	var rMap = new Map();
	var bMap, stateLayer,stateQuery,stateQueryTask,  zoneLayer,zoneQuery,zoneQueryTask;
	var emptyLineRenderer;
	var mapLyears = new Map();
	var action_bool = true;
	

/********************************************************************/
/********************************************************************/
/************************ESRI-MAP************************************/
/********************************************************************/
/********************************************************************/

!function(){
	var gc_map_dashboard={};
	

	require([ "esri/map", "dojo/domReady!" ],

	 		function( esriMap ) 
	   		{
	 			esri.basemaps.EmtyBasemap = {
	 				      	baseMapLayers: [{url: "http://services.arcgisonline.com/ArcGIS/rest/services/Canvas/World_Light_Gray_Base/MapServer",opacity: 0.3}],
	 				      	title: "NIC Street"
	 				   };
	 	
	 	  		bMap = esri.Map("bmap", 
	 	  			   {
	 	  					basemap: esri.basemaps.EmtyBasemap,
	 	  					center: centerAt,
	 		        		zoom: 5, 
	 		        		logo: false,
	 						showAttribution:false, 
	 						slider: false,
	 						smartNavigation: false
	 	  			   });	
	 	
	 	  	  	
		        /*
		  		var layer = new ArcGISDynamicMapServiceLayer(stateArcUrl+"?Token="+stateArcKey);
		  		bMap.addLayer(layer);
		  		*/
		  		
		  	  	
	        	stateQueryTask 				= new esri.tasks.QueryTask(stateArcUrl+"/0?Token="+stateArcKey);// 0->State 1->District
				stateQuery 					= new esri.tasks.Query();
				stateQuery.where 			= "STCODE11 NOT IN ('')";
		     	stateQuery.returnGeometry 	= true;
		     	stateQuery.outFields 		= ["*"];
	 	  		emptyLineRenderer = esri.renderer.SimpleRenderer( esri.symbol.SimpleLineSymbol( esri.symbol.SimpleLineSymbol.STYLE_SOLID, esri.Color([160, 0, 0, 0]), 1 )); // RGB Opacity AND Line-Width
	 	  		bMap.infoWindow.resize(420,390);
	 	  		bMap.disableScrollWheel();
		  		bMap.on("load",function()
		  		{
		  			gc_map_dashboard.drawStateLyear();
		  		});
		  		
	});

	gc_map_dashboard.drawStateLyear = function(){
			
	    zone_id		= 0;  
	    zone_name	= '';
	    state_id	= 0; 
	    state_name	= '';
		event_STEP 	= 0;
		event_TYPE 	= 0;
		mapLyears 	= new Map();

		
		//var fset    =  dojo.fromJson( localStorage.getItem("state_geometry")  );
  		var dataD   =  dojo.fromJson( localStorage.getItem("bmap_data")  );
        rMap.set("zone_list", dataD.zoneList);
	            

		stateQueryTask.execute(stateQuery, function(fset) 
		{ 
			var jsnFset   =  fset;
					
			for (var i=0; i<jsnFset.features.length; i++ ) 
			{ 
		        var st_id =0, state_nm= '';
		        var z_id = 0, zone_nm = '';
		
				st_id = parseInt( jsnFset.features[i].attributes.stcode11 );
			    state_nm = jsnFset.features[i].attributes.stname;
			    
			    if(state_nm==null || ''+state_nm+'' == 'undefined')
			    {
			    	st_id = parseInt( jsnFset.features[i].attributes.STCODE11 );
			    	state_nm = jsnFset.features[i].attributes.STNAME;
			    }
			    
			    var dojoBorder = new dojo.Color([12, 12, 12]);   
		    	var dojoPlygon = new dojo.Color([196, 222, 233]); 
		    	
			    if( st_id<=9 || st_id==38)
			    {
			    	dojoPlygon = new dojo.Color([170, 183, 155]); // 100001-Northern
			    	z_id = 100001;
			    }
			    if( (st_id>=22 && st_id<=27) || st_id==30)
			    {
			    	dojoPlygon = new dojo.Color([255, 221, 174]); // 100002-Western
			    	z_id = 100002;
			    }
			    if( st_id==28 || st_id==29 || st_id==31 || st_id==32 || st_id==33 || st_id==34 || st_id==36 || st_id==37)
			    {
			    	dojoPlygon = new dojo.Color([248,245, 222]); // 100003-Southern
			    	z_id = 100003;
			    }			    
			    if( st_id==10 || st_id==11 || st_id==19 || st_id==20 || st_id==21 || st_id==35)
			    {
			    	dojoPlygon = new dojo.Color([142, 221, 217]); // 100004-Eastern
			    	z_id = 100004;
			    }
			    if( st_id>=12 && st_id<=18)
			    {
			    	dojoPlygon = new dojo.Color([255, 193, 183]); // 100005-North Eastern
			    	z_id = 100005;
			    }
			    
			    //-------------------get zone name
				var zone = rMap.get("zone_list");
				for(var ii=0;zone!=null && ii<zone.length;ii++)
				{
					if(zone[ii].zone_id == z_id)
					{
						zone_nm = zone[ii].zone_name; break;
					}
				}//-------------------------------



		    	var symbol = new esri.symbol.SimpleFillSymbol(
								esri.symbol.SimpleFillSymbol.STYLE_SOLID,  
								new esri.symbol.SimpleLineSymbol(esri.symbol.SimpleLineSymbol.STYLE_SOLID, dojoBorder, 1), 
								dojoPlygon);
		    	var gmtry = new esri.geometry.Polygon( jsnFset.features[i].geometry );
		    	var infoGraphic = new esri.Graphic( gmtry, symbol );
		    	infoGraphic.setAttributes( {"STEP": 1, "TYPE" : 'STATE_LYEAR', "zone_id":z_id, "zone_name": zone_nm, "state_id":st_id, "state_name":state_nm, "color_code":dojoPlygon});
				mapLyears.set(st_id, infoGraphic);
				bMap.graphics.add( infoGraphic  );

			    
 
				dojo.require("esri.symbols.TextSymbol");
		    	var font = new esri.symbol.Font(10, esri.symbol.Font.STYLE_NORMAL, esri.symbol.Font.VARIANT_NORMAL, "Arial");
	            var strLabel = state_nm.charAt(0).toUpperCase() + state_nm.slice(1).toLowerCase();//state_nm;//stateObj.state_name;//creates string label formatted
	            var textSymbol = new esri.symbol.TextSymbol(strLabel, font);//create symbol with attribute name 
	            textSymbol.setColor(new dojo.Color([11, 11 ,1]));//set the color
	            var centroid = gmtry.getCentroid();
	            var labelPointGraphic = new esri.Graphic(centroid, textSymbol); //create label graphic 
	            labelPointGraphic.setAttributes( {
	            	"STEP"		: 1, 
					"TYPE" 		: 'STATE_LYEAR_TEXT_MARKER', 
					"state_id"	: st_id, 
					"state_name": state_nm
            		});                  
	            bMap.graphics.add(labelPointGraphic);
	            mapLyears.set(st_id+'LBL', labelPointGraphic);
			}
	
			var zone = rMap.get("zone_list");
			for(var i=0;zone!=null && i<zone.length;i++)
			{
				   var myPosition = new esri.geometry.Point( 16, 72);
				   var url = home_path+"/gmap2/images/cir_07.png";
				   var infoSymbol = new esri.symbol.PictureMarkerSymbol( url, 14, 14);
                   
				   if(zone[i].lat!=null && zone[i].lng!=null)
				   {
					   myPosition = new esri.geometry.Point( zone[i].lng, zone[i].lat  );
				   }
				   else
				   {
					   myPosition = new esri.geometry.Point( 16, 72  );
				   }
				   var marker = new esri.Graphic( myPosition, infoSymbol );
				   marker.setAttributes( {
	            		"STEP"			: 1,   
	            		"TYPE"			: 'STATE_LYEAR_MARKER',  
	            		"zone_id" 		: zone[i].zone_id,
	            		"zone_name" 	: zone[i].zone_name
	            		
	            		});
				   mapLyears.set(zone[i].zone_id+'ZONE_MARKER', marker);
		           bMap.graphics.add(marker);
			}
			

			if(action_bool)
			{
				action_bool = false;
				gc_map_dashboard.onActionEventMap();
			}
			
			initialize();//Chart
			
		}, showError );
	}; //END
	
	
	gc_map_dashboard.onActionEventMap = function(){
        
		bMap.graphics.on("click", function(fs) 
		{ 
			var data_set = fs.graphic.attributes;
			bMap.infoWindow.hide();
			
			event_STEP = data_set.STEP;
			event_TYPE = data_set.TYPE;
			//alert(event_STEP);
			//alert("event_STEP----"+event_STEP+"-----event_TYPE"+event_TYPE);
			if( event_STEP == 1 && (event_TYPE == 'STATE_LYEAR' || event_TYPE=='STATE_LYEAR_TEXT_MARKER'))
			{
				gc_map_dashboard.setCenter();
				state_id   = data_set.state_id;
				state_name = data_set.state_name;
				
				zone_id   = data_set.zone_id;
				zone_name = data_set.zone_name;
				
				for(var ii=0; ii<bMap.graphics.graphics.length; ii++)
				{
					try
					{
					    if( bMap.graphics.graphics[ii].attributes.TYPE == 'STATE_LYEAR_MARKER' || bMap.graphics.graphics[ii].attributes.TYPE == 'STATION_LYEAR_MARKER' )
						{
							bMap.graphics.remove(   bMap.graphics.graphics[ii] );
							
							if(ii>0) ii = ii-1;
						}
					}catch(err) {}
				}
				/*
	        	mapLyears.forEach(function(infoGraphic, stateID, mapV) 
	        	{
	        		if(!(infoGraphic==null || infoGraphic=='undefined' || infoGraphic.attributes==null || infoGraphic.attributes=='undefined'))
	        		{
	        			if(infoGraphic.attributes.TYPE == 'STATE_LYEAR_MARKER' )
	        			{   
	        				bMap.graphics.remove(infoGraphic);
	        			}
	        			if(infoGraphic.attributes.TYPE == 'STATION_LYEAR_MARKER' )
	        			{
	        				bMap.graphics.remove(infoGraphic);
	        			}
	        		}    	    		
    	    	});*/
	        	 
				gc_map_dashboard.clearHighlightLine();
	        	gc_map_dashboard.addZoneHighlightLine(); 
	        	set_II_Lyears();
			}

			if( event_STEP == 2 && (event_TYPE == 'STATE_LYEAR' || event_TYPE=='STATE_LYEAR_TEXT_MARKER'))
			{
				gc_map_dashboard.setCenter();
				
				state_id   = data_set.state_id;
				state_name = data_set.state_name;
				zone_id   = data_set.zone_id;
				zone_name = data_set.zone_name;
               
				for(var ii=0; ii<bMap.graphics.graphics.length; ii++)
				{
					try
					{
					    if( bMap.graphics.graphics[ii].attributes.TYPE == 'STATE_LYEAR_MARKER' || bMap.graphics.graphics[ii].attributes.TYPE == 'STATION_LYEAR_MARKER' )
						{
							bMap.graphics.remove(   bMap.graphics.graphics[ii] );
							
							if(ii>0) ii = ii-1;
						}
					}catch(err) {}
				}
				/*
	        	mapLyears.forEach(function(infoGraphic, stateID, mapV) 
	        	{
	        		if(!(infoGraphic==null || infoGraphic=='undefined' || infoGraphic.attributes==null || infoGraphic.attributes=='undefined'))
	        		{
	        			if(infoGraphic.attributes.TYPE == 'STATE_LYEAR_MARKER' )
	        			{
	        				bMap.graphics.remove(infoGraphic);
	        			}
	        			if(infoGraphic.attributes.TYPE == 'STATION_LYEAR_MARKER' )
	        			{
	        				bMap.graphics.remove(infoGraphic);
	        			}
	        		}    	    		
    	    	});*/
	        	gc_map_dashboard.clearHighlightLine();
	        	gc_map_dashboard.addStateHighlightLine(); 
	        	set_III_Lyears();   	
			}
		});
		
		bMap.graphics.on("mouse-over", function(fs) 
		{ 
			var data_set = fs.graphic.attributes;
			event_STEP = data_set.STEP;
			event_TYPE = data_set.TYPE;
			
			if( event_STEP == 1 && event_TYPE == 'STATE_LYEAR_MARKER')
			{
				  var station = station_id_map[data_set.zone_id]; 
				
			 	  var data_1= [   [ '', (station.actual_generation==null) 				? 0.0 : parseFloat(parseFloat( station.actual_generation ).toFixed(2))  ],
			                    [ '', (station.actual_generation_cumulative==null) 		? 0.0 : parseFloat(parseFloat( station.actual_generation_cumulative ).toFixed(2))   ]
				      
				     	  	];
		  
			      var data_2 = [   [ '', (station.actual_generation_ly==null) 				? 0.0 : parseFloat(parseFloat( station.actual_generation_ly ).toFixed(2)) ],
					    		[ '', (station.actual_generation_cumulative_ly==null) 	? 0.0 : parseFloat(parseFloat( station.actual_generation_cumulative_ly ).toFixed(2)) ]
					      
					      	];


				  var data_3=  [  [ '',  null ],
			                	[ '',  parseFloat(  parseFloat( parseFloat(data_1[1][1]) - parseFloat(data_2[1][1]) ).toFixed(2)    )  ]
			      
			     	      	];
				
				  var contentString = '<div id="chart05" style="height:200px; width:400px;"></div>   '+ 
									  '</div>';
				  bMap.infoWindow.setTitle( '<table><tr><td class=\"datamw01\"> '+popup_header+' : '+station.zone_name+'</td><td class=\"datamw\"></td></tr>' );
				  
				  bMap.infoWindow.setContent( contentString );
				  bMap.infoWindow.show(fs.screenPoint,bMap.getInfoWindowAnchor(fs.screenPoint));	
				  
				  setTimeout( function() {
					   try
					   {
						   testChart(data_1, data_2, data_3, 'chart05');
					   }catch(err){}
					   
				  }, 100); 
			}	
			if( event_STEP == 2 && event_TYPE == 'STATE_LYEAR_MARKER')
			{
				  var station = station_id_map[data_set.state_id]; 
				
			 	  var data_1= [   [ '', (station.actual_generation==null) 				? 0.0 : parseFloat(parseFloat( station.actual_generation ).toFixed(2))  ],
			                    [ '', (station.actual_generation_cumulative==null) 		? 0.0 : parseFloat(parseFloat( station.actual_generation_cumulative ).toFixed(2))   ]
				      
				     	  	];
		  
			      var data_2 = [   [ '', (station.actual_generation_ly==null) 				? 0.0 : parseFloat(parseFloat( station.actual_generation_ly ).toFixed(2)) ],
					    		[ '', (station.actual_generation_cumulative_ly==null) 	? 0.0 : parseFloat(parseFloat( station.actual_generation_cumulative_ly ).toFixed(2)) ]
					      
					      	];


				  var data_3=  [  [ '',  null ],
			                	[ '',  parseFloat(  parseFloat( parseFloat(data_1[1][1]) - parseFloat(data_2[1][1]) ).toFixed(2)    )  ]
			      
			     	      	];
				
				  var contentString = '<div id="chart05" style="height:200px; width:400px;"></div>   '+ 
									  '</div>';
				  bMap.infoWindow.setTitle( '<table><tr><td class=\"datamw01\"> '+popup_header+' : '+station.state_name+'</td><td class=\"datamw\"></td></tr>' );
				  
				  bMap.infoWindow.setContent( contentString );
				  bMap.infoWindow.show(fs.screenPoint,bMap.getInfoWindowAnchor(fs.screenPoint));	
				  
				  setTimeout( function() {
					   try
					   {
						   testChart(data_1, data_2, data_3, 'chart05');
					   }catch(err){}
					   
				  }, 100); 
			}
			
			if( event_STEP == 3 && event_TYPE == 'STATION_LYEAR_MARKER')
			{
				  var station = station_id_map[data_set.station_id]; 
				
			 	  var data_1= [   [ '', (station.actual_generation==null) 				? 0.0 : parseFloat(parseFloat( station.actual_generation ).toFixed(2))  ],
			                    [ '', (station.actual_generation_cumulative==null) 		? 0.0 : parseFloat(parseFloat( station.actual_generation_cumulative ).toFixed(2))   ]
				      
				     	  	];
		  
			      var data_2 = [   [ '', (station.actual_generation_ly==null) 				? 0.0 : parseFloat(parseFloat( station.actual_generation_ly ).toFixed(2)) ],
					    		[ '', (station.actual_generation_cumulative_ly==null) 	? 0.0 : parseFloat(parseFloat( station.actual_generation_cumulative_ly ).toFixed(2)) ]
					      
					      	];


				  var data_3=  [  [ '',  null ],
			                	[ '',  parseFloat(  parseFloat( parseFloat(data_1[1][1]) - parseFloat(data_2[1][1]) ).toFixed(2)    )  ]
			      
			     	      	];
				
				  var contentString = '<div id="chart05" style="height:200px; width:400px;"></div>   '+ 
									  '</div>';
				  bMap.infoWindow.setTitle( '<table><tr><td class=\"datamw01\" nowrap> '+data_set.STATION_TYPE+' - '+popup_header+' : '+station.station_name+'</td><td class=\"datamw\"></td></tr>' );
				  
				  bMap.infoWindow.setContent( contentString );
				  bMap.infoWindow.show(fs.screenPoint,bMap.getInfoWindowAnchor(fs.screenPoint));	
				  
				  setTimeout( function() {
					   try
					   {
						   testChart(data_1, data_2, data_3, 'chart05');
					   }catch(err){}
					   
				  }, 100); 
			}	
		});

		bMap.infoWindow.on("hide", function(fs) 
		{   
		});
		
		
	}; //END of onActionEventMap
	
	

	gc_map_dashboard.addZoneStation = function(){
        
		
		
		var state = rMap.get("state_list");
		
		for(var i=0;state!=null && i<state.length;i++)
		{
			   var myPosition = new esri.geometry.Point( 16, 72);
			   var url = home_path+"/gmap2/images/cir_07.png";
			   var infoSymbol = new esri.symbol.PictureMarkerSymbol( url, 14, 14);
               
			   if(state[i].lat!=null && state[i].lng!=null)
			   {
				   myPosition = new esri.geometry.Point( state[i].lng, state[i].lat  );
			   }
			   else
			   {
				   myPosition = new esri.geometry.Point( 16, 72  );
			   }
			   var marker = new esri.Graphic( myPosition, infoSymbol );
			   marker.setAttributes( {
            		"STEP"			: 2,  
            		"TYPE"			: 'STATE_LYEAR_MARKER',  
            		
            		"zone_id" 		: zone_id,
            		"zone_name" 	: zone_name,
            		
            		"state_id" 		: state[i].state_id,
            		"state_name" 	: state[i].state_name
            		
            		});
			   mapLyears.set(state[i].state_id+'STATE', marker);
	           bMap.graphics.add(marker);
	            
	           /* var highlightPolyLine = new esri.Graphic(infoGraphic.geometry, highlightLine); 
	    		highlightPolyLine.setAttributes( {"STEP": 1, "TYPE" : 'HIGHLIGHT'});
	    		bMap.graphics.add(highlightPolyLine);
	    		
	    		mapLyears.set("HighlightPolyLine_"+infoGraphic.attributes.state_id, highlightPolyLine);*/
		}
		
		//gc_map_dashboard.clearHighlightLine();
    	//gc_map_dashboard.addZoneHighlightLine();
		
    	mapLyears.forEach(function(infoGraphic, stateID, mapV) 
    	{
    		if(!(infoGraphic==null || infoGraphic=='undefined' || infoGraphic.attributes==null || infoGraphic.attributes=='undefined'))
    		{
    			if(infoGraphic.attributes.TYPE == 'STATE_LYEAR')
    			{
    				if( infoGraphic.attributes.zone_id == zone_id )
    				{
    					infoGraphic.attributes.STEP = 2; //Modify
    				}
    				else
    				{
    					infoGraphic.attributes.STEP = 1; //Re-Set
    				}
    			}
    		}    	    		
    	});
	}; 

	gc_map_dashboard.addStateStation = function(){
        
		//set_III_Lyears();
       var station = rMap.get("station_list");
		
		for(var i=0;station!=null && i<station.length;i++)
		{
			   var myPosition = new esri.geometry.Point( 16, 72);
			   
			   
			   var station_type = '';
			   var url = home_path+"/gmap2/images/cir_07.png";
			   var infoSymbol = new esri.symbol.PictureMarkerSymbol( url, 14, 14);
			   
			   if( station[i].generating_type_id=='100001') // HYDRO
			   {
				   url = home_path+"/gmap2/images/cir_07.png";
				   infoSymbol = new esri.symbol.PictureMarkerSymbol( url, 12, 12);
				   station_type = 'HYDRO';
			   }
			   if( station[i].generating_type_id=='100002') // THERMAL
			   {
				   url = home_path+"/gmap2/images/cir_06.png";
				   infoSymbol = new esri.symbol.PictureMarkerSymbol( url, 14, 14);
				   station_type = 'THERMAL';
			   }
			   if( station[i].generating_type_id=='100003') // NUCLEAR
			   {
				   url = home_path+"/gmap2/images/cir_02.png";
				   infoSymbol = new esri.symbol.PictureMarkerSymbol( url, 14, 14);
				   station_type = 'NUCLEAR';
			   }
			   
			   
               
			   if(station[i].latitude!=null && station[i].longitude!=null)
			   {
				   myPosition = new esri.geometry.Point( station[i].longitude, station[i].latitude  );
			   }
			   else
			   {
				   myPosition = new esri.geometry.Point( 16, 72  );
			   }
			   var marker = new esri.Graphic( myPosition, infoSymbol );
			   marker.setAttributes( {
            		"STEP"			: 3,   //LYEAR
            		"TYPE"			: 'STATION_LYEAR_MARKER', 
            		
            		"STATION_TYPE"  : station_type,
			   
            		"zone_id" 		: zone_id,
            		"zone_name" 	: zone_name,
            		
            		"state_id" 		: state_id,
            		"state_name" 	: state_name,
            		
            		"station_id" 	: station[i].station_id,
            		"station_name" 	: station[i].station_name

            		});
			    mapLyears.set(station[i].station_id+'STATION', marker);
	            bMap.graphics.add(marker);
		}
    	
    	//gc_map_dashboard.clearHighlightLine();
    	//gc_map_dashboard.addStateHighlightLine();
		
    	mapLyears.forEach(function(infoGraphic, stateID, mapV) 
    	{
    		if(!(infoGraphic==null || infoGraphic=='undefined' || infoGraphic.attributes==null || infoGraphic.attributes=='undefined'))
    		{
    			if(infoGraphic.attributes.TYPE == 'STATE_LYEAR')
    			{
    				if( infoGraphic.attributes.zone_id == zone_id )
    				{
    					infoGraphic.attributes.STEP = 2; //Modify
    				}
    				else
    				{
    					infoGraphic.attributes.STEP = 1; //Re-Set
    				}
    			}
    		}    	    		
    	});
	}; 
	
	
	gc_map_dashboard.addZoneHighlightLine = function(){
        
    	mapLyears.forEach(function(infoGraphic, stateID, mapV) 
    	{
    		if(!(infoGraphic==null || infoGraphic=='undefined' || infoGraphic.attributes==null || infoGraphic.attributes=='undefined'))
    		{
    			    			
    			if(infoGraphic.attributes.TYPE == 'STATE_LYEAR' && infoGraphic.attributes.zone_id == zone_id)
    			{
    				//alert(infoGraphic.attributes.zone_id)   
    				var highlightColor = new dojo.Color([255, 0, 0]);
    					var highlightLine = new esri.symbol.SimpleLineSymbol(
    						esri.symbol.SimpleLineSymbol.STYLE_SOLID, 
    						highlightColor, 
    						1);
    					
			    		var highlightPolyLine = new esri.Graphic(infoGraphic.geometry, highlightLine); 
			    		highlightPolyLine.setAttributes( {"STEP": 1, "TYPE" : 'HIGHLIGHT'});
			    		bMap.graphics.add(highlightPolyLine);
			    		
			    		mapLyears.set("HighlightPolyLine_"+infoGraphic.attributes.state_id, highlightPolyLine);
    			}
    		}    	    		
    	});
	}; 
	
	gc_map_dashboard.addStateHighlightLine = function(){
        
    	mapLyears.forEach(function(infoGraphic, stateID, mapV) 
    	{
    		if(!(infoGraphic==null || infoGraphic=='undefined' || infoGraphic.attributes==null || infoGraphic.attributes=='undefined'))
    		{
    			if(infoGraphic.attributes.TYPE == 'STATE_LYEAR' && infoGraphic.attributes.state_id == state_id)
    			{
    				    var highlightColor = new dojo.Color([255, 0, 0]);
    					var highlightLine = new esri.symbol.SimpleLineSymbol(
    						esri.symbol.SimpleLineSymbol.STYLE_SOLID, 
    						highlightColor, 
    						1);
    					
			    		var highlightPolyLine = new esri.Graphic(infoGraphic.geometry, highlightLine); 
			    		highlightPolyLine.setAttributes( {"STEP": 1, "TYPE" : 'HIGHLIGHT'});
			    		bMap.graphics.add(highlightPolyLine);
			    		
			    		mapLyears.set("HighlightPolyLine_"+infoGraphic.attributes.state_id, highlightPolyLine);
    			}
    		}    	    		
    	});
	}; 
	
	gc_map_dashboard.clearHighlightLine = function(){

		mapLyears.forEach(function(infoGraphic, stateID, mapV) 
    	{
    		if(!(infoGraphic==null || infoGraphic=='undefined' || infoGraphic.attributes==null || infoGraphic.attributes=='undefined'))
    		{
    			if(infoGraphic.attributes.TYPE == 'HIGHLIGHT' )
    			{
    				bMap.graphics.remove(infoGraphic);
    			}
    		}    	    		
    	});
	}; 
	


	gc_map_dashboard.backToAllIndia = function()
	{
	    state_id=0; state_name='';
	    zone_id=0; zone_name='';
	    station_id=0; station_name='';
		event_STEP = 0;
		event_TYPE = 0;
		bMap.infoWindow.hide();
		gc_map_dashboard.setCenter();
		
		mapLyears.forEach(function(infoGraphic, stateID, mapV) 
		{
			if(!(infoGraphic==null || infoGraphic=='undefined' || infoGraphic.attributes==null || infoGraphic.attributes=='undefined'))
    		{
    			if(infoGraphic.attributes.TYPE == 'STATE_LYEAR_MARKER' )
    			{    
    				bMap.graphics.remove(infoGraphic);
    			}
    			if(infoGraphic.attributes.TYPE == 'STATION_LYEAR_MARKER' )
    			{    
    				bMap.graphics.remove(infoGraphic);
    			}
    			if( infoGraphic.attributes.STEP == 1 &&  infoGraphic.attributes.TYPE == 'STATE_LYEAR_MARKER'  )
    			{    
    				bMap.graphics.add(infoGraphic);
    			}
    			if(infoGraphic.attributes.TYPE == 'STATE_LYEAR')
    			{
    				infoGraphic.attributes.STEP = 1; //Re-Set
    			}
    		}   	    		
		});
    	
		gc_map_dashboard.clearHighlightLine();
    	initialize();
	}
	
	gc_map_dashboard.backToZone = function()
	{
		state_id=0; state_name='';
		mapLyears.forEach(function(infoGraphic, stateID, mapV) 
		{
			if(!(infoGraphic==null || infoGraphic=='undefined' || infoGraphic.attributes==null || infoGraphic.attributes=='undefined'))
    		{
    			if(infoGraphic.attributes.TYPE == 'STATION_LYEAR_MARKER' )
    			{    
    				bMap.graphics.remove(infoGraphic);
    			}
    			if(infoGraphic.attributes.TYPE == 'STATION_LYEAR_MARKER' )
    			{   
    				bMap.graphics.remove(infoGraphic);
    			}
    		}   	    		
		});
			
		gc_map_dashboard.clearHighlightLine();
    	gc_map_dashboard.addZoneHighlightLine();  
    	set_II_Lyears();
	}
	/*
	gc_map_dashboard.backToState = function(){
	    
		event_STEP = 1;
		event_TYPE = 'STATE_LYEAR';

		mapLyears.forEach(function(infoGraphic, stateID, mapV) 
	    {
			if(!(infoGraphic==null || infoGraphic=='undefined' || infoGraphic.attributes==null || infoGraphic.attributes=='undefined'))
    		{
    			if(infoGraphic.attributes.TYPE == 'ZONE' )
    			{   
    				bMap.graphics.remove(infoGraphic);
    			}
    			if(infoGraphic.attributes.TYPE == 'STATE' )
    			{   
    				bMap.graphics.remove(infoGraphic);
    			}
    			if(infoGraphic.attributes.TYPE == 'STATION' )
    			{   
    				bMap.graphics.remove(infoGraphic);
    			}
    		}   	    		
		});
		gc_map_dashboard.clearHighlightLine();
    	gc_map_dashboard.addStateHighlightLine(); 
    	set_III_Lyears();	
	}; */
	
	
	gc_map_dashboard.setCenter = function(){
		
		bMap.setZoom( 5 );
    	bMap.centerAt(new esri.geometry.Point( centerAt ));  
	};
	
	
	this.gc_map_dashboard = gc_map_dashboard;
}();






