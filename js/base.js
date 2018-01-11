/**
 * MiniBase
 * --------
 * Version: 0.0.1
 */


/**
 * XHR methods
 */
function xhr_get(url, callback, timeout=10000){
    const xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function(){
	if(xhr.readyState != 4 || xhr.status != 200) return;
	callback(xhr.response);
    }

    xhr.open("GET", url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.timeout = timeout;
    xhr.send();
}

function xhr_post(url, params, callback, timeout=10000){
    const xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function(){
	if(xhr.readyState != 4 || xhr.status != 200) return;
	callback(xhr.response);
    }

    params = params.map(function(pair){ return pair[0] + "=" + pair[1] }).join("&");
    console.log(params);

    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(params);
}


/**
 * DOM methods
 */
function hasClass(object, class_name){
    return object.className.split(" ").indexOf(class_name) >= 0;
}

function toggleClass(object, class_name, force_to){
    const has_class = hasClass(object, class_name);
    if((force_to == true && !has_class) || (force_to == undefined && !has_class)){
	let classes = object.className.split(" ");
	classes.push(class_name);
	object.className = classes.join(" ");
    } else if(has_class && !force_to) {
	const classes = object.className.split(" ");
	classes.splice(classes.indexOf(class_name), 1);
	object.className = classes.join(" ");
    }
}

function closestParentByClassName(object, class_name){
    var node = object;
    for(var i = 0; i < 6; i++){
	if(node.className === undefined) break;
	if( hasClass( node, class_name )) return node;
	node = node.parentNode;
    }
    return null;
}

function is_on_page(object){
    if(!object) return false;

    var object_middle = object.offsetTop + (object.offsetHeight/2);
    var window_top = pageYOffset;
    var window_bottom = window_top + window.innerHeight;

    if(object_middle > window_bottom || object_middle < window_top) return false;
    return true;
}
