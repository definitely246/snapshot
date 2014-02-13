<?php include ("headers.js") ?>

var address = "<?= $options->url ?>";
var output = "<?= $options->path ?>";
var paperSize = "<?= $options->size ?>";
var zoomFactor = "<?= $options->zoom ?>";

page.viewportSize = { width: 600, height: 600 };

if (output.substr(-4) === ".pdf")
{
    size = paperSize.split('*');
    page.paperSize = size.length === 2 ? { width: size[0], height: size[1], margin: '0px' }
                                       : { format: paperSize, orientation: 'portrait', margin: '1cm' };
}
else if (paperSize.substr(-2) === "px")
{
    size = paperSize.split('*');
    if (size.length === 2)
    {
        pageWidth = parseInt(size[0], 10);
        pageHeight = parseInt(size[1], 10);
        page.viewportSize = { width: pageWidth, height: pageHeight };
        page.clipRect = { top: 0, left: 0, width: pageWidth, height: pageHeight };
    }
    else
    {
        pageWidth = parseInt(paperSize, 10);
        pageHeight = parseInt(pageWidth * 3/4, 10); // it's as good an assumption as any
        page.viewportSize = { width: pageWidth, height: pageHeight };
    }
}

if (zoomFactor.length > 0)
{
    page.zoomFactor = zoomFactor;
}

page.open(address, function (status)
{
    console.log(JSON.stringify(response, undefined, 4));

    if (status === 'success')
    {
        window.setTimeout(function ()
        {
            page.render(output);
            phantom.exit();
        }, 200);
    }
});