$(document).ready(function()
{
	tinymce.init({
		selector: '#text',
		plugins: ["preview", "autosave", "spellchecker", "code", "visualblocks"],
		menu: {
			file: { title: 'File', items: 'newdocument restoredraft | preview | print ' },
			edit: { title: 'Edit', items: 'undo redo | cut copy paste | selectall | searchreplace' },
			view: { title: 'View', items: 'code | visualaid visualchars visualblocks | spellchecker | preview fullscreen' },
			insert: { title: 'Insert', items: 'image link media template codesample inserttable | charmap emoticons hr | pagebreak nonbreaking anchor toc | insertdatetime' },
			format: { title: 'Format', items: 'bold italic underline strikethrough superscript subscript codeformat | formats blockformats fontformats fontsizes align lineheight | numlist bullist | forecolor backcolor | removeformat' },
			tools: { title: 'Tools', items: 'spellchecker spellcheckerlanguage | code wordcount' },
			table: { title: 'Table', items: 'inserttable | cell row column | tableprops deletetable' },
			help: { title: 'Help', items: 'help' },
		}
	});

	$("#confirmImport").click(function()
	{
		var src = $("#file-preview").attr('src');
		var old_image = $('#header_image').val();
		var new_image = $('input[name=new_image]:checked').val();
		
		if(old_image.length > 0)
		{
			var base_src = src.split(old_image);
			var new_src = base_src[0]+new_image;
		}
		else
		{
			var base_src = src;
			var new_src = base_src+new_image;
		}

		$("#header_image").val(new_image);
		$("#file-preview").attr('src', new_src);
	});

	$(".file .file-preview").click(function()
	{
		var id = $(this).attr('id');
		$("input[name=new_image]:checked").attr('checked', false);
		$("#"+id+"-radio").attr('checked', true);
	});
});