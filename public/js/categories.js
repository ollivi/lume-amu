$(document).ready(function()
{
	$(".editCategory").click(function(e)
	{
		$('.edit input[name="id"]').val($(this).data('category-id'));
		$('.edit input[name="category"]').val($(this).data('category-name'));
	});

	$(".deleteCategory").click(function(e)
	{
		var id = $(this).data('category-id');
		$('.delete input[name="id"]').val(id);
	});

	$("#category-search").keyup(function(e)
	{
		$(".category-row").hide();

		if($("#category-search")[0].value.length == 0)
		{
			$(".category-row").fadeIn();
		}

		search($(this)[0].value, $(".category-row"));
	});

	function search(needle, hay)
	{
		for (var i = 0; i < hay.length; i++)
		{
			if(hay[i].innerText.search(needle) > 0)
				hay[i].style.display = "table-row";
		}
	}
});