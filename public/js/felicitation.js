
var input = "",
	correct = "";
var mynumber="";
		var token="";


(function () {

	

	var dots = document.querySelectorAll(".dot"),
		numbers = document.querySelectorAll(".number");
	dots = Array.prototype.slice.call(dots);
	numbers = Array.prototype.slice.call(numbers);

	numbers.forEach(function (number, index) {
		number.addEventListener("click", function () {
			mynumber += this.innerHTML;
		
			number.className += " grow";
			input += index;
			dots[input.length - 1].className += " active";
			if (input.length == 4) {

console.log(mynumber);

				$.ajax({
      
					url:("http://localhost:8000/api/verification_code_lading"),
					method:"POST",
				   data:{
					token:token,
					code:mynumber
				   },
					success: function (data){
						//$('#staticBackdrop_3').data-bs-target;
						
						var obj=JSON.parse(data);
						if (obj.message=="erreur")
						{
							alert("Erreur");
							mynumber="";
							return
						}
						
						if (obj.message=="invalide")
						{
							alert("L'inscription n'est plus valide.");
							return
						}
						if (obj.message=="code wrong"){
							mynumber="";
							$('#message_code').html('Tentative restante '+obj.tentative );
							return
						}
						if (obj.message=="ok")
						{


							$('#staticBackdrop_3').modal('hide')
							$('#staticBackdrop_4').modal('show')							
							
							
						}
						
						
			
					},
					error: function (request, status, error) {
					alert("Erreur");
					return
					
			
				}
				});


				if (input != mynumber) {

					dots.forEach(function (dot, index) {
						dot.className += " wrong";
					});
					document.body.className += " wrong";
				} else {
					dots.forEach(function (dot, index) {
						dot.className += " correct";
					});
					document.body.className += " correct";
				}
				setTimeout(function () {
					dots.forEach(function (dot, index) {
						dot.className = "dot";
					});
					input = "";
				}, 900);
				setTimeout(function () {
					document.body.className = "";
				}, 2000);
			}
			setTimeout(function () {
				number.className = "number";
			}, 1000);
		});
	});
})();









function test(){


	
	
	
var email=$("#email_id").val();
var name=$("#name_id").val();
var prenom=$("#prenom_id").val();
var password=$("#password_id").val();

var d=false;

if(email=="")
{
	$('#span_email').html("L'adresse email est obligatoire");
	d=true;
}else{
	$('#span_email').html("");
}
if(name=="")
{
	$('#span_name').html("Le nom est obligatoire");
	d=true;
}else{
	$('#span_name').html("");
}
if(prenom=="")
{
	$('#span_prenom').html("Le prénom est obligatoire");
	d=true;
}else{
	$('#span_prenom').html("");
}
if(password=="")
{
	$('#span_password').html("Le mot de passe est obligatoire");
	d=true;
}else{
	$('#span_password').html("");
}
if ($("#flexCheckDefault").prop('checked')== false){
	$('#span_condition').html("Vous devez accepter les conditions");
	d=true;
   }else{
	$('#span_condition').html("");
}
if(d==true)
{
	d=false;
	return
}




	$.ajax({
      
        url:("http://localhost:8000/api/inscription"),
        method:"POST",
       data:{
		email:email,
		name:name,
		prenom:prenom,
		password:password
       },
        success: function (data){
			//$('#staticBackdrop_3').data-bs-target;
			
			
			if (data=="erreur")
			{
				alert("Erreur");
				return
			}
			if (data=="email used")
			{
				alert("Cette adresse mail est déjà utilisé");
				return
			}
			var obj=JSON.parse(data);
			if(obj.message=="ok")
			{
				token=obj.token;
				$('#staticBackdrop_2').modal('hide')
				$('#staticBackdrop_3').modal('show')
			}
			

        },
        error: function (request, status, error) {
        alert("Erreur");
		

    }
    });


}



/* **********************************************************************************felicitation google *********************************************************************/

const Confettiful = function(el) {
    this.el = el;
    this.containerEl = null;
    
    this.confettiFrequency = 3;
    this.confettiColors = ['#EF2964', '#00C09D', '#2D87B0', '#48485E','#EFFF1D'];
    this.confettiAnimations = ['slow', 'medium', 'fast'];
    
    this._setupElements();
    this._renderConfetti();
  };
  
  Confettiful.prototype._setupElements = function() {
    const containerEl = document.createElement('div');
    const elPosition = this.el.style.position;
    
    if (elPosition !== 'relative' || elPosition !== 'absolute') {
      this.el.style.position = 'relative';
    }
    
    containerEl.classList.add('confetti-container');
    
    this.el.appendChild(containerEl);
    
    this.containerEl = containerEl;
  };
  
  Confettiful.prototype._renderConfetti = function() {
    this.confettiInterval = setInterval(() => {
      const confettiEl = document.createElement('div');
      const confettiSize = (Math.floor(Math.random() * 3) + 7) + 'px';
      const confettiBackground = this.confettiColors[Math.floor(Math.random() * this.confettiColors.length)];
      const confettiLeft = (Math.floor(Math.random() * this.el.offsetWidth)) + 'px';
      const confettiAnimation = this.confettiAnimations[Math.floor(Math.random() * this.confettiAnimations.length)];
      
      confettiEl.classList.add('confetti', 'confetti--animation-' + confettiAnimation);
      confettiEl.style.left = confettiLeft;
      confettiEl.style.width = confettiSize;
      confettiEl.style.height = confettiSize;
      confettiEl.style.backgroundColor = confettiBackground;
      
      confettiEl.removeTimeout = setTimeout(function() {
        confettiEl.parentNode.removeChild(confettiEl);
      }, 3000);
      
      this.containerEl.appendChild(confettiEl);
    }, 25);
  };
  
  window.confettiful = new Confettiful(document.querySelector('.js-container'));
  
  
  







