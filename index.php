<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Happy Birtday !</title>
        
        <link rel="icon" type="image/x-icon" href="favicon" />
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/tron.css">
    </head>
    <body>
        <div id="page-wrapper">
        	<div class="pull-right"><fb:login-button class="fbButton" width="200" max-rows="1" data-scope="read_stream"></fb:login-button></div>
            <h1><span class="hbname"></span></h1>
        </div>
        <div id="fb-root"></div>
        <div id="getFriends" class="centered"><h3 class='openMe'>Ouvre moi ;-)<h3><img class='presentImg' src='present.png'></div>
        <script type="text/javascript" src="js/jquery-2.1.0.min.js"> </script>
        <script type="text/javascript" src="js/bootstrap.min.js"> </script>
        <script>
        $("#getFriends").on("click", function(){
        	getFriends();
        })
        var friends =[];
        var sentences = [];
		var me;
    	function getFriends() {
    		setSentences();
    		getMyInformation();
		    FB.api('/me/friends?fields=picture', function(response) {
		        if(response.data) {
		            $.each(response.data,function(index,friend) {
		                friends.push({
		                	id : friend.id,
		                	first_name : friend.first_name,
		                	name : friend.name,
		                	picture : friend.picture.data.url,
		                	bigPicture : 'undefined',
		                	lastMessage : 'undefined'
		            	});
		          	});
		          	surprise(friends);
		          	// console.log(friends);
		        } else {
		            alert("Connecte toi d'abord!");
		        }
		    });
		}

		function getMyInformation(friends){
			FB.api('/me', function(response) {
		    	me = {
		    		id : response.id,
		    		firstname : response.first_name,
		    	};
			});
		}
		
		function surprise(friends){
			$(".hbname").text("!!!!!!!! HAPPY BIRTHDAY "+me.firstname+" !!!!!!!!");
			$(".openMe").addClass('hidden');
			$("#page-wrapper").addClass('on');
			$(".presentImg").addClass('hidden');
			for(friend in friends){
				$("#getFriends").append("<img class='head "+friends[friend]["id"]+"' src='"+friends[friend]["picture"]+"'>");
				animateDiv($('.'+friends[friend]["id"]+''));
			}
			var i = 0;
			for(friend in friends){
				i++;
				doSetTimeout(i, friend);
			}
		}

		function doSetTimeout(i, friend) {
			setTimeout(function(){
					emphaseFriend(getRandomFriend());
				}, i*100);
		}

		function arraySearch(arr,val) {
		    for (var i=0; i<arr.length; i++)
		        if (arr[i] === val)                    
		            return i;
		    return false;
		}

		function setSentences(){
			sentences= [
				"Je te souhaite un bon anniversaire, tu trouveras avec ton cadeau la facture pour me rembourser.",
				"Si je retiens 3, que je rajoute 10, que multiplie racine carrée de pi puissance 12….Bon en clair bon anniversaire.",
				"Un sage à dit que vieillir c’était la seule façon que l’on ait trouvé pour vivre très longtemps ! C’était pour te consoler…Nous te souhaitons une longue vie, et pour l’instant, un formidable anniversaire !",
				"Vieillir est obligatoire, grandir est facultatif. Joyeux anniversaire !",
				"C’est fou comme on peut s’amuser et rire… quand c’est un autre qui vient de vieillir ! Joyeux anniversaire !",
				"On sait que l’on vieillit lorsque l’on reçoit une carte écrite en TRÈS GROS CARACTÈRES. Joyeux anniversaire !",
				"Une année de plus ? Pas de panique ! Tu parais encore assez jeune pour prétendre n’avoir que trente-neuf ans… et t’éviter ainsi la mise en quarantaine. Bon anniversaire !",
				"Il paraît que la sagesse vient avec l’âge… Tu vois ? Tu n’as pas encore tous les signes de vieillesse ! Joyeux anniversaire !",
				"Joyeux anniversaire à une personne extrêmement brillante, remarquablement raffinée, très séduisante et surtout incroyablement… crédule !",
				"J’espère que je paraîtrai aussi bien que toi au même âge ! Cela prendra naturellement très, très, très longtemps ! Joyeux anniversaire !",
				"Vieillir c’est encore le seul moyen qu’on ait trouvé de vivre longtemps.",
				"Tu vois même les plus cons ont leur jour de gloire : Bon anniversaire !",
				"Je me souviens de ton anniversaire, mais pas de ton âge… tu vois que je suis un bon ami ! Bon Anniversaire !",
				"Si tu veux être heureux pendant une journée, choisi une rencontre. Heureux pendant une semaine, choisi un amant. Heureux pendant une vie, garde moi comme ami ! Bon anniversaire !",
				"Comme le dit le proverbe chinois, il faut rajouter de la vie aux années et non des années à la vie. Et moi j’ajouterai juste : Joyeux anniversaire.",
				"Je sais que tu ne dors plus depuis une semaine tellement tu attends ce cadeau. Je sais que tu ne penses plus qu’à ça, tu ne penses plus qu’à l’instant où tu vas ouvrir MON cadeau. Et bien laisse-moi t’annoncer la bonne nouvelle, MON cadeau, tu l’as ENFIN entre les mains ! Bon anniversaire !",
				"Un an de plus ! N’y pense plus, l’important c’est de l’avoir bien employé ! Joyeux anniversaire !",
				"Ne change rien, comme le vin, tu te bonifies avec le temps. Joyeux anniversaire !",
				"En ce jour extraordinaire, je te souhaite un fabuleux anniversaire… Avec un excellent gâteau, une tonne de fantastiques cadeaux et une fête d’enfer !"
				+"Rien n’est trop sensationnel pour ton anniversaire. Bon anniversaire !",
				
				"Aujourd’hui est LE jour le plus important de l’année : plus magique que Noël, plus festif que le Nouvel An, plus chanceux que le 1er mai, plus gourmand que Pâques, plus joyeux que l’arrivée du printemps…"
				+"<br>C’est le jour merveilleux où tu es né ! JOYEUX ANNIVERSAIRE !",
				
				"J’espère de tout coeur que, pendant ces 365 jours de ton nouvel âge, tu rencontreras la joie, tu flirteras avec le bonheur, tu trinqueras avec la chance, tu riras avec la santé et tu profiteras de la vie."
				+"<br>Je te souhaite un très heureux anniversaire !",
				
				"Ça y est, te voilà entré dans le nouvel âge. Pour que ces 365 jours qui t’attendent soient encore meilleurs que les précédents, je tenais à te souhaiter : une tonne de bons moments, pleins de fous rires, une abondance de surprises, de l’amour à volonté, beaucoup d’amitié et une pleine santé."
				+"<br>Joyeux anniversaire !",
				
				"Il faut être courageux pour affronter sa date d’anniversaire… D’une seconde à l’autre, on prend un an de plus et on vieillit 365 fois plus que les autres jours ! Mais toi tu n’as aucun souci à te faire, même si le temps passe, tu resteras toujours le même. Heureux anniversaire !",
				
				"Comme le veut la tradition, je vais te chanter une petite chanson :"
				+"« Joyeux anniversaire, Mes voeux les plus sincères, Que ces quelques fleurs, Vous apportent le bonheur, Que l’année entière, Vous soit douce et légère, Et que l’an fini, Nous soyons tous réunis ! »",
				
				"Ma chere amie, tu es comme le bon vin. Tu as du caractère, tu as du goût, tu mets l’ambiance dans les soirées, tu te bonifies avec le temps et chaque moment partagé avec toi est une joie. C’est sûr, l’année de ta naissance est un bon millésime et toi, tu es un grand cru ! Alors, quand est-ce que l’on trinque à ton anniversaire ?",
				
				"Joyeux anniversaire ! Voici ce que je te souhaite jusqu’à ton prochain anniversaire : 1 an d’Allégresse, 12 mois de Plaisir, 52 semaines de Bien-être, 365 jours de Chance, 8 760 heures de Succès, 525 600 minutes d’Amour, pour un total de 31 536 000 secondes de bonheur !"
				+"<br>Joyeux anniversaire et… à l’année prochaine !",
				
				"Bienvenue dans la fleur de l’âge !"
				+"<br>Voici le menu de cette belle année qui t’attend : Cocktail de joie, Velouté d’amitié, Gratiné de santé, Filet d’amour et sa sauce folie, Plateau de surprises, Fondant d’harmonie. Régale toi bien et… Joyeux anniversaire !",

				"Une pincée de bonne humeur, 10 cuillères à soupe de gentillesse, Un zeste de générosité, Quelques gouttes de d’honnêteté, Une pluie d’humour, Un grand cœur rempli d’amour : Voici la recette magique qu’a confectionné ta maman il y a … ans ! Joyeux anniversaire !",

				"On dit que l’on commence à se rendre compte que l’on vieillit lorsque les bougies débordent du gâteau. Moi j’ai une idée… Prend-en un plus grand et invite-nous avec les copains, on se fera un plaisir d’arranger ce problème… sans laisser de miettes ! Joyeux anniversaire vieille branche !",

				"Esquive à droite, parade à gauche, pirouette, feinte… Garde bien ta défense l’ami ! Même si, avec ta joie de vivre et ton dynamisme, je suis convaincu que tu ne prendras jamais de coup de vieux… Joyeux anniversaire !",

				"Chere amie, je t’envoie cette petite carte pour te souhaiter un très joyeux anniversaire. Bon… en réalité… j’aimerais surtout te demander l’adresse de ta magicienne. Ne me fait pas croire que ton éternelle jeunesse, tes yeux rieurs, ta gentillesse, ta pêche d’enfer et ta joie de vivre sont naturels : ce n’est pas possible d’être aussi génial ! Alors, dis-moi quelle est ta recette secrète. Et si tu ne me la donnes pas, je reviendrai chaque année pour te la demander !"
				+"<br>Bon anniversaire !",

				"Whaouh, tu en as vu des choses depuis que tu es né… L’apparition des premières radios, des cartes de crédit, des calculettes, de la TV, des stylos à billes, des CD, du micro-onde, des piles, du Monopoly, du vernis à ongles, des fusées, des ordinateurs, des TGV, de la crème solaire, de la mobylette, des codes barres, des téléphones portables, d’internet… Alors, comme on n’arrête pas le progrès, je te fais découvrir cette jolie carte virtuelle, à la pointe de la technologie. Joyeux anniversaire mon vieux !",

				"Depuis minuit, je n’arrête pas de penser à la meilleure façon de te souhaiter ton anniversaire. J’ai tout d’abord pensé à un lâcher de pétales de rose depuis une montgolfière, puis à écrire ton nom dans le ciel avec la fumée d’un avion, à te faire livrer ton poids en chocolat ou même à faire venir une fanfare pour chanter une chanson rien que pour toi. Puis je me suis dis, pourquoi ne pas lui offrir une attention des plus précieuses : une jolie cybercarte avec tout mon amour/toute mon amitié. J’espère qu’elle te plait ! Heureux anniversaire !",
			];
		}

		function getBirthdayFromUser(friend){
			friendId = friend["id"];
			//console.log("get" + friendId);
			FB.api("/"+friendId+"", function(response) {
				friend.first_name = response.first_name;
		    });
			FB.api("/"+friendId+"/feed?with=wall_post", function(response) {
				console.log(response);
				//console.log(response);
				datas = response.data;
				//console.log(datas);
				for(key in datas){
					//console.log(datas[data]);
					data = datas[key];
					//console.log(data);
					statusType = data.status_type;
					if(statusType == "wall_post"){
						/*console.log("story_tags");
						console.log(data.story_tags);*/
						
						story_tags = data.story_tags;
						//console.log(story_tags);
						if(typeof story_tags === 'undefined'){
							console.log(data);
							status = data.story;
							var m = status.match(/"(.*?)"/);
							console.log(m[1]);
							//console.log("c'est moi");
							getBigPicture(friend, m[1]);
						}
						/*for(key2 in story_tags){
							tag = story_tags[key2];
							console.log("tag");
							taggedId = tag[0].id;
							if (taggedId == me.id){
								console.log("c'est moi");
							}
						}*/
					}
				}
		    });
		    /*
			var query = "SELECT post_id, message FROM stream WHERE source_id = "+friendId+" AND target_id = "+me.id+"";
			FB.api('/fql', {q: query}, function(response) {
		        console.log(response);
		    });*/
		}

		function getBigPicture(friend, message){
			friendId = friend["id"];
			FB.api("/"+friendId+"/picture?type=large", function(response) {
		    	friend.bigPicture = response.data.url;
				$('.'+friend["id"]+'').remove();
				$("#getFriends").append("<img class='emphase "+friends["id"]+"' src='"+friend.bigPicture+"'>");
				$(".sentence").remove();
				$('#getFriends').append("<div class='sentence'>"+message+"</div>");
		    });

		}
		function emphaseFriend(friend){
			// console.log(friend);
			getBirthdayFromUser(friend);
		}

		function getRandomFriend(){
			return friends[Math.floor(Math.random()*friends.length)];
		}

		function getRandomSentence(){
			return sentences[Math.floor(Math.random()*sentences.length)];
		}

		function makeNewPosition($container) {

		    // Get viewport dimensions (remove the dimension of the div)
		    var h = $( document ).height() - 50;
		    var w = $( document ).width() - 50;

		    var nh = Math.floor(Math.random() * h);
		    var nw = Math.floor(Math.random() * w);

		    return [nh, nw];

		}

		function animateDiv($target) {
		    var newq = makeNewPosition($target.parent());
		    var oldq = $target.offset();
		    var speed = calcSpeed([oldq.top, oldq.left], newq);

		    $target.animate({
		        top: newq[0],
		        left: newq[1]
		    }, speed, function() {
		        animateDiv($target);
		    });
		}
		
		function stopAnimation($target) {
		    $target.animate({
		        top: 500,
		        left: 500
		    }, 0.9);
		}

		function calcSpeed(prev, next) {

		    var x = Math.abs(prev[1] - next[1]);
		    var y = Math.abs(prev[0] - next[0]);

		    var greatest = x > y ? x : y;

		    var speedModifier = 0.2;

		    var speed = Math.ceil(greatest / speedModifier);

		    return speed;

		}
		window.fbAsyncInit = function() {
			FB.init({
				appId      : '271246043053414',
				status     : true, // check login status
				cookie     : true, // enable cookies to allow the server to access the session
				xfbml      : true  // parse XFBML
			});
			FB.Event.subscribe('auth.authResponseChange', function(response) {
				// Here we specify what we do with the response anytime this event occurs. 
				if (response.status === 'connected') {
					$(".fbButton").addClass("hidden");
				  // The response object is returned with a status field that lets the app know the current
				  // login status of the person. In this case, we're handling the situation where they 
				  // have logged in to the app.
				} else if (response.status === 'not_authorized') {
				  FB.login();
				} else {
				  FB.login();
				}
			});
		};

		// Load the SDK asynchronously
		(function(d){
			var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
			if (d.getElementById(id)) {return;}
			js = d.createElement('script'); js.id = id; js.async = true;
			js.src = "//connect.facebook.net/fr_FR/all.js";
			ref.parentNode.insertBefore(js, ref);
		}(document));
		</script>
        
    </body>
</html>
