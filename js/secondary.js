/* function prettyRaCo()
        {
            var key =  Math.floor(Math.random()*6);
            var text = "rgb(";
            var num =  Math.floor(Math.random()*256);
            if(key ==0)
            text= text+ "0,255,"+num+")";
             if(key ==1)
            text= text+ "0,"+num+",255)";
             if(key ==2)
            text= text+ "255, 0,"+num+")";
             if(key ==3)
            text= text+ "255,"+num+",0)";
             if(key ==4)
            text= text+ num+",255,0)";
             if(key ==5)
            text= text+ num+",0,255)";
            return text;
        } */

        function prettyRaCo()
        {



            var colorWheel =  Math.floor(Math.random()*6);

            var color = "rgb(";
            var randomNumber =  Math.floor(Math.random()*256);
            if(colorWheel ==0)
            color= color+ "0,255,"+randomNumber+")";
             if(colorWheel ==1)
            color= color+ "0,"+randomNumber+",255)";
             if(colorWheel ==2)
            color= color+ "255, 0,"+randomNumber+")";
             if(colorWheel ==3)
            color= color+ "255,"+randomNumber+",0)";
             if(colorWheel ==4)
            color= color+ randomNumber+",255,0)";
             if(colorWheel ==5)
            color= color+ randomNumber+",0,255)";
            return color;
        }
function colorWheel(entry)
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
            else if(entry>1279 && entry<1535)
            	text= text+ (255-num)+",255,0)";
            return text;
        }
 function prettyRaCo2(whiteness)
        {
            var key =  Math.floor(Math.random()*6);
            var text = "rgb(";
            var num =  Math.floor(Math.random()*256);
            whiteness = whiteness%255;
            if(key ==0)
            text= text+ "0,255,"+whiteness+")";
             if(key ==1)
            text= text+ "0,"+whiteness+",255)";
             if(key ==2)
            text= text+ "255, 0,"+whiteness+")";
             if(key ==3)
            text= text+ "255,"+whiteness+",0)";
             if(key ==4)
            text= text+ whiteness+",255,0)";
             if(key ==5)
            text= text+ whiteness+",0,255)";
            return text;
        }
function ranHex(){
	var str = '#';
	var colors = ['ff','ff','ff']
	var which = Math.floor(Math.random()*3);
	var tokens = ['0','1','2','3','4','5','6','7','8','9','a','b','c','d','e','f']
	colors[which] = '00';
	var which2 = Math.floor(Math.random()*3);
	while(which === which2){
		which2 = Math.floor(Math.random()*3);
	}
	colors[which2] = 'ff';
	var which3 = Math.floor(Math.random()*3);
	while(which3 === which || which3 === which2){
		which3 = Math.floor(Math.random()*3);
	}
	colors[which3] = tokens[Math.floor(Math.random()*tokens.length)] +
		tokens[Math.floor(Math.random()*tokens.length)]
	str+= colors[0]+colors[1]+colors[2]
	return str;

}

Array.matrix = function(m,n,initial) {
	var a,i ,j,mat = [];
	for(i =0; i < m;i+=1){
		a = [];
		for(j = 0; j < n; j += 1) {
			a[j] = initial;
		}
		mat[i] = a;
	}
	return mat
};

function num(range){
  return Math.floor(Math.random()*range);
}
function numH(){
  return Math.floor(Math.random()*view.size.height);
}
function numW(){
  return Math.floor(Math.random()*view.size.width);
}

function downloadAsSVG(fileName) {

   if(!fileName) {
       fileName = "paperjs_example.svg"
   }

   var url = "data:image/svg+xml;utf8," + encodeURIComponent(paper.project.exportSVG({asString:true}));

   var link = document.createElement("a");
   link.download = fileName;
   link.href = url;
   link.click();
}
if(window.hasOwnProperty('paper'))
	{
	paper.Path.prototype.prt = function(wheel){
	if(wheel===undefined)
		this.fillColor = prettyRaCo();
	else
		this.fillColor = colorWheel(wheel);
	}
	paper.Path.prototype.grid = function(x,y,size){
		var columns = [];
		var groups = [];
		var offset = Math.floor(Math.random()*1536)
		width = window.innerWidth/x;
		height = window.innerHeight/y;
		if(size!==undefined){
			width = size;
			height = size;
			x = Math.ceil(window.innerWidth/size);
			y = Math.ceil(window.innerHeight/size);
		}
		for(var i=0;i<x;i++){
			columns[i] = [];
			groups[i] = new paper.Group();
			for(var j=0;j<y;j++){
				columns[i][j] = new paper.Path.Rectangle(i*width,j*height,width,height);
				columns[i][j].fillColor = colorWheel(offset+((i*j)/(x*y)*1536));//prettyRaCo();
				columns[i][j].scale(2)
				groups[i].children.push(columns[i][j]);
				}
			groups[i].scale(3);

		}
		this.columns = columns;
		return groups;
}
}
	console.dir(paper.Path.prototype)
  
