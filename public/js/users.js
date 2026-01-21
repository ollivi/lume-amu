$(document).ready(function()
{
	$(".editUser").click(function(e)
	{
		var data = JSON.parse(decodeURIComponent($(this).data('user')));
		$('.edit input[name="nom"]').val(data.nom);
		$('.edit input[name="prenom"]').val(data.prenom);
		$('.edit input[name="email"]').val(data.email);
		$('.edit input[name="birthdate"]').val(data.birthdate);
		$('.edit select[name="discipline"]').val(data.discipline);
		$('.edit select[name="study_year"]').val(data.study_year);
		$('.edit select[name="role"]').val(data.role);
		$('.edit input[name="confirmed"]').attr("checked", parseInt(data.confirmed));
		$('.edit input[name="active"]').attr("checked", parseInt(data.active));
		$('.edit input[name="id"]').val(data.id);
	});

	$(".deleteUser").click(function(e)
	{
		var id = $(this).data('user-id');
		$('.delete input[name="id"]').val(id);
	});

	$("#user-search").keyup(function(e)
	{
		$(".user-row").hide();

		if($("#user-search")[0].value.length == 0)
		{
			$(".user-row").fadeIn();
		}

		search($(this)[0].value, $(".user-row"));
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