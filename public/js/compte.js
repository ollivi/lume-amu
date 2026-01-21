$(document).ready(function()
{
	$(".deleteComment").click(function(e)
	{
		var id = $(this).data('comment-id');
		var user_id = $(this).data('user-id');
		$('.delete input[name="id"]').val(id);
		$('.delete input[name="user_id"]').val(user_id);
	});

	$(".editUser").click(function(e)
	{
		var data = JSON.parse(decodeURIComponent($(this).data('user')));
		$('.editInfo input[name="nom"]').val(data.nom);
		$('.editInfo input[name="prenom"]').val(data.prenom);
		$('.editInfo input[name="email"]').val(data.email);
		$('.editInfo input[name="birthdate"]').val(data.birthdate);
		$('.editInfo select[name="discipline"]').val(data.discipline);
		$('.editInfo select[name="study_year"]').val(data.study_year);
	});

	$(".picture_submit").on("change", function(e)
	{
		$(this).parent().submit();
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

	/* ---- particles.js config ---- */

	particlesJS("particles-js", {
		"particles": {
			"number": {
				"value": 20,
				"density": {
					"enable": true,
					"value_area": 800
				}
			},
			"color": {
				"value": "#000000"
			},
			"shape": {
				"type": "circle",
				"stroke": {
					"width": 0,
					"color": "#000000"
				},
				"polygon": {
					"nb_sides": 5
				},
				"image": {
					"src": "img/github.svg",
					"width": 100,
					"height": 100
				}
			},
			"opacity": {
				"value": 0.5,
				"random": false,
				"anim": {
					"enable": false,
					"speed": 1,
					"opacity_min": 0.1,
					"sync": false
				}
			},
			"size": {
				"value": 3,
				"random": true,
				"anim": {
					"enable": false,
					"speed": 40,
					"size_min": 0.1,
					"sync": false
				}
			},
			"line_linked": {
				"enable": true,
				"distance": 150,
				"color": "#000000",
				"opacity": 0.4,
				"width": 1
			},
			"move": {
				"enable": true,
				"speed": 6,
				"direction": "none",
				"random": false,
				"straight": false,
				"out_mode": "out",
				"bounce": false,
				"attract": {
					"enable": false,
					"rotateX": 600,
					"rotateY": 1200
				}
			}
		},
		"interactivity": {
			"detect_on": "canvas",
			"events": {
				"onhover": {
					"enable": true,
					"mode": "repulse"
				},
				"onclick": {
					"enable": true,
					"mode": "push"
				},
				"resize": true
			},
			"modes": {
				"grab": {
					"distance": 400,
					"line_linked": {
						"opacity": 1
					}
				},
				"bubble": {
					"distance": 400,
					"size": 40,
					"duration": 2,
					"opacity": 8,
					"speed": 3
				},
				"repulse": {
					"distance": 200,
					"duration": 0.4
				},
				"push": {
					"particles_nb": 4
				},
				"remove": {
					"particles_nb": 2
				}
			}
		},
		"retina_detect": true
	});
});