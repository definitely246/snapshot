var page = require('webpage').create();
var system = require('system');
var response = {}

if (typeof cookie !== 'undefined' && cookie != null)
{
    phantom.addCookie(cookie);
}

if (typeof headers !== 'undefined')
{
	page.customHeaders = headers;
}

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