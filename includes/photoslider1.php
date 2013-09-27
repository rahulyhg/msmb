<script language="javascript">

var photos<?=$member[id]?>=new Array()
var photoslink<?=$member[id]?>=new Array()
var which<?=$member[id]?>=0
var linkornot<?=$member[id]?>=0

//var linkornot=0
/*photoslink[0]="includes/popup.php?img=slide1.gif"
photoslink[1]="includes/popup.php?img=slide2.jpg"
photoslink[2]="includes/popup.php?img=slide3.jpg"*/

var preloadedimages<?=$member[id]?>=new Array()
for (i=0;i<photos<?=$member[id]?>.length;i++){
preloadedimages<?=$member[id]?>[i]=new Image()
preloadedimages<?=$member[id]?>[i].src=photos<?=$member[id]?>[i]
}


function applyeffect<?=$member[id]?>(){	
if (document.all){
try {
	document.getElementById("photoslider<?=$member[id]?>").filters.revealTrans.Transition=Math.floor(Math.random()*3)
	document.getElementById("photoslider<?=$member[id]?>").filters.revealTrans.stop()
	document.getElementById("photoslider<?=$member[id]?>").filters.revealTrans.apply()
	} catch(e) {
	}	
}
}



function playeffect<?=$member[id]?>(){
if (document.all)
document.getElementById("photoslider<?=$member[id]?>").filters.revealTrans.play()
}

function keeptrack<?=$member[id]?>(){
window.status="Logo "+(which<?=$member[id]?>+1)+" of "+photos<?=$member[id]?>.length
}


function backward<?=$member[id]?>(){
	
if (which<?=$member[id]?>>0){

	try {
	which<?=$member[id]?>--
	applyeffect<?=$member[id]?>()	
	document.images.photoslider<?=$member[id]?>.src=photos<?=$member[id]?>[which<?=$member[id]?>]
	//document.getElementById('photoslider<?=$member[id]?>').src=photos<?=$member[id]?>[which<?=$member[id]?>]
	document.getElementById('imgNum<?=$member[id]?>').innerHTML=which<?=$member[id]?>+1;	
	playeffect<?=$member[id]?>()
	keeptrack<?=$member[id]?>()	
	} catch(e) {
	}	
}else if(which<?=$member[id]?>==0){	
	
	try {
	which<?=$member[id]?>=photos<?=$member[id]?>.length-1;	
	applyeffect<?=$member[id]?>()	
	document.images.photoslider<?=$member[id]?>.src=photos<?=$member[id]?>[which<?=$member[id]?>]
	//document.getElementById('photoslider<?=$member[id]?>').src=photos<?=$member[id]?>[which<?=$member[id]?>]
	document.getElementById('imgNum<?=$member[id]?>').innerHTML=which<?=$member[id]?>+1;
	playeffect<?=$member[id]?>()
	keeptrack<?=$member[id]?>()	
	} catch(e) {
	}	

}
var imgurl = photos<?=$member[id]?>[which<?=$member[id]?>]
imgurl = imgurl.replace(/userthumbnail/g,"usernormal");
document.getElementById("img<?=$member[id]?>").src= imgurl
}

function forward<?=$member[id]?>(){
try{
if (which<?=$member[id]?><photos<?=$member[id]?>.length-1){

	which<?=$member[id]?>++
	applyeffect<?=$member[id]?>()
	document.images.photoslider<?=$member[id]?>.src=photos<?=$member[id]?>[which<?=$member[id]?>]
	document.getElementById('imgNum<?=$member[id]?>').innerHTML=which<?=$member[id]?>+1;
	playeffect<?=$member[id]?>()
	keeptrack<?=$member[id]?>()
} else if(which<?=$member[id]?>==photos<?=$member[id]?>.length-1){
	which<?=$member[id]?>=0;
	applyeffect<?=$member[id]?>()
	document.images.photoslider<?=$member[id]?>.src=photos<?=$member[id]?>[which<?=$member[id]?>]
	document.getElementById('imgNum<?=$member[id]?>').innerHTML=which<?=$member[id]?>+1;
	playeffect<?=$member[id]?>()
	keeptrack<?=$member[id]?>()
}
var imgurl = photos<?=$member[id]?>[which<?=$member[id]?>]
imgurl = imgurl.replace(/userthumbnail/g,"usernormal");
document.getElementById("img<?=$member[id]?>").src= imgurl
} catch(e) {
	}	
}
function transport<?=$member[id]?>( Newin ){
//window.open(photoslink[which],Newin,"ThisWindow","height=100px,width=100px,toolbar=no,directories=no,menubar=no,scrollbars=yes,top=0,left=0")

window.open(photoslink<?=$member[id]?>[which<?=$member[id]?>],Newin,"left=180, top=50, height=150,width=150,toolbar=no,scrollbars=no,menubar=no,resize=false");
}

</script>

