    var name_1='All India Status', name_2='';
    var home_path = '';
    var zone_id=0, zone_name='';
    var state_id=0, state_name='';
	var event_STEP = 0;
	var event_TYPE  = 0;
    
	var rMap = new Map();
	var data_state_wise_ur  = new Array();
	var data_state_wise_ru  = new Array();
	var popup_header    = "State";
	var bMap, stateLayer,stateQuery,stateQueryTask,  zoneLayer,zoneQuery,zoneQueryTask;
	var emptyLineRenderer;
	var mapLyears = new Map();

	

/********************************************************************/
/********************************************************************/
/************************ESRI-MAP************************************/
/********************************************************************/
/********************************************************************/

!function(){
	var fu_map_dashboard={};
	

	require([ "esri/map", "dojo/domReady!" ],

		function( esriMap  ) 
  		{
		
			esri.basemaps.EmtyBasemap = {
			      baseMapLayers: [{url: "http://services.arcgisonline.com/ArcGIS/rest/services/Canvas/World_Light_Gray_Base/MapServer",opacity: 0.3}
			      ],
			      title: "NIC Street"
			    };
          
    		bMap = new esri.Map("bmap", {
    				
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
    	  	bMap.infoWindow.resize(370,370);
    	  	bMap.disableScrollWheel();
	  		bMap.on("load",function(){
	  			fu_map_dashboard.drawStateLyear();
	  		});

    		initialize(); 
		}
	);
	

	
	

	
	fu_map_dashboard.drawStateLyear = function( ){

	    zone_id=0;  zone_name='';
	    state_id=0; state_name='';
		event_STEP = 0;
		event_TYPE = 0;
		mapLyears = new Map();
		bMap.infoWindow.hide();
		//bMap.graphics.clear();
		

		debugger;
		//var fset    =  dojo.fromJson( localStorage.getItem("state_geometry")  );
	    var dataD   =  dojo.fromJson( localStorage.getItem("bmap_data")  );
        var state_details = dataD.stateList;
	    
		stateQueryTask.execute(stateQuery, function(fset) 
		{ 
			var jsnFset   =  fset;
			
			for (var i=0; i<jsnFset.features.length; i++ ) 
			{ 
                var st_id =0, state_nm= '';
                //var z_id = 0, zone_nm = '';
				
				st_id = parseInt( jsnFset.features[i].attributes.stcode11 );
			    state_nm = jsnFset.features[i].attributes.stname;
			    
			    if(state_nm==null || ''+state_nm+'' == 'undefined')
			    {
			    	st_id = parseInt( jsnFset.features[i].attributes.STCODE11 );
			    	state_nm = jsnFset.features[i].attributes.STNAME;
			    }
			    
			    var dojoBorder = new dojo.Color([12, 12, 12]);   
		    	var dojoPlygon = new dojo.Color([196, 222, 233]); 


		    	var symbol = new esri.symbol.SimpleFillSymbol(
								esri.symbol.SimpleFillSymbol.STYLE_SOLID,  
								new esri.symbol.SimpleLineSymbol(esri.symbol.SimpleLineSymbol.STYLE_SOLID, dojoBorder, 1), 
								dojoPlygon);

		    	var gmtry = new esri.geometry.Polygon( jsnFset.features[i].geometry );
		    	
		    	var infoGraphic = new esri.Graphic( gmtry, symbol );


		    	infoGraphic.setAttributes( {"STEP": 1, "TYPE" : 'STATE_LYEAR', "state_id":st_id, "state_name":state_nm, "color_code":dojoPlygon});
		    	
		    	mapLyears.set(st_id, infoGraphic);
		    	
			    bMap.graphics.add( infoGraphic  );

			    
				//-------------------Lable--------------------//
		    	dojo.require("esri.symbols.TextSymbol");
		    	var font = new esri.symbol.Font(10, esri.symbol.Font.STYLE_NORMAL, esri.symbol.Font.VARIANT_NORMAL, "Arial");
		    	
	            var strLabel = state_nm.charAt(0).toUpperCase() + state_nm.slice(1).toLowerCase();//state_nm;//stateObj.state_name;//creates string label formatted
	            var textSymbol = new esri.symbol.TextSymbol(strLabel, font);//create symbol with attribute name 

	            textSymbol.setColor(new dojo.Color([11, 11 ,1]));//set the color
	            
	            //var centroid = infoGraphic.geometry.getExtent().getCenter(); //get center of county
	            var centroid = gmtry.getCentroid();
	            
	            var labelPointGraphic = new esri.Graphic(centroid, textSymbol); //create label graphic 
	            
	            labelPointGraphic.setAttributes( {
	            	"STEP"		: 1, 
					"TYPE" 		: 'STATE_LYEAR', 
					"state_id"	: st_id, 
					"state_name": state_nm
            		});
	            
	            //add label to the intended graphic                    
	            bMap.graphics.add(labelPointGraphic);
	            mapLyears.set(st_id+'LBL', labelPointGraphic);
	          //---------------------------------------// 

		    }
			
			//var state_details = dataD.stateList;
			//var state_details = rMap.get("state_list");
		   
			for(var i=0;state_details!=null && i<state_details.length;i++)
			{
				   var myPosition = new esri.geometry.Point( 16, 72);
				  
				   var url = home_path+"/gmap2/images/ico_1_1_1.png";
				  // var url = home_path+"/gmap2/images/cir_07.png";
				   var infoSymbol = new esri.symbol.PictureMarkerSymbol( url, 14, 14);
                   
				   if(state_details[i].lat!=null && state_details[i].lng!=null)
				   {
					   myPosition = new esri.geometry.Point( state_details[i].lng, state_details[i].lat  );
				   }
				   else
				   {
					   myPosition = new esri.geometry.Point( 16, 72  );
				   }
				   var marker = new esri.Graphic( myPosition, infoSymbol );
				   marker.setAttributes( {
	            		"STEP"			: 1,   
	            		"TYPE"			: 'STATE_LYEAR',  
	            		"state_id" 		: state_details[i].state_id,
	            		"state_name" 	: state_details[i].state_name
	            		});
				   mapLyears.set(state_details[i].state_id+'STN', marker);
		            bMap.graphics.add(marker);
			}
            fu_map_dashboard.onActionEventMap();

		}, showError );
	}; //END
	
	
	
	
	fu_map_dashboard.onActionEventMap = function(){
        
		bMap.graphics.on("click", function(fs) 
		{ 
			var data_set = fs.graphic.attributes;
			bMap.infoWindow.hide();
			
			event_STEP = data_set.STEP;
			event_TYPE = data_set.TYPE;
			if( event_STEP == 1 && event_TYPE == 'STATE_LYEAR')
			{
				state_id   = data_set.state_id;
				state_name = data_set.state_name;
				name_2=state_name;
				dynamicURL(2);
				fu_map_dashboard.clearHighlightLine();
				fu_map_dashboard.addStateHighlightLine(); 
	        	
				 var dt = '';
				  if(data_state_wise_ru[data_set.state_id]!=null) 
				  {
					  dt = ''+ data_state_wise_ru[data_set.state_id][2] + '';
				  }

					 var data_1= [
						    		[ '', null ],
						    		[ 'IPDS_11', (data_state_wise_ur[data_set.state_id]==null) ? null : data_state_wise_ur[data_set.state_id][4] ],
						    		[ 'RAPDRP_21', (data_state_wise_ur[data_set.state_id]==null) ? null : data_state_wise_ur[data_set.state_id][5] ],
						    		[ '', null ]
						      
						     ];

				 var data_11= [     [ '', null ],
				                    [ 'IPDS_12', (data_state_wise_ur[data_set.state_id]==null) ? null : data_state_wise_ur[data_set.state_id][6] ],
				                    [ 'RAPDRP_22', (data_state_wise_ur[data_set.state_id]==null) ? null : data_state_wise_ur[data_set.state_id][7] ],
					    			[ '', null ]
					      
					     	  ];

				 var data_12= [ [ 'Funds Sanctioned & Disbursed under IPDS', (data_state_wise_ur[data_set.state_id]==null) ? null : data_state_wise_ur[data_set.state_id][2]  ],
				                [ '', null ],
				                [ '', null ],
				    			[ '', null ]
				      
				     	  ];
				 
			   var data_2= [        [ 'Funds Sanctioned & Disbursed under IPDS', (data_state_wise_ur[data_set.state_id]==null) ? null : data_state_wise_ur[data_set.state_id][3]  ], 
						    		[ '', null ],
						    		[ '', null ],
						    		[ 'Funds Disbursed Under DDUGJY'           , (data_state_wise_ru[data_set.state_id]==null) ? null : parseFloat(parseFloat(dt ).toFixed(2))  ]
						      
						   ];
				
				  var contentString = '<div id="chart05" style="height:240px; width:350px;"></div>   '+ 
									  '</div>';
				  bMap.infoWindow.setTitle( '<table><tr><td class=\"datamw01\"> '+popup_header+' : '+data_set.state_name+'</td><td class=\"datamw\"></td></tr>' );
				  var dnd = new dojo.dnd.Moveable(bMap.infoWindow.domNode, { }); //Move to InfoWindow (Drag-n-Drop) 
				  bMap.infoWindow.setContent( contentString );
				  bMap.infoWindow.show(fs.screenPoint,bMap.getInfoWindowAnchor(fs.screenPoint));	
				  
				  setTimeout( function() {
					   try
					   {
						   testChart(data_1, data_11, data_12, data_2, 'chart05');
					   }catch(err){}
					   
				  }, 100); 
			}
			
		});
		
		bMap.graphics.on("mouse-over", function(fs) 
		{ 
	
		});

		bMap.infoWindow.on("hide", function(fs) 
		{   
			name_2=state_name;
			dynamicURL(1);
			fu_map_dashboard.clearHighlightLine();
		});
		
		
	}; //END of onActionEventMap
	

	fu_map_dashboard.clearHighlightLine = function(){

    	for(var ii=0; ii<bMap.graphics.graphics.length; ii++)
    	{
    		try
    		{
    		    if( bMap.graphics.graphics[ii].attributes.TYPE == 'HIGHLIGHT' )
    			{
    				bMap.graphics.remove(   bMap.graphics.graphics[ii] );
    				
    				if(ii>0) ii = ii-1;
    			}
    		}catch(err) {}
    	}
	}
	
	
	fu_map_dashboard.addStateHighlightLine = function(){
        
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
	
	
	this.fu_map_dashboard = fu_map_dashboard;
}();






