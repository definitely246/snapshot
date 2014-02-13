var page = require('webpage').create();
var system = require('system');
var response = {}
var headers = {};

page.settings.resourceTimeout = "30s";

page.onResourceTimeout = function(e)
{
    response        = e;
    response.status = e.errorCode;
};

page.onResourceReceived = function (r)
{
    if (!response.status) response = r;
};

page.customHeaders = headers ? headers : {};
