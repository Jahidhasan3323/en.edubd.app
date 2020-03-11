function HTMLtoPDF(){
	//event.preventDefault();
var pdf = new jsPDF('p', 'pt', 'letter');
source = $('#forPdf')[0];
specialElementHandlers = {
	'#bypassme': function(element, renderer){
		return true
	}
};
margins = {
    top: 50,
    left: 60,
    width: 545
  };
pdf.fromHTML(
  	source // HTML string or DOM elem ref.
  	, margins.left // x coord
  	, margins.top // y coord
  	, {
  		'width': margins.width // max width of content on PDF
  		, 'elementHandlers': specialElementHandlers
  	},
  	function (dispose) {
  	  // dispose: object with X, Y of the last line add to the PDF
  	  //          this allow the insertion of new lines after html
        pdf.save('result.pdf');
      }
  )		
}

// function printPage() {
// 	document.getElementById('forPdf').print();
// }

$(document).ready(function () {
	$('#print').on('click', function () {
		var mode = 'iframe';
		var close = mode == "pupup";
		var option = {mode:mode, popClose: close};
		$('#forPdf').printArea(option);
    })
});