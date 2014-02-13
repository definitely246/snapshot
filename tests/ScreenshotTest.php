<?php namespace Definitely246\Snapshot;

class ScreenshotTest extends \PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		$base = __DIR__;
		$this->url = "http://www.keltdockins.com";
		$this->pdf = "$base/files/test.pdf";
	}

	public function screenshot()
	{
		return new Snapshot(new PdfSnapshot);
	}

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testBasicExample()
	{
		$outcome = $this->screenshot()->pdf($this->url, $this->pdf);
		$this->assertEquals($this->pdf, $outcome);
	}
}