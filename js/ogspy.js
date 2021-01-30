/* JS OGSpy global */
/*eslint camelcase: ["error", {properties: "never"}]*/
'use strict';
// includes/admin_members.php
function _admin_visible(byId) {
	document.getElementById(byId).style.visibility = 'visible';
	document.getElementById(byId).style.display = 'block';
}
function _admin_unvisible(byId) {
	document.getElementById(byId).style.visibility = 'hidden';
	document.getElementById(byId).style.display = 'none';
}
function ogspy_beginCreateUser() {
	_admin_visible('createNewPlayer');
	_admin_unvisible('creatingNewPlayer');
}
function ogspy_endCreateUser() {
	_admin_visible('creatingNewPlayer');
	_admin_unvisible('createNewPlayer');
}
// views/profile.php
function ogspy_checkPassword(form, message) {
	var old_password = form.old_password.value;
	var new_password = form.new_password.value;
	var new_password2 = form.new_password2.value;

	if (typeof(message) == 'undefined') {
		var message = new Array();
		message['PROFILE_ERROR_RETRY']   = 'Saisissez le nouveau mot de passe et sa confirmation.';
		message['PROFILE_ERROR_OLDPWD']  = "Saisissez l'ancien mot de passe.";
		message['PROFILE_ERROR_ERROR']   = 'Le mot de passe saisi est différent de la confirmation !';
		message['PROFILE_ERROR_ILLEGAL'] = "Le mot de passe doit contenir entre 6 et 15 caractères et pas les caractères suivants : ;'&quot; !";
	}
	if (old_password !== '' && (new_password === '' || new_password2 === '')) {
		window.alert(message['PROFILE_ERROR_RETRY']);
		return false;
	}
	if (old_password === '' && (new_password !== '' || new_password2 !== '')) {
		window.alert(message['PROFILE_ERROR_OLDPWD']);
		return false;
	}
	if (old_password !== '' && new_password !== new_password2) {
		window.alert(message['PROFILE_ERROR_ERROR']);
		return false;
	}
	if (old_password !== '' && new_password !== '' && new_password2 !== '') {
		if (new_password.length < 6 || new_password.length > 64 || !new_password.match("^[^;\"']{6,64}$")) {
			window.alert(message['PROFILE_ERROR_ILLEGAL']);
			return false;
		}
	}
	return true;
}
// views/menu.php
function ogspy_runTimer() {
	if (document.getElementById('datetime') !== null) {
		var date = new Date();
		var options = { weekday: 'short', year: 'numeric', month: 'short', day: 'numeric' };
		
		document.getElementById('datetime').innerText = date.toLocaleString('fr-FR', options) + ' ' + date.toLocaleTimeString();
		
		setTimeout('ogspy_runTimer()', 1000);
	}
}

// Global debut
function ogspy_run() {
	ogspy_runTimer();
}

