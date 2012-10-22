var FILEPATH = location.pathname.split('/');
var FILENAME = FILEPATH[FILEPATH.length-1];

var menu_items = [6];
menu_items[0] = new Array('projects.php', 'Main JMF projects page'); //home (or main) page
menu_items[1] = new Array('projects_sourceforge.php', 'SourceForge.net'); //subsequent pages . . .
menu_items[2] = new Array('projects_devjavanet.php', 'Dev.java.net');
menu_items[3] = new Array('projects_misc.php', 'Miscellaneous open-source');
menu_items[4] = new Array('projects_commercial.php', 'Commercial');
menu_items[5] = new Array('projects_dead.php', 'Dead or unmaintained');
				
/*
var menu_items = {
					0: new Array('projects.php', 'Main JMF projects page'), //home (or main) page
					1: new Array('projects_sourceforge.php', 'Sourceforge.net'), //subsequent pages . . .
					2: new Array('projects_devjavanet.php', 'Dev.java.net'),
					3: new Array('projects_misc.php', 'Miscellaneous open-source'),
					4: new Array('projects_commercial.php', 'Commercial'),
					5: new Array('projects_dead.php', 'Dead or unmaintained')
				 };
				 */
function setNumberedMenu() {
	var data="";
	var mitem = "";
	var mdesc = "";
	
	data += '<table width="100%" border="0" cellspacing="0" cellpadding="0" >';

	for(var mindex=0; mindex < menu_items.length; mindex++) {
		data += '<tr><td style="height: 20px;"><strong>'+(mindex+1)+'.</strong> ';
		
		mitem = menu_items[mindex][0];
		mdesc = menu_items[mindex][1];
		
		if(FILENAME != mitem) {
			data += '<a href="'+mitem+'" title="'+mdesc+'" >'+mdesc+'</a>';
		}
		else {
			data += '<strong>'+mdesc+'</strong>';
		}
		
		data += '</td></tr>'; 
	}
	
	data += '</table>';
	
	$("#numberedmenu").hide();
	$("#numberedmenu").html(data);
	$("#numberedmenu").fadeIn("slow");
}

function setSliderMenu() {
	var data="";

	var prev_minx=0;
	var next_minx=0;
	var home_minx=0;
	
	for(var mindex=0; mindex<menu_items.length; mindex++) {
		if(FILENAME == menu_items[mindex][0]) { //we are currently at the index of current script filename
			if(mindex == 0) { //if its the first subsequent page (i.e. first one after root)
				prev_minx = menu_items.length - 1;
				next_minx = mindex + 1;
			}
			else if(menu_items.length - 1 == mindex) { //if its the last one
				prev_minx = mindex - 1;
				next_minx = 0;
			}
			else {
				prev_minx = mindex-1;
				next_minx = mindex+1;
			}
			
			break;
		} 
	}
	
	data += '<table width="100%" border="0" cellspacing="0" cellpadding="0" >';
	data += '<tr>'+
				'<td align="left" style="width: 40%;"><a href="'+menu_items[prev_minx][0]+'" title="Go back to \''+menu_items[prev_minx][1]+'\'" >&lt; '+menu_items[prev_minx][1]+'</a></td>'+
				'<td align="center" style="width: 20%;"><a href="'+menu_items[home_minx][0]+'" title="Home" >Home</a></td>'+
				'<td align="right" style="width: 40%;"><a href="'+menu_items[next_minx][0]+'" title="Move on to \''+menu_items[next_minx][1]+'\'" >'+menu_items[next_minx][1]+' &gt;</a></td>'+
			'</tr>'; 
	data += '</table>';
	
	$("#slidermenu").hide();
	$("#slidermenu").html(data);
	$("#slidermenu").fadeIn("slow");
}

