$(document).ready(function() {
    var totalRecord = 0;
	var category = getCheckboxValues('category');
    var brand = getCheckboxValues('brand');
    var material = getCheckboxValues('material');
    var size = getCheckboxValues('size');
    var totalData = $("#totalRecords").val();
	var sorting = getCheckboxValues('sorting');
	$.ajax({
		type: 'POST',
		url : "load_orders.php",
		dataType: "json",			
		data:{totalRecord:totalRecord, brand:brand, material:material, size:size, category:category, sorting:sorting},
		success: function (data) {
			$("#results").append(data.orders);
			totalRecord++;
		}
	});	
    $(window).scroll(function() {
		scrollHeight = parseInt($(window).scrollTop() + $(window).height());		
        if(scrollHeight == $(document).height()){	
            if(totalRecord <= totalData){
                loading = true;
                $('.loader').show();                
				$.ajax({
					type: 'POST',
					url : "load_orders.php",
					dataType: "json",			
					data:{totalRecord:totalRecord, brand:brand, material:material, size:size},
					success: function (data) {
						$("#results").append(data.orders);
						$('.loader').hide();
						totalRecord++;
					}
				});
            }            
        }
    });
    function getCheckboxValues(checkboxClass){
        var values = new Array();
		$("."+checkboxClass+":checked").each(function() {
		   values.push($(this).val());
		});
        return values;
    }
    $('.sort_rang').change(function(){
        $("#search_form").submit();
        return false;
    });
	$(document).on('click', 'label', function() {
		if($('input:checkbox:checked')) {
			$('input:checkbox:checked', this).closest('label').addClass('active');
		}
	});	
});



