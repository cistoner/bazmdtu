
function blur_func(id1,id2,text)
{
	var x=document.getElementById(id1);
	var y=document.getElementById(id2);
	if(x.value=="")
	{
		y.innerHTML=text;
	}
	else
	{
		y.innerHTML="";
	}
}