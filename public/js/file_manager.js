$(document).ready(function()
{
	$(".deleteFile").click(function(e)
	{
		var file = $(this).data('file-name');
		$('.delete input[name="file_name"]').val(file);
	});

	$("#file-search").keyup(function(e)
	{
		$(".img-thumb").hide();

		if($("#file-search")[0].value.length == 0)
		{
			$(".img-thumb").fadeIn();
		}

		search($(this)[0].value, $(".img-thumb"));
	});

	function search(needle, hay)
	{
		for (var i = 0; i < hay.length; i++)
		{
			if(hay[i].innerText.search(needle) > 0)
				hay[i].style.display = "block";
		}
	}

	$(".img-thumb img").on("click", function()
	{
		$('#imagepreview').attr('src', $(this).attr('src'));
		$('.preview').modal('show');
	});
});