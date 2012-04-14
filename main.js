/*
 * vim: ts=4 sw=4 et wrap co=100
 */

$(document).ready(onLoadDocument);

// Event listeners. ////////////////////////////////////////////////////////////////////////////////

/*
 *
 */
function onLoadDocument(e)
{
    try
    {
        var f = 'onLoadDocument()';
        UTILS.checkArgs(f, arguments, [Function]);

        // TODO
        // ----
        // Adding an onClick listener for every td element on the page is far too slow.
        // Better to add a single onClick listener to the tbody element, then calculate
        // which td was clicked from mouse coordinates.
        $('td'        ).click(onClickTd    );
        $('input#load').click('onClickLoad');
        $('input#save').click('onClickSave');
        $('input#play').click('onClickPlay');
    }
    catch (e)
    {
        UTILS.printExceptionToConsole(f, e);
    }
}

/*
 * 
 */
function onClickTd(e)
{
    try
    {
        var f = 'onClickTd()';
        UTILS.checkArgs(f, arguments, [Object]);

        var td = e.target;

        if ($(td).hasClass('selected'))
        {
            $(td).removeClass('selected');
        }
        else
        {
            clearColumnOfSelectedFields($(td).index());
            $(td).addClass('selected');
        }
    }
    catch (e)
    {
        UTILS.printExceptionToConsole(f, e);
    }
}

/*
 *
 */
function onClickLoad(e)
{
    try
    {
        var f = 'onClickLoad()';
        UTILS.checkArgs(f, arguments, [Object]);
    }
    catch (e)
    {
        UTILS.printExceptionToConsole(f, e);
    }
}

/*
 *
 */
function onClickSave(e)
{
    try
    {
        var f = 'onClickSave()';
        UTILS.checkArgs(f, arguments, [Object]);
    }
    catch (e)
    {
        UTILS.printExceptionToConsole(f, e);
    }
}

/*
 *
 */
function onClickPlay(e)
{
    try
    {
        var f = 'onClickPlay()';
        UTILS.checkArgs(f, arguments, [Object]);

        var melodyString = getMelodyString();
    }
    catch (e)
    {
        UTILS.printExceptionToConsole(f, e);
    }
}

// Other functions. ////////////////////////////////////////////////////////////////////////////////

/* 
 *
 */
function getMelodyString(e)
{
    var f = 'getMelodyString()';
    UTILS.checkArgs(f, arguments, [Object]);

    var tbody        = $('tbody')[0];
    var trs          = $(tbody).children();
    var melodyString = '';

    for (var r = 0, rlen = trs.length; r < rlen; ++r)
    {
        var tr  = trs[r];
        var tds = $(tr).children();

        for (var c = 0, clen = tds.length; c < clen; ++c)
        {
            if ($(tds[c]).hasClass('selected'))
            {
                melodyString += getMidiNoteNoFromTr(tr);
            }
        }
    }
}

/*
 * 
 */
function clearColumnOfSelectedFields(colNo)
{
    var f = 'clearColumnOfSelectedFields()';
    UTILS.checkArgs(f, arguments, ['nonNegativeInt']);

    var tbody = $('tbody')[0];
    var trs   = $(tbody).children();

    for (var r = 0, rlen = trs.length; r < rlen; ++r)
    {
        var tds = $(trs[r]).children();
        $(tds[colNo]).removeClass('selected');
    }
}
