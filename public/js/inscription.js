$(function()
{
	$('.datepicker').datepicker(
	{
		clearBtn: true,
		format: "dd/mm/yyyy"
	});

	$('#birthdate').on('change', function()
	{
		var pickedDate = $('input').val();
		$('#pickedDate').html(pickedDate);
	});
});