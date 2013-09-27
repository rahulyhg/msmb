<script language="javascript">
var photos=new Array()
var photoslink=new Array()
var which=0
var linkornot=0


var preloadedimages=new Array()
for (i=0;i<photos.length;i++){
preloadedimages[i]=new Image()
preloadedimages[i].src=photos[i]
}


function applyeffect(){
try {
	if (document.all){
	document.getElementById("photoslider").filters.revealTrans.Transition=Math.floor(Math.random()*3)
	document.getElementById("photoslider").filters.revealTrans.stop()
	document.getElementById("photoslider").filters.revealTrans.apply()
	}
} catch(e) {
}
}



function playeffect(){
try {
if (document.all)
document.getElementById("photoslider").filters.revealTrans.play()
} catch(e) {
}
}

function keeptrack(){
try {
window.status="Logo "+(which+1)+" of "+photos.length
} catch(e) {
}
}


function backward(){
try {
if (which>0){

	which--	
	applyeffect()	
	document.images.photoslider.src=photos[which]	
	document.getElementById('imgNum').innerHTML=which+1;
	playeffect()
	keeptrack()
}else if(which==0){
	which=photos.length-1;
	applyeffect()
	document.images.photoslider.src=photos[which]	
	document.getElementById('imgNum').innerHTML=which+1;
	playeffect()
	keeptrack()

}
} catch(e) {
}
}

function forward(){
try {
if (which<photos.length-1){
	which++
	applyeffect()
	document.images.photoslider.src=photos[which]
	document.getElementById('imgNum').innerHTML=which+1;
	playeffect()
	keeptrack()
} else if(which==photos.length-1){
	which=0;
	applyeffect()
	document.images.photoslider.src=photos[which]
	document.getElementById('imgNum').innerHTML=which+1;
	playeffect()
	keeptrack()
}
} catch(e) {
}
}
function transport( Newin ){
//window.open(photoslink[which],Newin,"ThisWindow","height=100px,width=100px,toolbar=no,directories=no,menubar=no,scrollbars=yes,top=0,left=0")

window.open(photoslink[which],Newin,"left=180, top=50, height=150,width=150,toolbar=no,scrollbars=no,menubar=no,resize=false");
}
</script>
