$(document).ready(function()
{
	$(".deleteFile").click(function(e)
	{
		var file = $(this).data('file-name');
		var id = $(this).data('id');
		$('.delete input[name="file_name"]').val(file);
		$('.delete input[name="id"]').val(id);
	});
});