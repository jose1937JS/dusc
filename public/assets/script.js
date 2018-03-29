// codigo para el reloj
function reloj()
{
	var fecha    = new Date(),
		diasSem  = ['DOM','LUN','MAR','MIE','JUE','VIE','SAB'],
		meses    = ['ENE','FEB','MAR','ABR','MAY','JUN','JUL','AGO','SEP','OCT','NOV','DIC'],
		diasNum  = fecha.getDay(),
		numDia	 = fecha.getDate(),
		mesesNum = fecha.getMonth(),
		anio     = fecha.getFullYear(),
		horas	 = fecha.getHours(),
		min 	 = fecha.getMinutes(),
		seg		 = fecha.getSeconds(),
		elem 	 = document.getElementById('hora');

	if (horas<10){ horas= '0' + horas }
	if (min < 10) { min = '0' + min }
	if (seg < 10) { seg = '0' + seg }

	elem.innerHTML = diasSem[diasNum] +', '+ numDia +' '+ meses[mesesNum] +' '+ anio +' '+ horas +':'+ min +':'+ seg ; 
}

setInterval(reloj,  1000);
