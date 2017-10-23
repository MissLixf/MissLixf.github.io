
function random(min,max){
	return Math.floor(Math.random()*(max-min+1)+min);
}
function snake(obj){
	this.content=obj.content;
	this.head=obj.head;
	this.new=null;//新创建出来的div
	this.bodys=[];
	this.minBody=obj.minBody;
	this.bodys.push(this.head);
	this.bodys.push(this.minBody[1]);
	this.bodys.push(this.minBody[0]);
	var x=[];//移动上一次的x坐标
	var y=[];//移动上一次的y坐标
	this.getXY=function(arr){
		x=[];
		y=[];
		for(var i=0;i<arr.length;i++){
			x.push(arr[i].offsetLeft);
			y.push(arr[i].offsetTop);
		}
	}
	this.die=function(arr){
		// console.log(this.head.offsetLeft);
		if(this.head.offsetTop<0 || this.head.offsetLeft<0 || this.head.offsetTop>580 || this.head.offsetLeft>780){
			alert("游戏结束");
			return 0;
		}
		for(var i=2;i<arr.length;i++){
			if(this.head.offsetTop>arr[i].offsetTop-20 && this.head.offsetTop<arr[i].offsetTop+20 && this.head.offsetLeft>arr[i].offsetLeft-20 && this.head.offsetLeft<arr[i].offsetLeft+20){
				alert("游戏结束");
				return 0;
			}
		}
		return 1;
	}
	this.createbody=function(){
		var color="rgb("+random(20,200)+","+random(20,200)+","+random(80,200)+")";
		var div=document.createElement("div");
		div.className="bodyBox";
		div.style.backgroundColor=color;
		var x=-1;
		var y=-1;
		while(x%20!=0||y%20!=0){
			x=random(20,780);
			y=random(20,580);
		}
		div.style.left=x+'px';
		div.style.top=y+'px';
		this.content.append(div);
		this.new=div;
	}	
	this.offTop=0;
	this.offLeft=0;
	this.move=function(){
		var temp=this;
		window.onkeydown=function(e){
			temp.offTop=temp.head.offsetTop;
			temp.offLeft=temp.head.offsetLeft;
			var ev=e || window.event;
			switch (e.keyCode){
				case 37:
					temp.head.style.left=temp.offLeft-20+"px";
					temp.grow();
					temp.allmove(temp.bodys);
					temp.getXY(temp.bodys);
					var flag=temp.die(temp.bodys);
					if(flag==0){
						window.onkeydown=null;
					}
					break;
				case 38:
					temp.head.style.top=temp.offTop-20+"px";
					temp.grow();
					temp.allmove(temp.bodys);
					temp.getXY(temp.bodys);
					var flag=temp.die(temp.bodys);
					if(flag==0){
						window.onkeydown=null;
					}
					break;
				case 39:
					temp.head.style.left=temp.offLeft+20+'px';
					temp.grow();
					temp.allmove(temp.bodys);
					temp.getXY(temp.bodys);
					var flag=temp.die(temp.bodys);
					if(flag==0){
						window.onkeydown=null;
					}
					break;
				case 40:
					temp.head.style.top=temp.offTop+20+'px';
					temp.grow();
					temp.allmove(temp.bodys);
					temp.getXY(temp.bodys); 
					var flag=temp.die(temp.bodys);
					if(flag==0){
						window.onkeydown=null;
					}
					break;
			}
		}	
	}
	this.move();
	this.createBox=function(){
		this.createbody();
	}
	this.createBox();
	this.grow=function(){
		var headOffsetTop=this.head.offsetTop;
		var headOffsetLeft=this.head.offsetLeft;
		if(this.new.offsetLeft==headOffsetLeft&&this.new.offsetTop==headOffsetTop){
			var newBodyColor=getComputedStyle(this.new,null).backgroundColor;
			var theBox=document.createElement("div");
			theBox.className="bodyBox";
			theBox.style.backgroundColor=newBodyColor;
			this.content.removeChild(this.new);
			var a=Math.random()*10>7?'<span class="glyphicon glyphicon-certificate" aria-hidden="true"></span>':'';
			theBox.innerHTML=a;
			this.content.appendChild(theBox);
			this.bodys.push(theBox);
			this.createbody();
		}
	}
	this.allmove=function(arr){
		for(var i=1;i<arr.length;i++){
			arr[i].style.left=x[i-1]+'px';
			arr[i].style.top=y[i-1]+'px';
		}
	}

}



