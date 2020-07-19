
    var name_1 ='All India Status (Category-wise)', name_2='', name_3='', name_4='';
    var home_path = '';
    var zone_id=0, zone_name='';
    var state_id=0, state_name='';
	var event_STEP = 0;
	var event_TYPE  = 0;
    
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
	var cp_map_dashboard={};
	

	require([ "esri/map", "esri/layers/ArcGISDynamicMapServiceLayer", "dojo/domReady!" ],

		function( esriMap, ArcGISDynamicMapServiceLayer ) 
  		{
		    initialize();//Chart
			esri.basemaps.EmtyBasemap = {
				      	baseMapLayers: [{url: "http://services.arcgisonline.com/ArcGIS/rest/services/Canvas/World_Light_Gray_Base/MapServer",opacity: 0.5}],
				      	title: "NIC Street"
				   };
	
	  		bMap = new esriMap("bmap", 
	  			   {
	  					basemap: "EmtyBasemap",
	  					center: [81.748, 23.500],
		        		zoom: 5, 
		        		logo: false,
						showAttribution:false, 
						slider: true,
						smartNavigation: true
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
	  		bMap.infoWindow.resize(250,170);
	  		bMap.disableScrollWheel();
	  		bMap.on("load",function(){
	  			cp_map_dashboard.drawStateLyear();
	  		});
	  		
  		});

	
	
	cp_map_dashboard.drawStateLyear = function(){
	  			
	  		action_bool = true;
		    zone_id		= 0;  
		    zone_name	= '';
		    state_id	= 0; 
		    state_name	= '';
			event_STEP 	= 0;
			event_TYPE 	= 0;
			mapLyears	= new Map();
			
			var dojoBorder = new dojo.Color([12, 12, 12]);   
	    	var dojoPlygon = new dojo.Color([196, 222, 233]); 
	

			debugger;
			//var fset    =  dojo.fromJson( localStorage.getItem("state_geometry")  );
		    var dataD   =  dojo.fromJson( localStorage.getItem("bmap_data")  );
            rMap.set("station_details", dataD.station_details);

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
					var stn = rMap.get("station_details");
					for(var ii=0;stn!=null && ii<stn.length;ii++)
					{
						if(stn[ii].zone_id == z_id)
						{
							zone_nm = stn[ii].zone_name; break;
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
		            var strLabel = state_nm.charAt(0).toUpperCase() + state_nm.slice(1).toLowerCase();
		            var textSymbol = new esri.symbol.TextSymbol(strLabel, font); 
		            textSymbol.setColor(new dojo.Color([11, 11 ,1]));
		            var centroid = gmtry.getCentroid();
		            var labelPointGraphic = new esri.Graphic(centroid, textSymbol); 
		            labelPointGraphic.setAttributes( {
		            	"STEP"		: 1, 
						"TYPE" 		: 'STATE_LYEAR_TEXT_MARKER', 
						"zone_id"   : z_id, 
						"zone_name" : zone_nm,
						"state_id"	: st_id, 
						"state_name": state_nm
	            		});          
		            bMap.graphics.add(labelPointGraphic);
		            mapLyears.set(st_id+'LBL', labelPointGraphic);
			    }
				
				
				debugger;
				var stn = rMap.get("station_details");
				for(var i=0;  stn!=null && i<stn.length;i++)
				{
					   var myPosition = new esri.geometry.Point( 16, 72);
					   var url = home_path+"/gmap2/images/cir_01.png";
					   var infoSymbol = new esri.symbol.PictureMarkerSymbol( url, 18, 18);
	  
					   if(stn[i].latitude!=null && stn[i].longitude!=null)
					   {
						   myPosition = new esri.geometry.Point( stn[i].longitude, stn[i].latitude  );
					   }
					   else
					   {
						   myPosition = new esri.geometry.Point( 16, 72  );
					   }

					   
					   if( stn[i].generating_type_id=='100001') // HYDRO
					   {
						   url = home_path+"/gmap2/images/cir_07.png";
						   infoSymbol = new esri.symbol.PictureMarkerSymbol( url, 12, 12);
					   }
					   if( stn[i].generating_type_id=='100002') // THERMAL
					   {
						   url = home_path+"/gmap2/images/cir_06.png";
						   infoSymbol = new esri.symbol.PictureMarkerSymbol( url, 14, 14);
					   }
					   if( stn[i].generating_type_id=='100003') // NUCLEAR
					   {
						   url = home_path+"/gmap2/images/cir_02.png";
						   infoSymbol = new esri.symbol.PictureMarkerSymbol( url, 14, 14);
					   }

			            
			            
			           var marker = new esri.Graphic( myPosition, infoSymbol );
			           
			           marker.setAttributes( {
			            		"STEP"			: 1,   //LYEAR
			            		"TYPE"			: 'STATION_MARKER', // STATION 
			            		
			            		"zone_id" 		: stn[i].zone_id,
			            		"zone_name" 	: stn[i].zone_name,
			            		
			            		"sector_name" 	: stn[i].sector_name,
			            		"sector_name" 	: stn[i].sector_name,
			            		
			            		"state_id"		: stn[i].state_id, 
			            		"state_name"	: stn[i].state_name, 
			            		
			            		"generating_type_name"		: stn[i].generating_type_name, 
			            		"generating_type_id"		: stn[i].generating_type_id, 
			            		"org_short_name"			: stn[i].org_short_name, 
			            		"unit_installed_capacity"	: stn[i].unit_installed_capacity,
			            		"unit_monitered_capacity"	: stn[i].unit_monitered_capacity, 
			            		 
			            		"station_id" 		: stn[i].station_id,
			            		"station_name" 		: stn[i].station_name
			            		});

			           mapLyears.set(stn[i].station_id+'STN', marker);
			           bMap.graphics.add(marker);	   
			    }
				
				if(action_bool)
				{
					action_bool = false;
					cp_map_dashboard.onActionEventMap();
				}
				
				

			}, showError );
    
	} //END


	

    


	cp_map_dashboard.onActionEventMap = function(){
        
		bMap.graphics.on("click", function(fs) 
		{ 
			var data_set = fs.graphic.attributes;

			if( bMap.infoWindow.isShowing )
			{bMap.infoWindow.hide();}
			
			event_STEP = data_set.STEP;
			event_TYPE = data_set.TYPE;
			
			if( event_STEP == 1 && (event_TYPE == 'STATE_LYEAR' || event_TYPE == 'STATION_MARKER' || event_TYPE == 'STATE_LYEAR_TEXT_MARKER') )
			{
				zone_id   = data_set.zone_id;
				zone_name = data_set.zone_name;
	        	mapLyears.forEach(function(infoGraphic, stateID, mapV) 
	        	{
	        		if(!(infoGraphic==null || infoGraphic=='undefined' || infoGraphic.attributes==null || infoGraphic.attributes=='undefined'))
	        		{
	        			if(infoGraphic.attributes.TYPE == 'STATION_MARKER' )
	        			{
	        				bMap.graphics.remove(infoGraphic);
	        			}
	        		}    	    		
    	    	});
	        	cp_map_dashboard.clearHighlightLine();
	        	cp_map_dashboard.addZoneHighlightLine();   
	        	cp_map_dashboard.addZoneStation();
			}
			if( event_STEP == 2 && (event_TYPE == 'STATE_LYEAR' || event_TYPE == 'STATION_MARKER' || event_TYPE == 'STATE_LYEAR_TEXT_MARKER') )
			{
				state_id   = data_set.state_id;
				state_name = data_set.state_name;

	        	mapLyears.forEach(function(infoGraphic, stateID, mapV) 
	        	{
	        		if(!(infoGraphic==null || infoGraphic=='undefined' || infoGraphic.attributes==null || infoGraphic.attributes=='undefined'))
	        		{
	        			if(infoGraphic.attributes.TYPE == 'STATION_MARKER' )
	        			{
	        				bMap.graphics.remove(infoGraphic);
	        			}
	        		}    	    		
    	    	});
	        	cp_map_dashboard.clearHighlightLine();
	        	cp_map_dashboard.addStateHighlightLine(); 
	        	cp_map_dashboard.addStateStation();     	
			}
		});
		
		bMap.graphics.on("mouse-over", function(fs) 
		{ 
			var data_set = fs.graphic.attributes;
			event_STEP = data_set.STEP;
			event_TYPE = data_set.TYPE;
			
			if(  event_TYPE == 'STATION_MARKER')
			{
		    	var info_panel_text = " class=\"info-panel-text-H\" ";
 
				var infow_wind = 
					'<table>'+
					'<tr><td class=\"info-panel-text-b  data03\" colspan=4>Installed Capacity :'+parseFloat( data_set.unit_installed_capacity ).toFixed(2)+' MW</td></tr>'+
					'<tr><td class=\"info-panel-text\">Generating Type </td><td>:</td><td '+info_panel_text+'>'+ data_set.generating_type_name+'</td> <td></td> </tr>'+
					'<tr><td class=\"info-panel-text\">Zone            </td><td>:</td><td '+info_panel_text+'>'+ data_set.zone_name+'</td> <td></td> </tr>'+
					'<tr><td class=\"info-panel-text\">State		   </td><td>:</td><td '+info_panel_text+'>'+ data_set.state_name+'</td> <td></td> </tr>'+
					'<tr><td class=\"info-panel-text\">Sector 	       </td><td>:</td><td '+info_panel_text+'>'+ data_set.sector_name+'</td> <td></td> </tr>'+
					'<tr><td class=\"info-panel-text\">Organization    </td><td>:</td><td '+info_panel_text+'>'+ data_set.org_short_name+'</td> <td></td> </tr>'+
					'</table>'
					; 
	
				var cont =  
					'<div id="tabs">'+
					  '<div id=\"allindiacp\"  style=\"height:150px; padding: 1px 0px;\">  '+infow_wind+'  </div>'+
					'</div>';
			  	
		      	 bMap.infoWindow.setContent( cont );
		         bMap.infoWindow.setTitle( '<table><tr><td class=\"datamw01\"> '+data_set.station_name+'</td><td class=\"datamw\"></td></tr>' );
		          
		      	 //var dnd = new dojo.dnd.Moveable(bMap.infoWindow.domNode, { }); //Move to InfoWindow (Drag-n-Drop) 

		         bMap.infoWindow.show(fs.screenPoint,bMap.getInfoWindowAnchor(fs.screenPoint));	
			}	
		});
		bMap.graphics.on("mouse-out", function(fs) 
		{ 
			if( bMap.infoWindow.isShowing )
			{bMap.infoWindow.hide();}
		});
		bMap.infoWindow.on("hide", function(fs) 
		{   
		});
		
		
	}; //END of onActionEventMap
	
	
	cp_map_dashboard.addAllStation = function(){
        

		cp_map_dashboard.clearHighlightLine();
		
		mapLyears.forEach(function(infoGraphic, stateID, mapV) 
    	{
    		if(!(infoGraphic==null || infoGraphic=='undefined' || infoGraphic.attributes==null || infoGraphic.attributes=='undefined'))
    		{
    			if(infoGraphic.attributes.TYPE == 'STATION_MARKER' )
    			{
    				bMap.graphics.remove(infoGraphic);
    			}
    		}    	    		
    	});
    	
    	mapLyears.forEach(function(infoGraphic, stateID, mapV) 
    	{
    		if(!(infoGraphic==null || infoGraphic=='undefined' || infoGraphic.attributes==null || infoGraphic.attributes=='undefined'))
    		{
    			if(infoGraphic.attributes.TYPE == 'STATION_MARKER')
    			{
    				bMap.graphics.add(infoGraphic);
    			}
    			
    			if( event_TYPE == 'STATE_LYEAR' || event_TYPE == 'STATION_MARKER' || event_TYPE == 'STATE_LYEAR_TEXT_MARKER'  )
    			{
    				infoGraphic.attributes.STEP = 1; //Re-Set
    			}
    		}    	    		
    	});
	}; 

	
	cp_map_dashboard.addZoneStation = function(){
        
		set_II_Lyears();
		
    	mapLyears.forEach(function(infoGraphic, stateID, mapV) 
    	{
    		if(!(infoGraphic==null || infoGraphic=='undefined' || infoGraphic.attributes==null || infoGraphic.attributes=='undefined'))
    		{
    			if(infoGraphic.attributes.TYPE == 'STATION_MARKER' && infoGraphic.attributes.zone_id == zone_id)
    			{
    				bMap.graphics.add(infoGraphic);
    			}
    			
    			//if(infoGraphic.attributes.TYPE == 'STATE_LYEAR')
    			if( event_STEP == 1 && (event_TYPE == 'STATE_LYEAR' || event_TYPE == 'STATION_MARKER' || event_TYPE == 'STATE_LYEAR_TEXT_MARKER') )
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

	cp_map_dashboard.addStateStation = function(){
        
		set_III_Lyears();
		
    	mapLyears.forEach(function(infoGraphic, stateID, mapV) 
    	{
    		if(!(infoGraphic==null || infoGraphic=='undefined' || infoGraphic.attributes==null || infoGraphic.attributes=='undefined'))
    		{
    			if(infoGraphic.attributes.TYPE == 'STATION_MARKER' && infoGraphic.attributes.state_id == state_id)
    			{
    				bMap.graphics.add(infoGraphic);
    			}
    		}    	    		
    	});
	}; 
	
	
	cp_map_dashboard.addZoneHighlightLine = function(){
        
    	mapLyears.forEach(function(infoGraphic, stateID, mapV) 
    	{
    		if(!(infoGraphic==null || infoGraphic=='undefined' || infoGraphic.attributes==null || infoGraphic.attributes=='undefined'))
    		{
    			if(infoGraphic.attributes.TYPE == 'STATE_LYEAR' && infoGraphic.attributes.zone_id == zone_id)
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
	
	cp_map_dashboard.addStateHighlightLine = function(){
        
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
	
	cp_map_dashboard.clearHighlightLine = function(){

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
	
	cp_map_dashboard.backToZone = function()
	{
		state_id=0; state_name='';
		mapLyears.forEach(function(infoGraphic, stateID, mapV) 
		{
			if(!(infoGraphic==null || infoGraphic=='undefined' || infoGraphic.attributes==null || infoGraphic.attributes=='undefined'))
			{
				if(infoGraphic.attributes.TYPE == 'STATION_MARKER' )
				{
					bMap.graphics.remove(infoGraphic);
				}
			}    	    		
		});
		cp_map_dashboard.clearHighlightLine();
		cp_map_dashboard.addZoneHighlightLine();   
		cp_map_dashboard.addZoneStation();
	}

	
	this.cp_map_dashboard = cp_map_dashboard;
}();






