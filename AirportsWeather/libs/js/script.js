	$('.btnRun').click(function() {
		
		$.ajax({
			url: "libs/php/getInfo.php",
			type: 'GET',
			dataType: 'json',
			data: {
				north: $('.northSel').val(),
				south: $('.southSel').val(),
				east: $('.eastSel').val(),
				west: $('.westSel').val()
				
			},
			
			success: function(result) {

				console.log(result);
					
					$("#resultNorth").html(result['north']);
					$("#resultSouth").html(result['south']);
					$("#resultWest").html(result['east']);
					$("#resultEast").html(result['west']);

				
			
			},
			error: function(jqXHR, textStatus, errorThrown) {
				if (jqXHR.status == 500) {
					alert('Internal error: ' + jqXHR.responseText);
				} else {
					alert('Unexpected error.');
				}
			}
	
			
		}); 
	return false;

	});