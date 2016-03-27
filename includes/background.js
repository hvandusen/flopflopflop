
var ctr = new paper.Point(window.innerWidth*2,window.innerHeight*2);
var bounds = new paper.Point(window.innerWidth*2,window.innerHeight);
var spex = {
	x:Math.floor(Math.random()*40),
	y:Math.floor(Math.random()*40),
	size: 3+Math.random()*15,
}
var count = Math.floor(Math.random()*600)//Math.floor(Math.random()*1536);

var speed = 2//Math.floor(Math.random()*3)
var difference = 300//Math.random()*100
var background = new paper.Path.Rectangle(paper.view.bounds);
	background.fillColor = {
		gradient:{
			stops:[[whl(count),'0'],[whl(count+difference),'.5'],[whl(count+difference),'1']]},
			origin: [0,Math.random()*screen.availHeight],
			destination: [screen.availWidth+150,Math.random()*screen.availHeight]
					}
function whl(entry)
				{
						var key;
						entry = entry%1535
						var text = "rgb(";
						var num = entry%256;
						if(entry >= 0 && entry < 256)
							text= text+ "0,255,"+num+")";
						else if(entry>255 && entry<512)
				text= text+ "0,"+(255-num)+",255)";
			else if(entry>511 && entry<768)
							text= text+ num +",0,255)";
			else if(entry>767 && entry<1024)
							text= text+ "255,0,"+(255-num)+")";
						else if(entry>1023 && entry<1280)
							text= text+ "255,"+num+",0)";
						else //if(entry>1279 && entry<1535)
							text= text+ "0,"+(255-num)+",255)";//text= text+ (255-num)+",255,0)";
						return text;
				}



function onMouseMove(ev){
	$('#myCanvas').css('z-index') !== '-1' && $('#myCanvas').css('z-index','-1');

	pt = [ev%window.outerWidth,ctr.y]
	stopLocation = .5+Math.sin(ev.count/100)*.5
	percentString = stopLocation.toString();
	count+=speed;
 background.fillColor = {
		gradient:{
			stops:[[whl(count),'0'],[whl(count+difference),percentString],[whl(count+difference),'1']]},
			origin: [-50,screen.availHeight/2],
			destination: [screen.availWidth+150,screen.availHeight/2]
					}
}
if(navigator.userAgent.indexOf('iPhone')>0)
$('#myCanvas').remove()
