$(document).ready(function()
{
	$('.jarallax').jarallax({
		speed: 0.2,
		imgRepeat: "no-repeat"
	});

	$(".deleteComment").click(function(e)
	{
		var id = $(this).data('comment-id');
		var user_id = $(this).data('user-id');

		$('.delete input[name="id"]').val(id);
		$('.delete input[name="user_id"]').val(user_id);
	});

	$(".editComment").click(function(e)
	{
		var id = $(this).data('comment-id');
		var user_id = $(this).data('user-id');
		var text = $(this).data('comment-text');

		$('.edit textarea[name="text"]').val(text);
		$('.edit textarea[name="text"]').text(text);
		$('.edit input[name="id"]').val(id);
		$('.edit input[name="user_id"]').val(user_id);
	});

	$(".likeComment").click(function(e)
	{
		e.preventDefault();
		var url = $(this).data('url');
		var id = $(this).data('comment-id');

		if($("."+id).hasClass("liked"))
			$("."+id).removeClass("liked");
		else
			$("."+id).addClass("liked");

		$.ajax({
			url: url,
			type: "POST",
			data: {"comment_id": id},
			dataType: "json",
			success: function(result)
			{

			}
		});
	});

	$(".likeArticle").click(function(e)
	{
		e.preventDefault();
		var url = $(this).data('url');
		var id = $(this).data('id');

		if($(".likeArticle").hasClass("liked"))
			$(".likeArticle").removeClass("liked");
		else
			$(".likeArticle").addClass("liked");

		$.ajax({
			url: url,
			type: "POST",
			data: {"article_id": id},
			dataType: "json",
			success: function(result)
			{
				$(".counter.article").text(result);
			}
		});
	});
});