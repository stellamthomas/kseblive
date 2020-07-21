
    var name_1 = 'All India', name_2='', name_3='', name_4='';
    var discom_id=0, discom_name='';
    var state_id=0, state_name='';
	var event_STEP = 0;
	var event_TYPE  = 0;
	var reInitialize = false;
    var centerAt = [81.748, 23.500];
	var mapLyears = new Map();
	var action_bool = true;
	var action_click_bool = true;
	var action_click_tim;
	
	
	var rMap = new Map();
	var bMap, stateLayer,stateQuery,stateQueryTask,  zoneLayer,zoneQuery,zoneQueryTask, dialog, _domStyle, _dijitPopup, _esriLang;
	var emptyLineRenderer;
	
//https://stackoverflow.com/questions/34149793/adding-tooltip-to-graphics-in-arcgis-javascript
/********************************************************************/
/********************************************************************/
/************************ESRI-MAP************************************/
/********************************************************************/
/********************************************************************/

!function(){
	var rd_map_dashboard={};
	

	require([ "esri/map",  "esri/lang", "dijit/TooltipDialog", "dijit/popup", "dojo/dom-style",        "dojo/domReady!" ],

		function( esriMap,   esriLang, TooltipDialog, dijitPopup, domStyle  ) 
  		{
			initialize(); 
			esri.basemaps.EmtyBasemap = {
			      baseMapLayers: [{url: "http://services.arcgisonline.com/ArcGIS/rest/services/Canvas/World_Light_Gray_Base/MapServer",opacity: 0.3}
			      ],
			      title: "NIC Street"
			    };

			bMap = new esriMap("bmap", {
    				
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
    	  	bMap.infoWindow.resize(310,375);
    	  	bMap.disableScrollWheel();
    	  	_esriLang = esriLang;
    	  	_dijitPopup = dijitPopup;
    	  	_domStyle = domStyle;
    	  	dialog = new TooltipDialog({
    	          id: "tooltipDialog",
    	          style: "position: absolute; width: 120px; font: normal normal normal 10pt Helvetica;z-index:100"
    	        });
    	    dialog.startup();
    	    emptyLineRenderer = esri.renderer.SimpleRenderer( esri.symbol.SimpleLineSymbol( esri.symbol.SimpleLineSymbol.STYLE_SOLID, esri.Color([160, 0, 0, 0]), 1 )); // RGB Opacity AND Line-Width
    		action_click_bool = true;
	  		bMap.on("load",function(){
	  			
	  			rd_map_dashboard.drawStateLyear();
	  		});
	  		
  		});

	
	rd_map_dashboard.drawStateLyear = function(){
		
		    state_id=0; state_name='';
			event_STEP = 0;
			event_TYPE = 0;
			mapLyears = new Map();

			//var fset    =  dojo.fromJson( localStorage.getItem("state_geometry")  );
			var dataD   =  dojo.fromJson( localStorage.getItem("bmap_data")  );
            var state_details = dataD.stateList;


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
			    	
					for(var ii=0;ii<state_details.length;ii++)
					{
						if(st_id == state_details[ii].state_id)
						{
							lat = state_details[ii].lat;
							lng = state_details[ii].lng;
							
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
		            labelPointGraphic.setAttributes( {
		            	"STEP"		: 1, 
						"TYPE" 		: 'STATE_LYEAR_TEXT_MARKER', 
						"state_id"	: st_id, 
						"state_name": state_nm
	            		});
		            //add label to the intended graphic                    
		            bMap.graphics.add(labelPointGraphic);
		            mapLyears.set(st_id+'LBL', labelPointGraphic);
		          //---------------------------------------// 
		            
	
		            var url = home_path+"/gmap2/images/ico_1_1_1.png";
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
					rd_map_dashboard.onActionEventMap();
				}
				
			}, showError );
	}; //END

	rd_map_dashboard.reInitialize = function( ){
    	
	    state_id=0; state_name='';
	    discom_id=0; discom_name='';
	    town_id=0; town_name='';
		event_STEP = 0;
		event_TYPE = 0;
		bMap.infoWindow.hide();
		
		rd_map_dashboard.removeDiscomMarker();
		rd_map_dashboard.removeStateMarker();
	    rd_map_dashboard.removeTownMarker();
		
    	rd_map_dashboard.clearHighlightLine();
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


	rd_map_dashboard.onActionEventMap = function(){
        
		bMap.graphics.on("click", function(fs) 
		{
			try
			{
				if(  action_click_bool  )
				{
					action_click_bool = false;
					var data_set = fs.graphic.attributes;
					bMap.infoWindow.hide();
					
					event_STEP = data_set.STEP;
					event_TYPE = data_set.TYPE;
					
					_dijitPopup.close(dialog);
		
					
					if( event_STEP == 1 && (event_TYPE == 'STATE_LYEAR' || event_TYPE == 'STATE_LYEAR_MARKER' || event_TYPE == 'STATE_LYEAR_TEXT_MARKER') )
					{
						state_id   = data_set.state_id;
						state_name = data_set.state_name;
						
						rd_map_dashboard.removeDiscomMarker();
						rd_map_dashboard.removeStateMarker();

			        	rd_map_dashboard.clearHighlightLine();
			        	rd_map_dashboard.addStateHighlightLine();   
		        		set_II_Lyears();	
		        		
		        		action_click_tim = setTimeout(  function(){ action_click_bool = true; } , 10000);
					}
					else if( (event_STEP == 2 || event_STEP == 22) && ( event_TYPE == 'DISCOM_LYEAR_MARKER') )
					{
						discom_id   = data_set.discom_id;
						discom_name = data_set.discom_name;
			        	mapLyears.forEach(function(infoGraphic, stateID, mapV) 
			        	{
			        		if(!(infoGraphic==null || infoGraphic=='undefined' || infoGraphic.attributes==null || infoGraphic.attributes=='undefined'))
			        		{    
			        			if(infoGraphic.attributes.TYPE == 'DISCOM_LYEAR_MARKER' &&  infoGraphic.attributes.state_id == state_id )
			        			{
			        				if( fs.graphic.attributes.discom_id == infoGraphic.attributes.discom_id )
			        				{
			        	                bMap.graphics.remove(infoGraphic);
			        	                
			        	                infoGraphic.symbol.height = 40;
			        	                infoGraphic.symbol.width  = 40;
			        	                bMap.graphics.add(infoGraphic);
			        				}
			        				else
			        				{
			        					bMap.graphics.remove(infoGraphic);        	                
			        	                infoGraphic.symbol.height = 27;
			        	                infoGraphic.symbol.width  = 27;
			        	                bMap.graphics.add(infoGraphic);
			        				}
			        			} 
			        		}    	    		
		    	    	});

		        		set_III_Lyears();
		        		action_click_tim = setTimeout(  function(){ action_click_bool = true; } , 10000);
					}
					else
					{
						action_click_bool = true;
					}
				}
			}
			catch(err){action_click_bool = true;}
		});
       
		bMap.graphics.on("mouse-over", function(fs) 
		{ 
			var data_set = fs.graphic.attributes;
			event_TYPE = data_set.TYPE;
			
			
			if(  event_TYPE == 'DISCOM_LYEAR_MARKER')
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
		});
		bMap.graphics.on("mouse-out", function(fs) 
		{ 
			_dijitPopup.close(dialog);
		});
		bMap.infoWindow.on("hide", function(fs) 
		{   

		});


	}; //END of onActionEventMap






	rd_map_dashboard.addStateHighlightLine = function(){

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
	rd_map_dashboard.setCenter = function(){

		bMap.setZoom( 5 );
    	bMap.centerAt(new esri.geometry.Point( centerAt ));  
	};
	
	rd_map_dashboard.setCenter_ = function(evt, obj){



	
	//debugger;
	var chart1 = $('#Anly_Chart_3').highcharts();
    //chart1.series[0].visible = false;

    chart1.series[4].visible = false;

	chart1.series[4].hide();
	
    //chart1.redraw();

    //chart3.series[3].data[0].setVisible(false);

	//chart.series[0].data[0].setVisible(false);


	};
	
	rd_map_dashboard.backToState = function(){

		event_STEP = 1;
		event_TYPE = 'STATE_LYEAR';
	
		rd_map_dashboard.removeDiscomMarker();
		rd_map_dashboard.removeStateMarker();

		set_II_Lyears();	
	}; 
	rd_map_dashboard.addStateDiscom = function(){
        
		var discom_details = rMap.get("discom_details");
		for(var i=0;  i<discom_details.length;  i++)
		{
			var step = 2;
            var url = home_path+"/gmap2/images/ico_2_1_2.png";
            var infoSymbol = new esri.symbol.PictureMarkerSymbol( url, 27, 27);
            
            if( parseInt(discom_details[i].count)==1 && discom_details[i].lat!=null && discom_details[i].lat>0 && discom_details[i].lng!=null && discom_details[i].lng>0)
            {
            	url = home_path+"/gmap2/images/ico_2_1_2.png";
            	infoSymbol = new esri.symbol.PictureMarkerSymbol( url, 27, 27);
            }
            else
            {
            	step = 22;
            	url = home_path+"/gmap2/images/ico_2_1_2_1.png";
            	infoSymbol = new esri.symbol.PictureMarkerSymbol( url, 27, 27);
            }
            
            var lng = discom_details[i].lng; 
            var lat = discom_details[i].lat;

				
            var myPosition = new esri.geometry.Point( lng, lat  );
            var marker_discom = new esri.Graphic( myPosition, infoSymbol );
            
            var marker = new esri.Graphic( myPosition, infoSymbol );
	           
	            marker.setAttributes( {
	            	"STEP"		: step, 
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
	
	
	rd_map_dashboard.clearHighlightLine = function(){

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
	}; 
	rd_map_dashboard.removeStateMarker = function(){
		
		for(var ii=0; ii<bMap.graphics.graphics.length; ii++)
		{
			try
			{
			    if( bMap.graphics.graphics[ii].attributes.TYPE == 'STATE_LYEAR_MARKER' )
				{
					bMap.graphics.remove(   bMap.graphics.graphics[ii] );
					
					if(ii>0) ii = ii-1;
				}
			}catch(err) {}
		}
	}
	rd_map_dashboard.removeDiscomMarker = function(){
		
		for(var ii=0; ii<bMap.graphics.graphics.length; ii++)
		{
			try
			{
			    if( bMap.graphics.graphics[ii].attributes.TYPE == 'DISCOM_LYEAR_MARKER' )
				{
					bMap.graphics.remove(   bMap.graphics.graphics[ii] );
					
					if(ii>0) ii = ii-1;
				}
			}catch(err) {}
		}
	}
	rd_map_dashboard.removeTownMarker = function(){
		
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
	
	//----------------------------------Chart---------------------------
	//----------------------------------Chart---------------------------
	//----------------------------------Chart---------------------------
	//----------------------------------Chart---------------------------
	//----------------------------------Chart---------------------------
	//----------------------------------Chart---------------------------
	//----------------------------------Chart---------------------------
	//----------------------------------Chart---------------------------
	//----------------------------------Chart---------------------------
	
	
	rd_map_dashboard.draw_Lable_1_step_1_chart = function(dataD){
		
		//var data            = dataD.stateList;
		//debugger;
		//rMap.set("state_details", 	data);
		
		if(reInitialize)
		{
			rd_map_dashboard.reInitialize();
		}
		else
		{
			reInitialize = true;
			//rd_map_dashboard.drawStateLayer();
		}
        dynamicURL(1);
        
        
		var hhe             	= dataD.households_electrified;
		var hemp            	= dataD.he_monthly_progress;
		//var rps             	= dataD.ruralPowerSupplyStatus;
		gbl_power_supply_status = dataD.powerSupplyStatus;

	    //-------------------------------------------------------------
		
		var hMap = dataD.headerMap;

		$("#ud").		html(    'On Board Feeders : '+        hMap["UD_OBJ"].totalfeederinmaster_1 );
		$("#ud2").		html(    'Communicating Feeders : '+   hMap["UD_OBJ"].feeder_data_avail_1 );
		
		$("#rd").		html(    'On Board Feeders : '+        hMap["RD_OBJ"].totalfeederinmaster );
		$("#rd2").		html(    'Communicating Feeders : '+   hMap["RD_OBJ"].nppfeeders );
		
		$("#capacity").	html(  parseFloat(hMap["CP_OBJ"].installed_capacity).toFixed(2)    +' MW');
		$("#dgen").     html(  parseFloat(hMap["GN_OBJ"].actual_generation).toFixed(2)     +' MU');
		
		$("#fnd_1").     html( 'IPDS : '  + parseFloat(hMap["FU_URS"]).toFixed(2)     +' cr');
		$("#fnd_2").     html( 'DDUGJY : '+ parseFloat(hMap["FU_RUS"]).toFixed(2)     +' cr');

		$("#trns_line"). html( hMap["TR_OBJ"].transmission_line_intra_state_ckm_cum +' CKM');
		$("#trns_cap").  html( hMap["TR_OBJ"].transform_capacity_mva_cumm           +' MVA');
		
		//------------------------------------------------------------------------
		doAnimateText_i_( $(rd) );
        doAnimateText_i_( $(rd2) );
        
		//------------------------L_Chart_1_1-------------------------------------
        try
        {
	        var electrified      = (hhe[0].electrified_households==null ) ? 0 : hhe[0].electrified_households;
	        var total_households = (hhe[0].total_households==null )       ? 0 : hhe[0].total_households;
	        var unelectrified    =  parseInt(total_households) - parseInt(electrified);
	        
	        var data_uev= 
        	       [
	                    ['Electrified'		    , electrified],
	                    ['To be Electrified'	, unelectrified] 
	               ];
        	glb_data_ch_1_v= 
        	       [
						['Electrified'		    , electrified],
						['To be Electrified'	, unelectrified] 
	               ];
	        
	        
	        var chart = $('#L_Chart_1').highcharts();
	        chart.series[0].setData( data_uev, false);
	        $('#L_Chart_1').highcharts().redraw();
	        
	        
	        var chart_pop = $('#L_Chart_1_pop').highcharts();
	        chart_pop.series[0].setData( data_uev, false);
	        $('#L_Chart_1_pop').highcharts().redraw();
	         
			// Progress of UE Villages GARV (as on 16/05/2016)
	        $("#L_Chart_1_Hdr_1").html("Households Electrification" );
	        $("#L_Chart_1_Hdr_1_date").html(  $.datepicker.formatDate('dd-M-yy',  new Date(hhe[0].reporting_date)) );
	        $("#L_Chart_1_Hdr_2").html("Households Electrification (as on - " + $.datepicker.formatDate('dd-M-yy',  new Date(hhe[0].reporting_date))  +")" );
        }
        catch(err){}
		//---------------------------Chart_1_2----------------------------------
		try
        {
        	var saturated_dist 		= (hhe[0].saturated_dist==null ) ? 0 : hhe[0].saturated_dist;
	        var total_dist 			= (hhe[0].total_dist==null )       ? 0 : hhe[0].total_dist;
	        var un_saturated_dist 	=  parseInt(total_dist) - parseInt(saturated_dist);

	        var data_11=
	        			[
			     		    ['Fully Electricfied ',  saturated_dist],
		                	['Under Progress     ',  un_saturated_dist]
		                ];
	        data_itet_name=
	        			[
			     		    ['Fully Electricfied ',  saturated_dist],
		                	['Under Progress     ',  un_saturated_dist]
		                ];
	        
	        
	        var chart = $('#L_Chart_2').highcharts();
	        chart.series[0].setData( data_11, false);
	        $('#L_Chart_2').highcharts().redraw();
	        
	        var chart_pop = $('#L_Chart_2_pop').highcharts();
	        chart_pop.series[0].setData( data_11, false);
	        $('#L_Chart_2_pop').highcharts().redraw();
	        
	        
	        $("#L_Chart_2_Hdr_1").html("Districts Saturated in Electrification" );
	        $("#L_Chart_2_Hdr_1_date").html(  $.datepicker.formatDate('dd-M-yy',   new Date(hhe[0].reporting_date))   );
	        $("#L_Chart_2_Hdr_2").html("Districts Saturated in Electrification   ( as on - "+ $.datepicker.formatDate('dd-M-yy',  new Date(hhe[0].reporting_date))  +")" );
        }
        catch(err) {}
		//---------------------------Chart_3----------------------------------
		try
        {
        	var saturated_villages 		= (hhe[0].saturated_villages==null )   ? 0 : hhe[0].saturated_villages;
	        var total_villages 			= (hhe[0].total_villages==null )       ? 0 : hhe[0].total_villages;
	        var un_saturated_villages 	=  parseInt(total_villages) - parseInt(saturated_villages);

	        var data_11=
	        			[
			     		    ['Fully Electricfied ',  saturated_villages],
		                	['Under Progress     ',  un_saturated_villages]
		                ];
	        data_vill_name=
	        			[
			     		    ['Fully Electricfied ',  saturated_villages],
		                	['Under Progress  ',  un_saturated_villages]
		                ];
	        
	        
	        var chart = $('#L_Chart_3').highcharts();
	        chart.series[0].setData( data_11, false);
	        $('#L_Chart_3').highcharts().redraw();
	        
	        var chart_pop = $('#L_Chart_3_pop').highcharts();
	        chart_pop.series[0].setData( data_11, false);
	        $('#L_Chart_3_pop').highcharts().redraw();
	        
	        
	        $("#L_Chart_3_Hdr_1").html("Villages Electrification ( 100% Saturated)" );
	        $("#L_Chart_3_Hdr_1_date").html(  $.datepicker.formatDate('dd-M-yy',   new Date(hhe[0].reporting_date))   );
	        $("#L_Chart_3_Hdr_2").html("Villages Electrification ( 100% Saturated)   ( as on - "+ $.datepicker.formatDate('dd-M-yy',  new Date(hhe[0].reporting_date))  +")" );
        }
        catch(err) {}
		//------------------------Chart_4-------------------------------------
		try
        {
        var cDate;
        var data_name = new Array();
        var data_val  = new Array();
       
        for(var i=0; i<hemp.length;i++)
        {
        	rd_hhe_progress_val[i]   = hemp[i].monthly_progress;
            rd_hhe_progress_month[i] = $.datepicker.formatDate('M-yy',   new Date(hemp[i].reporting_date)); //  Mon/Year
        	
        	cDate        = hemp[i].reporting_date;

        	if(i<6)
        	{
        		data_val[i]  = hemp[i].monthly_progress;
        		data_name[i] =  $.datepicker.formatDate('M-yy',   new Date(hemp[i].reporting_date)); //  Mon/Year
        	}
        }
        
        var chart1 = $('#L_Chart_4').highcharts();
        chart1.xAxis[0].setCategories( data_name );  
        chart1.series[0].setData( data_val, false);
        $('#L_Chart_4').highcharts().redraw();
        
        var chart2 = $('#L_Chart_4_pop').highcharts();
        chart2.xAxis[0].setCategories( rd_hhe_progress_month );  
        chart2.series[0].setData( rd_hhe_progress_val, false);
        $('#L_Chart_4_pop').highcharts().redraw();
        

        $("#L_Chart_4_Hdr_1").html("Households Electrification Progress." );
        $("#L_Chart_4_Hdr_1_date").html( 'as on -'+ $.datepicker.formatDate('dd-M-yy',   new Date(cDate))   );
        $("#L_Chart_4_Hdr_2").html("Households Electrification Progress   ( as on - "+ $.datepicker.formatDate('dd-M-yy',  new Date(cDate))  +")" );
        
        }
        catch(err) {}
		//-------------------------B_Chart_1------------------------------------
        /*
		var rps_date = null;
		var rps_val 	 	= new Array();
		var rps_sort_name  	= new Array();
	    
	    for(var i=0; i<rps.length;i++)
	    {
	    	rps_val[i] = rps[i].average_power_supply;
	    	rps_sort_name[i] = rps[i].state_short_name;
	    	rps_name[rps_sort_name[i]] = rps[i].state_name;
	    	
	    	rps_date = rps[i].reporting_date_start;
	    }

        var chart = $('#B_Chart_1').highcharts();
        chart.xAxis[0].setTitle({ text: 'State'  });
        chart.xAxis[0].setCategories( rps_sort_name );  
        chart.series[0].setData( rps_val, false);
        $('#B_Chart_1').highcharts().redraw();

        var chart_pop = $('#B_Chart_1_pop').highcharts();
        chart_pop.xAxis[0].setTitle({ text: 'State'  });
        chart_pop.xAxis[0].setCategories( rps_sort_name );  
        chart_pop.series[0].setData( rps_val, false);
        $('#B_Chart_1_pop').highcharts().redraw();

        $("#L_Chart_5_Hdr_1").html("Status of Rural Power Supply" );
        $("#L_Chart_5_Hdr_1_date").html( $.datepicker.formatDate('M-yy',  new Date(rps_date)) );
        $("#L_Chart_5_Hdr_2").html("Status of Rural Power Supply ( " + $.datepicker.formatDate('M-yy',  new Date(rps_date))  +")" );
        
        */
		//-------------------------------------------------------------

		//-------------------------------------------------------------
        //debugger;
        var flag_type = true;
		var gt_20_hr =0, betw_15_20_hr =0, betw_08_15_hr =0, les_08_hr =0;
		glb_data_val7         = [];	
		var feeders = 0;
		var rm_Data=null, ag_Data=null, eDate_1, eDate_2, rm_Type, ag_Type; 
		if( gbl_power_supply_status!=null && gbl_power_supply_status.length>0 )
		{
			if( gbl_power_supply_status[0].feeder_type==1) // Rural-2, Mixed-3
			{
					eDate_1 = gbl_power_supply_status[0].reportingmonthend; 
					rm_Type = gbl_power_supply_status[0].feeder_type;
					rm_Data = gbl_power_supply_status[0];
					flag_type = true;
			}
			else // Agriculture - 4
			{
					eDate_2 = gbl_power_supply_status[0].reportingmonthend; 
					ag_Type = gbl_power_supply_status[0].feeder_type;
					ag_Data = gbl_power_supply_status[0];
					flag_type = false;
			}
		}
		for(var i=1; gbl_power_supply_status!=null && i<gbl_power_supply_status.length;i++)
		{
			if(flag_type)
			{
				if(  eDate_1 == gbl_power_supply_status[i].reportingmonthend )
				{
						eDate_2 = gbl_power_supply_status[i].reportingmonthend; 
						ag_Type = gbl_power_supply_status[i].feeder_type;
						ag_Data = gbl_power_supply_status[i];
					    break;
				}
			}
			else
			{
				if(  eDate_1 == gbl_power_supply_status[i].reportingmonthend )
				{
						eDate_1 = gbl_power_supply_status[i].reportingmonthend; 
						rm_Type = gbl_power_supply_status[i].feeder_type;
						rm_Data = gbl_power_supply_status[i];
					    break;
				}
			}
		}

		reportingmonthend=eDate_1; 	
		

		
		//-----------------------------------------------------------------------------
		
		
		


        gt_20_hr 		= 	((rm_Data.gt_20_hr=='undefined' || rm_Data.gt_20_hr== null) ? 0 : parseInt(rm_Data.gt_20_hr)) +
                   			((ag_Data.gt_20_hr=='undefined' || ag_Data.gt_20_hr== null) ? 0 : parseInt(ag_Data.gt_20_hr));
        
        betw_15_20_hr 	=  	((rm_Data.betw_15_20_hr=='undefined' || rm_Data.betw_15_20_hr== null) ? 0 : parseInt(rm_Data.betw_15_20_hr)) +
        					((ag_Data.betw_15_20_hr=='undefined' || ag_Data.betw_15_20_hr== null) ? 0 : parseInt(ag_Data.betw_15_20_hr));

        betw_08_15_hr 	=  	((rm_Data.betw_08_15_hr=='undefined' || rm_Data.betw_08_15_hr== null) ? 0 : parseInt(rm_Data.betw_08_15_hr)) +
							((ag_Data.betw_08_15_hr=='undefined' || ag_Data.betw_08_15_hr== null) ? 0 : parseInt(ag_Data.betw_08_15_hr));

        les_08_hr   	=  	((rm_Data.les_08_hr=='undefined' || rm_Data.les_08_hr== null) ? 0 : parseInt(rm_Data.les_08_hr)) +
							((ag_Data.les_08_hr=='undefined' || ag_Data.les_08_hr== null) ? 0 : parseInt(ag_Data.les_08_hr));
        		   

        //Total Transactional Feeders
        feeders = ((rm_Data.feeders_t=='undefined' || rm_Data.feeders_t== null) ? 0 : parseInt(rm_Data.feeders_t)) +
        		  ((ag_Data.feeders_t=='undefined' || ag_Data.feeders_t== null) ? 0 : parseInt(ag_Data.feeders_t));
        
        
        
        //ToolTips

        m1 = (rm_Data.feeders_m=='undefined' || rm_Data.feeders_m== null) ? 0 : parseInt(rm_Data.feeders_m) ;
		m3 = (ag_Data.feeders_m=='undefined' || ag_Data.feeders_m== null) ? 0 : parseInt(ag_Data.feeders_m) ;
        m2 = 0;

        
        t1 = (rm_Data.feeders_t=='undefined' || rm_Data.feeders_t== null) ? 0 : parseInt(rm_Data.feeders_t);
        t3 = (ag_Data.feeders_t=='undefined' || ag_Data.feeders_t== null) ? 0 : parseInt(ag_Data.feeders_t);
        t2 = 0;
        
		tooltips_sup[0] = {Rural_m :m1, Mixed_m : m2, Agriculture_m :m3,    Rural_t :t1, Mixed_t : t2, Agriculture_t :t3}
		

        t1 = (rm_Data.gt_20_hr=='undefined' || rm_Data.gt_20_hr== null) ? 0 : parseInt(rm_Data.gt_20_hr) ;
		t3 = (ag_Data.gt_20_hr=='undefined' || ag_Data.gt_20_hr== null) ? 0 : parseInt(ag_Data.gt_20_hr) ;
		tooltips_sup[1] = {Rural_t :t1, Mixed_t : t2, Agriculture_t :t3}
		
		
		t1 = (rm_Data.betw_15_20_hr=='undefined' || rm_Data.betw_15_20_hr== null) ? 0 : parseInt(rm_Data.betw_15_20_hr) ;
		t3 = (ag_Data.betw_15_20_hr=='undefined' || ag_Data.betw_15_20_hr== null) ? 0 : parseInt(ag_Data.betw_15_20_hr) ;
		tooltips_sup[2] = {Rural_t :t1, Mixed_t : t2, Agriculture_t :t3}
		
		
		t1 = (rm_Data.betw_08_15_hr=='undefined' || rm_Data.betw_08_15_hr== null) ? 0 : parseInt(rm_Data.betw_08_15_hr) ;
		t3 = (ag_Data.betw_08_15_hr=='undefined' || ag_Data.betw_08_15_hr== null) ? 0 : parseInt(ag_Data.betw_08_15_hr) ;
		tooltips_sup[3] = {Rural_t :t1, Mixed_t : t2, Agriculture_t :t3}
		
		
		t1 = (rm_Data.les_08_hr=='undefined' || rm_Data.les_08_hr== null) ? 0 : parseInt(rm_Data.les_08_hr) ;
		t3 = (ag_Data.les_08_hr=='undefined' || ag_Data.les_08_hr== null) ? 0 : parseInt(ag_Data.les_08_hr) ;
		tooltips_sup[4] = {Rural_t :t1, Mixed_t : t2, Agriculture_t :t3}

        //------------------------------------------
		
		
        
		//debugger;

    	glb_data_val7[0] = gt_20_hr;
    	glb_data_val7[1] = betw_15_20_hr;
    	glb_data_val7[2] = betw_08_15_hr;
    	glb_data_val7[3] = les_08_hr;
    	
	
        
        var chart1 = $('#B_Chart_7').highcharts();
        
        chart1.setTitle(null, {text: "Total Feeders (11KV Only) : "+feeders});
        chart1.series[0].setData( glb_data_val7, false);
        $('#B_Chart_7').highcharts().redraw();
        			                            			        
        var chart2 = $('#B_Chart_7_pop').highcharts(); 
        chart2.setTitle(null, {text: "Total Feeders (11KV Only) : "+feeders});

        chart2.series[0].setData( glb_data_val7, false);
        $('#B_Chart_7_pop').highcharts().redraw();
        
        // Progress of BPL HHs (till Aug-2016)	
        $("#BChart_7_Hdr_1").html("Avg. Power Supply Monitoring Statistics (In Hrs)" );
        $("#BChart_7_Hdr_1_date").html(  $.datepicker.formatDate('M-yy',  new Date(reportingmonthend))    );
        $("#BChart_7_Hdr_2").html("Avg. Power Supply Monitoring Statistics (In Hrs) (" + $.datepicker.formatDate('M-yy',  new Date(reportingmonthend))  +")" );

		//-------------------------------------------------------------
        //-------------------------------------------------------------
        //-------------------------------------------------------------
        //-------------------------------------------------------------
        //-------------------------------------------------------------
		
        
        
		

		
		var uSaifi          = dataD.utilSaifi;
		var uSaifiAgr       = dataD.utilSaifiAgr;
		var uSaifi33kv      = dataD.utilSaifi33kv;

		//------------------------------------------------------------------11KV with Rural and Mixed
		try
        {
	    var feeder_count = 0;	
        var cDate;
        var data_name = new Array();
        var data_val  = new Array();
        saifi_val     = new Array();
        saifi_name    = new Array();
        for(var i=0; i<uSaifi.length;i++)
        {
        	saifi_val[i]  = parseFloat(parseFloat( uSaifi[i].interruption_no).toFixed(2));    
            saifi_name[i] = uSaifi[i].organization_abbrevation;
        	cDate         = uSaifi[i].month_period_end;

        	if(i<6)
        	{
                data_val[i]  = parseFloat(parseFloat( uSaifi[i].interruption_no).toFixed(2));       
                data_name[i] = uSaifi[i].organization_abbrevation;
        	}
        	
        	feeder_count = feeder_count + uSaifi[i].feeder_count;
        }

        var chart1 = $('#B1_Chart_1').highcharts();
        chart1.xAxis[0].setCategories( data_name );  
        chart1.series[0].setData( data_val, false);
        chart1.xAxis[0].setTitle({text: '11KV Feeders ( Rural and Mixed ) : '+feeder_count});
        $('#B1_Chart_1').highcharts().redraw();

        var chart2 = $('#B1_Chart_1_pop').highcharts();
        chart2.xAxis[0].setCategories( saifi_name );  
        chart2.series[0].setData( saifi_val, false);
        chart2.xAxis[0].setTitle({text: '11KV Feeders ( Rural and Mixed ) : '+feeder_count});
        $('#B1_Chart_1_pop').highcharts().redraw();

        $("#B1Chart_1_Hdr_1").html("Avg. No. of Interruptions (Power Supply Outage)" );
        $("#B1Chart_1_Hdr_1_date").html(""+ $.datepicker.formatDate('M-yy',  new Date(cDate))  +"" );
        $("#B1Chart_1_Hdr_2").html("Average No. of Interruptions (Power Supply Outage) for ("+ $.datepicker.formatDate('M-yy',  new Date(cDate))  +")");
        }
        catch(err) {}
        //------------------------------------------------------------------// 11KV with Agriculture
        try
        {
	    var feeder_count = 0;
        var cDate;
        var data_name = new Array();
        var data_val  = new Array();

        saifi_val_Agr     = new Array();
        saifi_name_Agr    = new Array();
        for(var i=0; i<uSaifiAgr.length;i++)
        {
        	saifi_val_Agr[i]  = parseFloat(parseFloat( uSaifiAgr[i].interruption_no).toFixed(2));    
            saifi_name_Agr[i] = uSaifiAgr[i].organization_abbrevation;
        	cDate         = uSaifiAgr[i].month_period_end;

        	if(i<6)
        	{
                data_val[i]  = parseFloat(parseFloat( uSaifiAgr[i].interruption_no).toFixed(2));       
                data_name[i] = uSaifiAgr[i].organization_abbrevation;
        	}
        	feeder_count = feeder_count + uSaifiAgr[i].feeder_count;
        }

        var chart1 = $('#B1_Chart_2').highcharts();
        chart1.xAxis[0].setCategories( data_name );  
        chart1.series[0].setData( data_val, false);
        chart1.xAxis[0].setTitle({text: '11KV Feeders ( Agriculture ) : '+feeder_count});
        $('#B1_Chart_2').highcharts().redraw();

        var chart2 = $('#B1_Chart_2_pop').highcharts();
        chart2.xAxis[0].setCategories( saifi_name_Agr );  
        chart2.series[0].setData( saifi_val_Agr, false);
        chart2.xAxis[0].setTitle({text: '11KV Feeders ( Agriculture ) : '+feeder_count});
        $('#B1_Chart_2_pop').highcharts().redraw();

        $("#B1Chart_2_Hdr_1").html("Avg. No. of Interruptions (Power Supply Outage)" ); 
        $("#B1Chart_2_Hdr_1_date").html(""+ $.datepicker.formatDate('M-yy',  new Date(cDate))  +"" );
        $("#B1Chart_2_Hdr_2").html("Average No. of Interruptions (Power Supply Outage) for ("+ $.datepicker.formatDate('M-yy',  new Date(cDate))  +")");
        }
        catch(err) {}
        //------------------------------------------------------------------33KV Above
        try
        {
	    var feeder_count = 0;
	    var cDate;
        var data_name = new Array();
        var data_val  = new Array();
        saifi_val_33kv     = new Array();
        saifi_name_33kv    = new Array();
        for(var i=0; i<uSaifi33kv.length;i++)
        {
        	saifi_val_33kv[i]  = parseFloat(parseFloat( uSaifi33kv[i].interruption_no).toFixed(2));    
            saifi_name_33kv[i] = uSaifi33kv[i].organization_abbrevation;
        	cDate         = uSaifi33kv[i].month_period_end;

        	if(i<6)
        	{
                data_val[i]  = parseFloat(parseFloat( uSaifi33kv[i].interruption_no).toFixed(2));       
                data_name[i] = uSaifi33kv[i].organization_abbrevation;
        	}
        	feeder_count = feeder_count + uSaifi33kv[i].feeder_count;
        }

        var chart1 = $('#B1_Chart_3').highcharts();
        chart1.xAxis[0].setCategories( data_name );  
        chart1.series[0].setData( data_val, false);
        chart1.xAxis[0].setTitle({text: '33KV & Above Feeders : '+feeder_count});
        $('#B1_Chart_3').highcharts().redraw();

        var chart2 = $('#B1_Chart_3_pop').highcharts();
        chart2.xAxis[0].setCategories( saifi_name_33kv );  
        chart2.series[0].setData( saifi_val_33kv, false);
        chart2.xAxis[0].setTitle({text: '33KV & Above Feeders : '+feeder_count});
        $('#B1_Chart_3_pop').highcharts().redraw();

        $("#B1Chart_3_Hdr_1").html("Avg. No. of Interruptions (Power Supply Outage)" );
        $("#B1Chart_3_Hdr_1_date").html(""+ $.datepicker.formatDate('M-yy',  new Date(cDate))  +"" );
        $("#B1Chart_3_Hdr_2").html("Average No. of Interruptions (Power Supply Outage) for ("+ $.datepicker.formatDate('M-yy',  new Date(cDate))  +")");
        }
        catch(err) {}	
		//-------------------------------------------------------------
		//------------------------------------------------------------------11KV with Rural and Mixed
		try
        {
        var cDate;
        var feeder_count = 0;
        var data_name = new Array();
        var data_val  = new Array();
        
        saidi_val     = new Array();
        saidi_name    = new Array();
        
        for(var i=0; i<uSaifi.length;i++)
        {
        	var val_sec_H = parseInt(parseInt( uSaifi[i].interruption_duration )/3600);
        	var val_sec_M = (parseInt(  parseInt(uSaifi[i].interruption_duration)/60  ))%60;
        	    val_sec_M = parseInt(val_sec_M)<10 ? '0'+val_sec_M : val_sec_M;
        	//alert(  uSaifi.length+'<<<HH:MM-->'+val_sec_H+'.'+val_sec_M   );
        	saidi_val[i]  = parseFloat(val_sec_H+'.'+val_sec_M);//parseFloat(parseFloat( uSaifi[i].interruption_duration).toFixed(2));      
            saidi_name[i] = uSaifi[i].organization_abbrevation;

            cDate         = uSaifi[i].month_period_end;
        	
        	if(i<6)
        	{
                data_val[i]  = parseFloat(val_sec_H+'.'+val_sec_M);//parseFloat(parseFloat( uSaifi[i].interruption_duration).toFixed(2));    
                data_name[i] = uSaifi[i].organization_abbrevation;
        	}
        	feeder_count = feeder_count + uSaifi[i].feeder_count;
        }
        
        var chart1 = $('#B2_Chart_1').highcharts();
        chart1.xAxis[0].setCategories( data_name );  
        chart1.series[0].setData( data_val, false);
        chart1.xAxis[0].setTitle({text: '11KV Feeders ( Rural and Mixed ) : '+feeder_count});
        $('#B2_Chart_1').highcharts().redraw();
        
        
        var chart2 = $('#B2_Chart_1_pop').highcharts();
        chart2.xAxis[0].setCategories( saidi_name );  
        chart2.series[0].setData( saidi_val, false);
        chart2.xAxis[0].setTitle({text: '11KV Feeders ( Rural and Mixed ) : '+feeder_count});
        $('#B2_Chart_1_pop').highcharts().redraw();

        $("#B2Chart_1_Hdr_1").html("Avg. Duration of Interruptions (Power Supply Outage)" );
        $("#B2Chart_1_Hdr_1_date").html(" "+ $.datepicker.formatDate('M-yy',  new Date(cDate))  +"" );
        $("#B2Chart_1_Hdr_2").html("Average Duration of Interruptions (Power Supply Outage) for ("+ $.datepicker.formatDate('M-yy',  new Date(cDate))  +")");
        }
        catch(err) {}
      	//------------------------------------------------------------------// 11KV with Agriculture
        try
        {
        var cDate;
        var feeder_count = 0;
        var data_name = new Array();
        var data_val  = new Array();
        saidi_val_Agr     = new Array();
        saidi_name_Agr    = new Array();
        
        for(var i=0; i<uSaifiAgr.length;i++)
        {
        	var val_sec_H = parseInt(parseInt( uSaifiAgr[i].interruption_duration )/3600);
        	var val_sec_M = (parseInt(  parseInt(uSaifiAgr[i].interruption_duration)/60  ))%60;
        	    val_sec_M = parseInt(val_sec_M)<10 ? '0'+val_sec_M : val_sec_M;
        	//alert(  uSaifiAgr.length+'<<<HH:MM-->'+val_sec_H+'.'+val_sec_M   );
        	saidi_val_Agr[i]  = parseFloat(val_sec_H+'.'+val_sec_M);//parseFloat(parseFloat( uSaifi[i].interruption_duration).toFixed(2));      
            saidi_name_Agr[i] = uSaifiAgr[i].organization_abbrevation;

            cDate         = uSaifiAgr[i].month_period_end;
        	
        	if(i<6)
        	{
                data_val[i]  = parseFloat(val_sec_H+'.'+val_sec_M);//parseFloat(parseFloat( uSaifi[i].interruption_duration).toFixed(2));    
                data_name[i] = uSaifiAgr[i].organization_abbrevation;
        	}
        	feeder_count = feeder_count + uSaifiAgr[i].feeder_count;
        }
        
        var chart1 = $('#B2_Chart_2').highcharts();
        chart1.xAxis[0].setCategories( data_name );  
        chart1.series[0].setData( data_val, false);
        chart1.xAxis[0].setTitle({text: '11KV Feeders ( Agriculture ) : '+feeder_count});
        $('#B2_Chart_2').highcharts().redraw();
        
        var chart2 = $('#B2_Chart_2_pop').highcharts();
        chart2.xAxis[0].setCategories( saidi_name_Agr );  
        chart2.series[0].setData( saidi_val_Agr, false);
        chart2.xAxis[0].setTitle({text: '11KV Feeders ( Agriculture ) : '+feeder_count});
        $('#B2_Chart_2_pop').highcharts().redraw();
        
        $("#B2Chart_2_Hdr_1").html("Avg. Duration of Interruptions (Power Supply Outage)" );
        $("#B2Chart_2_Hdr_1_date").html(" "+ $.datepicker.formatDate('M-yy',  new Date(cDate))  +"" );
        $("#B2Chart_2_Hdr_2").html("Average Duration of Interruptions (Power Supply Outage) for ("+ $.datepicker.formatDate('M-yy',  new Date(cDate))  +")");
        }
        catch(err) {}
      	//------------------------------------------------------------------33KV Above
        try
        {
        var cDate;
        var feeder_count = 0;
        var data_name = new Array();
        var data_val  = new Array();
        saidi_val_33kv     = new Array();
        saidi_name_33kv    = new Array();
        
        for(var i=0; i<uSaifi33kv.length;i++)
        {
        	var val_sec_H = parseInt(parseInt( uSaifi33kv[i].interruption_duration )/3600);
        	var val_sec_M = (parseInt(  parseInt(uSaifi33kv[i].interruption_duration)/60  ))%60;
        	    val_sec_M = parseInt(val_sec_M)<10 ? '0'+val_sec_M : val_sec_M;
        	//alert(  uSaifi33kv.length+'<<<HH:MM-->'+val_sec_H+'.'+val_sec_M   );
        	saidi_val_33kv[i]  = parseFloat(val_sec_H+'.'+val_sec_M);//parseFloat(parseFloat( uSaifi33kv[i].interruption_duration).toFixed(2));      
            saidi_name_33kv[i] = uSaifi33kv[i].organization_abbrevation;

            cDate         = uSaifi33kv[i].month_period_end;
        	
        	if(i<6)
        	{
                data_val[i]  = parseFloat(val_sec_H+'.'+val_sec_M);//parseFloat(parseFloat( uSaifi[i].interruption_duration).toFixed(2));    
                data_name[i] = uSaifi33kv[i].organization_abbrevation;
        	}
        	feeder_count = feeder_count + uSaifi33kv[i].feeder_count;
        }
        
        var chart1 = $('#B2_Chart_3').highcharts();
        chart1.xAxis[0].setCategories( data_name );  
        chart1.series[0].setData( data_val, false);
        chart1.xAxis[0].setTitle({text: '33KV & Above Feeders : '+feeder_count});
        $('#B2_Chart_3').highcharts().redraw();
        
        
        var chart2 = $('#B2_Chart_3_pop').highcharts();
        chart2.xAxis[0].setCategories( saidi_name_33kv );  
        chart2.series[0].setData( saidi_val_33kv, false);
        chart2.xAxis[0].setTitle({text: '33KV & Above Feeders : '+feeder_count});
        $('#B2_Chart_3_pop').highcharts().redraw();

        $("#B2Chart_3_Hdr_1").html("Avg. Duration of Interruptions (Power Supply Outage)" );
        $("#B2Chart_3_Hdr_1_date").html(" "+ $.datepicker.formatDate('M-yy',  new Date(cDate))  +"" );
        $("#B2Chart_3_Hdr_2").html("Average Duration of Interruptions (Power Supply Outage) for ("+ $.datepicker.formatDate('M-yy',  new Date(cDate))  +")");
        }
        catch(err) {}
        //--------------------------------------------------------------------
		
        
        setTimeout(  function(){ clearTimeout(action_click_tim); action_click_bool = true; } , 300);
		
		
	}
	rd_map_dashboard.draw_Lable_1_step_2_chart = function(dataD){
		//------------Avg. Power Supply Monitoring Statistics (In Hrs)-----------
		//---------------------------------------------------------ToolTips
		var data            = dataD.ruralPowerSupplyCategoryWise;
		
		var m1=0, t1=0; // Rural
		var m2=0, t2=0; // Mixed
		var m3=0, t3=0; // Agriculture
		tooltips_sup = new Array();
		
		for(var i=0; i<data.length; i++)
		{
			if( data[i].feeder_type==2 ) m1 = m1 + data[i].feeder_id_m;  // Rural
			if( data[i].feeder_type==3 ) m2 = m2 + data[i].feeder_id_m;  // Mixed
			if( data[i].feeder_type==4 ) m3 = m3 + data[i].feeder_id_m;  // Agriculture							

			if( data[i].hrs_supply>0 ) 
			{
				if( data[i].feeder_type==2 ) t1 = t1 + data[i].feeder_id_t; // Rural
				if( data[i].feeder_type==3 ) t2 = t2 + data[i].feeder_id_t; // Mixed
				if( data[i].feeder_type==4 ) t3 = t3 + data[i].feeder_id_t; // Agriculture
			}									
		}
		tooltips_sup[0] = {Rural_m :m1, Mixed_m : m2, Agriculture_m :m3,    Rural_t :t1, Mixed_t : t2, Agriculture_t :t3}

		t1=0; t2=0;  t3=0; 
		for(var i=0; i<data.length; i++)
		{
			if( data[i].hrs_supply == 1 ) // Greater Than 20 Hr
			{
				if( data[i].feeder_type==2 ) t1 = t1 + data[i].feeder_id_t; // Rural
				if( data[i].feeder_type==3 ) t2 = t2 + data[i].feeder_id_t; // Mixed
				if( data[i].feeder_type==4 ) t3 = t3 + data[i].feeder_id_t; // Agriculture
			}								
		}
		tooltips_sup[1] = {Rural_t :t1, Mixed_t : t2, Agriculture_t :t3}
		
		t1=0; t2=0;  t3=0; 
		for(var i=0; i<data.length; i++)
		{
			if( data[i].hrs_supply == 2 ) // 15-20 Hr
			{
				if( data[i].feeder_type==2 ) t1 = t1 + data[i].feeder_id_t; // Rural
				if( data[i].feeder_type==3 ) t2 = t2 + data[i].feeder_id_t; // Mixed
				if( data[i].feeder_type==4 ) t3 = t3 + data[i].feeder_id_t; // Agriculture
			}								
		}
		tooltips_sup[2] = {Rural_t :t1, Mixed_t : t2, Agriculture_t :t3}

		t1=0; t2=0;  t3=0; 
		for(var i=0; i<data.length; i++)
		{
			if( data[i].hrs_supply == 3 ) // 15- <=20 Hr
			{
				if( data[i].feeder_type==2 ) t1 = t1 + data[i].feeder_id_t; // Rural
				if( data[i].feeder_type==3 ) t2 = t2 + data[i].feeder_id_t; // Mixed
				if( data[i].feeder_type==4 ) t3 = t3 + data[i].feeder_id_t; // Agriculture
			}								
		}
		tooltips_sup[3] = {Rural_t :t1, Mixed_t : t2, Agriculture_t :t3}
		
		t1=0; t2=0;  t3=0; 
		for(var i=0; i<data.length; i++)
		{
			if( data[i].hrs_supply == 4 ) // Less than 8 Hr
			{
				if( data[i].feeder_type==2 ) t1 = t1 + data[i].feeder_id_t; // Rural
				if( data[i].feeder_type==3 ) t2 = t2 + data[i].feeder_id_t; // Mixed
				if( data[i].feeder_type==4 ) t3 = t3 + data[i].feeder_id_t; // Agriculture
			}								
		}
		tooltips_sup[4] = {Rural_t :t1, Mixed_t : t2, Agriculture_t :t3}

	}
	
	
	
	
	
	//**************************************************************/
	rd_map_dashboard.draw_Lable_2_step_1_chart = function(dataD){
		
		rMap.set("discom_details", dataD.discomDetailsList );
		rd_map_dashboard.addStateDiscom();
		
		dynamicURL( 2 );
		
		
		var hhe             		= dataD.households_electrified;
		var hemp            		= dataD.he_monthly_progress;
		//var rps             		= dataD.ruralPowerSupplyStatus;
		gbl_power_supply_status     = dataD.powerSupplyStatus;
		var rAtc            		= dataD.discomDetails;

		
        
		//------------------------L_Chart_1_1-------------------------------------
        try
        {
	        var electrified      = (hhe[0].electrified_households==null ) ? 0 : hhe[0].electrified_households;
	        var total_households = (hhe[0].total_households==null )       ? 0 : hhe[0].total_households;
	        var unelectrified    =  parseInt(total_households) - parseInt(electrified);
	        
	        var data_uev= 
        	       [
	                    ['Electrified'		    , electrified],
	                    ['To be Electrified'	, unelectrified] 
	               ];
        	glb_data_ch_1_v= 
        	       [
						['Electrified'		    , electrified],
						['To be Electrified'	, unelectrified] 
	               ];
	        
	        
	        var chart = $('#L_Chart_1').highcharts();
	        chart.series[0].setData( data_uev, false);
	        $('#L_Chart_1').highcharts().redraw();
	        
	        
	        var chart_pop = $('#L_Chart_1_pop').highcharts();
	        chart_pop.series[0].setData( data_uev, false);
	        $('#L_Chart_1_pop').highcharts().redraw();
	         
			// Progress of UE Villages GARV (as on 16/05/2016)
	        $("#L_Chart_1_Hdr_1").html("Households Electrification" );
	        $("#L_Chart_1_Hdr_1_date").html(  $.datepicker.formatDate('dd-M-yy',  new Date(hhe[0].reporting_date)) );
	        $("#L_Chart_1_Hdr_2").html("Households Electrification (as on - " + $.datepicker.formatDate('dd-M-yy',  new Date(hhe[0].reporting_date))  +")" );
        }
        catch(err){}
		//---------------------------Chart_1_2----------------------------------
	    try
        {
        	var saturated_dist 		= (hhe[0].saturated_dist==null ) ? 0 : hhe[0].saturated_dist;
	        var total_dist 			= (hhe[0].total_dist==null )       ? 0 : hhe[0].total_dist;
	        var un_saturated_dist 	=  parseInt(total_dist) - parseInt(saturated_dist);

	        var data_11=
	        			[
			     		    ['Fully Electricfied ',  saturated_dist],
		                	['Under Progress     ',  un_saturated_dist]
		                ];
	        data_itet_name=
	        			[
			     		    ['Fully Electricfied ',  saturated_dist],
		                	['Under Progress     ',  un_saturated_dist]
		                ];
	        
	        
	        var chart = $('#L_Chart_2').highcharts();
	        chart.series[0].setData( data_11, false);
	        $('#L_Chart_2').highcharts().redraw();
	        
	        var chart_pop = $('#L_Chart_2_pop').highcharts();
	        chart_pop.series[0].setData( data_11, false);
	        $('#L_Chart_2_pop').highcharts().redraw();
	        
	        
	        $("#L_Chart_2_Hdr_1").html("Districts Saturated in Electrification" );
	        $("#L_Chart_2_Hdr_1_date").html(  $.datepicker.formatDate('dd-M-yy',   new Date(hhe[0].reporting_date))   );
	        $("#L_Chart_2_Hdr_2").html("Districts Saturated in Electrification   ( as on - "+ $.datepicker.formatDate('dd-M-yy',  new Date(hhe[0].reporting_date))  +")" );
        }
        catch(err) {}
        //---------------------------Chart_3----------------------------------
        try
        {
        	var saturated_villages 		= (hhe[0].saturated_villages==null )   ? 0 : hhe[0].saturated_villages;
	        var total_villages 			= (hhe[0].total_villages==null )       ? 0 : hhe[0].total_villages;
	        var un_saturated_villages 	=  parseInt(total_villages) - parseInt(saturated_villages);

	        var data_11=
	        			[
			     		    ['Fully Electricfied ',  saturated_villages],
		                	['Under Progress     ',  un_saturated_villages]
		                ];
	        data_vill_name=
	        			[
			     		    ['Fully Electricfied ',  saturated_villages],
		                	['Under Progress     ',  un_saturated_villages]
		                ];
	        
	        
	        var chart = $('#L_Chart_3').highcharts();
	        chart.series[0].setData( data_11, false);
	        $('#L_Chart_3').highcharts().redraw();
	        
	        var chart_pop = $('#L_Chart_3_pop').highcharts();
	        chart_pop.series[0].setData( data_11, false);
	        $('#L_Chart_3_pop').highcharts().redraw();
	        
	        
	        $("#L_Chart_3_Hdr_1").html("Villages Electrification ( 100% Saturated)" );
	        $("#L_Chart_3_Hdr_1_date").html(  $.datepicker.formatDate('dd-M-yy',   new Date(hhe[0].reporting_date))   );
	        $("#L_Chart_3_Hdr_2").html("Villages Electrification ( 100% Saturated)   ( as on - "+ $.datepicker.formatDate('dd-M-yy',  new Date(hhe[0].reporting_date))  +")" );
        }
        catch(err) {}
        //------------------------Chart_4-------------------------------------
        try
        {
        var cDate;
        var data_name = new Array();
        var data_val  = new Array();
        
        rd_hhe_progress_val   = new Array();
        rd_hhe_progress_month = new Array();
       
        for(var i=0; i<hemp.length;i++)
        {
        	rd_hhe_progress_val[i]   = hemp[i].monthly_progress;
            rd_hhe_progress_month[i] = $.datepicker.formatDate('M-yy',   new Date(hemp[i].reporting_date)); //  Mon/Year
        	
        	cDate        = hemp[i].reporting_date;
        	
        	if(i<6)
        	{
        		data_val[i]  = hemp[i].monthly_progress;
        		data_name[i] =  $.datepicker.formatDate('M-yy',   new Date(hemp[i].reporting_date)); //  Mon/Year
        	}
        }
         
        
        var chart1 = $('#L_Chart_4').highcharts();
        chart1.xAxis[0].setCategories( data_name );  
        chart1.series[0].setData( data_val, false);
        $('#L_Chart_4').highcharts().redraw();
        
        var chart2 = $('#L_Chart_4_pop').highcharts();
        chart2.xAxis[0].setCategories( rd_hhe_progress_month );  
        chart2.series[0].setData( rd_hhe_progress_val, false);
        $('#L_Chart_4_pop').highcharts().redraw();
        

        $("#L_Chart_4_Hdr_1").html("Households Electrification Progress." );
        $("#L_Chart_4_Hdr_1_date").html( 'as on -'+ $.datepicker.formatDate('dd-M-yy',   new Date(cDate))   );
        $("#L_Chart_4_Hdr_2").html("Households Electrification Progress   ( as on - "+ $.datepicker.formatDate('dd-M-yy',  new Date(cDate))  +")" );
        }
        catch(err) {}
       //------------------------L_Chart_5-------------------------------------
        /*
        try
        {
            var rps_date 		= null;
			var rps_val 	 	= new Array();
			var rps_sort_name  	= new Array();
		    
		    for(var i=0; i<rps.length;i++)
		    {
		    	rps_val[i] = rps[i].average_power_supply;
		    	rps_sort_name[i] = rps[i].discom_name;
		    	rps_name[rps_sort_name[i]] = rps[i].discom_name;
		    	
		    	rps_date = rps[i].reportingmonthstart;
		    }
    
	        var chart = $('#B_Chart_2').highcharts();
	        chart.xAxis[0].setTitle({ text: 'Discom'  });
	        chart.xAxis[0].setCategories( rps_sort_name );  
	        chart.series[0].setData( rps_val, false);
	        $('#B_Chart_2').highcharts().redraw();

	        var chart_pop = $('#B_Chart_1_pop').highcharts();
	        chart_pop.xAxis[0].setTitle({ text: 'Discom'  });
	        chart_pop.xAxis[0].setCategories( rps_sort_name );  
	        chart_pop.series[0].setData( rps_val, false);
	        $('#B_Chart_1_pop').highcharts().redraw();

	        $("#L_Chart_6_Hdr_1").html("Status of Rural Power Supply" );
	        if(rps_date==null)
	        {
		        $("#L_Chart_6_Hdr_1_date").html('');
		        $("#L_Chart_5_Hdr_2").html("Status of Rural Power Supply ( )" );
	        }
	        else
	        {
	        	$("#L_Chart_6_Hdr_1_date").html( $.datepicker.formatDate('M-yy',  new Date(rps_date)) );
		        $("#L_Chart_5_Hdr_2").html("Status of Rural Power Supply ( " + $.datepicker.formatDate('M-yy',  new Date(rps_date))  +")" );
	        }
        }
	    catch(err) {}
		*/
		//-------------------------------------------------------------

	    
	    
	    /*****************Atc_Chart****************************/
		$("#BChart_2_Hdr_1").html( "AT&C Loss of Feeders (Discom wise)" );
		$("#BChart_2_Hdr_2").html( "AT&C Loss of Feeders (Discom wise)" );

		//-----------------------------------------
		
		for (var j = 0; j < 5; j++) 
		for (var i = 0; i < 5; i++) 
		{
			var rChart_1 = $('#Atc_Chart').highcharts();
			var rChart_2 = $('#Atc_Chart_pop').highcharts();
			try
			{
				rChart_1.series[i].remove();
				rChart_2.series[i].remove();
			}
			catch(err) {}
	    }							
		
		
        for(var number_of_chart=1; number_of_chart<=5;number_of_chart++)// draw maximum number of chart
        {   
        	var countIndex = 0;
        	var disName = "";
        	var name =["","","",""];
        	var valu =["","","",""];
        
            for(var i=0; i<rAtc.length;i++)
	        {
            	if(parseInt(rAtc[i].index) == parseInt(number_of_chart))
            	{
                	name[countIndex] = rAtc[i].vts_name;
                	valu[countIndex] = rAtc[i].count;
                	countIndex = countIndex + 1;
                	
                	disName = rAtc[i].discom_name;
                	stDate  = rAtc[i].reportingmonthstart;
	            	enDate  = rAtc[i].reportingmonthend;
            	}
	        }
            
            if(disName=='') continue;
        
           
	         $('#Atc_Chart').highcharts().addSeries({
                
	        	 type: 'pie', 
	        	 showInLegend: (number_of_chart==1) ? true : false,
	        	 name: 'Number of Feeders',
	        	 
	             data: [
	                    { name: name[0],  y: valu[0]  },
	                    { name: name[1],  y: valu[1]  },
	                    { name: name[2],  y: valu[2]  },
	                    { name: name[3],  y: valu[3]  },
	                    { name: name[4],  y: valu[4]  }
	                ],
	                
	                title: {
	                    align: 'center',
	                    text: '<b>'+disName+'\t</b> <br> \t'+$.datepicker.formatDate('M-yy',  new Date(enDate)),
	                    verticalAlign: 'top',
	                    verticalAlign: 'top',
	                    y: 150,
	                },
	                    
	                    
	                center: [(number_of_chart*330)-150,50],
	                size: 150   

            }); 
	         
	         $('#Atc_Chart_pop').highcharts().addSeries({
                    
	        	 type: 'pie', 
	        	 showInLegend: (number_of_chart==1) ? true : false,
	        	 name: 'Number of Feeders',
	        	 
	             data: [
	                    { name: name[0],  y: valu[0]  },
	                    { name: name[1],  y: valu[1]  },
	                    { name: name[2],  y: valu[2]  },
	                    { name: name[3],  y: valu[3]  },
	                    { name: name[4],  y: valu[4]  }
	                ],
	                
	                title: {
	                    align: 'center',
	                    text: '<b>'+disName+'\t</b> <br> \t'+$.datepicker.formatDate('M-yy',  new Date(enDate)),
	                    verticalAlign: 'top',
	                    verticalAlign: 'top',
	                    y: 150,
	                },
	                    
	                    
	                center: [(number_of_chart*220)-160,150],
	                size: 120   

            }); 

        }
        /***************************************************/
		//-------------------------------------------------------------

		//-------------------------------------------------------------


        var flag_type = true;
		var gt_20_hr =0, betw_15_20_hr =0, betw_08_15_hr =0, les_08_hr =0;
		glb_data_val7         = [];	
		var feeders = 0;
		var rm_Data=null, ag_Data=null, eDate_1, eDate_2, rm_Type, ag_Type; 
		
		if( gbl_power_supply_status!=null && gbl_power_supply_status.length>0 )
		{
			if( gbl_power_supply_status[0].feeder_type==1) // Rural-2, Mixed-3
			{
					eDate_1 = gbl_power_supply_status[0].reportingmonthend; 
					rm_Type = gbl_power_supply_status[0].feeder_type;
					rm_Data = gbl_power_supply_status[0];
					flag_type = true;
			}
			else // Agriculture - 4
			{
					eDate_2 = gbl_power_supply_status[0].reportingmonthend; 
					ag_Type = gbl_power_supply_status[0].feeder_type;
					ag_Data = gbl_power_supply_status[0];
					flag_type = false;
			}
		}
		for(var i=1; gbl_power_supply_status!=null && i<gbl_power_supply_status.length;i++)
		{
			if(flag_type)
			{
				if(  eDate_1 == gbl_power_supply_status[i].reportingmonthend )
				{
						eDate_2 = gbl_power_supply_status[i].reportingmonthend; 
						ag_Type = gbl_power_supply_status[i].feeder_type;
						ag_Data = gbl_power_supply_status[i];
					    break;
				}
			}
			else
			{
				if(  eDate_1 == gbl_power_supply_status[i].reportingmonthend )
				{
						eDate_1 = gbl_power_supply_status[i].reportingmonthend; 
						rm_Type = gbl_power_supply_status[i].feeder_type;
						rm_Data = gbl_power_supply_status[i];
					    break;
				}
			}
		}
		reportingmonthend=eDate_1; 	
		

		
		//-----------------------------------------------------------------------------
		

        gt_20_hr 		= 	((rm_Data==null || rm_Data.gt_20_hr=='undefined' || rm_Data.gt_20_hr== null) ? 0 : parseInt(rm_Data.gt_20_hr)) +
                   			((ag_Data==null || ag_Data.gt_20_hr=='undefined' || ag_Data.gt_20_hr== null) ? 0 : parseInt(ag_Data.gt_20_hr));
        
        betw_15_20_hr 	=  	((rm_Data==null || rm_Data.betw_15_20_hr=='undefined' || rm_Data.betw_15_20_hr== null) ? 0 : parseInt(rm_Data.betw_15_20_hr)) +
        					((ag_Data==null || ag_Data.betw_15_20_hr=='undefined' || ag_Data.betw_15_20_hr== null) ? 0 : parseInt(ag_Data.betw_15_20_hr));

        betw_08_15_hr 	=  	((rm_Data==null || rm_Data.betw_08_15_hr=='undefined' || rm_Data.betw_08_15_hr== null) ? 0 : parseInt(rm_Data.betw_08_15_hr)) +
							((ag_Data==null || ag_Data.betw_08_15_hr=='undefined' || ag_Data.betw_08_15_hr== null) ? 0 : parseInt(ag_Data.betw_08_15_hr));

        les_08_hr   	=  	((rm_Data==null || rm_Data.les_08_hr=='undefined' || rm_Data.les_08_hr== null) ? 0 : parseInt(rm_Data.les_08_hr)) +
							((ag_Data==null || ag_Data.les_08_hr=='undefined' || ag_Data.les_08_hr== null) ? 0 : parseInt(ag_Data.les_08_hr));
        		   

        //Total Transactional Feeders
        feeders = ((rm_Data==null || rm_Data.feeders_t=='undefined' || rm_Data.feeders_t== null) ? 0 : parseInt(rm_Data.feeders_t)) +
        		  ((ag_Data==null || ag_Data.feeders_t=='undefined' || ag_Data.feeders_t== null) ? 0 : parseInt(ag_Data.feeders_t));
        
        
        
        //ToolTips

        m1 = (rm_Data==null || rm_Data.feeders_m=='undefined' || rm_Data.feeders_m== null) ? 0 : parseInt(rm_Data.feeders_m) ;
		m3 = (ag_Data==null || ag_Data.feeders_m=='undefined' || ag_Data.feeders_m== null) ? 0 : parseInt(ag_Data.feeders_m) ;
        m2 = 0;

        
        t1 = (rm_Data==null || rm_Data.feeders_t=='undefined' || rm_Data.feeders_t== null) ? 0 : parseInt(rm_Data.feeders_t);
        t3 = (ag_Data==null || ag_Data.feeders_t=='undefined' || ag_Data.feeders_t== null) ? 0 : parseInt(ag_Data.feeders_t);
        t2 = 0;
        
		tooltips_sup[0] = {Rural_m :m1, Mixed_m : m2, Agriculture_m :m3,    Rural_t :t1, Mixed_t : t2, Agriculture_t :t3}
		

        t1 = (rm_Data==null || rm_Data.gt_20_hr=='undefined' || rm_Data.gt_20_hr== null) ? 0 : parseInt(rm_Data.gt_20_hr) ;
		t3 = (ag_Data==null || ag_Data.gt_20_hr=='undefined' || ag_Data.gt_20_hr== null) ? 0 : parseInt(ag_Data.gt_20_hr) ;
		tooltips_sup[1] = {Rural_t :t1, Mixed_t : t2, Agriculture_t :t3}
		
		
		t1 = (rm_Data==null || rm_Data.betw_15_20_hr=='undefined' || rm_Data.betw_15_20_hr== null) ? 0 : parseInt(rm_Data.betw_15_20_hr) ;
		t3 = (ag_Data==null || ag_Data.betw_15_20_hr=='undefined' || ag_Data.betw_15_20_hr== null) ? 0 : parseInt(ag_Data.betw_15_20_hr) ;
		tooltips_sup[2] = {Rural_t :t1, Mixed_t : t2, Agriculture_t :t3}
		
		
		t1 = (rm_Data==null || rm_Data.betw_08_15_hr=='undefined' || rm_Data.betw_08_15_hr== null) ? 0 : parseInt(rm_Data.betw_08_15_hr) ;
		t3 = (ag_Data==null || ag_Data.betw_08_15_hr=='undefined' || ag_Data.betw_08_15_hr== null) ? 0 : parseInt(ag_Data.betw_08_15_hr) ;
		tooltips_sup[3] = {Rural_t :t1, Mixed_t : t2, Agriculture_t :t3}
		
		
		t1 = (rm_Data==null || rm_Data.les_08_hr=='undefined' || rm_Data.les_08_hr== null) ? 0 : parseInt(rm_Data.les_08_hr) ;
		t3 = (ag_Data==null || ag_Data.les_08_hr=='undefined' || ag_Data.les_08_hr== null) ? 0 : parseInt(ag_Data.les_08_hr) ;
		tooltips_sup[4] = {Rural_t :t1, Mixed_t : t2, Agriculture_t :t3}

        //------------------------------------------
		
		
        
		//debugger;

    	glb_data_val7[0] = gt_20_hr;
    	glb_data_val7[1] = betw_15_20_hr;
    	glb_data_val7[2] = betw_08_15_hr;
    	glb_data_val7[3] = les_08_hr;
    	
	
        
        var chart1 = $('#B_Chart_7').highcharts();
        
        chart1.setTitle(null, {text: "Total Feeders (11KV Only) : "+feeders});
        chart1.series[0].setData( glb_data_val7, false);
        $('#B_Chart_7').highcharts().redraw();
        			                            			        
        var chart2 = $('#B_Chart_7_pop').highcharts(); 
        chart2.setTitle(null, {text: "Total Feeders (11KV Only) : "+feeders});

        chart2.series[0].setData( glb_data_val7, false);
        $('#B_Chart_7_pop').highcharts().redraw();
        
        // Progress of BPL HHs (till Aug-2016)	
        $("#BChart_7_Hdr_1").html("Avg. Power Supply Monitoring Statistics (In Hrs)" );
        $("#BChart_7_Hdr_1_date").html(  $.datepicker.formatDate('M-yy',  new Date(reportingmonthend))    );
        $("#BChart_7_Hdr_2").html("Avg. Power Supply Monitoring Statistics (In Hrs) (" + $.datepicker.formatDate('M-yy',  new Date(reportingmonthend))  +")" );
        
       

/*
        try
        {   
        	debugger;
        
        	reportingmonthend=state_frps.reportingmonthend; 	
        	glb_data_val7         = [];	
        	//glb_data_val7[0] = (state_frps.hrs24    =='undefined' || state_frps.hrs24    == null) ? 0 : parseInt(state_frps.hrs24);
        	glb_data_val7[0] = (state_frps.les24gt20=='undefined' || state_frps.les24gt20== null) ? 0 : parseInt(state_frps.les24gt20);
        	glb_data_val7[1] = (state_frps.les20gt15=='undefined' || state_frps.les20gt15== null) ? 0 : parseInt(state_frps.les20gt15);
        	glb_data_val7[2] = (state_frps.les15gt10=='undefined' || state_frps.les15gt10== null) ? 0 : parseInt(state_frps.les15gt10);
        	glb_data_val7[3] = (state_frps.hrs10les =='undefined' || state_frps.hrs10les == null) ? 0 : parseInt(state_frps.hrs10les);

        	var chart1 = $('#B_Chart_7').highcharts(); 
        	chart1.setTitle(null, {text: "Total Feeders (11KV Only) : "+state_frps.feeders});
	        chart1.series[0].setData( glb_data_val7, false);
	        $('#B_Chart_7').highcharts().redraw();
	        
	        var chart2 = $('#B_Chart_7_pop').highcharts(); 
        	chart2.setTitle(null, {text: "Total Feeders (11KV Only) : "+state_frps.feeders});
	        chart2.series[0].setData( glb_data_val7, false);
	        $('#B_Chart_7_pop').highcharts().redraw();
	        
	        if(reportingmonthend=='undefined' || reportingmonthend == null)
	        {
	        	$("#B1Chart_7_Hdr_1").html("Avg. Power Supply Monitoring Statistics (In Hrs)" );
		        $("#BChart_7_Hdr_1_date").html( '' );
		        $("#BChart_7_Hdr_2").html("Avg. Power Supply Monitoring Statistics (In Hrs) ( )" );
	        }
	        else
	        {
	        	$("#B1Chart_7_Hdr_1").html("Avg. Power Supply Monitoring Statistics (In Hrs)" );
		        $("#BChart_7_Hdr_1_date").html(  $.datepicker.formatDate('M-yy',  new Date(reportingmonthend))    );
		        $("#BChart_7_Hdr_2").html("Avg. Power Supply Monitoring Statistics (In Hrs) ( " + $.datepicker.formatDate('M-yy',  new Date(reportingmonthend))  +")" );
	        }
	        

        }catch(err) { }	
*/
        

		//-------------------------------------------------------------
		//-------------------------------------------------------------
        //-------------------------------------------------------------
        //-------------------------------------------------------------
        //-------------------------------------------------------------
        //-------------------------------------------------------------
		
        
        
		

		//debugger;
        var uSaifi          = dataD.utilSaifi;
		var uSaifiAgr       = dataD.utilSaifiAgr;
		var uSaifi33kv      = dataD.utilSaifi33kv;

        //------------------------------------------------------------------11KV with Rural and Mixed
	    try
        {
	    var feeder_count = 0;		
        var cDate;
        var data_name = new Array();
        var data_val  = new Array();
        saifi_val     = new Array();
        saifi_name    = new Array();
        for(var i=0; i<uSaifi.length;i++)
        {
        	saifi_val[i]  = parseFloat(parseFloat( uSaifi[i].interruption_no).toFixed(2));    
          saifi_name[i] = uSaifi[i].organization_abbrevation;
        	cDate         = uSaifi[i].month_period_end;

        	if(i<6)
        	{
                data_val[i]  = parseFloat(parseFloat( uSaifi[i].interruption_no).toFixed(2));       
                data_name[i] = uSaifi[i].organization_abbrevation;
        	}
        	feeder_count = feeder_count + uSaifi[i].feeder_count;
        }

        var chart1 = $('#B1_Chart_1').highcharts(); 
        chart1.xAxis[0].setCategories( data_name );  
        chart1.series[0].setData( data_val, false);
        chart1.xAxis[0].setTitle({text: '11KV Feeders ( Rural and Mixed ) : '+feeder_count});
        $('#B1_Chart_1').highcharts().redraw();

        var chart2 = $('#B1_Chart_1_pop').highcharts();
        chart2.xAxis[0].setCategories( saifi_name );  
        chart2.series[0].setData( saifi_val, false);
        chart2.xAxis[0].setTitle({text: '11KV Feeders ( Rural and Mixed ) : '+feeder_count});
        $('#B1_Chart_1_pop').highcharts().redraw();

        $("#B1Chart_1_Hdr_1").html("Average No. of Interruptions (Power Supply Outage)" );
        $("#B1Chart_1_Hdr_1_date").html(""+ $.datepicker.formatDate('M-yy',  new Date(cDate))  +"" );
        $("#B1Chart_1_Hdr_2").html("Average No. of Interruptions (Power Supply Outage) for ("+ $.datepicker.formatDate('M-yy',  new Date(cDate))  +")");
        }
        catch(err) {}
        //------------------------------------------------------------------// 11KV with Agriculture
	    try
        {
	    var feeder_count = 0;
        var cDate;
        var data_name = new Array();
        var data_val  = new Array();

        saifi_val_Agr     = new Array();
        saifi_name_Agr    = new Array();
        for(var i=0; i<uSaifiAgr.length;i++)
        {
        	saifi_val_Agr[i]  = parseFloat(parseFloat( uSaifiAgr[i].interruption_no).toFixed(2));    
          saifi_name_Agr[i] = uSaifiAgr[i].organization_abbrevation;
        	cDate         = uSaifiAgr[i].month_period_end;

        	if(i<6)
        	{
                data_val[i]  = parseFloat(parseFloat( uSaifiAgr[i].interruption_no).toFixed(2));       
                data_name[i] = uSaifiAgr[i].organization_abbrevation;
        	}
        	feeder_count = feeder_count + uSaifiAgr[i].feeder_count;
        }

        var chart1 = $('#B1_Chart_2').highcharts();
        chart1.xAxis[0].setCategories( data_name );  
        chart1.series[0].setData( data_val, false);
        chart1.xAxis[0].setTitle({text: '11KV Feeders ( Agriculture ) : '+feeder_count});
        $('#B1_Chart_2').highcharts().redraw();

        var chart2 = $('#B1_Chart_2_pop').highcharts();
        chart2.xAxis[0].setCategories( saifi_name_Agr );  
        chart2.series[0].setData( saifi_val_Agr, false);
        chart2.xAxis[0].setTitle({text: '11KV Feeders ( Agriculture ) : '+feeder_count});
        $('#B1_Chart_2_pop').highcharts().redraw();

        $("#B1Chart_2_Hdr_1").html("Average No. of Interruptions (Power Supply Outage)" ); 
        $("#B1Chart_2_Hdr_1_date").html(""+ $.datepicker.formatDate('M-yy',  new Date(cDate))  +"" );
        $("#B1Chart_2_Hdr_2").html("Average No. of Interruptions (Power Supply Outage) for ("+ $.datepicker.formatDate('M-yy',  new Date(cDate))  +")");
        }
        catch(err) {}
        //------------------------------------------------------------------33KV Above
	    try
        {
	    var feeder_count = 0;
        var cDate;
        var data_name = new Array();
        var data_val  = new Array();
        saifi_val_33kv     = new Array();
        saifi_name_33kv    = new Array();
        for(var i=0; i<uSaifi33kv.length;i++)
        {
        	saifi_val_33kv[i]  = parseFloat(parseFloat( uSaifi33kv[i].interruption_no).toFixed(2));    
          saifi_name_33kv[i] = uSaifi33kv[i].organization_abbrevation;
        	cDate         = uSaifi33kv[i].month_period_end;

        	if(i<6)
        	{
                data_val[i]  = parseFloat(parseFloat( uSaifi33kv[i].interruption_no).toFixed(2));       
                data_name[i] = uSaifi33kv[i].organization_abbrevation;
        	}
        	feeder_count = feeder_count + uSaifi33kv[i].feeder_count;
        }

        var chart1 = $('#B1_Chart_3').highcharts();
        chart1.xAxis[0].setCategories( data_name );  
        chart1.series[0].setData( data_val, false);
        chart1.xAxis[0].setTitle({text: '33KV & Above Feeders : '+feeder_count});
        $('#B1_Chart_3').highcharts().redraw();

        var chart2 = $('#B1_Chart_3_pop').highcharts();
        chart2.xAxis[0].setCategories( saifi_name_33kv );  
        chart2.series[0].setData( saifi_val_33kv, false);
        chart2.xAxis[0].setTitle({text: '33KV & Above Feeders : '+feeder_count});
        $('#B1_Chart_3_pop').highcharts().redraw();

        $("#B1Chart_3_Hdr_1").html("Average No. of Interruptions (Power Supply Outage)" );
        $("#B1Chart_3_Hdr_1_date").html(""+ $.datepicker.formatDate('M-yy',  new Date(cDate))  +"" );
        $("#B1Chart_3_Hdr_2").html("Average No. of Interruptions (Power Supply Outage) for ("+ $.datepicker.formatDate('M-yy',  new Date(cDate))  +")");
        }
        catch(err) {}	
        
        
        /***************************************************/

	   try
       {
        var cDate;
        var feeder_count = 0;
        var data_name = new Array();
        var data_val  = new Array();
        saidi_val     = new Array();
        saidi_name    = new Array();
        for(var i=0; i<uSaifi.length;i++)
        {  // dataList[i].billing_efficiency.toFixed(2) 
        	//saidi_val[i]  = (uSaidi[i].interruption_duration).toFixed(2);
        
        	var val_sec_H = parseInt(parseInt( uSaifi[i].interruption_duration )/3600);
        	var val_sec_M = (parseInt(  parseInt(uSaifi[i].interruption_duration)/60  ))%60;
        	
        	saidi_val[i]  = parseFloat(val_sec_H+'.'+val_sec_M); //saidi_val[i]  = parseFloat(parseFloat( uSaifi[i].interruption_duration ).toFixed(2));
        	
          saidi_name[i] = uSaifi[i].organization_abbrevation;
        	cDate         = uSaifi[i].month_period_end;
        	//alert(saidi_val[i]+"<-->"+saidi_name[i]+"<-->"+cDate);
        	if(i<6)
        	{
                data_val[i]  = parseFloat(val_sec_H+'.'+val_sec_M);//parseFloat(parseFloat( uSaifi[i].interruption_duration ).toFixed(2));
                data_name[i] = uSaifi[i].organization_abbrevation;
        	}
        	feeder_count = feeder_count + uSaifi[i].feeder_count;
        }
        
        var chart1 = $('#B2_Chart_1').highcharts();
        chart1.xAxis[0].setCategories( data_name );  
        chart1.series[0].setData( data_val, false);
        chart1.xAxis[0].setTitle({text: '11KV Feeders ( Rural and Mixed ) : '+feeder_count});
        $('#B2_Chart_1').highcharts().redraw();
        
        
        var chart2 = $('#B2_Chart_1_pop').highcharts();
        chart2.xAxis[0].setCategories( saidi_name );  
        chart2.series[0].setData( saidi_val, false);
        chart2.xAxis[0].setTitle({text: '11KV Feeders ( Rural and Mixed ) : '+feeder_count});
        $('#B2_Chart_1_pop').highcharts().redraw();
        
        
        	
        $("#B1Chart_6_Hdr_1").html("Average Duration of Interruptions (Power Supply Outage)" );
        $("#BChart_6_Hdr_1_date").html(" "+ $.datepicker.formatDate('M-yy',  new Date(cDate))  +"" );
        $("#BChart_6_Hdr_2").html("Average Duration of Interruptions (Power Supply Outage) for ("+ $.datepicker.formatDate('M-yy',  new Date(cDate))  +")");
        }
        catch(err) {}	
        //------------------------------------------------------------------// 11KV with Agriculture

        try
        {
        var cDate;
        var feeder_count = 0;
        var data_name = new Array();
        var data_val  = new Array();
        saidi_val_Agr     = new Array();
        saidi_name_Agr    = new Array();
        
        for(var i=0; i<uSaifiAgr.length;i++)
        {
        	var val_sec_H = parseInt(parseInt( uSaifiAgr[i].interruption_duration )/3600);
        	var val_sec_M = (parseInt(  parseInt(uSaifiAgr[i].interruption_duration)/60  ))%60;
        	//alert(  uSaifiAgr.length+'<<<HH:MM-->'+val_sec_H+'.'+val_sec_M   );
        	saidi_val_Agr[i]  = parseFloat(val_sec_H+'.'+val_sec_M);//parseFloat(parseFloat( uSaifi[i].interruption_duration).toFixed(2));      
          saidi_name_Agr[i] = uSaifiAgr[i].organization_abbrevation;

          cDate         = uSaifiAgr[i].month_period_end;
        	
        	if(i<6)
        	{
                data_val[i]  = parseFloat(val_sec_H+'.'+val_sec_M);//parseFloat(parseFloat( uSaifi[i].interruption_duration).toFixed(2));    
                data_name[i] = uSaifiAgr[i].organization_abbrevation;
        	}
        	feeder_count = feeder_count + uSaifiAgr[i].feeder_count;
        }
        
        var chart1 = $('#B2_Chart_2').highcharts();
        chart1.xAxis[0].setCategories( data_name );  
        chart1.series[0].setData( data_val, false);
        chart1.xAxis[0].setTitle({text: '11KV Feeders ( Agriculture ) : '+feeder_count});
        $('#B2_Chart_2').highcharts().redraw();
        
        
        var chart2 = $('#B2_Chart_2_pop').highcharts();
        chart2.xAxis[0].setCategories( saidi_name_Agr );  
        chart2.series[0].setData( saidi_val_Agr, false);
        chart2.xAxis[0].setTitle({text: '11KV Feeders ( Agriculture ) : '+feeder_count});
        $('#B2_Chart_2_pop').highcharts().redraw();
        
        //alert(   $.datepicker.formatDate('M-yy',  new Date(cDate))   );

        $("#B2Chart_2_Hdr_1").html("Avg. Duration of Interruptions (Power Supply Outage)" );
        $("#B2Chart_2_Hdr_1_date").html(" "+ $.datepicker.formatDate('M-yy',  new Date(cDate))  +"" );
        $("#B2Chart_2_Hdr_2").html("Average Duration of Interruptions (Power Supply Outage) for ("+ $.datepicker.formatDate('M-yy',  new Date(cDate))  +")");
        }
        catch(err) {}

      	//------------------------------------------------------------------33KV Above
        try
        {
        var cDate;
        var feeder_count = 0;
        var data_name = new Array();
        var data_val  = new Array();
        saidi_val_33kv     = new Array();
        saidi_name_33kv    = new Array();
        
        for(var i=0; i<uSaifi33kv.length;i++)
        {
        	var val_sec_H = parseInt(parseInt( uSaifi33kv[i].interruption_duration )/3600);
        	var val_sec_M = (parseInt(  parseInt(uSaifi33kv[i].interruption_duration)/60  ))%60;
        	//alert(  uSaifi33kv.length+'<<<HH:MM-->'+val_sec_H+'.'+val_sec_M   );
        	saidi_val_33kv[i]  = parseFloat(val_sec_H+'.'+val_sec_M);//parseFloat(parseFloat( uSaifi33kv[i].interruption_duration).toFixed(2));      
          saidi_name_33kv[i] = uSaifi33kv[i].organization_abbrevation;

          cDate         = uSaifi33kv[i].month_period_end;
        	
        	if(i<6)
        	{
                data_val[i]  = parseFloat(val_sec_H+'.'+val_sec_M);//parseFloat(parseFloat( uSaifi[i].interruption_duration).toFixed(2));    
                data_name[i] = uSaifi33kv[i].organization_abbrevation;
        	}
        	feeder_count = feeder_count + uSaifi33kv[i].feeder_count;
        }
        

        var chart1 = $('#B2_Chart_3').highcharts();
        chart1.xAxis[0].setCategories( data_name );  
        chart1.series[0].setData( data_val, false);
        chart1.xAxis[0].setTitle({text: '33KV & Above Feeders : '+feeder_count});
        $('#B2_Chart_3').highcharts().redraw();
        
        
        var chart2 = $('#B2_Chart_3_pop').highcharts();
        chart2.xAxis[0].setCategories( saidi_name_33kv );  
        chart2.series[0].setData( saidi_val_33kv, false);
        chart2.xAxis[0].setTitle({text: '33KV & Above Feeders : '+feeder_count});
        $('#B2_Chart_3_pop').highcharts().redraw();
        
        //alert(   $.datepicker.formatDate('M-yy',  new Date(cDate))   );

        $("#B2Chart_3_Hdr_1").html("Avg. Duration of Interruptions (Power Supply Outage)" );
        $("#B2Chart_3_Hdr_1_date").html(" "+ $.datepicker.formatDate('M-yy',  new Date(cDate))  +"" );
        $("#B2Chart_3_Hdr_2").html("Average Duration of Interruptions (Power Supply Outage) for ("+ $.datepicker.formatDate('M-yy',  new Date(cDate))  +")");
        }
        catch(err) {}
        
        
        
        
		
		
		setTimeout(  function(){ clearTimeout(action_click_tim); action_click_bool = true; } , 300);
	}
	
	
	
	rd_map_dashboard.view_more_chart = function(dataD)
	{
		
		if(dataD!=null)
		{  
			var uSaifi = dataD.utilSaifi;
			gbl_power_supply_status = dataD.powerSupplyStatus;
	        try
	        {
		        var  month_sd_name  = new Array();
		        var  month_safidi_count = 0;
		        
		        var  p_val_rm_1_1 = new Array();
		        var  p_val_ag_1_2 = new Array();
		        var  p_val_33_1_3 = new Array();
		        var  p_val_rm_2_1 = new Array();
		        var  p_val_ag_2_2 = new Array();
		        var  p_val_33_2_3 = new Array();
		        
		        var  d_val_rm_1_1 = new Array();
		        var  d_val_ag_1_2 = new Array();
		        var  d_val_33_1_3 = new Array();
		        var  d_val_rm_2_1 = new Array();
		        var  d_val_ag_2_2 = new Array();
		        var  d_val_33_2_3 = new Array();

		        var Data_1=null, Data_2=null, eDate_1, eDate_2, rm_Type, ag_Type; 
				
				for(var i=0; uSaifi!=null && i<uSaifi.length;i++)
				{
						Data_1 = uSaifi[i];
						//debugger;
				        var count_11kv_rm 		= 	((Data_1.feeder_count_11kv_rm=='undefined' 			  || Data_1.feeder_count_11kv_rm== null) 			? 0 : parseInt(Data_1.feeder_count_11kv_rm)) ;
				        var saifi_11kv_rm 		= 	((Data_1.interruption_no_11kv_rm=='undefined' 		  || Data_1.interruption_no_11kv_rm== null) 		? 0 : parseInt(Data_1.interruption_no_11kv_rm)) ;
				        var saidi_11kv_rm 		= 	((Data_1.interruption_duration_11kv_rm=='undefined'   || Data_1.interruption_duration_11kv_rm== null)   ? 0 : parseInt(Data_1.interruption_duration_11kv_rm)) ;
				        var val_sec_H 			=	 parseInt(parseInt( saidi_11kv_rm )/3600);
			        	var val_sec_M 			= 	(parseInt(  parseInt(saidi_11kv_rm)/60  ))%60;
			        	    val_sec_M           =   parseInt(val_sec_M)<10 ? '0'+val_sec_M : val_sec_M;
			        	saidi_11kv_rm           =   parseFloat(parseFloat( val_sec_H+'.'+val_sec_M  ).toFixed(2));
			        	
				        
				        var count_11kv_ag 		= 	((Data_1.feeder_count_11kv_ag=='undefined' 			  || Data_1.feeder_count_11kv_ag== null) 			? 0 : parseInt(Data_1.feeder_count_11kv_ag)) ;
				        var saifi_11kv_ag 		= 	((Data_1.interruption_no_11kv_ag=='undefined' 		  || Data_1.interruption_no_11kv_ag== null) 		? 0 : parseInt(Data_1.interruption_no_11kv_ag)) ;
				        var saidi_11kv_ag 		= 	((Data_1.interruption_duration_11kv_ag=='undefined'   || Data_1.interruption_duration_11kv_ag== null)   ? 0 : parseInt(Data_1.interruption_duration_11kv_ag)) ;
				        val_sec_H 				=	 parseInt(parseInt( saidi_11kv_ag )/3600);
			        	val_sec_M 				= 	(parseInt(  parseInt(saidi_11kv_ag)/60  ))%60;
			        	val_sec_M               =   parseInt(val_sec_M)<10 ? '0'+val_sec_M : val_sec_M;
			        	saidi_11kv_ag           =   parseFloat(parseFloat( val_sec_H+'.'+val_sec_M  ).toFixed(2));
				         
				        var count_11kv_33 		= 	((Data_1.feeder_count_33kv=='undefined' 		 || Data_1.feeder_count_33kv== null) 	      ? 0 : parseInt(Data_1.feeder_count_33kv)) ;
				        var saifi_11kv_33 		= 	((Data_1.interruption_no_33kv=='undefined' 	     || Data_1.interruption_no_33kv== null) 	  ? 0 : parseInt(Data_1.interruption_no_33kv)) ;
				        var saidi_11kv_33 		= 	((Data_1.interruption_duration_33kv=='undefined' || Data_1.interruption_duration_33kv== null) ? 0 : parseInt(Data_1.interruption_duration_33kv)) ;
				        val_sec_H 				=	 parseInt(parseInt( saidi_11kv_33 )/3600);
			        	val_sec_M 				= 	(parseInt(  parseInt(saidi_11kv_33)/60  ))%60;
			        	val_sec_M               =   parseInt(val_sec_M)<10 ? '0'+val_sec_M : val_sec_M;
			        	saidi_11kv_33           =   parseFloat(parseFloat( val_sec_H+'.'+val_sec_M  ).toFixed(2));
				        
				        month_sd_name[month_safidi_count] = ''+  $.datepicker.formatDate('M-yy',  new Date(Data_1.month_period_end))  +'';
								
						p_val_rm_1_1[month_safidi_count]  = { 'feeders_count':count_11kv_rm, 'name':month_sd_name[month_safidi_count], 'y' : saifi_11kv_rm }; 
						p_val_ag_1_2[month_safidi_count]  = { 'feeders_count':count_11kv_ag, 'name':month_sd_name[month_safidi_count], 'y' : saifi_11kv_ag };
						p_val_33_1_3[month_safidi_count]  = { 'feeders_count':count_11kv_33, 'name':month_sd_name[month_safidi_count], 'y' : saifi_11kv_33 };

						d_val_rm_1_1[month_safidi_count]  = { 'feeders_count':count_11kv_rm, 'name':month_sd_name[month_safidi_count], 'y' : saidi_11kv_rm }; 
						d_val_ag_1_2[month_safidi_count]  = { 'feeders_count':count_11kv_ag, 'name':month_sd_name[month_safidi_count], 'y' : saidi_11kv_ag };
						d_val_33_1_3[month_safidi_count]  = { 'feeders_count':count_11kv_33, 'name':month_sd_name[month_safidi_count], 'y' : saidi_11kv_33 };
							
						if( uSaifi.length > (i+12)   )
						{
							Data_2 = uSaifi[i+12];
							
					        var count_11kv__rm 		= 	((Data_2.feeder_count_11kv_rm=='undefined' 			  || Data_2.feeder_count_11kv_rm== null) 			? 0 : parseInt(Data_2.feeder_count_11kv_rm)) ;
					        var saifi_11kv__rm 		= 	((Data_2.interruption_no_11kv_rm=='undefined' 		  || Data_2.interruption_no_11kv_rm== null) 		? 0 : parseInt(Data_2.interruption_no_11kv_rm)) ;
					        var saidi_11kv__rm 		= 	((Data_2.interruption_duration_11kv_rm=='undefined'   || Data_2.interruption_duration_11kv_rm== null)   ? 0 : parseInt(Data_2.interruption_duration_11kv_rm)) ;
					        val_sec_H 				=	 parseInt(parseInt( saidi_11kv__rm )/3600);
				        	val_sec_M 				= 	(parseInt(  parseInt(saidi_11kv__rm)/60  ))%60;
				        	val_sec_M               =   parseInt(val_sec_M)<10 ? '0'+val_sec_M : val_sec_M;
				        	saidi_11kv__rm          =   parseFloat(parseFloat( val_sec_H+'.'+val_sec_M  ).toFixed(2));

					        
					        var count_11kv__ag 		= 	((Data_2.feeder_count_11kv_ag=='undefined' 			  || Data_2.feeder_count_11kv_ag== null) 			? 0 : parseInt(Data_2.feeder_count_11kv_ag)) ;
					        var saifi_11kv__ag 		= 	((Data_2.interruption_no_11kv_ag=='undefined' 		  || Data_2.interruption_no_11kv_ag== null) 		? 0 : parseInt(Data_2.interruption_no_11kv_ag)) ;
					        var saidi_11kv__ag 		= 	((Data_2.interruption_duration_11kv_ag=='undefined'   || Data_2.interruption_duration_11kv_ag== null)   ? 0 : parseInt(Data_2.interruption_duration_11kv_ag)) ;
					        val_sec_H 				=	 parseInt(parseInt( saidi_11kv__ag )/3600);
				        	val_sec_M 				= 	(parseInt(  parseInt(saidi_11kv__ag)/60  ))%60;
				        	val_sec_M               =   parseInt(val_sec_M)<10 ? '0'+val_sec_M : val_sec_M;
				        	saidi_11kv__ag          =   parseFloat(parseFloat( val_sec_H+'.'+val_sec_M  ).toFixed(2));
				        	
					        var count_11kv__33 		= 	((Data_2.feeder_count_33kv=='undefined' 		 || Data_2.feeder_count_33kv== null) 			? 0 : parseInt(Data_2.feeder_count_33kv)) ;
					        var saifi_11kv__33 		= 	((Data_2.interruption_no_33kv=='undefined' 	     || Data_2.interruption_no_33kv== null) 		? 0 : parseInt(Data_2.interruption_no_33kv)) ;
					        var saidi_11kv__33 		= 	((Data_2.interruption_duration_33kv=='undefined' || Data_2.interruption_duration_33kv== null) ? 0 : parseInt(Data_2.interruption_duration_33kv)) ;
					        val_sec_H 				=	 parseInt(parseInt( saidi_11kv__33 )/3600);
				        	val_sec_M 				= 	(parseInt(  parseInt(saidi_11kv__33)/60  ))%60;
				        	val_sec_M               =   parseInt(val_sec_M)<10 ? '0'+val_sec_M : val_sec_M;
				        	saidi_11kv__33          =   parseFloat(parseFloat( val_sec_H+'.'+val_sec_M  ).toFixed(2));
				        	

					        var month_name = ''+  $.datepicker.formatDate('M-yy',  new Date(Data_2.month_period_end))  +'';
					        
					        month_sd_name[month_safidi_count] =  month_sd_name[month_safidi_count] + '<br>'+ month_name  ;


							p_val_rm_2_1[month_safidi_count]  = { 'feeders_count':count_11kv__rm, 'name':month_name, 'y' : saifi_11kv__rm }; 
							p_val_ag_2_2[month_safidi_count]  = { 'feeders_count':count_11kv__ag, 'name':month_name, 'y' : saifi_11kv__ag };
							p_val_33_2_3[month_safidi_count]  = { 'feeders_count':count_11kv__33, 'name':month_name, 'y' : saifi_11kv__33 };
							
							
							d_val_rm_2_1[month_safidi_count]  = { 'feeders_count':count_11kv__rm, 'name':month_name, 'y' : saidi_11kv__rm }; 
							d_val_ag_2_2[month_safidi_count]  = { 'feeders_count':count_11kv__ag, 'name':month_name, 'y' : saidi_11kv__ag };
							d_val_33_2_3[month_safidi_count]  = { 'feeders_count':count_11kv__33, 'name':month_name, 'y' : saidi_11kv__33 };

						}
							
							
						month_safidi_count = parseInt(month_safidi_count) + 1;
						if(month_safidi_count>=12) break;
				}
				
				
				
		        var chart1 = $('#Anly_Chart_1').highcharts();
		        chart1.xAxis[0].setCategories( month_sd_name );
		        
		        chart1.series[0].setData( d_val_rm_1_1, false);
		        chart1.series[1].setData( d_val_ag_1_2, false);
		        chart1.series[2].setData( d_val_33_1_3, false);
		        
		        chart1.series[3].setData( d_val_rm_2_1, false);
		        chart1.series[4].setData( d_val_ag_2_2, false);
		        chart1.series[5].setData( d_val_33_2_3, false);
		        
		        $('#Anly_Chart_1').highcharts().redraw();
		        $("#Anly_Chart_H_1").html("Average Duration of Interruptions (Power Supply Outage) Month-wisw");
		        
		        
		        var chart1 = $('#Anly_Chart_2').highcharts();
		        chart1.xAxis[0].setCategories( month_sd_name );
		        
		        chart1.series[0].setData( p_val_rm_1_1, false);
		        chart1.series[1].setData( p_val_ag_1_2, false);
		        chart1.series[2].setData( p_val_33_1_3, false);
		        
		        chart1.series[3].setData( p_val_rm_2_1, false);
		        chart1.series[4].setData( p_val_ag_2_2, false);
		        chart1.series[5].setData( p_val_33_2_3, false);
		        
		        $('#Anly_Chart_2').highcharts().redraw();
		        $("#Anly_Chart_H_2").html("Average Number of Interruptions (Power Supply Outage) Month-wisw");	
				
		        
		       
		       

				//debugger;
		        var month_count = 0;
		        var  month_name = new Array();
		        
		        var  p_val_1_1 = new Array();
		        var  p_val_1_2 = new Array();
		        var  p_val_1_3 = new Array();
		        var  p_val_1_4 = new Array();
		        var  p_val_2_1 = new Array();
		        var  p_val_2_2 = new Array();
		        var  p_val_2_3 = new Array();
		        var  p_val_2_4 = new Array();
		        
		        
				var rm_ag__Data=null, rm_Data=null, ag_Data=null, eDate_1, eDate_2, rm_Type, ag_Type; 
				
				
				
				for(var i=0; gbl_power_supply_status!=null && i<gbl_power_supply_status.length;i++)
				{
					rm_ag_Data = gbl_power_supply_status[i];

						
			        var gt_20_hr 		= 	(rm_ag_Data.gt_20_hr=='undefined' || rm_ag_Data.gt_20_hr== null) ? 			 0 : parseInt(rm_ag_Data.gt_20_hr) ;
			        var betw_15_20_hr 	=  	(rm_ag_Data.betw_15_20_hr=='undefined' || rm_ag_Data.betw_15_20_hr== null) ? 0 : parseInt(rm_ag_Data.betw_15_20_hr);
			        var betw_08_15_hr 	=  	(rm_ag_Data.betw_08_15_hr=='undefined' || rm_ag_Data.betw_08_15_hr== null) ? 0 : parseInt(rm_ag_Data.betw_08_15_hr);
			        var les_08_hr   	=  	(rm_ag_Data.les_08_hr=='undefined' || rm_ag_Data.les_08_hr== null) ? 		 0 : parseInt(rm_ag_Data.les_08_hr);

					month_name[month_count] = ''+  $.datepicker.formatDate('M-yy',  new Date(rm_ag_Data.reportingmonthend))  +'';
							
							
					p_val_1_1[month_count]  = { 'feeders_m':rm_ag_Data.feeders_m, 'feeders_t':rm_ag_Data.feeders_t, 'name':month_name[month_count], 'y' : gt_20_hr }; 
					p_val_1_2[month_count]  = { 'feeders_m':rm_ag_Data.feeders_m, 'feeders_t':rm_ag_Data.feeders_t, 'name':month_name[month_count], 'y' : betw_15_20_hr };
					p_val_1_3[month_count]  = { 'feeders_m':rm_ag_Data.feeders_m, 'feeders_t':rm_ag_Data.feeders_t, 'name':month_name[month_count], 'y' : betw_08_15_hr };
					p_val_1_4[month_count]  = { 'feeders_m':rm_ag_Data.feeders_m, 'feeders_t':rm_ag_Data.feeders_t, 'name':month_name[month_count], 'y' : les_08_hr  };
							
							
					if( gbl_power_supply_status.length > (i+12)   )
					{
						rm_ag_Data = gbl_power_supply_status[i+12];

						
				        gt_20_hr 		= 	(rm_ag_Data.gt_20_hr=='undefined' || rm_ag_Data.gt_20_hr== null) 			? 0 : parseInt(rm_ag_Data.gt_20_hr);
				        betw_15_20_hr 	=  	(rm_ag_Data.betw_15_20_hr=='undefined' || rm_ag_Data.betw_15_20_hr== null)  ? 0 : parseInt(rm_ag_Data.betw_15_20_hr);
				        betw_08_15_hr 	=  	(rm_ag_Data.betw_08_15_hr=='undefined' || rm_ag_Data.betw_08_15_hr== null)  ? 0 : parseInt(rm_ag_Data.betw_08_15_hr);
				        les_08_hr   	=  	(rm_ag_Data.les_08_hr=='undefined' || rm_ag_Data.les_08_hr== null) 			? 0 : parseInt(rm_ag_Data.les_08_hr);

						
						var month = $.datepicker.formatDate('M-yy',  new Date(rm_ag_Data.reportingmonthend));
						month_name[month_count] =  month_name[month_count] + '<br>'+ month  ;
						 
						p_val_2_1[month_count]  = { 'feeders_m':rm_ag_Data.feeders_m, 'feeders_t':rm_ag_Data.feeders_t, 'name':month, 'y' : gt_20_hr }; 
						p_val_2_2[month_count]  = { 'feeders_m':rm_ag_Data.feeders_m, 'feeders_t':rm_ag_Data.feeders_t, 'name':month, 'y' : betw_15_20_hr };
						p_val_2_3[month_count]  = { 'feeders_m':rm_ag_Data.feeders_m, 'feeders_t':rm_ag_Data.feeders_t, 'name':month, 'y' : betw_08_15_hr };
						p_val_2_4[month_count]  = { 'feeders_m':rm_ag_Data.feeders_m, 'feeders_t':rm_ag_Data.feeders_t, 'name':month, 'y' : les_08_hr };
					}
							
							
					month_count = parseInt(month_count) + 1;
					if(month_count>=12) break;

				}
				reportingmonthend=eDate_1; 	
				
				
				
				var chart3 = $('#Anly_Chart_3').highcharts();
		        chart3.xAxis[0].setCategories( month_name );
		        chart3.series[0].setData( p_val_1_1, false);
		        chart3.series[1].setData( p_val_1_2, false);
		        chart3.series[2].setData( p_val_1_3, false);
		        chart3.series[3].setData( p_val_1_4, false);
		        
		        chart3.series[4].setData( p_val_2_1, false);
		        chart3.series[5].setData( p_val_2_2, false);
		        chart3.series[6].setData( p_val_2_3, false);
		        chart3.series[7].setData( p_val_2_4, false);
		        
		        $('#Anly_Chart_3').highcharts().redraw();
		        $("#Anly_Chart_H_3").html("Average Duration of Interruptions (Power Supply Outage) Month-wisw");
		        
		        
				
				
		        //
		    }
		    catch(err) {}								    
		    
		}
		
	}
	
	this.rd_map_dashboard = rd_map_dashboard;
}();






