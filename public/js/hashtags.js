$(document).ready(function()
{
	$(".editHashtag").click(function(e)
	{
		$('.edit input[name="id"]').val($(this).data('hashtag-id'));
		$('.edit input[name="hashtag"]').val($(this).data('hashtag-name'));
	});

	$(".deleteHashtag").click(function(e)
	{
		var id = $(this).data('hashtag-id');
		$('.delete input[name="id"]').val(id);
	});

	$("#hashtag-search").keyup(function(e)
	{
		$(".hashtag-row").hide();

		if($("#hashtag-search")[0].value.length == 0)
		{
			$(".hashtag-row").fadeIn();
		}

		search($(this)[0].value, $(".hashtag-row"));
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