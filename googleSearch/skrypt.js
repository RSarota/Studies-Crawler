
$(document).ready(function(){
	$("#button").on('click',foo);
	$("#button1").on('click',foo);
	$(document).keypress(function(e){
		if(e.which == 13) {
			foo();
		}
	});
});

var foo=function(){	
		var data={};
		if(getPhrase()!=''){
		data['phrase']=getPhrase();
        $.ajax({
            type:"GET", 
            url: 'search.php',
			data: data,
            contentType:"application/json; charset=utf-8",
            dataType:'json', 
            success: function(response) {
				//alert('Success');
                refreshResults(response);
			},
			error: function(err) {
                    alert( "AJAX error");
                    console.log(err); 
                }
		});
		}
	};
function refreshResults(data){
	var i;
	var htmlText='';
	if(data==''){
		htmlText+='<div class="results-count">Brak wyników wyszukiwania</div>';
	}
	else{
		htmlText+='<div class="results-count">Znaleziono '+data.length+' wyników wyszukiwania</div>';
		for(i = 0; i < data.length; i++) {
			htmlText += '<div class="result"><div class="title">';
			if(data[i].title!=null){
				htmlText +=data[i].title + '</div><div class="link">';
			}
			else{
				htmlText +=data[i].url + '</div><div class="link">';
			}
			htmlText +=data[i].url + '</div><div class="description">';
			if(data[i].content!=null){
				htmlText+=data[i].content + '</div></div>';
			}
			else{
				htmlText+='</div></div>';
			}
		};
	}
	document.getElementById("results").innerHTML = htmlText;
};
function getPhrase(){
	var phrase=$('#phrase').val();
	return phrase;
}
