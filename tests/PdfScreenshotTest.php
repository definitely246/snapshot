<?php namespace Definitely246\Snapshot;

class PdfScreenshotTest extends \PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		$base = __DIR__;
		$this->url = "http://www.keltdockins.com";
		$this->pdf = "$base/files/test.pdf";
	}

	public function tearDown()
	{
		if (file_exists($this->pdf))
		{
			unlink($this->pdf);
		}
	}

	public function screenshot()
	{
		return new PdfSnapshot;
	}

	public function testBasicExample()
	{
		$outcome = $this->screenshot()->snapshot($this->url, $this->pdf);
		$this->assertEquals($this->pdf, $outcome);
	}

	public function testAsyncExample()
	{
		$outcome = $this->screenshot()->snapshotInBackground($this->url, $this->pdf);
		$this->assertEquals($this->pdf, $outcome);
	}
}
