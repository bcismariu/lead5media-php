<?PHP

namespace Bcismariu\Lead5Media\Tests;

use Bcismariu\Lead5Media\Lead5Media;
use Bcismariu\Lead5Media\Exception;

class Lead5MediaTest extends TestCase
{
    protected $provider;

    public function setUp()
    {
        parent::setUp();
        $this->provider = $this->provider();
    }

    public function tearDown()
    {
        unset($this->provider);
        parent::tearDown();
    }

    /** @test */
    public function it_can_instantiate()
    {
        $this->assertInstanceOf(Lead5Media::class, $this->provider);
    }

    /** 
     * @test
     * @dataProvider methodProvider
     */
    public function it_can_map_methods($method, $field, $value)
    {
        $this->provider->$method($value);
        $this->assertArraySubset([$field => $value], $this->provider->getQueryParameters());
    }

    /** 
     * @test
     * @dataProvider methodProvider
     */
    public function it_can_chain_methods($method, $field, $value)
    {
        $this->assertInstanceOf(Lead5Media::class, $this->provider->$method($value));
    }

    /**
     * @test
     * @expectedException Exception
     */
    public function it_throws_exception_on_unknown_method()
    {
        $this->provider->unknownMethod('some-value');
    }

    /**
     * instantiates the job provider
     * @return Lead5Media
     */
    protected function provider()
    {
        return new Lead5Media('client-cid');
    }

    /**
     * sets method and value
     * @return array
     */
    public function methodProvider()
    {
        return [
            ['setCid',  'CID',  'CID-value'],
            ['setChid', 'CHID', 'CHID-value'],
            ['setQuery',    'q',    'q-value'],
            ['setLocation', 'l',    'l-value'],
            ['setRadius',   'r',    'r-value'],
            ['setStart',    'start',    'start-value'],
            ['setLimit',    'limit',    'limit-value'],
            ['setFormat',   'format',   'format-value'],
            ['setHighlight',    'highlight',    'highlight-value'],
            ['setSorting',  's',    's-value'],
            ['setAge',  'a',    'a-value'],
        ];
    }
}
