<?php

namespace EFive\Bale\Tests\Unit;

use EFive\Bale\FileUpload\InputFile;
use EFive\Bale\Tests\TestCase;

class InputFileTest extends TestCase
{
    public function test_input_file_from_contents(): void
    {
        $file = InputFile::createFromContents('file content here', 'sample.txt');

        $this->assertSame('sample.txt', $file->getFilename());
        $this->assertSame('file content here', (string) $file->getContents());
    }

    public function test_input_file_from_file(): void
    {
        $temp = tempnam(sys_get_temp_dir(), 'bale_test_');
        file_put_contents($temp, 'test data');

        $file = InputFile::file($temp);

        $this->assertSame(basename($temp), $file->getFilename());
        $this->assertSame('test data', (string) $file->getContents());

        @unlink($temp);
    }
}
