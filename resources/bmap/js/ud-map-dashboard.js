
    var name_1 ='All India Status', name_2='', name_3='', name_4='';
    var home_path = '';
    var discom_id=0, discom_name='';
    var state_id=0, state_name='';
	var event_STEP = 0;
	var event_TYPE  = 0;
	var reInitialize = false;
	var action_click_bool = true;
	var action_click_tim;
	
	
	var centerAt = [81.748, 23.500];
    
	var rMap = new Map();
	var bMap, stateLayer,stateQuery,stateQueryTask,  zoneLayer,zoneQuery,zoneQueryTask;
	var emptyLineRenderer;
	var mapLyears = new Map();
	var action_bool = true;
	

	
	
	
	var total_atc_los_of_a_goven_town = 0;
	var selected_towm_marker = null;
	var previous_towm_marker = null;
	var previous_imag_marker = null;
	

/********************************************************************/
/********************************************************************/
/************************ESRI-MAP************************************/
/********************************************************************/
/********************************************************************/

!function(){
	var ud_map_dashboard={};
	

	require([ "esri/basemaps", "esri/map", "esri/lang", "dijit/TooltipDialog",  "dijit/popup", "dojo/dom-style", "dojo/domReady!" ],

		function( esriBasemaps, esriMap, esriLang, TooltipDialog,  dijitPopup, domStyle  ) 
  		{
		    initialize();
			esriBasemaps.EmtyBasemap = {
			      baseMapLayers: [{url: "http://services.arcgisonline.com/ArcGIS/rest/services/Canvas/World_Light_Gray_Base/MapServer",opacity: 0.3}
			      ],
			      title: "NIC Street"
			    };

    		bMap = new esri.Map("bmap", {
    				
    			basemap: "EmtyBasemap",
    			center: centerAt,
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

	     	bMap.infoWindow.resize(250,130);
    		bMap.disableScrollWheel();
			     	
    	  	_esriLang   = esriLang;
    	  	_dijitPopup = dijitPopup;
    	  	_domStyle   = domStyle;
    	  	dialog = new TooltipDialog({
    	          id: "tooltipDialog",
    	          style: "position: absolute; width: 120px; font: normal normal normal 10pt Helvetica;z-index:100"
    	        });
    	    dialog.startup();
    	    
	  		emptyLineRenderer = esri.renderer.SimpleRenderer( esri.symbol.SimpleLineSymbol( esri.symbol.SimpleLineSymbol.STYLE_SOLID, esri.Color([160, 0, 0, 0]), 1 )); // RGB Opacity AND Line-Width

	  		
	  		
	  		bMap.on("load",function()
	  		{
	  			ud_map_dashboard.drawStateLyear();
	  		});
	  		
  		});
	
	
	
	
	ud_map_dashboard.drawStateLyear = function(){
		
		    state_id	=0; 
		    state_name	='';
			event_STEP 	= 0;
			event_TYPE 	= 0;
			mapLyears 	= new Map();
	
	
			var colors = ["#0d260d","#133913","#194d19","#206020","#267326","#2d862d","#339933","#39ac39","#40bf40","#53c653","#66cc66","#79d279","#8cd98c","#9fdf9f","#b3e6b3","#c6ecc6","#d9f2d9","#ecf9ec","#ecf9ec","#ecf9ec","#ecf9ec","#ecf9ec","#ecf9ec"];
	
			debugger;
			//var fset    =  dojo.fromJson( localStorage.getItem("state_geometry")  );
		    var dataD   =  dojo.fromJson( localStorage.getItem("bmap_data")  );
            rMap.set("state_details", dataD.stateList);
            
            
	        
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
			    	
			    	var lat = 0, lng = 0;
			    	var jsn = {};
			    	var state_details = rMap.get("state_details");
			    	var is_acttive = true;
					for(var ii=0;ii<state_details.length;ii++)
					{
						if(st_id == state_details[ii].state_id)
						{
							lat 		= state_details[ii].lat;
							lng 		= state_details[ii].lng;
							is_acttive  = state_details[ii].is_active;
	
							jsn = {
									"STEP"		: 1, 
									"TYPE" 		: 'STATE_LYEAR', 
									"state_id"	: st_id, 
									"state_name": state_nm
								};
						}
				    }


			    	var symbol = new esri.symbol.SimpleFillSymbol(
									esri.symbol.SimpleFillSymbol.STYLE_SOLID,  
									new esri.symbol.SimpleLineSymbol(esri.symbol.SimpleLineSymbol.STYLE_SOLID, dojoBorder, 1), 
									dojoPlygon);
	
			    	var gmtry = new esri.geometry.Polygon( jsnFset.features[i].geometry );
			    	var infoGraphic = new esri.Graphic( gmtry, symbol );
			    	infoGraphic.setAttributes( jsn );
			    	mapLyears.set(st_id, infoGraphic);
				    bMap.graphics.add( infoGraphic  );
					//-------------------Lable--------------------//
			    	dojo.require("esri.symbols.TextSymbol");
			    	var font = new esri.symbol.Font(11, esri.symbol.Font.WEIGHT_BOLD, esri.symbol.Font.WEIGHT_BOLD, "Arial");
		            var strLabel = state_nm.charAt(0).toUpperCase() + state_nm.slice(1).toLowerCase();
		            var textSymbol = new esri.symbol.TextSymbol(strLabel, font);//create symbol with attribute name 
		            textSymbol.setColor(new dojo.Color([11, 11 ,1]));//set the color
		            //var centroid = infoGraphic.geometry.getExtent().getCenter(); //get center of county
		            var centroid = gmtry.getCentroid();
		            var labelPointGraphic = new esri.Graphic(centroid, textSymbol); //create label graphic 
		            //add label to the intended graphic                    
		            bMap.graphics.add(labelPointGraphic);
		            mapLyears.set(st_id+'LBL', labelPointGraphic);
		          //---------------------------------------// 

		            var url = home_path+"/gmap2/images/ico_1_1_1.png";
		            
		            if( !is_acttive )
		            {
		            	url = home_path+"/gmap2/images/ico_1_1_1_1.png";
		            }
		            	
		            	
		            var infoSymbol = new esri.symbol.PictureMarkerSymbol( url, 13, 13);
	
		            var myPosition = new esri.geometry.Point( lng, lat  );
		            var marker = new esri.Graphic( myPosition, infoSymbol );
		            
		            var marker = new esri.Graphic( myPosition, infoSymbol );
			           
			            marker.setAttributes( {
			            	"STEP"		: 1, 
							"TYPE" 		: 'STATE_LYEAR_MARKER', 
							"state_id"	: st_id, 
							"state_name": state_nm
		            		});
	
		            mapLyears.set( st_id+'MARKER', marker);
		            bMap.graphics.add(marker);

			    }
	
				if(action_bool)
				{
					action_bool = false;
					ud_map_dashboard.onActionEventMap();
				}
				
			}, showError );
		    
	} //END

	ud_map_dashboard.reInitialize = function( ){
    	
	    state_id=0; state_name='';
	    discom_id=0; discom_name='';
	    town_id=0; town_name='';
		event_STEP = 0;
		event_TYPE = 0;

		if( bMap.infoWindow.isShowing )
		{bMap.infoWindow.hide();}
		
		ud_map_dashboard.setCenter();
		
    	mapLyears.forEach(function(infoGraphic, stateID, mapV) 
    	{
    		if(!(infoGraphic==null || infoGraphic=='undefined' || infoGraphic.attributes==null || infoGraphic.attributes=='undefined'))
    		{    
    			if(infoGraphic.attributes.TYPE == 'STATE_LYEAR_MARKER' || infoGraphic.attributes.TYPE == 'DISCOM_LYEAR_MARKER' || infoGraphic.attributes.TYPE == 'TOWN_LYEAR_MARKER' )
    			{
    				bMap.graphics.remove(infoGraphic);
    			} 
    		}    	    		
    	});
    	ud_map_dashboard.removeTown();
    	ud_map_dashboard.clearHighlightLine();
    	mapLyears.forEach(function(infoGraphic, stateID, mapV) 
    	{
    		if(!(infoGraphic==null || infoGraphic=='undefined' || infoGraphic.attributes==null || infoGraphic.attributes=='undefined'))
    		{    
    			if( infoGraphic.attributes.TYPE == 'STATE_LYEAR_MARKER'  )
    			{
    				bMap.graphics.add(infoGraphic);
    			} 
    		}    	    		
    	});

	}; //END
	

    


	ud_map_dashboard.onActionEventMap = function(){
        
		bMap.graphics.on("click", function(fs) 
		{
			try
			{
				if(  action_click_bool  )
				{
					action_click_bool = false;
					
					total_atc_los_of_a_goven_town = 0;
					var data_set = fs.graphic.attributes;

					if( bMap.infoWindow.isShowing )
					{bMap.infoWindow.hide();}
					
					event_STEP = data_set.STEP;
					event_TYPE = data_set.TYPE;
					
		
					_dijitPopup.close(dialog);
					
					
					if( event_STEP == 1 && (event_TYPE == 'STATE_LYEAR' || event_TYPE == 'STATE_LYEAR_MARKER' ) )
					{
		
						state_id   = data_set.state_id;
						state_name = data_set.state_name;
						ud_map_dashboard.setCenter();
						
						
			        	mapLyears.forEach(function(info_Graphic, stateID, mapV) 
			        	{
			        		if(!(info_Graphic==null || info_Graphic=='undefined' || info_Graphic.attributes==null || info_Graphic.attributes=='undefined'))
			        		{
			        			if(info_Graphic.attributes.TYPE == 'STATE_LYEAR_MARKER' )
			        			{
			        				bMap.graphics.remove(info_Graphic);
			        			}
			        			if(info_Graphic.attributes.TYPE == 'DISCOM_LYEAR_MARKER' )
			        			{
			        				bMap.graphics.remove(info_Graphic);
			        			}
			        			if(info_Graphic.attributes.TYPE == 'TOWN_LYEAR_MARKER' )
			        			{
			        				bMap.graphics.remove(info_Graphic);
			        			}
			        		}    	    		
		    	    	});
		
		
			        	
			            ud_map_dashboard.removeTown();
			        	
		
						if( previous_towm_marker!=null  )
						{
			    			bMap.graphics.remove( previous_towm_marker );
			    			previous_towm_marker = null;
			    			previous_imag_marker = null;
						}
						
			        	ud_map_dashboard.clearHighlightLine();
			        	ud_map_dashboard.addStateHighlightLine();   
		        		set_II_Lyears();
		        		
		        		action_click_tim = setTimeout(  function(){ action_click_bool = true; } , 10000);
		
		        		
					}
					if( event_STEP == 2 && ( event_TYPE == 'DISCOM_LYEAR_MARKER') )
					{
						discom_id   = data_set.discom_id;
						discom_name = data_set.discom_name;
			        	mapLyears.forEach(function(infoGraphic, stateID, mapV) 
			        	{
			        		if(!(infoGraphic==null || infoGraphic=='undefined' || infoGraphic.attributes==null || infoGraphic.attributes=='undefined'))
			        		{    
			        			if(infoGraphic.attributes.TYPE == 'DISCOM_LYEAR_MARKER' )
			        			{
			        				bMap.graphics.remove(infoGraphic);
			        			} 
			        		}    	    		
		    	    	});
			        	
						if( previous_towm_marker!=null  )
						{
			    			bMap.graphics.remove( previous_towm_marker );
			    			previous_towm_marker = null;
			    			previous_imag_marker = null;
						}
		
			        	
			        	bMap.setZoom( 6 );
			        	bMap.centerAt(new esri.geometry.Point(fs.graphic.geometry.x, fs.graphic.geometry.y));    
			        	//bMap.centerAt( fs.graphic.geometry.getCentroid() );
		        		set_III_Lyears();
		        		action_click_tim = setTimeout(  function(){ action_click_bool = true; } , 10000);

		        		
					}
					if( event_STEP == 3 && event_TYPE == 'TOWN_LYEAR_MARKER')
					{
		
			        	var marker_1 = fs.graphic;
			        	var marker_2 = fs.graphic;
			        	var marker_3 = null;
		
			        	
			        	var img_url = fs.graphic.symbol.url;
			        	
			        	
			        	fs.graphic.symbol.url =  home_path+"/gmap2/images/icon_3_9.png";
			        	mapLyears.forEach(function(infoGraphic, stateID, mapV) 
			        	{
			        		if(!(infoGraphic==null || infoGraphic=='undefined' || infoGraphic.attributes==null || infoGraphic.attributes=='undefined'))
			        		{    
			        			if(infoGraphic.attributes.TYPE == 'TOWN_LYEAR_MARKER' && infoGraphic.attributes.town_id==data_set.town_id)
			        			{
			        				bMap.graphics.remove(infoGraphic);
			        			} 
			        		}    	    		
		    	    	});
			        	bMap.graphics.add(fs.graphic);
			        	//----------------
			        	
			        	
			        	
			        	
			        	
						if( previous_towm_marker!=null  )
						{
		        			bMap.graphics.remove( previous_towm_marker );
		        			
		        			previous_towm_marker.symbol.url =  previous_imag_marker;
		        			bMap.graphics.add(previous_towm_marker);
		        			
		        			previous_imag_marker = img_url;
		        			previous_towm_marker = fs.graphic;
						}
						else
						{
							previous_towm_marker = fs.graphic;
				        	previous_imag_marker = img_url;
						}
						//previous_towm_marker = marker_3;
						//selected_towm_marker = marker_1;
						//-----------------
						
						
						total_atc_los_of_a_goven_town = data_set.atc_loss;
						town_id   = data_set.town_id;
						town_name = data_set.town_name;
						set_IIII_Lyears();
						action_click_tim = setTimeout(  function(){ action_click_bool = true; } , 5000);
					}
				}
			}
			catch(err){action_click_bool = true;}

		});
		
		bMap.graphics.on("mouse-over", function(fs) 
		{ 
			if(!(fs.graphic==null || fs.graphic=='undefined' || fs.graphic.attributes==null || fs.graphic.attributes=='undefined'))
			{
				var data_set = fs.graphic.attributes;
				event_STEP = data_set.STEP;
				event_TYPE = data_set.TYPE;
				
				if( event_STEP == 3 && event_TYPE == 'TOWN_LYEAR_MARKER')
				{
			    	 var info_panel_text = " class=\"info-panel-text-H\" ";
	 
					 var infow_wind = 
						'<table>'+
						'<tr><td nowrap class=\"info-panel-text-b  data03\" colspan=4>Date :'+data_set.start_date +' TO '+data_set.end_date+'</td></tr>'+
						'<tr><td nowrap class=\"info-panel-text\">AT&C Loss              </td><td>:</td><td '+info_panel_text+'>'+ data_set.atc_loss+'</td> <td></td> </tr>'+
						'<tr><td nowrap class=\"info-panel-text\">Billing Efficiency     </td><td>:</td><td '+info_panel_text+'>'+ data_set.billing_e+'</td> <td></td> </tr>'+
						'<tr><td nowrap class=\"info-panel-text\">Collection Efficiency  </td><td>:</td><td '+info_panel_text+'>'+ data_set.collection_e+'</td> <td></td> </tr>'+
						'</table>'
						; 
	
					 var cont =  
						'<div id="tabs">'+
						  '<div id=\"allindiacp\"  style=\"height:110px; padding: 1px 0px;\">  '+infow_wind+'  </div>'+
						'</div>';
				  	
			      	 bMap.infoWindow.setContent( cont );
			         bMap.infoWindow.setTitle( '<table><tr><td class=\"datamw01\"> '+data_set.town_name+'</td><td class=\"datamw\"></td></tr>' );
			          
			      	 var dnd = new dojo.dnd.Moveable(bMap.infoWindow.domNode, { }); //Move to InfoWindow (Drag-n-Drop) 
	
			         bMap.infoWindow.show(fs.screenPoint,bMap.getInfoWindowAnchor(fs.screenPoint));	
				}	
				
				
				if(  event_STEP == 2 && event_TYPE == 'DISCOM_LYEAR_MARKER')
				{
					var t = data_set.discom_name;
					dialog.setContent( data_set.discom_name );
					
					  _domStyle.set(dialog.domNode, "opacity", 0.85);
					  _dijitPopup.open({
					    popup: dialog,
					    x: fs.pageX+1,
					    y: fs.pageY+1
					  });
				}
			}
		});
		bMap.graphics.on("mouse-out", function(fs) 
		{ 
			_dijitPopup.close(dialog);
			
			if( bMap.infoWindow.isShowing )
			{bMap.infoWindow.hide();}
		});

				
		bMap.infoWindow.on("hide", function(fs) 
		{   
		});
		
		
	}; //END of onActionEventMap
	

	
	
	
	ud_map_dashboard.clearHighlightLine = function(){

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
	ud_map_dashboard.addStateHighlightLine = function(){
        
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

	ud_map_dashboard.addStateDiscom = function(){
        
		var discom_details = rMap.get("discom_details");
		ud_map_dashboard.setCenter();

		if( bMap.infoWindow.isShowing )
		{bMap.infoWindow.hide();}
		
		for(var i=0;  i<discom_details.length;  i++)
		{
            var url = home_path+"/gmap2/images/ico_2_1_2.png";
            var infoSymbol = new esri.symbol.PictureMarkerSymbol( url, 27, 27);
            var lng = discom_details[i].lng; 
            var lat = discom_details[i].lat;

				
            var myPosition = new esri.geometry.Point( lng, lat  );
            var marker_discom = new esri.Graphic( myPosition, infoSymbol );
            
            var marker = new esri.Graphic( myPosition, infoSymbol );
	           
	            marker.setAttributes( {
	            	"STEP"		: 2, 
					"TYPE" 		: 'DISCOM_LYEAR_MARKER', 
					"state_id"	: state_id, 
					"state_name": state_name,
					"discom_id"	: discom_details[i].discom_id, 
					"discom_name": discom_details[i].discom_name
            		});

            mapLyears.set( discom_details[i].discom_id+'MARKER', marker);
            bMap.graphics.add(marker);

	    }
	}; 
	ud_map_dashboard.addStateDiscomTown = function(){
        
		var discom_town_list = rMap.get("discom_town_list");
		
		
		var cir_01 = home_path+"/gmap2/images/cir_01.png";
		var cir_02 = home_path+"/gmap2/images/cir_02.png";
		var cir_03 = home_path+"/gmap2/images/cir_03.png";
		var cir_04 = home_path+"/gmap2/images/cir_04.png";
		var cir_05 = home_path+"/gmap2/images/cir_05.png";
		var cir_06 = home_path+"/gmap2/images/cir_06.png";
		
		var icon_3_1_d = cir_06;
		
		
		for(var i=0;  discom_town_list!=null && i<discom_town_list.length;  i++)
		{
	    	// Remove Town LatLng if data not found.............
		    if(  discom_town_list[i].reportingmonthstart == null ) continue;
		    
		    
	        var myPosition = new esri.geometry.Point( 70-Math.random()*10, 30-Math.random()*10  );
            var dist_name  = discom_town_list[i].district_name;
		    var town_name  = discom_town_list[i].town_name;  
		    var adr 	   = town_name+' '+dist_name+' '+name_2+'  india';
		   
			   
            var atc   = '';
            var beff  = '';
		    var ceff  = '';
		   
		    if(discom_town_list[i].atc_loss!=null)
		    {
			    atc = parseFloat( discom_town_list[i].atc_loss ).toFixed(2);
		    }
		    if(discom_town_list[i].billing_efficiency!=null)
		    {
			    beff = parseFloat( discom_town_list[i].billing_efficiency ).toFixed(2);
		    }
		   
		    if(discom_town_list[i].collection_efficiency!=null)
		    {
			    ceff = parseFloat( discom_town_list[i].collection_efficiency ).toFixed(2);
		    }
		    //---------------------
		    
		    if(discom_town_list[i].atc_loss!=null)
		    {   /*
			   if( parseFloat(atc) <= parseFloat('0') )  // Data not founds.......
			   {   
				   icon_3_1_d = cir_06;						   
			   }
			   else */
			   if( parseFloat(atc) < parseFloat('15.0') )  
			   {   
				   icon_3_1_d = cir_04;						   
			   }
			   else if( parseFloat(atc)>=parseFloat('15.0') &&  parseFloat(atc)<parseFloat('25.0')   )  
			   {
				   icon_3_1_d = cir_01;		
			   }
			   else if( parseFloat(atc)>=parseFloat('25.0') &&  parseFloat(atc)<parseFloat('35.0')   )  
			   {
				   icon_3_1_d = cir_03;		
			   }
			   else if( parseFloat(atc)>=parseFloat('35.0') &&  parseFloat(atc)<parseFloat('45.0')   )  
			   {
				   icon_3_1_d = cir_05;		
			   }
			   else// if( parseFloat(atc)>=parseFloat('45.0')  )   
			   {
				   icon_3_1_d = cir_02;		
			   }
		    }
		    //--------------------------
		    

			var stDate = (discom_town_list[i].reportingmonthstart==null) ? '' :  ""+$.datepicker.formatDate('dd/mm/yy',  new Date(discom_town_list[i].reportingmonthstart))+"" ;
		    var edDate = (discom_town_list[i].reportingmonthend==null)   ? '' :  ""+$.datepicker.formatDate('dd/mm/yy',  new Date(discom_town_list[i].reportingmonthend))+"" ;
			   
			   
		    if(  !( discom_town_list[i].lat==null ||  parseInt(discom_town_list[i].lat)<=0 )) 
			{
		    	var infoSymbol = new esri.symbol.PictureMarkerSymbol( icon_3_1_d, 20, 20);
		    	var lng = discom_town_list[i].lng; 
	            var lat = discom_town_list[i].lat;
		    	
	            myPosition = new esri.geometry.Point( lng, lat  );
	            var marker = new esri.Graphic( myPosition, infoSymbol );
	            	marker.setAttributes( {
	            	"STEP"		 : 3, 
					"TYPE" 		 : 'TOWN_LYEAR_MARKER', 
					"state_id"	 : state_id, 
					"state_name" : state_name,
					"discom_id"	 : discom_id, 
					"discom_name": discom_name,
					"town_id"	 : discom_town_list[i].town_id, 
					"town_name"  : discom_town_list[i].town_name,
					
					"atc_loss"  	: atc,
					"billing_e"  	: beff,
					"collection_e"  : ceff,
					"start_date"  	: stDate,
					"end_date"  	: edDate,

            		});

	            mapLyears.set( discom_town_list[i].town_id+'MARKER', marker);
	            bMap.graphics.add(marker);
            
			}
	    }
	};
	

	ud_map_dashboard.setCenter = function(){
		
		bMap.setZoom( 5 );
    	bMap.centerAt(new esri.geometry.Point( centerAt ));  
	};
	ud_map_dashboard.reSetLyears = function(){
		
		mapLyears.forEach(function(infoGraphic, stateID, mapV) 
    	{
    		if(!(infoGraphic==null || infoGraphic=='undefined' || infoGraphic.attributes==null || infoGraphic.attributes=='undefined'))
    		{    
    			bMap.graphics.remove(infoGraphic);
    		}    	    		
    	});
	};



	ud_map_dashboard.backToState = function(){
	    
		event_STEP = 1;
		event_TYPE = 'STATE_LYEAR';
	
		mapLyears.forEach(function(infoGraphic, stateID, mapV) 
	    {
			if(!(infoGraphic==null || infoGraphic=='undefined' || infoGraphic.attributes==null || infoGraphic.attributes=='undefined'))
			{
				if(infoGraphic.attributes.TYPE == 'STATE_LYEAR_MARKER' )
				{
					bMap.graphics.remove(infoGraphic);
				}
				if(infoGraphic.attributes.TYPE == 'DISCOM_LYEAR_MARKER' )
				{
					bMap.graphics.remove(infoGraphic);
				}
				if(infoGraphic.attributes.TYPE == 'TOWN_LYEAR_MARKER' )
				{
					bMap.graphics.remove(infoGraphic);
				}
			}    	    		
		});
		ud_map_dashboard.removeTown();
		set_II_Lyears();	
	}; 
	ud_map_dashboard.backToDiscom = function(){
	    
		event_STEP = 2;
		event_TYPE = 'DISCOM_LYEAR_MARKER';
	
		mapLyears.forEach(function(infoGraphic, stateID, mapV) 
	    {
			if(!(infoGraphic==null || infoGraphic=='undefined' || infoGraphic.attributes==null || infoGraphic.attributes=='undefined'))
			{
				if(infoGraphic.attributes.TYPE == 'STATE_LYEAR_MARKER' )
				{
					bMap.graphics.remove(infoGraphic);
				}
				if(infoGraphic.attributes.TYPE == 'DISCOM_LYEAR_MARKER' )
				{
					bMap.graphics.remove(infoGraphic);
				}
				if(infoGraphic.attributes.TYPE == 'TOWN_LYEAR_MARKER' )
				{
					bMap.graphics.remove(infoGraphic);
				}
			}    	    		
		});
		ud_map_dashboard.removeTown();
		set_III_Lyears();	
	}; 

	ud_map_dashboard.removeTown = function(){
		
		
    	for(var ii=0; ii<bMap.graphics.graphics.length; ii++)
    	{
    		try
    		{
    		    if( bMap.graphics.graphics[ii].attributes.TYPE == 'TOWN_LYEAR_MARKER' )
    			{
    				bMap.graphics.remove(   bMap.graphics.graphics[ii] );
    				
    				if(ii>0) ii = ii-1;
    			}
    		}catch(err) {}
    	}
	}

	
	this.ud_map_dashboard = ud_map_dashboard;
}();






