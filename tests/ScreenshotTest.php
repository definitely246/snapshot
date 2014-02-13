<?php namespace Definitely246\Snapshot;

use StdClass;
use PHPUnit_Framework_TestCase;

class ScreenshotTest extends PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		$base = __DIR__;
		$paths = new StdClass;

		$paths->scripts = "$base/files";
		$paths->rasterize = "$base/../src/views/rasterize.js";
		$paths->phantomjs = "$base/../bin/phantomjs";
		$paths->testurl = "http://www.keltdockins.com";
		$paths->pdf = "$base/files/test.pdf";

		$this->paths = $paths;
	}

	public function screenshot()
	{
		$view = new PhpView($this->paths->rasterize);
		$engine = new PhantomEngine($this->paths->phantomjs, $this->paths->scripts);

		return new PdfSnapshot($engine, $view);
	}

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testBasicExample()
	{
		$results = $this->screenshot()->snapshot($this->paths->testurl, $this->paths->pdf);

		var_dump($results);
		
	}

}
