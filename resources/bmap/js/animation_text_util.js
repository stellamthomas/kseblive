/**
 * 
 */

function commaSeparateNumber(val) {
    while (/(\d+)(\d{3})/.test(val.toString())) {
        val = val.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
    }
    return val;
}
//==========For ODF Village ==============//


function doAnimateText(idText)
{   //alert(idText+"-->"+idText.html());
	if(   isNaN(idText.html()) )  {idText.text( '0' );}

	var orgVal = idText.html() ;
	if(   !isNaN(orgVal) )  
	{
		
		var nVal     = idText.html().split('.');
		
		var lVal_1   = 0;
		var lVal_2   = 0;
		
		if( nVal.length==1 )
		{
			lVal_1   = nVal[0].length;
		}
		if( nVal.length==2 )
		{
			lVal_1   = nVal[0].length;
			lVal_2   = nVal[1].length;
		}


		var lVal_1_a   = 1;
		var lVal_2_a   = 1;
		for(var i=0; i<lVal_1;i++)
		{		  
			lVal_1_a = lVal_1_a * 10;
		}
		for(var i=0; i<lVal_2;i++)
		{		  
			lVal_2_a = lVal_2_a * 10;
		}  
		  

		var hv1 =   10000;

		start_1 = 0;
	    $({ someValue: start_1 }).animate({ someValue: hv1 }, {
	        duration: 2200,
	        easing: 'swing', // can be anything
	        step: function () { // called on every step
	            // Update the element's text with rounded-up value:
	            	
	            var a1 = 0;
	            if(nVal.length==1)
	            {
	            	a1 = Math.round(Math.random()*lVal_1_a);	
	            }
	            if(nVal.length==2)
	            {
	            	a1 = Math.round(Math.random()*lVal_1_a)+'.'+Math.round(Math.random()*lVal_2_a);	
	            }
	            	
	            idText.text(a1 );
	        },
	        complete: function () {
	        	idText.text( orgVal );
	        }
	    });
	}
}

function doAnimateText_i_(idText)
{  
	var unit     = 'NL';
	var unit_last     = '';

	// alert( idText.html()+"-----"+idText.html().split(' ').length );
	if(idText.html().split(' ').length>1)
	{
		unit     = '';
		for(var ia=0;ia<idText.html().split(' ').length-1; ia++)
		{
			unit     = unit + ' '+ idText.html().split(' ')[ia];
		}
		
		idText.html(  idText.html().split(' ')[ idText.html().split(' ').length-1 ]  );
	}
	//alert(idText.html() +  !isNaN(idText.html())   );
	
	if(  isNaN(idText.html())   )
	{
		unit_last = idText.html();
		idText.html( unit  );
		unit     = 'NL';
		
		if(idText.html().split(' ').length>1)
		{
			unit     = '';
			for(var ia=0;ia<idText.html().split(' ').length-1; ia++)
			{
				unit     = unit + ' '+ idText.html().split(' ')[ia];
			}
			
			idText.html(  idText.html().split(' ')[ idText.html().split(' ').length-1 ]  );
		}
	}

	
	var orgVal = idText.html() ;
	
	if(   !isNaN(orgVal) )  
	{
		
		var nVal     = idText.html().split('.');
		
		var lVal_1   = 0;
		var lVal_2   = 0;
		
		if( nVal.length==1 )
		{
			lVal_1   = nVal[0].length;
		}
		if( nVal.length==2 )
		{
			lVal_1   = nVal[0].length;
			lVal_2   = nVal[1].length;
		}


		var lVal_1_a   = 1;
		var lVal_2_a   = 1;
		for(var i=0; i<lVal_1;i++)
		{		  
			lVal_1_a = lVal_1_a * 10;
		}
		for(var i=0; i<lVal_2;i++)
		{		  
			lVal_2_a = lVal_2_a * 10;
		}  
		  

		var hv1 =   10000;

		start_1 = 0;
	    $({ someValue: start_1 }).animate({ someValue: hv1 }, {
	        duration: 2200,
	        easing: 'swing', // can be anything
	        step: function () { // called on every step
	            // Update the element's text with rounded-up value:
	            	
	            var a1 = 0;
	            if(nVal.length==1)
	            {
	            	a1 = Math.round(Math.random()*lVal_1_a);	
	            }
	            if(nVal.length==2)
	            {
	            	a1 = Math.round(Math.random()*lVal_1_a)+'.'+Math.round(Math.random()*lVal_2_a);	
	            }
	            	
	            idText.text(a1 );
	        },
	        complete: function () {
	        	idText.text( unit +' '+ orgVal + ' ' + unit_last );
	        }
	    });
	}
}

function doAnimateText_(idText)
{  
	var unit     = 'NL';

	// alert( idText.html()+"-----"+idText.html().split(' ').length );
	if(idText.html().split(' ').length>1)
	{
		unit     = '';
		for(var ia=1;ia<idText.html().split(' ').length; ia++)
		{
			unit     = unit + ' '+ idText.html().split(' ')[ia];
		}
		
		idText.html(  idText.html().split(' ')[0]  );
	}
	//alert(unit);

	
	var orgVal = idText.html() ;
	
	if(   !isNaN(orgVal) )  
	{
		
		var nVal     = idText.html().split('.');
		
		var lVal_1   = 0;
		var lVal_2   = 0;
		
		if( nVal.length==1 )
		{
			lVal_1   = nVal[0].length;
		}
		if( nVal.length==2 )
		{
			lVal_1   = nVal[0].length;
			lVal_2   = nVal[1].length;
		}


		var lVal_1_a   = 1;
		var lVal_2_a   = 1;
		for(var i=0; i<lVal_1;i++)
		{		  
			lVal_1_a = lVal_1_a * 10;
		}
		for(var i=0; i<lVal_2;i++)
		{		  
			lVal_2_a = lVal_2_a * 10;
		}  
		  

		var hv1 =   10000;

		start_1 = 0;
	    $({ someValue: start_1 }).animate({ someValue: hv1 }, {
	        duration: 2200,
	        easing: 'swing', // can be anything
	        step: function () { // called on every step
	            // Update the element's text with rounded-up value:
	            	
	            var a1 = 0;
	            if(nVal.length==1)
	            {
	            	a1 = Math.round(Math.random()*lVal_1_a);	
	            }
	            if(nVal.length==2)
	            {
	            	a1 = Math.round(Math.random()*lVal_1_a)+'.'+Math.round(Math.random()*lVal_2_a);	
	            }
	            	
	            idText.text(a1 );
	        },
	        complete: function () {
	        	idText.text( orgVal + ' '+unit );
	        }
	    });
	}
}