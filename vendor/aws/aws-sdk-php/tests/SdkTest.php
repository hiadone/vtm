<?php
namespace Aws\Test;

use Aws\AwsClientInterface;
use Aws\MultiRegionClient;
use Aws\S3\S3MultiRegionClient;
use Aws\Sdk;

/**
 * @covers Aws\Sdk
 */
class SdkTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \BadMethodCallException
     */
    public function testEnsuresMissingMethodThrowsException()
    {
        (new Sdk)->foo();
    }

    public function testHasMagicMethods()
    {
        $sdk = $this->getMockBuilder('Aws\Sdk')
            ->setMethods(['createClient'])
            ->getMock();
        $sdk->expects($this->once())
            ->method('createClient')
            ->with('Foo', ['bar' => 'baz']);
        $sdk->createFoo(['bar' => 'baz']);
    }

    public function testCreatesClients()
    {
        $this->assertInstanceOf(
            AwsClientInterface::class,
            (new Sdk)->createDynamoDb([
                'region'  => 'us-east-1',
                'version' => 'latest'
            ])
        );
    }

    public function testCreatesMultiRegionClients()
    {
        $multiregionS3 = (new Sdk)->createMultiRegionS3([
            'version' => 'latest',
        ]);

        $this->assertInstanceOf(AwsClientInterface::class, $multiregionS3);
        $this->assertInstanceOf(MultiRegionClient::class, $multiregionS3);
        $this->assertInstanceOf(S3MultiRegionClient::class, $multiregionS3);
    }

    public function testCreatesClientsWithAlias()
    {
        $this->assertInstanceOf(
            AwsClientInterface::class,
            (new Sdk)->createCloudWatch([
                'region'  => 'us-east-1',
                'version' => 'latest'
            ])
        );
    }
}
