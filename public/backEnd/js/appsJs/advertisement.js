
/**
 * Created by Mehedi on 19-Feb-2019.
 */
var openFile = function(event,i) {
var input = event.target;
var reader = new FileReader();
reader.onload = function(){
var dataURL = reader.result;
var output = document.getElementById('photo_up'+i);
output.src = dataURL;
};
reader.readAsDataURL(input.files[0]);
};
