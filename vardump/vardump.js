proceedVarDump();

function proceedVarDump()
{

    var xdebs = document.getElementsByClassName('xdebug-var-dump');

    if (xdebs.length > 0)
    {
        var wrapHtml = document.createElement('div'),
            hndlrHtml = document.createElement('div'),
            body = document.getElementsByTagName('body')[0];

        wrapHtml.setAttribute('class','vdWrapper');
        hndlrHtml.setAttribute('class','vdHndl');

        body.appendChild(hndlrHtml);
        body.appendChild(wrapHtml);

        while (xdebs.length>0) {
            wrapHtml.innerHTML += '<pre>'+xdebs[0].innerHTML+'</pre>';
            xdebs[0].parentNode.removeChild(xdebs[0])
        }

        hndlrHtml.addEventListener('click', function () {
            body.classList.toggle('vd_show')
        });

    }
}
