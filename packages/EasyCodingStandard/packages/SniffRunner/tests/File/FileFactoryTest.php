<?php declare(strict_types=1);

namespace Symplify\EasyCodingStandard\SniffRunner\Tests\File;

use PHP_CodeSniffer\Files\File as BaseFile;
use Symplify\EasyCodingStandard\HttpKernel\EasyCodingStandardKernel;
use Symplify\EasyCodingStandard\SniffRunner\File\File;
use Symplify\EasyCodingStandard\SniffRunner\File\FileFactory;
use Symplify\EasyCodingStandard\SniffRunner\Fixer\Fixer;
use Symplify\PackageBuilder\FileSystem\SmartFileInfo;
use Symplify\PackageBuilder\Tests\AbstractKernelTestCase;

final class FileFactoryTest extends AbstractKernelTestCase
{
    /**
     * @var FileFactory
     */
    private $fileFactory;

    protected function setUp(): void
    {
        $this->bootKernel(EasyCodingStandardKernel::class);

        $this->fileFactory = self::$container->get(FileFactory::class);
    }

    public function test(): void
    {
        $fileInfo = new SmartFileInfo(__DIR__ . '/FileFactorySource/SomeFile.php');
        $file = $this->fileFactory->createFromFileInfo($fileInfo);
        $this->assertInstanceOf(File::class, $file);
        $this->assertInstanceOf(BaseFile::class, $file);
        $this->assertInstanceOf(Fixer::class, $file->fixer);
    }
}
