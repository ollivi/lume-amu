$(document).ready(function()
{
	$(".deleteArticle").click(function(e)
	{
		var id = $(this).data('article-id');
		$('.delete input[name="id"]').val(id);
	});

	$("#article-search").keyup(function(e)
	{
		$(".article-row").hide();

		if($("#article-search")[0].value.length == 0)
		{
			$(".article-row").fadeIn();
		}

		search($(this)[0].value, $(".article-row"));
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