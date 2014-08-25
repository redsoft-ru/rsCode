/**
 * Created by mitrich on 25.08.14.
 */
function makRandString(len, unique)
{
    var ln = 12;
    if(typeof len != 'undefined')
    {
        ln = parseInt(len);
    }
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for( var i=0; i < ln; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));


    if(typeof unique != 'undefined')
    {
        var exists = $('#'+text);
        if(exists.length > 0)
        {
            return makRandString(ln,unique);
        }
    }

    return text;
}