/* @see w3color.js ver.1.18 by w3schools.com */
function _getColorArr(x) {
	const colors = {'names': ['AliceBlue','AntiqueWhite','Aqua','Aquamarine','Azure','Beige','Bisque','Black','BlanchedAlmond','Blue','BlueViolet','Brown','BurlyWood','CadetBlue','Chartreuse','Chocolate','Coral','CornflowerBlue','Cornsilk','Crimson','Cyan','DarkBlue','DarkCyan','DarkGoldenRod','DarkGray','DarkGrey','DarkGreen','DarkKhaki','DarkMagenta','DarkOliveGreen','DarkOrange','DarkOrchid','DarkRed','DarkSalmon','DarkSeaGreen','DarkSlateBlue','DarkSlateGray','DarkSlateGrey','DarkTurquoise','DarkViolet','DeepPink','DeepSkyBlue','DimGray','DimGrey','DodgerBlue','FireBrick','FloralWhite','ForestGreen','Fuchsia','Gainsboro','GhostWhite','Gold','GoldenRod','Gray','Grey','Green','GreenYellow','HoneyDew','HotPink','IndianRed','Indigo','Ivory','Khaki','Lavender','LavenderBlush','LawnGreen','LemonChiffon','LightBlue','LightCoral','LightCyan','LightGoldenRodYellow','LightGray','LightGrey','LightGreen','LightPink','LightSalmon','LightSeaGreen','LightSkyBlue','LightSlateGray','LightSlateGrey','LightSteelBlue','LightYellow','Lime','LimeGreen','Linen','Magenta','Maroon','MediumAquaMarine','MediumBlue','MediumOrchid','MediumPurple','MediumSeaGreen','MediumSlateBlue','MediumSpringGreen','MediumTurquoise','MediumVioletRed','MidnightBlue','MintCream','MistyRose','Moccasin','NavajoWhite','Navy','OldLace','Olive','OliveDrab','Orange','OrangeRed','Orchid','PaleGoldenRod','PaleGreen','PaleTurquoise','PaleVioletRed','PapayaWhip','PeachPuff','Peru','Pink','Plum','PowderBlue','Purple','RebeccaPurple','Red','RosyBrown','RoyalBlue','SaddleBrown','Salmon','SandyBrown','SeaGreen','SeaShell','Sienna','Silver','SkyBlue','SlateBlue','SlateGray','SlateGrey','Snow','SpringGreen','SteelBlue','Tan','Teal','Thistle','Tomato','Turquoise','Violet','Wheat','White','WhiteSmoke','Yellow','YellowGreen'],
			'hexs': ['f0f8ff','faebd7','00ffff','7fffd4','f0ffff','f5f5dc','ffe4c4','000000','ffebcd','0000ff','8a2be2','a52a2a','deb887','5f9ea0','7fff00','d2691e','ff7f50','6495ed','fff8dc','dc143c','00ffff','00008b','008b8b','b8860b','a9a9a9','a9a9a9','006400','bdb76b','8b008b','556b2f','ff8c00','9932cc','8b0000','e9967a','8fbc8f','483d8b','2f4f4f','2f4f4f','00ced1','9400d3','ff1493','00bfff','696969','696969','1e90ff','b22222','fffaf0','228b22','ff00ff','dcdcdc','f8f8ff','ffd700','daa520','808080','808080','008000','adff2f','f0fff0','ff69b4','cd5c5c','4b0082','fffff0','f0e68c','e6e6fa','fff0f5','7cfc00','fffacd','add8e6','f08080','e0ffff','fafad2','d3d3d3','d3d3d3','90ee90','ffb6c1','ffa07a','20b2aa','87cefa','778899','778899','b0c4de','ffffe0','00ff00','32cd32','faf0e6','ff00ff','800000','66cdaa','0000cd','ba55d3','9370db','3cb371','7b68ee','00fa9a','48d1cc','c71585','191970','f5fffa','ffe4e1','ffe4b5','ffdead','000080','fdf5e6','808000','6b8e23','ffa500','ff4500','da70d6','eee8aa','98fb98','afeeee','db7093','ffefd5','ffdab9','cd853f','ffc0cb','dda0dd','b0e0e6','800080','663399','ff0000','bc8f8f','4169e1','8b4513','fa8072','f4a460','2e8b57','fff5ee','a0522d','c0c0c0','87ceeb','6a5acd','708090','708090','fffafa','00ff7f','4682b4','d2b48c','008080','d8bfd8','ff6347','40e0d0','ee82ee','f5deb3','ffffff','f5f5f5','ffff00','9acd32']};
	if (x === 'names' || x === 'hexs') {
		return colors[x];
	}
	return colors;
}
function ogspy_isColor(x) {
	var colors = _getColorArr();
	if (typeof(x) === 'string') {
		x = x.replace('#', ''); //cas '#xxyyzz'
	}
	if (typeof(x) === 'number') {
		var hex = x.toString(16);
		x = '000000'.substr(0, 6 - hex.length) + hex;
	}
	for (var i = 0 ; i < colors['names'].length ; i++) {
		if (x.toLowerCase() === colors['names'][i].toLowerCase() || x.toLowerCase() === colors['hexs'][i].toLowerCase()) {
			return {'name': colors['names'][i], 'hex': colors['hexs'][i]};
		}
	}
	return false;
}
function ogspy_colorDoubleChange(id) {
	var value = document.getElementById(id).value;
	var color = ogspy_isColor(value);
	var baseid = id.replace('colorname_', '');
	if (color === false) {
		return; //no change
	}
	document.getElementById('colorname_' + baseid).value = color['name'];
	document.getElementById(baseid).value = '#' + color['hex'];
}
