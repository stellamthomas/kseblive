
    var name_1 ='All India', name_2='', name_3='', name_4='';
    var home_path = '';
    var town_id=0, town_name='';
    var discom_id=0, discom_name='';
    var state_id=0, state_name='';
	var event_STEP = 0;
	var event_TYPE  = 0;
    
	var rMap = new Map();
	var bMap, stateLayer,stateQuery,stateQueryTask,  zoneLayer,zoneQuery,zoneQueryTask;
	var emptyLineRenderer;
	//var mapLyears = new Map();
	var action_click_bool = true;
	var action_bool = true;
	var action_click_tim = null;
	var total_atc_los_of_a_goven_town = 99.99; // AT&C Loss
	

/********************************************************************/
/********************************************************************/
/************************ESRI-MAP************************************/
/********************************************************************/
/********************************************************************/

!function(){
	var ud_all_town_map_dashboard={};
	

	require([ "esri/map", "esri/layers/ArcGISDynamicMapServiceLayer", "dojo/domReady!"  ],

		function( esriMap, ArcGISDynamicMapServiceLayer ) 
  		{
		esri.basemaps.EmtyBasemap = {
			      baseMapLayers: [{url: "http://services.arcgisonline.com/ArcGIS/rest/services/Canvas/World_Light_Gray_Base/MapServer",opacity: 0.5}
			      ],
			      title: "NIC Street"
			    };

		debugger;
    		bMap = new esriMap("bmap", {
    				
    			basemap: "EmtyBasemap",
    			center: [81.748, 22.900],
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
    	  	bMap.infoWindow.resize(270,170);
    	  	bMap.disableScrollWheel();
    		action_bool = true;
	  		bMap.on("load",function(){
	  			initialize(0); 
	  		});
	  		
    		
		}
	);
	
	
	

	
	ud_all_town_map_dashboard.drawStateLayer = function( ){

	    state_id=0; state_name='';
		event_STEP = 0;
		event_TYPE = 0;
		//mapLyears = new Map();

		if( bMap.infoWindow.isShowing )
		{bMap.infoWindow.hide();}
		
		bMap.graphics.clear();
		
		
		debugger;
		//var fset    =  dojo.fromJson( localStorage.getItem("state_geometry")  );

		stateQueryTask.execute(stateQuery, function(fset) 
		{
			var jsnFset   =  fset;
			
			for (var i=0; i<jsnFset.features.length; i++ ) 
			{ 
                var st_id =0, state_nm= '';
				
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


		    	infoGraphic.setAttributes( {"STEP": 1, "TYPE" : 'STATE_LYEAR', "state_id":st_id, "state_name":state_nm });
		    	
		    	//mapLyears.set(st_id, infoGraphic);
		    	
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
					"TYPE" 		: 'STATE_LYEAR_TEXT_MARKER', 
					"state_id"	: st_id, 
					"state_name": state_nm
            		});
	            
	            //add label to the intended graphic                    
	            bMap.graphics.add(labelPointGraphic);
	            //mapLyears.set(st_id+'LBL', labelPointGraphic);
	          //---------------------------------------// 

		    }

			debugger;
			var stn = rMap.get("station_details");
			for(var i=0;stn!=null && i<stn.length;i++)
			{
				   //if(i>20) break;
				   var dist_name   = stn[i].district_name;
				   var town_name_   = stn[i].town_name;
				   var state_name_  = stn[i].state_name;  
				   var discm_name_  = stn[i].discom_name;  
				   
				   
				   var atc   = '';
                   var beff  = '';
				   var ceff  = '';
				   
				   if(stn[i].atc_loss!=null)
				   {
					   atc = parseFloat( stn[i].atc_loss ).toFixed(2);
				   }
				   if(stn[i].billing_efficiency!=null)
				   {
					   beff = parseFloat( stn[i].billing_efficiency ).toFixed(2);
				   }
				   if(stn[i].collection_efficiency!=null)
				   {
					   ceff = parseFloat( stn[i].collection_efficiency ).toFixed(2);
				   }
				   
				   var url = home_path+"/gmap2/images/cir_06.png";
				   
				   if(stn[i].atc_loss!=null)
				   {    
					   if( parseFloat(atc) < parseFloat('15.0') )  
					   {   
						   url = home_path+"/gmap2/images/cir_04.png"; 					   
					   }
					   else if( parseFloat(atc)>=parseFloat('15.0') &&  parseFloat(atc)<parseFloat('25.0')   )  
					   {
						   url = home_path+"/gmap2/images/cir_01.png"; 
					   }
					   else if( parseFloat(atc)>=parseFloat('25.0') &&  parseFloat(atc)<parseFloat('35.0')   )  
					   {
						   url = home_path+"/gmap2/images/cir_03.png"; 
					   }
					   else if( parseFloat(atc)>=parseFloat('35.0') &&  parseFloat(atc)<parseFloat('45.0')   )  
					   {
						   url = home_path+"/gmap2/images/cir_05.png"; 
					   }
					   else 
					   {
						   url = home_path+"/gmap2/images/cir_02.png"; 	
					   }
				   }

				   var stDate = (stn[i].reportingmonthstart==null) ? '' :  ""+$.datepicker.formatDate('dd*M*yy',  new Date(stn[i].reportingmonthstart))+"" ;
				   var edDate = (stn[i].reportingmonthend==null)   ? '' :  ""+$.datepicker.formatDate('dd*M*yy',  new Date(stn[i].reportingmonthend))+"" ;
				   
				   
				   var myPosition = new esri.geometry.Point( 16, 72);
				   var infoSymbol = new esri.symbol.PictureMarkerSymbol( url, 14, 14);
				   if(  !( stn[i].lat==null )) 
				   {
					   if(stn[i].lat!=null && stn[i].lng!=null)
					   {
						   myPosition = new esri.geometry.Point( stn[i].lng, stn[i].lat  );
					   }
					   else
					   {
						   myPosition = new esri.geometry.Point( 16, 72  );
					   }
				   }
				   infoSymbol = new esri.symbol.PictureMarkerSymbol( url, 14, 14);

		            
		           var marker = new esri.Graphic( myPosition, infoSymbol );
		           
		           marker.setAttributes( {
		            		"STEP"			: 1,   //LYEAR
		            		"TYPE"			: 'STATION_MARKER', // STATION 
		            		

		            		"town_id" 	    : stn[i].town_id,
		            		"town_name" 	: town_name_,
		            		
		            		"state_id"		: stn[i].state_id, 
		            		"state_name" 	: state_name_,
		            		
		            		"discom_id" 	: stn[i].discom_id,
		            		"discm_name" 	: discm_name_,
		            		
		            		
							"atc_loss"  	: atc,
							"billing_e"  	: beff,
							"collection_e"  : ceff,
							"start_date"  	: stDate,
							"end_date"  	: edDate 
							
		            		});

		           //mapLyears.set(stn[i].station_id+'STN', marker);
		           bMap.graphics.add(marker);	   
		    }

			if(action_bool)
			{
				action_bool = false;
				ud_all_town_map_dashboard.onActionEventMap();
			}
			

		} );
	}; //END


	

    


	ud_all_town_map_dashboard.onActionEventMap = function(){
        
		bMap.graphics.on("click", function(fs) 
		{ 
			try
			{
				if(  action_click_bool  )
				{
					action_click_bool = false;
					var data_set = fs.graphic.attributes;

					if( bMap.infoWindow.isShowing )
					{bMap.infoWindow.hide();}
					
					
					if(  event_TYPE == 'STATION_MARKER'   )
					{
						state_id   = data_set.state_id;
						discom_id  = data_set.discom_id;
						town_id    = data_set.town_id;
						
						state_name = data_set.state_name;
						discm_name = data_set.discm_name;
						town_name  = data_set.town_name;
						total_atc_los_of_a_goven_town = data_set.atc_loss;
						set_Town_Lyear();
						action_click_tim = setTimeout(  function(){ action_click_bool = true; } , 3000);
					}
				}
			}
			catch(err){action_click_bool = true;}
		});
		
		bMap.graphics.on("mouse-over", function(fs) 
		{ 
			var data_set = fs.graphic.attributes;
			event_STEP = data_set.STEP;
			event_TYPE = data_set.TYPE;
			
			if(  event_TYPE == 'STATION_MARKER')
			{
		    	var info_panel_text = " class=\"info-panel-text-H\" ";

		    	var stDate  = data_set.start_date;  stDate = stDate.replace("*", "-");stDate = stDate.replace("*", "-");
		  	    var edDate  = data_set.end_date;    edDate = edDate.replace("*", "-");edDate = edDate.replace("*", "-");
		  	  
				var infow_wind = 
					'<table>'+
					'<tr><td class=\"info-panel-text-b  data03\" colspan=4>'+stDate+' to '+edDate+'</td></tr>'+
					'<tr><td class=\"info-panel-text\">State 				</td><td>:</td><td '+info_panel_text+'>'+ data_set.state_name+'</td> <td></td> </tr>'+
					'<tr><td class=\"info-panel-text\">Discom            	</td><td>:</td><td '+info_panel_text+'>'+ data_set.discm_name+'</td> <td></td> </tr>'+
					'<tr><td class=\"info-panel-text\">AT&C Loss		   	</td><td>:</td><td '+info_panel_text+'>'+ data_set.atc_loss+'</td> <td></td> </tr>'+
					'<tr><td class=\"info-panel-text\">Billing Efficiency 	</td><td>:</td><td '+info_panel_text+'>'+ data_set.billing_e+'</td> <td></td> </tr>'+
					'<tr><td class=\"info-panel-text\">Collection Efficiency</td><td>:</td><td '+info_panel_text+'>'+ data_set.collection_e+'</td> <td></td> </tr>'+
					'</table>'
					; 
	
				var cont =  
					'<div id="tabs">'+
					  '<div id=\"allindiacp\"  style=\"height:150px; padding: 1px 0px;\">  '+infow_wind+'  </div>'+
					'</div>';
			  	
		      	 bMap.infoWindow.setContent( cont );
		         bMap.infoWindow.setTitle( '<table><tr><td class=\"datamw01\">Town : '+data_set.town_name+'</td><td class=\"datamw\"></td></tr>' );
		          
		      	 var dnd = new dojo.dnd.Moveable(bMap.infoWindow.domNode, { }); //Move to InfoWindow (Drag-n-Drop) 

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
	
	




	


	
	this.ud_all_town_map_dashboard = ud_all_town_map_dashboard;
}();






