
    var name_1 = 'All India', name_2='', name_3='', name_4='';
    
	var rMap = new Map();
	var bMap, stateLayer,stateQuery,stateQueryTask,  zoneLayer,zoneQuery,zoneQueryTask;
	var emptyLineRenderer;
	

/********************************************************************/
/********************************************************************/
/************************ESRI-MAP************************************/
/********************************************************************/
/********************************************************************/

!function(){
	var trans_map_dashboard={};
	

	require( [ "esri/map", "dojo/domReady!" ],

		function( esriBasemaps,esriMap ) 
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
    	  	bMap.infoWindow.resize(310,375);
    	  	bMap.disableScrollWheel();
    		emptyLineRenderer = esri.renderer.SimpleRenderer( esri.symbol.SimpleLineSymbol( esri.symbol.SimpleLineSymbol.STYLE_SOLID, esri.Color([160, 0, 0, 0]), 1 )); // RGB Opacity AND Line-Width
	  		bMap.on("load",function(){
	  			trans_map_dashboard.drawStateLayer();
	  		});
    		initialize(0); 
	});


	trans_map_dashboard.drawStateLayer = function( ){
		
		    //event_STEP = 1;
			bMap.infoWindow.hide();
			bMap.graphics.clear();
			statePolyMap = new Map();
			var colors = ["#0d260d","#133913","#194d19","#206020","#267326","#2d862d","#339933","#39ac39","#40bf40","#53c653","#66cc66","#79d279","#8cd98c","#9fdf9f","#b3e6b3","#c6ecc6","#d9f2d9","#ecf9ec","#ecf9ec","#ecf9ec","#ecf9ec","#ecf9ec","#ecf9ec"];

			//stateQueryTask.execute(stateQuery, function(fset) 
			//web_db.get_state_geometry( false, function(id, key, state_geometry)
			//var fset    =  dojo.fromJson( localStorage.getItem("state_geometry")  );

			stateQueryTask.execute(stateQuery, function(fset) 
			{		
				var jsnFset   =  fset;
				for (var i=0; i<jsnFset.features.length; i++ ) 
				{ 
                    var state_id = '', state_nm= '';
					
					state_id = parseInt( jsnFset.features[i].attributes.stcode11 );
				    state_nm = jsnFset.features[i].attributes.stname;
				    
				    if(state_nm==null || ''+state_nm+'' == 'undefined')
				    {
				    	state_id = parseInt( jsnFset.features[i].attributes.STCODE11 );
				    	state_nm = jsnFset.features[i].attributes.STNAME;
				    }

			    	
				    var dojoColor1 = new dojo.Color([12, 12, 12]);   
			    	var dojoColor2 = new dojo.Color([196, 222, 233]);    

			    	var symbol = new esri.symbol.SimpleFillSymbol(
									esri.symbol.SimpleFillSymbol.STYLE_SOLID,  
									new esri.symbol.SimpleLineSymbol(esri.symbol.SimpleLineSymbol.STYLE_SOLID, dojoColor1, 1), 
									dojoColor2);

			    	var gmtry = new esri.geometry.Polygon( jsnFset.features[i].geometry );
			    	
			    	var infoGraphic = new esri.Graphic( gmtry, symbol );


			    	infoGraphic.setAttributes( {"STEP": 1, "state_id":state_id, "state_name":state_nm, "color_code":dojoColor2});
			    	
			    	statePolyMap.set(state_id, infoGraphic);
			    	
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
		            //add label to the intended graphic                    
		            bMap.graphics.add(labelPointGraphic);
		          //---------------------------------------// 
			    }
			}, showError );
	}

    

	
	trans_map_dashboard.onCilicMap = function( dataMap ){
        
		bMap.graphics.on("click", function(fs) 
		{ 

		});

		bMap.infoWindow.on("hide", function(fs) 
		{   
		});
		
		
	}; //END of onCilicMap
	
	

	
	this.trans_map_dashboard = trans_map_dashboard;
}();






