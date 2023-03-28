$(document).ready(function () {
	search();
	function search() {
		const searchValue = $('[name="searchInput"]').val();
		var totalRecord = 0;
		var category = getCheckboxValues('category');
		var brand = getCheckboxValues('brand');
		var material = getCheckboxValues('material');
		var size = getCheckboxValues('size');
		var totalData = $("#totalRecords").val();
		var sorting = getCheckboxValues('sorting');
		$.ajax({
			type: 'POST',
			url: "load_products.php",
			dataType: "json",
			data: { totalRecord: totalRecord, brand: brand, material: material, size: size, category: category, sorting: sorting, searchValue: searchValue },
			success: function (data) {
				$("#results").empty();
				$("#results").append(data.products);
				totalRecord++;
			}
		});
	}
	$(window).scroll(function () {
		scrollHeight = parseInt($(window).scrollTop() + $(window).height());
		if (scrollHeight == $(document).height()) {
			if (totalRecord <= totalData) {
				loading = true;
				$('.loader').show();
				$.ajax({
					type: 'POST',
					url: "load_products.php",
					dataType: "json",
					data: { totalRecord: totalRecord, brand: brand, material: material, size: size },
					success: function (data) {
						$("#results").append(data.products);
						$('.loader').hide();
						totalRecord++;
					}
				});
			}
		}
	});
	function getCheckboxValues(checkboxClass) {
		var values = new Array();
		$("." + checkboxClass + ":checked").each(function () {
			values.push($(this).val());
		});
		return values;
	}
	$('.sort_rang').change(function () {
		$("#search_form").submit();
		return false;
	});
	$(document).on('click', 'label', function () {
		if ($('input:checkbox:checked')) {
			$('input:checkbox:checked', this).closest('label').addClass('active');
		}
		search();
	});

	$('#searchInventory').on('click', () => {
		search();
	});
});
