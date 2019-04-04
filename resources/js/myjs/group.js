$(document).ready(function(){
    var i=1;
    $('#add').click(function(){
        i++;
        $('#dynamic_field').append('<tr id="row'+i+'">'+
            '	<td>'+
            '		<input type="text" class="form-group" name="name[]"  placeholder="ok">'+
            '	</td>'+
            '	<td>'+
            '		<input type="button"  value="x" id="btn'+i+'" onclick="removeopt('+i+')"  class="btn btn-danger" >'+
            '	</td>'+
            '</tr>');
    });

});


function removeopt(j){ //ho usato la function cosi normale di js perche provando con $(clase bottone).click non riuscivo a farlo funzionare in alcun modo allora ho messo il onclick nel dom element
    $("#row"+j).remove();

}


//carosello delle imagini del gruppo
$('.carousel').carousel({
    interval: 2000
})

//il timer del prox evento
document.addEventListener('DOMContentLoaded', () => {

    // Unix timestamp (in seconds) to count down to
    var twoDaysFromNow = (new Date().getTime() / 1000) + (86400 * 2) + 1;

    // Set up FlipDown
    var flipdown = new FlipDown(twoDaysFromNow)

    // Start the countdown
        .start()

        // Do something when the countdown ends
        .ifEnded(() => {
            console.log('The countdown has ended!');
        });
});