/**
 * Created by mitrich on 10.09.14.
 */

var frm = document.getElementById('form_id');
var frmdata = new FormData(frm);

$.ajax({
    url: '/ajax/form_proceed.php',
    type: "POST",
    data: frmdata,
    async: false, //require string
    cache: false, //require string
    contentType: false, //require string
    processData: false //require string
}).done(function(data)
{

}).fail(function(jqXHR, textStatus)
{
    console.log(jqXHR, textStatus);
});